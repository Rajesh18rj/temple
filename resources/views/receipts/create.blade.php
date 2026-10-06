@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-2">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4 mb-6">

            <div>

                <div class="flex items-center gap-2
                        text-sm text-slate-500 mb-2">

                    <a href="{{ route('receipts.index') }}"
                       class="hover:text-violet-600 transition">

                        Receipts

                    </a>

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>

                    </svg>

                    <span>New Receipt</span>

                </div>


                <h1 class="text-2xl font-semibold text-slate-800">
                    New Receipt
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Create a new receipt by entering the donor information.
                </p>

            </div>


            {{-- Back --}}
            <a href="{{ route('receipts.index') }}"
               class="inline-flex items-center
                  justify-center gap-2
                  px-4 py-2.5
                  rounded-lg
                  bg-white
                  border border-slate-200
                  text-sm font-medium
                  text-slate-600
                  hover:bg-slate-50
                  transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>

                </svg>

                Back to Receipts

            </a>

        </div>


        {{-- Main Form Card --}}
        <div class="bg-white
                border border-slate-200
                rounded-xl
                shadow-sm
                overflow-hidden">


            {{-- Card Header --}}
            <div class="px-5 sm:px-6 py-4
                    border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800">
                    Receipt Information
                </h2>

                <p class="text-sm text-slate-500 mt-0.5">
                    Enter the basic details of the receipt holder.
                </p>

            </div>


            {{-- Form --}}
            <form action="{{ route('receipts.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <div class="p-5 sm:p-6 lg:p-8">


                    {{-- ================= DONOR DETAILS ================= --}}
                    <div class="mb-8">

                        <div class="mb-5">

                            <h3 class="text-sm font-semibold text-slate-800">
                                Donor Details
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Basic information about the receipt holder.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">


                            {{-- Name --}}
                            <div class="lg:col-span-2">

                                <label for="name"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-1.5">

                                    Name
                                    <span class="text-red-500">*</span>

                                </label>


                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Enter receipt holder name"
                                       class="w-full h-11
                                          px-3.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-white
                                          text-sm text-slate-700
                                          placeholder:text-slate-400
                                          outline-none
                                          focus:border-violet-400
                                          focus:ring-2
                                          focus:ring-violet-100
                                          transition">

                                @error('name')

                                <p class="text-sm text-red-600 mt-1.5">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- Mobile --}}
                            <div>

                                <label for="mobile"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-1.5">

                                    Mobile

                                </label>


                                <input type="text"
                                       id="mobile"
                                       name="mobile"
                                       value="{{ old('mobile') }}"
                                       placeholder="Enter mobile number"
                                       class="w-full h-11
                                          px-3.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-white
                                          text-sm text-slate-700
                                          placeholder:text-slate-400
                                          outline-none
                                          focus:border-violet-400
                                          focus:ring-2
                                          focus:ring-violet-100
                                          transition">

                                @error('mobile')

                                <p class="text-sm text-red-600 mt-1.5">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- Date --}}
                            <div>

                                <label for="receipt_date"
                                       class="block text-sm
                                          font-medium
                                          text-slate-700 mb-1.5">

                                    Receipt Date

                                </label>


                                <input type="text"
                                       id="receipt_date"
                                       value="{{ now()->format('d-m-Y') }}"
                                       disabled
                                       class="w-full h-11
                                          px-3.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-100
                                          text-sm
                                          text-slate-500
                                          cursor-not-allowed">


                                <p class="text-xs text-slate-400 mt-1.5">
                                    Current date will be saved automatically.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Divider --}}
                    <div class="border-t border-slate-200 mb-8"></div>


                    {{-- ================= ADDRESS & CITY ================= --}}
                    <div class="mb-8">

                        <div class="mb-5">

                            <h3 class="text-sm font-semibold text-slate-800">
                                Address Details
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Enter the donor's address and city.
                            </p>

                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                            {{-- ================= ADDRESS ================= --}}
                            <div>

                                <label for="address"
                                       class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Address
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    placeholder="Enter complete address"
                                    class="w-full px-3.5 py-3
                       rounded-lg
                       border border-slate-200
                       bg-white
                       text-sm text-slate-700
                       placeholder:text-slate-400
                       resize-none
                       outline-none
                       focus:border-violet-400
                       focus:ring-2
                       focus:ring-violet-100
                       transition">{{ old('address') }}</textarea>

                                @error('address')
                                <p class="text-sm text-red-600 mt-1.5">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            {{-- ================= CITY ================= --}}
                            <div>

                                <label for="city_id"
                                       class="block text-sm font-medium text-slate-700 mb-1.5">

                                    City
                                    <span class="text-red-500">*</span>

                                </label>

                                <select
                                    id="city_id"
                                    name="city_id"
                                    class="w-full h-11
                       px-3.5
                       rounded-lg
                       border border-slate-200
                       bg-white
                       text-sm text-slate-700
                       outline-none
                       focus:border-violet-400
                       focus:ring-2
                       focus:ring-violet-100
                       transition">

                                    <option value="">Select City</option>

                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('city_id')
                                <p class="text-sm text-red-600 mt-1.5">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Divider --}}
                    <div class="border-t border-slate-200 mb-8"></div>

                </div>


                {{-- ================= FOOTER ================= --}}
                <div class="px-5 sm:px-6 py-4
                        border-t border-slate-200
                        bg-slate-50
                        flex flex-col-reverse
                        sm:flex-row
                        sm:items-center
                        sm:justify-end
                        gap-3">


                    {{-- Cancel --}}
                    <a href="{{ route('receipts.index') }}"
                       class="w-full sm:w-auto
                          inline-flex
                          items-center
                          justify-center
                          px-5 py-2.5
                          rounded-lg
                          border border-slate-200
                          bg-white
                          text-sm font-medium
                          text-slate-600
                          hover:bg-slate-50
                          transition">

                        Cancel

                    </a>


                    {{-- Save --}}
                    <button type="submit"
                            class="w-full sm:w-auto
                               inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-6 py-2.5
                               rounded-lg
                               bg-violet-600
                               text-white
                               text-sm
                               font-medium
                               hover:bg-violet-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-violet-200
                               transition">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Save & Continue

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ================= FILE NAME SCRIPT ================= --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const fileInput = document.getElementById('paymentProof');
            const fileName = document.getElementById('fileName');

            if (fileInput && fileName) {

                fileInput.addEventListener('change', function () {

                    if (this.files.length > 0) {

                        fileName.textContent =
                            'Selected: ' + this.files[0].name;

                        fileName.classList.remove('hidden');

                    } else {

                        fileName.textContent = '';

                        fileName.classList.add('hidden');

                    }

                });

            }

        });

    </script>

@endsection
