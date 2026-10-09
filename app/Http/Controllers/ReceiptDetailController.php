<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReceiptDetailController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Receipt Details Form
    |--------------------------------------------------------------------------
    */

    public function create(Receipt $receipt)
    {
        // Load parent categories with their subcategories
        $categories = Category::with([
            'subcategories' => function ($query) {
                $query->orderBy('display_order')
                    ->orderBy('name');
            }
        ])
            ->whereNull('parent_id')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('receipts.details', compact(
            'receipt',
            'categories'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | View Receipt
    |--------------------------------------------------------------------------
    */

    public function show(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category.parent', 'city');

        return view('receipts.view', compact('receipt'));
    }


    /*
    |--------------------------------------------------------------------------
    | Save Receipt Details
    |--------------------------------------------------------------------------
    */


    public function store(Request $request, Receipt $receipt)
    {
        // Validate submitted data.
        $validated = $request->validate([
            'categories' => [
                'required',
                'array',
                'min:1',
            ],
            'categories.*' => [
                'required',
                'integer',
                'distinct',
                'exists:categories,id',
            ],
            'amounts' => [
                'nullable',
                'array',
            ],
            'amounts.*' => [
                'nullable',
                'numeric',
                'min:0.01',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Load selected categories and determine which have children.
        $selectedCategories = Category::withCount('subcategories')
            ->whereIn('id', $validated['categories'])
            ->get()
            ->keyBy('id');

        // Validate category selection and manual amounts.
        foreach ($validated['categories'] as $categoryId) {
            $category = $selectedCategories->get($categoryId);

            if (!$category) {
                return back()
                    ->withInput()
                    ->with('error', 'One or more selected categories are invalid.');
            }

            // A category with children cannot be selected directly.
            if ($category->subcategories_count > 0) {
                return back()
                    ->withInput()
                    ->with('error', 'Please select a subcategory instead of its parent.');
            }

            // Require a valid amount for categories without a fixed amount.
            if ($category->amount === null) {
                $amount = $request->input("amounts.$categoryId");

                if (
                    $amount === null ||
                    $amount === '' ||
                    !is_numeric($amount) ||
                    (float) $amount < 0.01
                ) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            "amounts.$categoryId" =>
                                "Please enter a valid amount for {$category->name}.",
                        ]);
                }
            }
        }

        try {
            DB::transaction(function () use (
                $request,
                $receipt,
                $validated,
                $selectedCategories
            ) {
                // Upload optional payment proof.
                if ($request->hasFile('image')) {
                    $file = $request->file('image');

                    if (!$file->isValid()) {
                        throw new \RuntimeException(
                            'Payment proof upload failed: ' .
                            $file->getErrorMessage()
                        );
                    }

                    $uploadPath = public_path('uploads/receipts');

                    if (
                        !is_dir($uploadPath) &&
                        !mkdir($uploadPath, 0755, true) &&
                        !is_dir($uploadPath)
                    ) {
                        throw new \RuntimeException(
                            'Unable to create the payment-proof upload directory.'
                        );
                    }

                    if (!is_writable($uploadPath)) {
                        throw new \RuntimeException(
                            'The payment-proof upload directory is not writable.'
                        );
                    }

                    $filename = uniqid('receipt_', true) .
                        '.' . $file->extension();

                    $file->move($uploadPath, $filename);

                    if (!file_exists($uploadPath . '/' . $filename)) {
                        throw new \RuntimeException(
                            'Payment proof could not be saved.'
                        );
                    }

                    $receipt->update([
                        'image' => 'uploads/receipts/' . $filename,
                    ]);
                }

                // Replace existing receipt details.
                $receipt->receiptDetails()->delete();

                // Save selected subcategories or standalone categories.
                foreach ($validated['categories'] as $categoryId) {
                    $category = $selectedCategories->get($categoryId);

                    // Fixed amounts always come from the database.
                    $amount = $category->amount !== null
                        ? $category->amount
                        : $request->input("amounts.$categoryId");

                    ReceiptDetail::create([
                        'receipt_id' => $receipt->id,
                        'category_id' => $category->id,
                        'amount' => $amount,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to save receipt details. Please check the information and try again.'
                );
        }

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Receipt details saved successfully.');
    }

}
