<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterReceiptController extends Controller
{
    /**
     * Show public registration form
     */
    public function create()
    {
        $categories = Category::orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('register-receipts.create', compact('categories'));
    }


    /**
     * Save registration details
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string',

            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',

            'amounts' => 'nullable|array',
            'amounts.*' => 'nullable|numeric|min:0.01',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Validate manual amounts
        |--------------------------------------------------------------------------
        */

        foreach ($request->categories as $categoryId) {

            $category = Category::findOrFail($categoryId);

            // Category has no fixed amount
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
        | Create receipt and receipt details
        |--------------------------------------------------------------------------
        */

        $receipt = DB::transaction(function () use ($request) {

            $receipt = Receipt::create([
                'name' => $request->name,
                'image' => null,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'date' => now()->toDateString(),

                // Important:
                // This identifies it as a public/walk-in registration.
                'receipt_type' => 'registered',
            ]);


            foreach ($request->categories as $categoryId) {

                $category = Category::findOrFail($categoryId);


                /*
                |--------------------------------------------------------------------------
                | Determine amount
                |--------------------------------------------------------------------------
                */

                if ($category->amount !== null) {

                    // Fixed category amount
                    $amount = $category->amount;

                } else {

                    // User-entered amount
                    $amount = $request->input(
                        "amounts.$categoryId"
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Create receipt detail
                |--------------------------------------------------------------------------
                */

                ReceiptDetail::create([
                    'receipt_id' => $receipt->id,
                    'category_id' => $category->id,
                    'amount' => $amount,
                ]);
            }


            return $receipt;
        });


        /*
        |--------------------------------------------------------------------------
        | Go to payment page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('register-receipts.payment', $receipt)
            ->with('success', 'Registration details saved successfully.');
    }


    /**
     * Show payment page
     */
    public function payment(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category');

        return view(
            'register-receipts.payment',
            compact('receipt')
        );
    }


    /**
     * Upload payment proof
     */
    public function paymentStore(Request $request, Receipt $receipt)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Store payment proof
        |--------------------------------------------------------------------------
        */

        $imagePath = $request->file('image')
            ->store('receipts', 'public');


        /*
        |--------------------------------------------------------------------------
        | Update receipt
        |--------------------------------------------------------------------------
        */

        $receipt->update([
            'image' => $imagePath,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Go to success page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('register-receipts.success', $receipt)
            ->with('success', 'Payment proof submitted successfully.');
    }


    /**
     * Show success page
     */
    public function success(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category');

        return view(
            'register-receipts.success',
            compact('receipt')
        );
    }
}
