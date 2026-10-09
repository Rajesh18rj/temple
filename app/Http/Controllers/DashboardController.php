<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Date Filters
        |--------------------------------------------------------------------------
        */

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        /*
        |--------------------------------------------------------------------------
        | Base Receipt Query
        |--------------------------------------------------------------------------
        */

        $receiptQuery = Receipt::query();

        if ($fromDate) {
            $receiptQuery->whereDate('date', '>=', $fromDate);
        }

        if ($toDate) {
            $receiptQuery->whereDate('date', '<=', $toDate);
        }

        /*
        |--------------------------------------------------------------------------
        | Summary Cards
        |--------------------------------------------------------------------------
        */

        $totalReceipts = (clone $receiptQuery)->count();

        $totalCities = (clone $receiptQuery)
            ->whereNotNull('city_id')
            ->distinct('city_id')
            ->count('city_id');

        /*
        |--------------------------------------------------------------------------
        | Receipt IDs for Selected Date Range
        |--------------------------------------------------------------------------
        */

        $receiptIds = (clone $receiptQuery)->pluck('id');

        $recentReceipts = (clone $receiptQuery)
            ->with('city', 'receiptDetails')
            ->latest('id')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Total Amount
        |--------------------------------------------------------------------------
        */

        $totalAmount = (float) ReceiptDetail::query()
            ->whereIn('receipt_id', $receiptIds)
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Calculate Contribution Totals by Category
        |--------------------------------------------------------------------------
        |
        | Parent category:
        |     Annadhanam
        |       - Samanthakarargal
        |       - Thaimargal
        |
        | Receipt details are linked to the selected subcategory.
        | Parent totals are calculated from their subcategories.
        */

        $allCategories = Category::query()
            ->with('subcategories')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        // Calculate each category's receipt-detail total in one query.
        $detailTotals = ReceiptDetail::query()
            ->selectRaw('category_id, SUM(amount) as total')
            ->whereIn('receipt_id', $receiptIds)
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        // Display root categories and their subcategories.
        $categoryTotals = $allCategories
            ->whereNull('parent_id')
            ->map(function ($category) use (
                $detailTotals,
                $allCategories
            ) {
                $children = $allCategories
                    ->where('parent_id', $category->id)
                    ->map(function ($subcategory) use ($detailTotals) {
                        return [
                            'id' => $subcategory->id,
                            'name' => $subcategory->name,
                            'total' => (float) (
                            $detailTotals->get($subcategory->id, 0)
                            ),
                        ];
                    })
                    ->values();

                // If this category has children, total their amounts.
                // Otherwise, use its own receipt-detail total.
                $total = $children->isNotEmpty()
                    ? (float) $children->sum('total')
                    : (float) $detailTotals->get($category->id, 0);

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'total' => $total,
                    'subcategories' => $children,
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Chart Data: Main Category Totals
        |--------------------------------------------------------------------------
        */

        $chartLabels = $categoryTotals
            ->pluck('name')
            ->values()
            ->toArray();

        $chartData = $categoryTotals
            ->pluck('total')
            ->map(fn ($amount) => (float) $amount)
            ->values()
            ->toArray();

        return view('dashboard', compact(
            'totalReceipts',
            'totalCities',
            'totalAmount',
            'categoryTotals',
            'chartLabels',
            'chartData',
            'fromDate',
            'toDate',
            'recentReceipts'
        ));
    }
}
