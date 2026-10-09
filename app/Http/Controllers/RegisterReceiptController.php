<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegisterReceiptController extends Controller
{
    /**
     * Show public registration form
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->with([
                'subcategories' => function ($query) {
                    $query->orderBy('display_order')
                        ->orderBy('name');
                },
            ])
            ->orderBy('display_order')
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
            ],
            'address' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',

            'categories' => 'required|array|min:1',
            'categories.*' => 'required|integer|distinct|exists:categories,id',

            'amounts' => 'nullable|array',
            'amounts.*' => 'nullable|numeric|min:0.01',
        ]);

        $selectedIds = collect($validated['categories'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        // Load only the selected categories.
        $selectedCategories = Category::whereIn('id', $selectedIds)
            ->get()
            ->keyBy('id');

        // A category with subcategories must not be selected as a receipt item.
        foreach ($selectedCategories as $category) {
            if ($category->subcategories()->exists()) {
                throw ValidationException::withMessages([
                    'categories' => "Please select a subcategory under {$category->name}, not the main category itself.",
                ]);
            }
        }

        // Validate amounts and ensure fixed amounts cannot be overridden.
        foreach ($selectedCategories as $category) {
            if ($category->amount === null) {
                $amount = $request->input("amounts.{$category->id}");

                if (!is_numeric($amount) || (float) $amount <= 0) {
                    throw ValidationException::withMessages([
                        "amounts.{$category->id}" =>
                            "Please enter a valid amount for {$category->name}.",
                    ]);
                }
            }
        }

        $receipt = DB::transaction(function () use (
            $request,
            $selectedIds,
            $selectedCategories
        ) {
            $receipt = Receipt::create([
                'name' => $request->name,
                'image' => null,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'date' => now()->toDateString(),
                'receipt_type' => 'registered',
            ]);

            $receipt->update([
                'receipt_number' => $receipt->date->format('Ymd')
                    . '-'
                    . str_pad($receipt->id, 3, '0', STR_PAD_LEFT),
            ]);

            foreach ($selectedIds as $categoryId) {
                $category = $selectedCategories->get($categoryId);

                // Use the fixed category amount when configured.
                // Otherwise, use the amount entered by the user.
                $amount = $category->amount !== null
                    ? $category->amount
                    : $request->input("amounts.{$category->id}");

                ReceiptDetail::create([
                    'receipt_id' => $receipt->id,
                    'category_id' => $category->id,
                    'amount' => $amount,
                ]);
            }

            return $receipt;
        });

        return redirect()
            ->route('register-receipts.payment', $receipt)
            ->with('success', 'Registration details saved successfully.');
    }

    /**
     * Show payment page
     */
    public function payment(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category.parent');

        return view(
            'register-receipts.payment',
            compact('receipt')
        );
    }

    /**
     * Upload payment proof - optional
     */
    public function paymentStore(Request $request, Receipt $receipt)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $uploadPath = public_path('uploads/receipts');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move($uploadPath, $filename);

            $receipt->update([
                'image' => 'uploads/receipts/' . $filename,
            ]);
        }

        return redirect()
            ->route('register-receipts.success', $receipt)
            ->with('success', 'Payment details submitted successfully.');
    }

    /**
     * Show success page
     */
    public function success(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category.parent');

        return view(
            'register-receipts.success',
            compact('receipt')
        );
    }


    public function storeCity(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        // Prevent duplicate city names (case-insensitive).
        $exists = City::whereRaw(
            'LOWER(name) = ?',
            [mb_strtolower(trim($validated['name']))]
        )->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This city already exists.',
            ], 422);
        }

        $city = new City();
        $city->name = trim($validated['name']);
        $city->status = true;
        $city->save();

        return response()->json([
            'message' => 'City added successfully.',
            'city' => [
                'id' => $city->id,
                'name' => $city->name,
            ],
        ], 201);
    }

}
