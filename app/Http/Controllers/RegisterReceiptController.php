<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
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

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'register-receipts.create',
            compact('categories', 'cities')
        );
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

            'city_id' => 'required|exists:cities,id',

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

                // City
                'city_id' => $request->city_id,

                'date' => now()->toDateString(),

                // Public registration
                'receipt_type' => 'registered',
            ]);

            $receipt->update([
                'receipt_number' => $receipt->date->format('Ymd')
                    . '-'
                    . str_pad($receipt->id, 3, '0', STR_PAD_LEFT),
            ]);


            foreach ($request->categories as $categoryId) {

                $category = Category::findOrFail($categoryId);

                if ($category->amount !== null) {

                    // Fixed category amount
                    $amount = $category->amount;

                } else {

                    // User-entered amount
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


            return $receipt;
        });


        /*
        |--------------------------------------------------------------------------
        | Go to payment page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('register-receipts.payment', $receipt)
            ->with(
                'success',
                'Registration details saved successfully.'
            );
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
     * Upload payment proof - OPTIONAL
     */
    public function paymentStore(Request $request, Receipt $receipt)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Store payment proof only if uploaded
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $uploadPath = public_path('uploads/receipts');

            // Create directory if it doesn't exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generate unique filename
            $filename = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            // Move file directly to public folder
            $file->move(
                $uploadPath,
                $filename
            );

            // Update receipt with payment proof
            $receipt->update([
                'image' => 'uploads/receipts/' . $filename,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Go to success page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('register-receipts.success', $receipt)
            ->with(
                'success',
                'Payment details submitted successfully.'
            );
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
