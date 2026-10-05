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

            // Payment proof is optional
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

            /*
            |--------------------------------------------------------------------------
            | Payment Proof
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                // Check upload validity
                if (!$file->isValid()) {
                    throw new \Exception(
                        'Payment proof upload failed: ' . $file->getErrorMessage()
                    );
                }

                // Public upload directory
                $uploadPath = public_path('uploads/receipts');

                // Create directory if it does not exist
                if (!is_dir($uploadPath)) {

                    mkdir($uploadPath, 0755, true);
                }

                // Check directory
                if (!is_dir($uploadPath)) {
                    throw new \Exception(
                        'Unable to create upload directory: ' . $uploadPath
                    );
                }

                // Generate unique filename
                $filename = time()
                    . '_'
                    . uniqid()
                    . '.'
                    . $file->getClientOriginalExtension();

                // Move uploaded file
                $file->move(
                    $uploadPath,
                    $filename
                );

                // Check file exists
                if (!file_exists($uploadPath . '/' . $filename)) {
                    throw new \Exception(
                        'Payment proof could not be saved.'
                    );
                }

                // Save path in database
                $receipt->update([
                    'image' => 'uploads/receipts/' . $filename,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Remove Old Receipt Details
            |--------------------------------------------------------------------------
            */

            $receipt->receiptDetails()->delete();

            /*
            |--------------------------------------------------------------------------
            | Save Selected Categories
            |--------------------------------------------------------------------------
            */

            foreach ($request->categories as $categoryId) {

                $category = Category::findOrFail($categoryId);

                if ($category->amount !== null) {

                    $amount = $category->amount;

                } else {

                    $amount = $request->input(
                        "amounts.$categoryId"
                    );
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
                'Receipt details saved successfully.'
            );
    }
}
