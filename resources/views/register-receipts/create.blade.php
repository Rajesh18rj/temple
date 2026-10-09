@extends('layouts.register')

@section('content')

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">

            {{-- PAGE HEADER --}}
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-700 text-white shadow-md shadow-emerald-100">
                        <i class="fa-solid fa-hand-holding-heart text-2xl"></i>
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                            நன்கொடை பதிவு
                        </h1>
                        <p class="mt-1 text-sm font-semibold text-emerald-700">
                            Donation Registration
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            Register your details and choose your donations.
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('register-receipts.store') }}"
                  method="POST"
                  id="registerReceiptForm">

                @csrf

                {{-- PERSONAL INFORMATION --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                            <i class="fa-regular fa-user text-lg"></i>
                        </div>

                        <div>
                            <h2 class="font-bold text-slate-900">
                                தனிப்பட்ட தகவல்கள்
                            </h2>
                            <p class="text-sm text-slate-500">
                                Personal Information
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                        {{-- NAME --}}
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                                பெயர் / Name <span class="text-red-500">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   required
                                   placeholder="Enter your name"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                            @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- MOBILE --}}
                        <div>
                            <label for="mobile" class="mb-2 block text-sm font-semibold text-slate-700">
                                கைபேசி எண் / Mobile Number <span class="text-red-500">*</span>
                            </label>

                            <input type="text"
                                   name="mobile"
                                   id="mobile"
                                   value="{{ old('mobile') }}"
                                   placeholder="Enter 10-digit mobile number"
                                   inputmode="numeric"
                                   pattern="[0-9]{10}"
                                   minlength="10"
                                   maxlength="10"
                                   required
                                   title="Please enter exactly 10 digits."
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                            @error('mobile')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- ADDRESS --}}
                        <div class="sm:col-span-2">
                            <label for="address" class="mb-2 block text-sm font-semibold text-slate-700">
                                முகவரி / Address
                            </label>

                            <textarea name="address"
                                      id="address"
                                      rows="3"
                                      placeholder="Enter your address"
                                      class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('address') }}</textarea>

                            @error('address')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CITY --}}
                        <div class="sm:col-span-1">
                            <label for="city_id" class="mb-2 block text-sm font-semibold text-slate-700">
                                ஊர் / City <span class="text-red-500">*</span>
                            </label>

                            <select name="city_id"
                                    id="city_id"
                                    required
                                    onchange="handleCityChange(this)"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                                <option value="">Select your city</option>
                                <option value="add_new_city">＋ Add New City</option>

                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('city_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- DONATION SECTION --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    {{-- SECTION HEADER --}}
                    <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fa-solid fa-list-check text-lg"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-slate-900">
                                    நன்கொடை விவரங்கள்
                                </h2>
                                <p class="text-sm text-slate-500">
                                    Donation Details
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl bg-slate-50 px-4 py-3">
                            <p class="text-sm font-medium text-slate-700">
                                உங்களுக்கு விருப்பமான நன்கொடைகளைத் தேர்வு செய்யவும்.
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Select the donations you wish to contribute to.
                            </p>
                        </div>
                    </div>

                    {{-- CATEGORY LIST --}}
                    <div class="space-y-5 p-4 sm:p-6">

                        @php
                            $oldCategories = array_map(
                                'strval',
                                old('categories', [])
                            );
                        @endphp

                        @forelse($categories as $category)

                            @php
                                $hasSubcategories = $category->subcategories->isNotEmpty();

                                $items = $hasSubcategories
                                    ? $category->subcategories
                                    : collect([$category]);
                            @endphp

                            {{-- CATEGORY CARD --}}
                            <div class="category-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">

                                {{-- MAIN CATEGORY HEADER --}}
                                <div class="flex items-center gap-3 border-b border-emerald-100 bg-emerald-50/80 px-4 py-4 sm:px-5">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-700 text-white shadow-sm">
                                        <i class="fa-solid fa-folder-open text-lg"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-base font-bold text-slate-900 sm:text-lg">
                                            {{ $category->name }}
                                        </h3>

                                    </div>

                                    @if($hasSubcategories)
                                        <span class="hidden rounded-full border border-emerald-200 bg-white px-3 py-1 text-xs font-semibold text-emerald-800 sm:inline-flex">
                                        {{ $items->count() }}
                                            {{ $items->count() === 1 ? 'Option' : 'Options' }}
                                    </span>
                                    @endif

                                </div>

                                {{-- SUBCATEGORY INTRO --}}
                                @if($hasSubcategories)
                                    <div class="border-b border-slate-100 px-4 py-3 sm:px-5">
                                        <p class="text-xs font-medium text-slate-500">
                                            கீழே உள்ள நன்கொடை வகைகளில் தேர்வு செய்யவும்
                                        </p>
                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Choose one or more options under {{ $category->name }}.
                                        </p>
                                    </div>
                                @endif

                                {{-- DONATION OPTIONS --}}
                                <div class="divide-y divide-slate-100">

                                    @foreach($items as $item)

                                        @php
                                            $isSelected = in_array(
                                                (string) $item->id,
                                                $oldCategories,
                                                true
                                            );
                                        @endphp

                                        <div class="donation-option px-4 py-4 transition sm:px-5 {{ $isSelected ? 'bg-emerald-50/50' : 'bg-white' }}">

                                            <div class="grid grid-cols-1 items-center gap-4 sm:grid-cols-[minmax(0,1fr)_160px]">

                                                {{-- CHECKBOX AND NAME --}}
                                                <div class="flex min-w-0 items-start gap-3">

                                                    <input
                                                        type="checkbox"
                                                        name="categories[]"
                                                        value="{{ $item->id }}"
                                                        id="category_{{ $item->id }}"
                                                        class="category-checkbox mt-1 h-5 w-5 shrink-0 cursor-pointer rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                                        data-category-id="{{ $item->id }}"
                                                        data-fixed-amount="{{ $item->amount ?? '' }}"
                                                        {{ $isSelected ? 'checked' : '' }}
                                                    >

                                                    <label for="category_{{ $item->id }}" class="min-w-0 flex-1 cursor-pointer">

                                                    <span class="block text-sm font-semibold leading-5 text-slate-800">
                                                        {{ $item->name }}
                                                    </span>

                                                        @if($item->amount !== null)
                                                            <span class="mt-1 block text-xs text-slate-500">
                                                            நிர்ணயிக்கப்பட்ட தொகை
                                                            <span class="mx-1">·</span>
                                                            Fixed amount
                                                        </span>
                                                        @else
                                                            <span class="mt-1 block text-xs text-slate-500">
                                                            நீங்கள் விரும்பும் தொகையை உள்ளிடவும்
                                                        </span>
                                                            <span class="mt-0.5 block text-xs text-slate-400">
                                                            Enter your preferred donation amount
                                                        </span>
                                                        @endif

                                                    </label>
                                                </div>

                                                {{-- AMOUNT FIELD --}}
                                                <div>
                                                    <label
                                                        for="{{ $item->amount !== null ? 'fixed_amount_' . $item->id : 'amount_' . $item->id }}"
                                                        class="mb-1.5 block text-xs font-semibold text-slate-500"
                                                    >
                                                        தொகை / Amount
                                                    </label>

                                                    @if($item->amount !== null)

                                                        <div class="flex h-11 items-center rounded-lg border border-slate-200 bg-slate-50 px-3">
                                                            <span class="mr-2 text-sm font-medium text-slate-400">₹</span>

                                                            <input
                                                                type="text"
                                                                id="fixed_amount_{{ $item->id }}"
                                                                value="{{ number_format($item->amount, 2, '.', '') }}"
                                                                readonly
                                                                aria-label="Fixed amount for {{ $item->name }}"
                                                                class="w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-700 focus:ring-0"
                                                            >
                                                        </div>

                                                    @else

                                                        <div class="flex h-11 items-center rounded-lg border border-slate-200 bg-white px-3 transition focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100">
                                                            <span class="mr-2 text-sm font-medium text-slate-400">₹</span>

                                                            <input
                                                                type="number"
                                                                name="amounts[{{ $item->id }}]"
                                                                id="amount_{{ $item->id }}"
                                                                step="0.01"
                                                                min="0.01"
                                                                placeholder="0.00"
                                                                value="{{ old('amounts.' . $item->id) }}"
                                                                {{ $isSelected ? '' : 'disabled' }}
                                                                class="amount-input w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-800 placeholder:text-slate-300 focus:ring-0 disabled:cursor-not-allowed"
                                                            >
                                                        </div>

                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>

                        @empty

                            <div class="rounded-xl border border-dashed border-slate-300 px-5 py-10 text-center">
                                <i class="fa-regular fa-folder-open text-3xl text-slate-300"></i>
                                <p class="mt-3 text-sm font-semibold text-slate-700">
                                    நன்கொடை வகைகள் இல்லை
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    No donation categories are available.
                                </p>
                            </div>

                        @endforelse

                        @error('categories')
                        <p class="text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror

                        @error('amounts')
                        <p class="text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- TOTAL DONATION --}}
                    <div class="border-t border-slate-200 bg-slate-50 p-4 sm:p-6">
                        <div class="flex items-center justify-between gap-4 rounded-xl border border-emerald-100 bg-white p-4 shadow-sm sm:px-5">

                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                    <i class="fa-solid fa-calculator text-lg"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-slate-800">
                                        மொத்த நன்கொடை தொகை
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Total Donation Amount
                                    </p>
                                </div>
                            </div>

                            <span id="totalAmount"
                                  aria-live="polite"
                                  class="shrink-0 text-xl font-extrabold tabular-nums text-emerald-700 sm:text-2xl">
                            ₹0.00
                        </span>

                        </div>
                    </div>

                </section>

                {{-- SUBMIT --}}
                <div class="mt-6">
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                    >
                        <i class="fa-solid fa-arrow-right"></i>
                        <span>தொடரவும் / Continue to Payment</span>
                    </button>

                    <p class="mt-3 text-center text-xs text-slate-400">
                        Please verify your details before continuing.
                    </p>
                </div>

            </form>
        </div>
    </div>

    <div id="cityModal"
         class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/50 px-4">

        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">

            <div class="mb-5 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">Add New City</h3>

                <button type="button"
                        onclick="closeCityModal()"
                        class="text-xl text-slate-400 hover:text-slate-700">
                    &times;
                </button>
            </div>

            <label for="new_city_name"
                   class="mb-2 block text-sm font-semibold text-slate-700">
                City Name
            </label>

            <input type="text"
                   id="new_city_name"
                   maxlength="100"
                   placeholder="Enter city name"
                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

            <p id="cityError" class="mt-2 hidden text-sm text-red-600"></p>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        onclick="closeCityModal()"
                        class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600">
                    Cancel
                </button>

                <button type="button"
                        id="saveCityBtn"
                        onclick="saveCity()"
                        class="rounded-xl bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800 disabled:opacity-60">
                    Save City
                </button>
            </div>

        </div>
    </div>

    {{-- TOTAL CALCULATION AND INTERACTIONS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const totalElement = document.getElementById('totalAmount');

            function updateTotal() {
                let total = 0;

                checkboxes.forEach(function (checkbox) {
                    if (!checkbox.checked) {
                        return;
                    }

                    const id = checkbox.dataset.categoryId;
                    const fixedAmount = checkbox.dataset.fixedAmount;
                    const amountInput = document.getElementById('amount_' + id);

                    if (fixedAmount !== '') {
                        total += parseFloat(fixedAmount) || 0;
                    } else if (amountInput) {
                        total += parseFloat(amountInput.value) || 0;
                    }
                });

                if (totalElement) {
                    totalElement.textContent = '₹' + total.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }

            checkboxes.forEach(function (checkbox) {
                const id = checkbox.dataset.categoryId;
                const amountInput = document.getElementById('amount_' + id);
                const option = checkbox.closest('.donation-option');

                if (amountInput) {
                    amountInput.disabled = !checkbox.checked;
                }

                checkbox.addEventListener('change', function () {
                    if (amountInput) {
                        amountInput.disabled = !this.checked;

                        if (!this.checked) {
                            amountInput.value = '';
                        }
                    }

                    if (option) {
                        option.classList.toggle('bg-emerald-50/50', this.checked);
                        option.classList.toggle('bg-white', !this.checked);
                    }

                    updateTotal();
                });
            });

            document.querySelectorAll('.amount-input').forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            updateTotal();
        });
    </script>

    <script>
        function handleCityChange(select) {
            if (select.value === 'add_new_city') {
                select.value = '';

                const modal = document.getElementById('cityModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.getElementById('cityError').classList.add('hidden');

                setTimeout(() => {
                    document.getElementById('new_city_name').focus();
                }, 100);
            }
        }

        function closeCityModal() {
            const modal = document.getElementById('cityModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }


        async function saveCity() {
            const input = document.getElementById('new_city_name');
            const error = document.getElementById('cityError');
            const button = document.getElementById('saveCityBtn');
            const select = document.getElementById('city_id');

            const name = input.value.trim();

            error.classList.add('hidden');
            error.textContent = '';

            if (!name) {
                error.textContent = 'Please enter a city name.';
                error.classList.remove('hidden');
                input.focus();
                return;
            }

            button.disabled = true;
            button.textContent = 'Saving...';

            try {
                const response = await fetch(
                    @json(route('register-receipts.cities.store')),
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                        },
                        body: JSON.stringify({ name })
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Unable to save city.'
                    );
                }

                // Add the newly saved city to the dropdown.
                const option = new Option(
                    data.city.name,
                    data.city.id,
                    true,
                    true
                );

                // Insert after "Select your city" and "Add New City".
                const addCityOption = Array.from(select.options).find(
                    option => option.value === 'add_new_city'
                );

                if (addCityOption) {
                    addCityOption.after(option);
                } else {
                    select.add(option);
                }

                // Select the new city.
                select.value = data.city.id;

                closeCityModal();
                input.value = '';

            } catch (err) {
                error.textContent = err.message ||
                    'Something went wrong. Please try again.';
                error.classList.remove('hidden');
            } finally {
                button.disabled = false;
                button.textContent = 'Save City';
            }
        }
    </script>


@endsection
