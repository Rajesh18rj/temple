@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-[#f8f7ff] p-4 sm:p-6 lg:p-8">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}
        <div class="w-full mb-6">

            <div class="flex flex-col lg:flex-row
                    lg:items-center
                    lg:justify-between
                    gap-5">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14
                            rounded-2xl
                            bg-gradient-to-br from-violet-500 to-purple-600
                            flex items-center justify-center
                            shadow-lg shadow-purple-200">

                        <svg class="w-7 h-7 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a2 2 0 01.293.707V19a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl sm:text-3xl
                               font-bold
                               text-[#18213d]
                               tracking-tight">

                            Receipt Details

                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            Select donation categories and enter the required amounts.
                        </p>

                    </div>

                </div>


                {{-- Receipt ID --}}
                <div class="flex items-center gap-3
                        bg-white
                        border border-purple-100
                        rounded-2xl
                        px-5 py-3
                        shadow-sm">

                    <div class="w-9 h-9
                            rounded-lg
                            bg-violet-50
                            flex items-center justify-center">

                        <svg class="w-4 h-4 text-violet-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a2 2 0 01.293.707V19a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                    <div>

                        <p class="text-[10px]
                              uppercase
                              tracking-wider
                              font-bold
                              text-slate-400">

                            Receipt ID

                        </p>

                        <p class="text-sm
                              font-bold
                              text-violet-600">

                            #{{ $receipt->id }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            RECEIPT INFORMATION
        ========================================================== --}}
        <div class="w-full
                bg-white
                rounded-3xl
                border border-purple-100
                shadow-[0_8px_30px_rgba(91,65,170,0.06)]
                mb-6
                overflow-hidden">

            <div class="px-6 sm:px-8 py-5
                    border-b border-purple-50
                    flex items-center gap-3">

                <div class="w-10 h-10
                        rounded-xl
                        bg-violet-50
                        flex items-center justify-center">

                    <svg class="w-5 h-5 text-violet-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm7-3a4 4 0 110 8m4 5v-2a4 4 0 00-3-3.87"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-bold text-[#18213d]">
                        Receipt Information
                    </h2>

                    <p class="text-xs text-slate-400 mt-0.5">
                        Donor information
                    </p>

                </div>

            </div>


            <div class="px-6 sm:px-8 py-6">

                <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4
                        gap-6">

                    {{-- Name --}}
                    <div>

                        <p class="text-[11px]
                              uppercase
                              tracking-wider
                              font-bold
                              text-slate-400">

                            Name

                        </p>

                        <p class="mt-1.5
                              text-sm
                              font-semibold
                              text-[#18213d]">

                            {{ $receipt->name }}

                        </p>

                    </div>


                    {{-- Mobile --}}
                    <div>

                        <p class="text-[11px]
                              uppercase
                              tracking-wider
                              font-bold
                              text-slate-400">

                            Mobile

                        </p>

                        <p class="mt-1.5
                              text-sm
                              font-semibold
                              text-[#18213d]">

                            {{ $receipt->mobile ?? '-' }}

                        </p>

                    </div>


                    {{-- Date --}}
                    <div>

                        <p class="text-[11px]
                              uppercase
                              tracking-wider
                              font-bold
                              text-slate-400">

                            Date

                        </p>

                        <p class="mt-1.5
                              text-sm
                              font-semibold
                              text-[#18213d]">

                            {{ $receipt->date ? $receipt->date->format('d M Y') : '-' }}

                        </p>

                    </div>


                    {{-- Address --}}
                    <div>

                        <p class="text-[11px]
                              uppercase
                              tracking-wider
                              font-bold
                              text-slate-400">

                            Address

                        </p>

                        <p class="mt-1.5
                              text-sm
                              font-medium
                              text-slate-700
                              leading-5">

                            {{ $receipt->address ?? '-' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            CATEGORY FORM
        ========================================================== --}}
        <form action="{{ route('receipts.details.store', $receipt) }}"
              method="POST"
              enctype="multipart/form-data"
              id="receiptDetailsForm">

            @csrf


            <div class="w-full
                    bg-white
                    rounded-3xl
                    border border-purple-100
                    shadow-[0_8px_30px_rgba(91,65,170,0.06)]
                    overflow-hidden">

                {{-- Header --}}
                <div class="px-6 sm:px-8 py-5
                        border-b border-purple-50
                        flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-3">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10
                                rounded-xl
                                bg-violet-50
                                flex items-center justify-center">

                            <svg class="w-5 h-5 text-violet-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M9 5H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2h-4M9 5a3 3 0 016 0M9 5h6"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-[#18213d]">
                                Donation Categories
                            </h2>

                            <p class="text-xs text-slate-400 mt-0.5">
                                Select the applicable categories
                            </p>

                        </div>

                    </div>


                    <div class="text-xs text-slate-400">
                        Select at least one category
                    </div>

                </div>


                {{-- Category List --}}

                {{-- Category List --}}
                <div class="p-4 sm:p-6">

                    @php
                        $selectedCategories = old('categories', []);
                    @endphp

                    <div class="space-y-5">
                        @forelse($categories as $category)

                            @php
                                $hasSubcategories = $category->subcategories->isNotEmpty();

                                $options = $hasSubcategories
                                    ? $category->subcategories
                                    : collect([$category]);
                            @endphp

                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                                {{-- Category Heading --}}
                                <div class="flex items-center gap-3 border-b border-violet-100 bg-gradient-to-r from-violet-50 to-purple-50 px-4 py-4 sm:px-5">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-violet-600 shadow-sm">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                  d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-bold text-[#18213d]">
                                            {{ $category->name }}
                                        </h3>
                                        <p class="mt-0.5 text-xs text-slate-500">
                                            {{ $hasSubcategories ? 'Select applicable options below' : 'Select this category and enter the amount' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Selectable Options --}}
                                <div class="space-y-3 p-3 sm:p-4">
                                    @foreach($options as $option)

                                        @php
                                            $isSelected = in_array(
                                                $option->id,
                                                $selectedCategories
                                            );

                                            $fixedAmount = $option->amount;
                                        @endphp

                                        <div class="category-row rounded-xl border p-3 transition-all duration-200 sm:p-4
                        {{ $isSelected
                            ? 'border-violet-300 bg-violet-50/40'
                            : 'border-slate-200 bg-white hover:border-violet-200 hover:bg-violet-50/20' }}">

                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                                                <div class="flex min-w-0 flex-1 items-start gap-3">
                                                    <input
                                                        type="checkbox"
                                                        name="categories[]"
                                                        value="{{ $option->id }}"
                                                        id="category_{{ $option->id }}"
                                                        data-category-id="{{ $option->id }}"
                                                        data-fixed-amount="{{ $fixedAmount ?? '' }}"
                                                        @checked($isSelected)
                                                        class="category-checkbox mt-0.5 h-5 w-5 shrink-0 rounded-md border-slate-300 text-violet-600 focus:ring-violet-500">

                                                    <label for="category_{{ $option->id }}" class="min-w-0 flex-1 cursor-pointer">
                                    <span class="block text-sm font-semibold text-[#18213d]">
                                        {{ $option->name }}
                                    </span>

                                                        <span class="mt-1 block text-xs {{ $fixedAmount !== null ? 'text-slate-400' : 'text-orange-500' }}">
                                        {{ $fixedAmount !== null ? 'Fixed amount' : 'Enter amount manually' }}
                                    </span>
                                                    </label>
                                                </div>

                                                {{-- Amount Input --}}
                                                <div class="w-full sm:w-44">
                                                    <div class="relative">
                                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">₹</span>

                                                        @if($fixedAmount !== null)
                                                            <input
                                                                type="text"
                                                                value="{{ number_format($fixedAmount, 2, '.', '') }}"
                                                                readonly
                                                                class="amount-input w-full cursor-not-allowed rounded-xl border-slate-200 bg-slate-50 py-2.5 pl-7 pr-3 text-sm font-semibold text-slate-600">
                                                        @else
                                                            <input
                                                                type="number"
                                                                name="amounts[{{ $option->id }}]"
                                                                id="amount_{{ $option->id }}"
                                                                step="0.01"
                                                                min="0.01"
                                                                placeholder="0.00"
                                                                value="{{ old('amounts.'.$option->id) }}"
                                                                @disabled(!$isSelected)
                                                                class="amount-input w-full rounded-xl border-slate-200 py-2.5 pl-7 pr-3 text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:border-violet-500 focus:ring-violet-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400">
                                                        @endif
                                                    </div>

                                                    @error('amounts.'.$option->id)
                                                    <p class="mt-1.5 text-xs font-medium text-red-600">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @empty
                            <div class="py-14 text-center">
                                <p class="text-sm font-semibold text-slate-600">No categories available</p>
                                <p class="mt-1 text-xs text-slate-400">Create categories in Category Master first.</p>
                            </div>
                        @endforelse
                    </div>

                    @error('categories')
                    <p class="mt-3 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror

                </div>

                {{-- =================================================
     PAYMENT PROOF
================================================== --}}

                <div class="px-6 sm:px-8 py-6 border-t border-purple-50">

                    <div class="mb-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10
                        rounded-xl
                        bg-emerald-50
                        flex items-center justify-center">

                                <svg class="w-5 h-5 text-emerald-600"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 11v6m0 0l-2.5-2.5M12 17l2.5-2.5"/>

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-[#18213d]">
                                    Payment Proof
                                </h2>

                                <p class="text-xs text-slate-400 mt-0.5">
                                    Upload the payment screenshot or receipt
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Upload Box --}}

                    <label
                        for="paymentProof"
                        class="block cursor-pointer"
                    >

                        <div
                            id="paymentUploadBox"
                            class="rounded-2xl
                   border-2 border-dashed
                   border-slate-200
                   bg-slate-50
                   px-5 py-10
                   text-center
                   transition-all
                   hover:border-emerald-300
                   hover:bg-emerald-50/30"
                        >

                            <input
                                type="file"
                                name="image"
                                id="paymentProof"
                                accept=".jpg,.jpeg,.png,.webp,image/*"
                                class="hidden"
                            >


                            {{-- Upload Icon --}}

                            <div class="mx-auto flex h-14 w-14
                        items-center justify-center
                        rounded-2xl
                        bg-white
                        text-slate-400
                        shadow-sm">

                                <svg class="h-6 w-6"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 16V4m0 0L8 8m4-4l4 4"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6"/>

                                </svg>

                            </div>


                            {{-- Text --}}

                            <p class="mt-4 text-sm font-semibold text-slate-700">

                                Click to upload payment proof

                            </p>


                            <p class="mt-1 text-xs text-slate-400">

                                JPG, JPEG, PNG or WEBP · Maximum 2 MB

                            </p>


                            {{-- Selected File --}}

                            <p
                                id="paymentFileName"
                                class="mt-3 hidden rounded-lg
                       bg-emerald-50
                       px-3 py-1.5
                       text-xs font-medium
                       text-emerald-600"
                            >
                            </p>

                        </div>

                    </label>


                    @error('image')

                    <p class="mt-2 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- =================================================
                     TOTAL
                ================================================== --}}
                <div class="px-6 sm:px-8
                        py-5
                        border-t border-purple-50
                        bg-[#faf9ff]">

                    <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-4">

                        <div>

                            <p class="text-sm
                                  font-semibold
                                  text-[#18213d]">

                                Total Amount

                            </p>

                            <p class="text-xs
                                  text-slate-400
                                  mt-1">

                                Amount from selected categories

                            </p>

                        </div>


                        <div class="text-left sm:text-right">

                        <span id="totalAmount"
                              class="text-3xl
                                     font-bold
                                     text-violet-600">

                            ₹0.00

                        </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}
                <div class="px-6 sm:px-8
                        py-5
                        border-t border-slate-100
                        flex flex-col-reverse
                        sm:flex-row
                        sm:justify-end
                        gap-3">

                    <a href="{{ route('receipts.index') }}"
                       class="inline-flex
                          items-center
                          justify-center
                          px-5 py-2.5
                          rounded-xl
                          border border-slate-200
                          bg-white
                          text-sm
                          font-semibold
                          text-slate-600
                          hover:bg-slate-50
                          transition">

                        Cancel

                    </a>


                    <button type="submit"
                            class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-6 py-2.5
                               rounded-xl
                               bg-gradient-to-r
                               from-violet-600
                               to-purple-600
                               text-white
                               text-sm
                               font-semibold
                               shadow-md
                               shadow-purple-200
                               hover:from-violet-700
                               hover:to-purple-700
                               hover:-translate-y-0.5
                               transition-all">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Save Receipt

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Category Selection & Total Calculation
            |--------------------------------------------------------------------------
            */

            const checkboxes = document.querySelectorAll('.category-checkbox');
            const totalAmount = document.getElementById('totalAmount');

            function calculateTotal() {
                let total = 0;

                checkboxes.forEach(function (checkbox) {

                    if (!checkbox.checked) {
                        return;
                    }

                    const categoryId = checkbox.dataset.categoryId;
                    const fixedAmount = checkbox.dataset.fixedAmount;
                    const manualInput = document.getElementById(
                        'amount_' + categoryId
                    );

                    // Fixed amount category
                    if (fixedAmount !== '') {
                        total += parseFloat(fixedAmount) || 0;
                    }
                    // Manual amount category
                    else if (manualInput) {
                        total += parseFloat(manualInput.value) || 0;
                    }

                });

                if (totalAmount) {
                    totalAmount.textContent = '₹' + total.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Update Category Row Appearance
            |--------------------------------------------------------------------------
            */

            function updateCategoryRow(checkbox) {
                const row = checkbox.closest('.category-row');

                if (!row) {
                    return;
                }

                if (checkbox.checked) {
                    row.classList.add(
                        'border-violet-300',
                        'bg-violet-50/40'
                    );
                } else {
                    row.classList.remove(
                        'border-violet-300',
                        'bg-violet-50/40'
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Category Checkbox Events
            |--------------------------------------------------------------------------
            */

            checkboxes.forEach(function (checkbox) {

                const categoryId = checkbox.dataset.categoryId;
                const manualInput = document.getElementById(
                    'amount_' + categoryId
                );

                // Restore the correct state after validation errors
                if (manualInput) {
                    manualInput.disabled = !checkbox.checked;
                }

                updateCategoryRow(checkbox);

                checkbox.addEventListener('change', function () {

                    const selectedCategoryId = this.dataset.categoryId;
                    const selectedManualInput = document.getElementById(
                        'amount_' + selectedCategoryId
                    );

                    // Enable or disable manual amount input
                    if (selectedManualInput) {
                        selectedManualInput.disabled = !this.checked;

                        if (!this.checked) {
                            selectedManualInput.value = '';
                        }
                    }

                    // Update row appearance
                    updateCategoryRow(this);

                    // Recalculate total
                    calculateTotal();

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Manual Amount Input Events
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.amount-input').forEach(function (input) {

                input.addEventListener('input', function () {
                    calculateTotal();
                });

            });


            // Calculate the initial total
            calculateTotal();


            /*
            |--------------------------------------------------------------------------
            | Payment Proof File Selection
            |--------------------------------------------------------------------------
            */

            const paymentProof = document.getElementById('paymentProof');
            const paymentFileName = document.getElementById('paymentFileName');
            const paymentUploadBox = document.getElementById('paymentUploadBox');

            if (paymentProof && paymentFileName && paymentUploadBox) {

                paymentProof.addEventListener('change', function () {

                    if (this.files && this.files.length > 0) {

                        const file = this.files[0];

                        // Display selected filename
                        paymentFileName.textContent = 'Selected: ' + file.name;
                        paymentFileName.classList.remove('hidden');

                        // Highlight upload box
                        paymentUploadBox.classList.add(
                            'border-emerald-300',
                            'bg-emerald-50/30'
                        );

                    } else {

                        // Clear selected filename
                        paymentFileName.textContent = '';
                        paymentFileName.classList.add('hidden');

                        // Restore upload box appearance
                        paymentUploadBox.classList.remove(
                            'border-emerald-300',
                            'bg-emerald-50/30'
                        );

                    }

                });

            }

        });
    </script>

@endsection
