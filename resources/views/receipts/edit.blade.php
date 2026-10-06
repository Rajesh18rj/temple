@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

        <div class="mb-6">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">

                <a href="{{ route('receipts.index') }}"
                   class="hover:text-violet-600 transition-colors">

                    Receipts

                </a>

                <svg class="w-4 h-4 text-slate-400"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7"/>

                </svg>

                <a href="{{ route('receipts.view', $receipt) }}"
                   class="hover:text-violet-600 transition-colors">

                    Receipt #{{ $receipt->id }}

                </a>

                <svg class="w-4 h-4 text-slate-400"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7"/>

                </svg>

                <span class="text-slate-700">
                Edit
            </span>

            </div>


            <div class="flex flex-col sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4">

                <div>

                    <h1 class="text-2xl sm:text-3xl
                           font-bold text-slate-800">

                        Edit Receipt

                    </h1>

                    <p class="text-sm text-slate-500 mt-1">

                        Update receipt information and donation details.

                    </p>

                </div>


                <a href="{{ route('receipts.view', $receipt) }}"
                   class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5
                      rounded-lg
                      border border-slate-200
                      bg-white
                      text-sm font-semibold
                      text-slate-600
                      hover:bg-slate-50
                      transition-colors">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>

                    </svg>

                    Back to Receipt

                </a>

            </div>

        </div>


        {{-- =========================================================
             FORM
        ========================================================== --}}

        <form action="{{ route('receipts.update', $receipt) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="space-y-6">


                {{-- =================================================
                     RECEIPT INFORMATION
                ================================================== --}}

                <div class="bg-white
                        border border-slate-200
                        rounded-xl
                        shadow-sm
                        overflow-hidden">

                    {{-- Card Header --}}
                    <div class="px-5 sm:px-6 py-5
                            border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9
                                    rounded-lg
                                    bg-violet-50
                                    flex items-center justify-center">

                                <svg class="w-5 h-5 text-violet-600"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base
                                       font-semibold
                                       text-slate-800">

                                    Receipt Information

                                </h2>

                                <p class="text-xs text-slate-500 mt-0.5">

                                    Update donor and payment information.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="p-5 sm:p-6 lg:p-8">

                        <div class="grid grid-cols-1
                                md:grid-cols-2
                                gap-6">


                            {{-- Name --}}
                            <div>

                                <label for="name"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-2">

                                    Name

                                    <span class="text-red-500">*</span>

                                </label>

                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $receipt->name) }}"
                                       placeholder="Enter donor name"
                                       class="w-full px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-white
                                          text-sm text-slate-800
                                          placeholder:text-slate-400
                                          outline-none
                                          focus:border-violet-400
                                          focus:ring-2
                                          focus:ring-violet-100
                                          transition">

                                @error('name')

                                <p class="text-xs
                                          text-red-600
                                          mt-1.5">

                                    {{ $message }}

                                </p>

                                @enderror

                            </div>


                            {{-- Mobile --}}
                            <div>

                                <label for="mobile"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-2">

                                    Mobile

                                </label>

                                <input type="text"
                                       id="mobile"
                                       name="mobile"
                                       value="{{ old('mobile', $receipt->mobile) }}"
                                       placeholder="Enter mobile number"
                                       class="w-full px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-white
                                          text-sm text-slate-800
                                          placeholder:text-slate-400
                                          outline-none
                                          focus:border-violet-400
                                          focus:ring-2
                                          focus:ring-violet-100
                                          transition">

                                @error('mobile')

                                <p class="text-xs
                                          text-red-600
                                          mt-1.5">

                                    {{ $message }}

                                </p>

                                @enderror

                            </div>


                            {{-- Date --}}
                            <div>

                                <label class="block text-sm
                                          font-medium
                                          text-slate-700 mb-2">

                                    Receipt Date

                                </label>

                                <input type="text"
                                       value="{{ $receipt->date ? $receipt->date->format('d-m-Y') : '-' }}"
                                       disabled
                                       class="w-full px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-50
                                          text-sm
                                          text-slate-500">

                            </div>


                            {{-- ================= ADDRESS & CITY ================= --}}
                            <div class="md:col-span-2">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    {{-- Address --}}
                                    <div>

                                        <label for="address"
                                               class="block text-sm
                          font-medium
                          text-slate-700 mb-2">

                                            Address

                                        </label>

                                        <textarea
                                            id="address"
                                            name="address"
                                            rows="3"
                                            placeholder="Enter donor address"
                                            class="w-full px-4 py-2.5
                       rounded-lg
                       border border-slate-200
                       bg-white
                       text-sm text-slate-800
                       placeholder:text-slate-400
                       outline-none
                       resize-none
                       focus:border-violet-400
                       focus:ring-2
                       focus:ring-violet-100
                       transition">{{ old('address', $receipt->address) }}</textarea>

                                        @error('address')
                                        <p class="text-xs text-red-600 mt-1.5">
                                            {{ $message }}
                                        </p>
                                        @enderror

                                    </div>


                                    {{-- City --}}
                                    <div>

                                        <label for="city_id"
                                               class="block text-sm
                          font-medium
                          text-slate-700 mb-2">

                                            City

                                            <span class="text-red-500">*</span>

                                        </label>

                                        <select
                                            id="city_id"
                                            name="city_id"
                                            class="w-full px-4 py-2.5
                       rounded-lg
                       border border-slate-200
                       bg-white
                       text-sm text-slate-800
                       outline-none
                       focus:border-violet-400
                       focus:ring-2
                       focus:ring-violet-100
                       transition">

                                            <option value="">
                                                Select City
                                            </option>

                                            @foreach($cities as $city)

                                                <option value="{{ $city->id }}"
                                                    {{ old('city_id', $receipt->city_id) == $city->id ? 'selected' : '' }}>

                                                    {{ $city->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                        @error('city_id')
                                        <p class="text-xs text-red-600 mt-1.5">
                                            {{ $message }}
                                        </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PAYMENT PROOF
                ================================================== --}}

                <div class="bg-white
                        border border-slate-200
                        rounded-xl
                        shadow-sm
                        overflow-hidden">

                    <div class="px-5 sm:px-6 py-5
                            border-b border-slate-200">

                        <h2 class="text-base
                               font-semibold
                               text-slate-800">

                            Payment Proof

                        </h2>

                        <p class="text-xs text-slate-500 mt-1">

                            Upload a new payment proof only if you want to replace the existing image.

                        </p>

                    </div>


                    <div class="p-5 sm:p-6 lg:p-8">

                        <div class="grid grid-cols-1
                                lg:grid-cols-2
                                gap-6
                                items-start">


                            {{-- Current Image --}}
                            <div>

                                <p class="text-sm
                                      font-medium
                                      text-slate-700 mb-2">

                                    Current Payment Proof

                                </p>

                                @if($receipt->image)

                                    <div class="border
                                            border-slate-200
                                            rounded-lg
                                            overflow-hidden
                                            bg-slate-50">

                                        <img src="{{ asset($receipt->image) }}"
                                             alt="Current payment proof"
                                             class="w-full
                                                max-h-72
                                                object-contain">

                                    </div>

                                @else

                                    <div class="h-48
                                            rounded-lg
                                            border border-dashed
                                            border-slate-300
                                            bg-slate-50
                                            flex items-center
                                            justify-center">

                                    <span class="text-sm
                                                 text-slate-400">

                                        No payment proof uploaded

                                    </span>

                                    </div>

                                @endif

                            </div>


                            {{-- New Image --}}
                            <div>

                                <label for="image"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-2">

                                    Replace Payment Proof

                                </label>

                                <label for="image"
                                       class="flex flex-col
                                          items-center
                                          justify-center
                                          min-h-48
                                          px-6
                                          py-8
                                          rounded-lg
                                          border-2
                                          border-dashed
                                          border-slate-200
                                          bg-slate-50
                                          hover:bg-violet-50/40
                                          hover:border-violet-300
                                          cursor-pointer
                                          transition">

                                    <svg class="w-9 h-9
                                            text-slate-400 mb-3"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-9h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                    </svg>

                                    <span class="text-sm
                                             font-medium
                                             text-slate-600">

                                    Choose a new image

                                </span>

                                    <span class="text-xs
                                             text-slate-400 mt-1">

                                    JPG, JPEG, PNG or WEBP

                                </span>

                                    <input type="file"
                                           id="image"
                                           name="image"
                                           accept=".jpg,.jpeg,.png,.webp"
                                           class="hidden">

                                </label>

                                <p id="imageName"
                                   class="text-xs
                                      text-violet-600
                                      mt-2">
                                </p>

                                @error('image')

                                <p class="text-xs
                                          text-red-600
                                          mt-1.5">

                                    {{ $message }}

                                </p>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DONATION DETAILS
                ================================================== --}}

                <div class="bg-white
                        border border-slate-200
                        rounded-xl
                        shadow-sm
                        overflow-hidden">


                    {{-- Header --}}
                    <div class="px-5 sm:px-6 py-5
                            border-b border-slate-200
                            flex flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-3">

                        <div>

                            <h2 class="text-base
                                   font-semibold
                                   text-slate-800">

                                Donation Details

                            </h2>

                            <p class="text-xs
                                  text-slate-500
                                  mt-1">

                                Select the categories included in this receipt.

                            </p>

                        </div>


                        <div class="px-3 py-1.5
                                rounded-lg
                                bg-violet-50
                                text-violet-600
                                text-xs
                                font-semibold">

                            Select Categories

                        </div>

                    </div>


                    {{-- Categories --}}
                    <div class="p-5 sm:p-6 lg:p-8">

                        <div class="space-y-3">

                            @php
                                $selectedCategories = old(
                                    'categories',
                                    $receipt->receiptDetails
                                        ->pluck('category_id')
                                        ->toArray()
                                );

                                $existingAmounts = [];

                                foreach ($receipt->receiptDetails as $detail) {
                                    $existingAmounts[$detail->category_id] = $detail->amount;
                                }
                            @endphp


                            @forelse($categories as $category)

                                @php
                                    $isSelected = in_array(
                                        $category->id,
                                        $selectedCategories
                                    );

                                    $manualAmount = old(
                                        'amounts.' . $category->id,
                                        $existingAmounts[$category->id] ?? ''
                                    );
                                @endphp


                                <div class="category-row
                                        border border-slate-200
                                        rounded-lg
                                        p-4
                                        transition
                                        {{ $isSelected
                                            ? 'border-violet-300 bg-violet-50/40'
                                            : 'bg-white' }}">

                                    <div class="flex flex-col
                                            sm:flex-row
                                            sm:items-center
                                            gap-4">


                                        {{-- Checkbox --}}
                                        <div class="flex items-center
                                                gap-3
                                                flex-1">

                                            <input type="checkbox"
                                                   id="category_{{ $category->id }}"
                                                   name="categories[]"
                                                   value="{{ $category->id }}"
                                                   {{ $isSelected ? 'checked' : '' }}
                                                   class="category-checkbox
                                                      w-4 h-4
                                                      rounded
                                                      border-slate-300
                                                      text-violet-600
                                                      focus:ring-violet-500">

                                            <label for="category_{{ $category->id }}"
                                                   class="cursor-pointer">

                                            <span class="block
                                                         text-sm
                                                         font-semibold
                                                         text-slate-800">

                                                {{ $category->name }}

                                            </span>

                                                @if($category->amount !== null)

                                                    <span class="block
                                                             text-xs
                                                             text-slate-500
                                                             mt-0.5">

                                                    Fixed amount

                                                </span>

                                                @else

                                                    <span class="block
                                                             text-xs
                                                             text-slate-500
                                                             mt-0.5">

                                                    Manual amount

                                                </span>

                                                @endif

                                            </label>

                                        </div>


                                        {{-- Amount --}}
                                        <div class="w-full sm:w-44">

                                            @if($category->amount !== null)

                                                <div class="relative">

                                                <span class="absolute
                                                             left-3
                                                             top-1/2
                                                             -translate-y-1/2
                                                             text-sm
                                                             font-semibold
                                                             text-slate-400">

                                                    ₹

                                                </span>

                                                    <input type="text"
                                                           value="{{ number_format($category->amount, 2) }}"
                                                           disabled
                                                           class="w-full
                                                              pl-8
                                                              pr-3
                                                              py-2.5
                                                              rounded-lg
                                                              border
                                                              border-slate-200
                                                              bg-slate-100
                                                              text-sm
                                                              font-semibold
                                                              text-slate-600">

                                                </div>

                                            @else

                                                <div class="relative">

                                                <span class="absolute
                                                             left-3
                                                             top-1/2
                                                             -translate-y-1/2
                                                             text-sm
                                                             font-semibold
                                                             text-slate-400">

                                                    ₹

                                                </span>

                                                    <input type="number"
                                                           name="amounts[{{ $category->id }}]"
                                                           value="{{ $manualAmount }}"
                                                           min="0"
                                                           step="0.01"
                                                           placeholder="Enter amount"
                                                           {{ $isSelected ? '' : 'disabled' }}
                                                           class="manual-amount
                                                              w-full
                                                              pl-8
                                                              pr-3
                                                              py-2.5
                                                              rounded-lg
                                                              border
                                                              border-slate-200
                                                              bg-white
                                                              text-sm
                                                              text-slate-800
                                                              outline-none
                                                              focus:border-violet-400
                                                              focus:ring-2
                                                              focus:ring-violet-100
                                                              disabled:bg-slate-100
                                                              disabled:text-slate-400
                                                              transition">

                                                </div>

                                            @endif

                                        </div>

                                    </div>


                                    @error('amounts.' . $category->id)

                                    <p class="text-xs
                                              text-red-600
                                              mt-2">

                                        {{ $message }}

                                    </p>

                                    @enderror

                                </div>

                            @empty

                                <div class="py-12 text-center">

                                    <p class="text-sm text-slate-500">
                                        No categories available.
                                    </p>

                                </div>

                            @endforelse

                        </div>


                        {{-- Total --}}
                        <div class="mt-6
                                flex flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                                px-5 py-4
                                rounded-lg
                                bg-violet-50
                                border border-violet-100">

                        <span class="text-sm
                                     font-semibold
                                     text-slate-700">

                            Total Amount

                        </span>

                            <span id="totalAmount"
                                  class="text-xl
                                     font-bold
                                     text-violet-700">

                            ₹0.00

                        </span>

                        </div>


                        @error('categories')

                        <p class="text-xs
                                  text-red-600
                                  mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="flex flex-col-reverse
                        sm:flex-row
                        sm:justify-end
                        gap-3">

                    <a href="{{ route('receipts.view', $receipt) }}"
                       class="inline-flex
                          items-center
                          justify-center
                          px-5 py-2.5
                          rounded-lg
                          border border-slate-200
                          bg-white
                          text-sm font-medium
                          text-slate-600
                          hover:bg-slate-50
                          transition-colors">

                        Cancel

                    </a>


                    <button type="submit"
                            class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-5 py-2.5
                               rounded-lg
                               bg-violet-600
                               text-white
                               text-sm
                               font-semibold
                               hover:bg-violet-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-violet-200
                               transition-colors">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Update Receipt

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- =============================================================
         JAVASCRIPT
    ============================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const checkboxes = document.querySelectorAll('.category-checkbox');

            const totalElement = document.getElementById('totalAmount');

            const imageInput = document.getElementById('image');

            const imageName = document.getElementById('imageName');


            /*
            |--------------------------------------------------------------------------
            | Category Selection
            |--------------------------------------------------------------------------
            */

            checkboxes.forEach(function (checkbox) {

                checkbox.addEventListener('change', function () {

                    const row = checkbox.closest('.category-row');

                    const manualInput = row.querySelector('.manual-amount');


                    if (checkbox.checked) {

                        row.classList.add(
                            'border-violet-300',
                            'bg-violet-50/40'
                        );

                        row.classList.remove(
                            'border-slate-200',
                            'bg-white'
                        );

                        if (manualInput) {
                            manualInput.disabled = false;
                        }

                    } else {

                        row.classList.remove(
                            'border-violet-300',
                            'bg-violet-50/40'
                        );

                        row.classList.add(
                            'border-slate-200',
                            'bg-white'
                        );

                        if (manualInput) {
                            manualInput.disabled = true;
                        }

                    }

                    calculateTotal();

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Manual Amount Changes
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.manual-amount')
                .forEach(function (input) {

                    input.addEventListener('input', calculateTotal);

                });


            /*
            |--------------------------------------------------------------------------
            | Calculate Total
            |--------------------------------------------------------------------------
            */

            function calculateTotal() {

                let total = 0;

                document.querySelectorAll('.category-row')
                    .forEach(function (row) {

                        const checkbox =
                            row.querySelector('.category-checkbox');

                        if (!checkbox || !checkbox.checked) {
                            return;
                        }


                        const manualInput =
                            row.querySelector('.manual-amount');

                        if (manualInput) {

                            const amount =
                                parseFloat(manualInput.value) || 0;

                            total += amount;

                        } else {

                            const fixedInput =
                                row.querySelector('input[disabled]');

                            if (fixedInput) {

                                const amount =
                                    parseFloat(
                                        fixedInput.value
                                            .replace(/,/g, '')
                                            .replace('₹', '')
                                    ) || 0;

                                total += amount;

                            }

                        }

                    });


                totalElement.textContent =
                    '₹' + total.toFixed(2);

            }


            /*
            |--------------------------------------------------------------------------
            | Payment Proof File Name
            |--------------------------------------------------------------------------
            */

            if (imageInput) {

                imageInput.addEventListener('change', function () {

                    if (this.files.length > 0) {

                        imageName.textContent =
                            'Selected: ' + this.files[0].name;

                    } else {

                        imageName.textContent = '';

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Initial Total
            |--------------------------------------------------------------------------
            */

            calculateTotal();

        });

    </script>

@endsection
