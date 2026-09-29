@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-[#f8f7ff] p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="flex items-center gap-4 mb-7">

            <a href="{{ route('categories.index') }}"
               class="w-10 h-10 rounded-xl
                  bg-white border border-purple-100
                  flex items-center justify-center
                  text-slate-500
                  hover:text-purple-600
                  hover:bg-purple-50
                  transition-all">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>

                </svg>

            </a>


            <div class="w-14 h-14 rounded-2xl
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
                          d="M12 4v16m8-8H4"/>

                </svg>

            </div>


            <div>

                <h1 class="text-2xl sm:text-3xl font-bold text-[#18213d] tracking-tight">
                    Add Category
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Create a new receipt category.
                </p>

            </div>

        </div>


        {{-- Full Width Form --}}
        <div class="w-full">

            <div class="w-full bg-white rounded-3xl
                    border border-purple-100
                    shadow-[0_10px_40px_rgba(91,65,170,0.07)]
                    overflow-hidden">


                {{-- Card Header --}}
                <div class="px-6 sm:px-8 lg:px-10 py-6
                        bg-gradient-to-r from-violet-50/80 to-purple-50/40
                        border-b border-purple-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl
                                bg-white
                                shadow-sm
                                flex items-center justify-center">

                            <svg class="w-5 h-5 text-violet-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 4v16m8-8H4"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-[#18213d]">
                                Category Information
                            </h2>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Enter the details for this receipt category.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Form --}}
                <form action="{{ route('categories.store') }}"
                      method="POST">

                    @csrf

                    <div class="p-6 sm:p-8 lg:p-10">

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-7">


                            {{-- Category Name --}}
                            <div class="lg:col-span-2">

                                <label for="name"
                                       class="flex items-center gap-1.5
                                          text-sm font-semibold text-[#18213d] mb-2.5">

                                    Category Name

                                    <span class="text-rose-500">*</span>

                                </label>

                                <div class="relative">

                                    <div class="absolute inset-y-0 left-0
                                            pl-4 flex items-center
                                            pointer-events-none">

                                        <svg class="w-5 h-5 text-slate-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M7 7h10M7 11h10M7 15h6m6-10v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z"/>

                                        </svg>

                                    </div>

                                    <input type="text"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Enter category name"
                                           class="w-full pl-12 pr-4 py-3.5
                                              rounded-xl
                                              border border-slate-200
                                              bg-slate-50/50
                                              text-sm text-[#18213d]
                                              placeholder:text-slate-400
                                              outline-none
                                              focus:bg-white
                                              focus:border-violet-400
                                              focus:ring-4 focus:ring-violet-100
                                              transition-all">

                                </div>

                                @error('name')

                                <div class="flex items-center gap-1.5 mt-2">

                                    <svg class="w-4 h-4 text-rose-500"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 8v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>

                                    </svg>

                                    <p class="text-xs font-medium text-rose-600">
                                        {{ $message }}
                                    </p>

                                </div>

                                @enderror

                            </div>


                            {{-- Amount --}}
                            <div>

                                <label for="amount"
                                       class="text-sm font-semibold text-[#18213d] mb-2.5 flex items-center gap-2">

                                    Amount

                                    <span class="px-2 py-0.5 rounded-md
                                             bg-violet-50
                                             text-violet-600
                                             text-[10px] font-bold uppercase tracking-wide">
                                    Optional
                                </span>

                                </label>

                                <div class="relative">

                                    <div class="absolute inset-y-0 left-0
                                            pl-4 flex items-center
                                            pointer-events-none">

                                    <span class="text-lg font-semibold text-slate-400">
                                        ₹
                                    </span>

                                    </div>

                                    <input type="number"
                                           id="amount"
                                           name="amount"
                                           value="{{ old('amount') }}"
                                           step="0.01"
                                           min="0"
                                           placeholder="Leave empty for manual amount"
                                           class="w-full pl-12 pr-4 py-3.5
                                              rounded-xl
                                              border border-slate-200
                                              bg-slate-50/50
                                              text-sm text-[#18213d]
                                              placeholder:text-slate-400
                                              outline-none
                                              focus:bg-white
                                              focus:border-violet-400
                                              focus:ring-4 focus:ring-violet-100
                                              transition-all">

                                </div>

                                <div class="flex items-start gap-2 mt-2.5">

                                    <svg class="w-4 h-4 text-violet-400 mt-0.5 shrink-0"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.8"
                                              d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"/>

                                    </svg>

                                    <p class="text-xs text-slate-500 leading-5">
                                        Leave this empty if the amount should be entered manually while creating a receipt.
                                    </p>

                                </div>

                                @error('amount')

                                <p class="text-xs font-medium text-rose-600 mt-2">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- Display Order --}}
                            <div>

                                <label for="display_order"
                                       class="text-sm font-semibold text-[#18213d] mb-2.5 flex items-center gap-2">

                                    Display Order

                                </label>

                                <input type="number"
                                       id="display_order"
                                       name="display_order"
                                       value="{{ old('display_order', 0) }}"
                                       min="0"
                                       class="w-full px-4 py-3.5
                                          rounded-xl
                                          border border-slate-200
                                          bg-slate-50/50
                                          text-sm text-[#18213d]
                                          outline-none
                                          focus:bg-white
                                          focus:border-violet-400
                                          focus:ring-4 focus:ring-violet-100
                                          transition-all">

                                <div class="flex items-center gap-2 mt-2.5">

                                    <div class="w-7 h-7 rounded-lg
                                            bg-blue-50
                                            flex items-center justify-center
                                            shrink-0">

                                        <svg class="w-4 h-4 text-blue-500"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M4 6h16M4 12h16M4 18h16"/>

                                        </svg>

                                    </div>

                                    <p class="text-xs text-slate-500">
                                        Controls the order in which categories appear on receipts.
                                    </p>

                                </div>

                                @error('display_order')

                                <p class="text-xs font-medium text-rose-600 mt-2">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="px-6 sm:px-8 lg:px-10 py-5
                            bg-slate-50/70
                            border-t border-slate-100
                            flex flex-col-reverse sm:flex-row
                            sm:items-center sm:justify-end
                            gap-3">

                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center justify-center gap-2
                              px-5 py-3
                              rounded-xl
                              border border-slate-200
                              bg-white
                              text-sm font-semibold text-slate-600
                              hover:bg-slate-50
                              hover:border-slate-300
                              transition-all">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>

                            </svg>

                            Cancel

                        </a>


                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2
                                   px-6 py-3
                                   rounded-xl
                                   bg-gradient-to-r from-violet-600 to-purple-600
                                   text-white
                                   text-sm font-semibold
                                   shadow-lg shadow-purple-200
                                   hover:from-violet-700 hover:to-purple-700
                                   hover:-translate-y-0.5
                                   focus:outline-none
                                   focus:ring-4 focus:ring-purple-100
                                   transition-all">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                            Save Category

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
