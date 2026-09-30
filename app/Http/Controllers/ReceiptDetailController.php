<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptDetailController extends Controller
{
    public function create(Receipt $receipt)
    {
        $categories = Category::orderBy('display_order')->get();

        return view('receipts.details', compact('receipt', 'categories'));
    }

    public function show(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category');

        return view('receipts.view', compact('receipt'));
    }

    public function store(Request $request, Receipt $receipt)
    {
        $request->validate([
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',

            'amounts' => 'nullable|array',
            'amounts.*' => 'nullable|numeric|min:0.01',

            // Payment Proof
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Check Manual Amount Categories
        |--------------------------------------------------------------------------
        */

        foreach ($request->categories as $categoryId) {

            $category = Category::findOrFail($categoryId);

            if ($category->amount === null) {

                $amount = $request->input("amounts.$categoryId");

                if ($amount === null || $amount <= 0) {
                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            "Please enter an amount for {$category->name}."
                        );
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save Receipt Details + Payment Proof
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($request, $receipt) {

            // Upload payment proof only if provided
            if ($request->hasFile('image')) {

                $imagePath = $request->file('image')
                    ->store('receipts', 'public');

                $receipt->update([
                    'image' => $imagePath,
                ]);
            }

            // Remove old details
            $receipt->receiptDetails()->delete();

            // Save selected categories
            foreach ($request->categories as $categoryId) {

                $category = Category::findOrFail($categoryId);

                if ($category->amount !== null) {
                    $amount = $category->amount;
                } else {
                    $amount = $request->input("amounts.$categoryId");
                }

                ReceiptDetail::create([
                    'receipt_id' => $receipt->id,
                    'category_id' => $category->id,
                    'amount' => $amount,
                ]);
            }
        });

        return redirect()
            ->route('receipts.index')
            ->with(
                'success',
                'Receipt details and payment proof saved successfully.'
            );
    }
}
