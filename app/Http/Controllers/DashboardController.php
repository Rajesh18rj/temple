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


        /*
        |--------------------------------------------------------------------------
        | Total Amount
        |--------------------------------------------------------------------------
        */

        $totalAmount = ReceiptDetail::whereIn(
            'receipt_id',
            $receiptIds
        )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Category-wise Contribution
        |--------------------------------------------------------------------------
        */

        $categoryTotals = Category::query()
            ->orderBy('display_order')
            ->orderBy('name')
            ->get()
            ->map(function ($category) use ($receiptIds) {

                $total = ReceiptDetail::where(
                    'category_id',
                    $category->id
                )
                    ->whereIn('receipt_id', $receiptIds)
                    ->sum('amount');

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'total' => (float) $total,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | Chart Data
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
            'toDate'
        ));
    }
}
