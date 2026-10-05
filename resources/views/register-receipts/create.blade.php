@extends('layouts.register')

@section('content')

    <div class="min-h-screen px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-4xl">

            {{-- BRAND / HEADER --}}
            <div class="mb-8 text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center
                        rounded-2xl bg-emerald-500 text-white shadow-lg shadow-emerald-200">

                    <i class="fa-solid fa-hand-holding-heart text-2xl"></i>

                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Register Your Receipt
                </h1>

                <p class="mx-auto mt-2 max-w-xl text-sm leading-6 text-slate-500">
                    Please enter your details and select the donation categories
                    you would like to contribute to.
                </p>

            </div>


            {{-- FORM --}}
            <form action="{{ route('register-receipts.store') }}"
                  method="POST"
                  id="registerReceiptForm">

                @csrf


                {{-- ================================================
                     STEP 1 — PERSONAL INFORMATION
                ================================================= --}}

                <div class="overflow-hidden rounded-3xl border border-slate-200
                        bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5 sm:px-8">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-user"></i>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900">
                                    தனிப்பட்ட தகவல்கள் / Personal Information
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Enter your basic details
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="px-6 py-6 sm:px-8">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- NAME --}}
                            <div>

                                <label for="name"
                                       class="mb-2 block text-sm font-semibold text-slate-700">

                                    பெயர் / Name
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="relative">

                                <span class="pointer-events-none absolute inset-y-0 left-0
                                             flex items-center pl-4 text-slate-400">

                                    <i class="fa-regular fa-user text-sm"></i>

                                </span>

                                    <input type="text"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Enter your name"
                                           class="w-full rounded-xl border-slate-200
                                              py-3 pl-11 pr-4 text-sm
                                              text-slate-700
                                              placeholder:text-slate-300
                                              focus:border-emerald-500
                                              focus:ring-emerald-500">

                                </div>

                                @error('name')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            {{-- MOBILE --}}
                            <div>

                                <label for="mobile"
                                       class="mb-2 block text-sm font-semibold text-slate-700">

                                    கைபேசி எண் / Mobile Number

                                </label>

                                <div class="relative">

                                <span class="pointer-events-none absolute inset-y-0 left-0
                                             flex items-center pl-4 text-slate-400">

                                    <i class="fa-solid fa-phone text-sm"></i>

                                </span>

                                    <input type="text"
                                           id="mobile"
                                           name="mobile"
                                           value="{{ old('mobile') }}"
                                           placeholder="Enter mobile number"
                                           class="w-full rounded-xl border-slate-200
                                              py-3 pl-11 pr-4 text-sm
                                              text-slate-700
                                              placeholder:text-slate-300
                                              focus:border-emerald-500
                                              focus:ring-emerald-500">

                                </div>

                                @error('mobile')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            {{-- ADDRESS --}}
                            <div class="md:col-span-2">

                                <label for="address"
                                       class="mb-2 block text-sm font-semibold text-slate-700">

                                    முகவரி / Address

                                </label>

                                <div class="relative">

                                <span class="pointer-events-none absolute left-0 top-3
                                             flex items-center pl-4 text-slate-400">

                                    <i class="fa-solid fa-location-dot text-sm"></i>

                                </span>

                                    <textarea id="address"
                                              name="address"
                                              rows="3"
                                              placeholder="Enter your address"
                                              class="w-full rounded-xl border-slate-200
                                                 py-3 pl-11 pr-4 text-sm
                                                 text-slate-700
                                                 placeholder:text-slate-300
                                                 focus:border-emerald-500
                                                 focus:ring-emerald-500">{{ old('address') }}</textarea>

                                </div>

                                @error('address')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            <div>
                                <label
                                    for="city_id"
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    ஊர் / City
                                </label>

                                <select
                                    name="city_id"
                                    id="city_id"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                                >
                                    <option value="">Select City</option>

                                    @foreach($cities as $city)
                                        <option
                                            value="{{ $city->id }}"
                                            {{ old('city_id') == $city->id ? 'selected' : '' }}
                                        >
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('city_id')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================
                     STEP 2 — DONATION CATEGORIES
                ================================================= --}}

                <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200
                        bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5 sm:px-8">

                        <div class="flex flex-col gap-3 sm:flex-row
                                sm:items-center sm:justify-between">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-emerald-50 text-emerald-600">

                                    <i class="fa-solid fa-list-check"></i>

                                </div>

                                <div>

                                    <h2 class="text-base font-bold text-slate-900">
                                        நன்கொடை விவரங்கள் / Donation Details
                                    </h2>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        Select one or more donation categories
                                    </p>

                                </div>

                            </div>


                            <span class="inline-flex w-fit items-center gap-2 rounded-full
                                     bg-slate-50 px-3 py-1.5 text-xs font-medium
                                     text-slate-500">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                            Select at least one

                        </span>

                        </div>

                    </div>


                    <div class="p-4 sm:p-6">

                        <div class="space-y-3">

                            @forelse($categories as $category)

                                <div class="category-row rounded-2xl border border-slate-200
                                        bg-white transition-all duration-200
                                        hover:border-emerald-200
                                        hover:bg-emerald-50/30">

                                    <div class="flex items-center gap-4 p-4 sm:p-5">


                                        {{-- CHECKBOX --}}
                                        <div class="shrink-0">

                                            <input type="checkbox"
                                                   name="categories[]"
                                                   value="{{ $category->id }}"
                                                   id="category_{{ $category->id }}"
                                                   class="category-checkbox
                                                      h-5 w-5 rounded-md
                                                      border-slate-300
                                                      text-emerald-600
                                                      focus:ring-emerald-500
                                                      cursor-pointer"
                                                   data-category-id="{{ $category->id }}"
                                                   data-fixed-amount="{{ $category->amount ?? '' }}">

                                        </div>


                                        {{-- CATEGORY INFORMATION --}}
                                        <label for="category_{{ $category->id }}"
                                               class="min-w-0 flex-1 cursor-pointer">

                                            <div class="flex flex-wrap items-center gap-2">

                                            <span class="text-sm font-semibold
                                                         text-slate-800 sm:text-base">

                                                {{ $category->name }}

                                            </span>


                                                @if($category->amount !== null)

                                                    <span class="rounded-md bg-emerald-50
                                                             px-2 py-1 text-[10px]
                                                             font-bold uppercase
                                                             tracking-wide
                                                             text-emerald-600">

                                                    Fixed Amount

                                                </span>

                                                @else

                                                    <span class="rounded-md bg-amber-50
                                                             px-2 py-1 text-[10px]
                                                             font-bold uppercase
                                                             tracking-wide
                                                             text-amber-600">

                                                    Enter Amount

                                                </span>

                                                @endif

                                            </div>


                                            @if($category->amount !== null)

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Fixed donation amount
                                                </p>

                                            @else

                                                <p class="mt-1 text-xs text-amber-600">
                                                    Please enter your donation amount
                                                </p>

                                            @endif

                                        </label>


                                        {{-- AMOUNT --}}
                                        <div class="w-32 shrink-0 sm:w-40">

                                            @if($category->amount !== null)

                                                <div class="relative">

                                                <span class="absolute left-3 top-1/2
                                                             -translate-y-1/2
                                                             text-xs font-semibold
                                                             text-slate-400">
                                                    ₹
                                                </span>

                                                    <input type="text"
                                                           value="{{ number_format($category->amount, 2, '.', '') }}"
                                                           readonly
                                                           class="w-full rounded-xl
                                                              border-slate-200
                                                              bg-slate-50
                                                              py-2.5 pl-7 pr-3
                                                              text-sm font-semibold
                                                              text-slate-600">

                                                </div>

                                            @else

                                                <div>

                                                    <div class="relative">

                                                    <span class="absolute left-3 top-1/2
                                                                 -translate-y-1/2
                                                                 text-xs font-semibold
                                                                 text-slate-400">
                                                        ₹
                                                    </span>

                                                        <input type="number"
                                                               name="amounts[{{ $category->id }}]"
                                                               id="amount_{{ $category->id }}"
                                                               step="0.01"
                                                               min="0.01"
                                                               placeholder="0.00"
                                                               value="{{ old('amounts.' . $category->id) }}"
                                                               disabled
                                                               class="amount-input w-full
                                                                  rounded-xl
                                                                  border-slate-200
                                                                  py-2.5 pl-7 pr-3
                                                                  text-sm font-semibold
                                                                  text-slate-700
                                                                  placeholder:text-slate-300
                                                                  focus:border-emerald-500
                                                                  focus:ring-emerald-500
                                                                  disabled:bg-slate-50
                                                                  disabled:text-slate-400">

                                                    </div>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="rounded-2xl border border-dashed
                                        border-slate-200 py-12 text-center">

                                    <i class="fa-regular fa-folder-open
                                          text-2xl text-slate-300"></i>

                                    <p class="mt-3 text-sm font-semibold text-slate-600">
                                        No donation categories available
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>


                    {{-- TOTAL --}}
                    <div class="border-t border-slate-100 bg-slate-50/70
                            px-6 py-5 sm:px-8">

                        <div class="flex items-center justify-between gap-4">

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Total Amount
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Based on your selected donations
                                </p>

                            </div>

                            <div class="text-right">

                            <span id="totalAmount"
                                  class="text-2xl font-bold text-emerald-600 sm:text-3xl">

                                ₹0.00

                            </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- CONTINUE --}}
                <div class="mt-6">

                    <button type="submit"
                            class="flex w-full items-center justify-center gap-2
                               rounded-2xl bg-emerald-600
                               px-6 py-3.5
                               text-sm font-semibold text-white
                               shadow-lg shadow-emerald-200
                               transition hover:bg-emerald-700
                               hover:shadow-xl
                               focus:outline-none
                               focus:ring-2
                               focus:ring-emerald-500
                               focus:ring-offset-2">

                        Continue to Payment

                        <i class="fa-solid fa-arrow-right text-xs"></i>

                    </button>

                    <p class="mt-3 text-center text-xs text-slate-400">
                        You will be redirected to the payment page after registration.
                    </p>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const checkboxes =
                document.querySelectorAll('.category-checkbox');

            const totalAmount =
                document.getElementById('totalAmount');


            function calculateTotal() {

                let total = 0;

                checkboxes.forEach(function (checkbox) {

                    if (!checkbox.checked) {
                        return;
                    }

                    const categoryId =
                        checkbox.dataset.categoryId;

                    const fixedAmount =
                        checkbox.dataset.fixedAmount;

                    const manualInput =
                        document.getElementById(
                            'amount_' + categoryId
                        );


                    if (fixedAmount !== '') {

                        total += parseFloat(fixedAmount) || 0;

                    } else if (manualInput) {

                        total += parseFloat(manualInput.value) || 0;

                    }

                });


                totalAmount.textContent =
                    '₹' + total.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

            }


            checkboxes.forEach(function (checkbox) {

                checkbox.addEventListener('change', function () {

                    const categoryId =
                        this.dataset.categoryId;

                    const manualInput =
                        document.getElementById(
                            'amount_' + categoryId
                        );

                    const row =
                        this.closest('.category-row');


                    if (manualInput) {

                        manualInput.disabled =
                            !this.checked;

                        if (!this.checked) {
                            manualInput.value = '';
                        }

                    }


                    if (this.checked) {

                        row.classList.add(
                            'border-emerald-300',
                            'bg-emerald-50/40'
                        );

                    } else {

                        row.classList.remove(
                            'border-emerald-300',
                            'bg-emerald-50/40'
                        );

                    }


                    calculateTotal();

                });

            });


            document
                .querySelectorAll('.amount-input')
                .forEach(function (input) {

                    input.addEventListener(
                        'input',
                        calculateTotal
                    );

                });

        });

    </script>

@endsection
