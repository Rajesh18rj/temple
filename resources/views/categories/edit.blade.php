@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-2">

        {{-- Page Header --}}
        <div class="mb-6">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">

                <a href="{{ route('categories.index') }}"
                   class="hover:text-violet-600 transition-colors">
                    Categories
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
                Edit Category
            </span>

            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                        Edit Category
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        Update the category details below.
                    </p>
                </div>

                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5
                      rounded-lg
                      border border-slate-200
                      bg-white
                      text-sm font-semibold text-slate-600
                      hover:bg-slate-50
                      hover:text-violet-600
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

                    Back to Categories

                </a>

            </div>

        </div>


        {{-- Form Card --}}
        <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Card Header --}}
            <div class="px-5 sm:px-6 py-5 border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-9 h-9 rounded-lg bg-violet-50
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
                        <h2 class="text-base font-semibold text-slate-800">
                            Category Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Update the details for this receipt category.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form action="{{ route('categories.update', $category) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="p-5 sm:p-6 lg:p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- Category Type --}}
                        <div>
                            <label for="category_type"
                                   class="block text-sm font-medium text-slate-700 mb-2">
                                Category Type <span class="text-red-500">*</span>
                            </label>

                            <select id="category_type"
                                    name="category_type"
                                    class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white
                                           text-sm text-slate-800 outline-none
                                           focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition">
                                <option value="main"
                                    {{ old('category_type', $category->parent_id ? 'sub' : 'main') === 'main' ? 'selected' : '' }}>
                                    Main Category
                                </option>
                                <option value="sub"
                                    {{ old('category_type', $category->parent_id ? 'sub' : 'main') === 'sub' ? 'selected' : '' }}>
                                    Subcategory
                                </option>
                            </select>

                            @error('category_type')
                            <p class="text-xs font-medium text-red-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Parent Category --}}
                        <div id="parent_category_wrapper"
                             class="{{ old('category_type', $category->parent_id ? 'sub' : 'main') === 'sub' ? '' : 'hidden' }}">
                            <label for="parent_id"
                                   class="block text-sm font-medium text-slate-700 mb-2">
                                Parent Category <span class="text-red-500">*</span>
                            </label>

                            <select id="parent_id"
                                    name="parent_id"
                                    class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white
                                           text-sm text-slate-800 outline-none
                                           focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition">
                                <option value="">Select main category</option>
                                @foreach($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}"
                                        {{ (string) old('parent_id', $category->parent_id) === (string) $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('parent_id')
                            <p class="text-xs font-medium text-red-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category Name --}}
                        <div class="md:col-span-2">

                            <label for="name"
                                   class="block text-sm font-medium text-slate-700 mb-2">

                                Category Name

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="Enter category name"
                                   class="w-full px-4 py-2.5
                                      rounded-lg
                                      border border-slate-200
                                      bg-white
                                      text-sm text-slate-800
                                      placeholder:text-slate-400
                                      outline-none
                                      focus:border-violet-400
                                      focus:ring-2 focus:ring-violet-100
                                      transition">

                            @error('name')
                            <p class="text-xs font-medium text-red-600 mt-1.5">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        {{-- Amount --}}
                        <div>

                            <label for="amount"
                                   class="block text-sm font-medium text-slate-700 mb-2">

                                Amount

                                <span class="ml-1 text-xs font-medium text-violet-600
                                         bg-violet-50 px-2 py-0.5 rounded">

                                Optional

                            </span>

                            </label>

                            <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2
                                         text-sm font-semibold text-slate-400">
                                ₹
                            </span>

                                <input type="number"
                                       id="amount"
                                       name="amount"
                                       value="{{ old('amount', $category->amount) }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="Leave empty for manual amount"
                                       class="w-full pl-9 pr-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-white
                                          text-sm text-slate-800
                                          placeholder:text-slate-400
                                          outline-none
                                          focus:border-violet-400
                                          focus:ring-2 focus:ring-violet-100
                                          transition">

                            </div>

                            <p class="text-xs text-slate-500 mt-2">
                                Leave empty if the amount should be entered manually.
                            </p>

                            @error('amount')
                            <p class="text-xs font-medium text-red-600 mt-1.5">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        {{-- Display Order --}}
                        <div>

                            <label for="display_order"
                                   class="block text-sm font-medium text-slate-700 mb-2">

                                Display Order

                            </label>

                            <input type="number"
                                   id="display_order"
                                   name="display_order"
                                   value="{{ old('display_order', $category->display_order) }}"
                                   min="0"
                                   placeholder="Enter display order"
                                   class="w-full px-4 py-2.5
                                      rounded-lg
                                      border border-slate-200
                                      bg-white
                                      text-sm text-slate-800
                                      placeholder:text-slate-400
                                      outline-none
                                      focus:border-violet-400
                                      focus:ring-2 focus:ring-violet-100
                                      transition">

                            <p class="text-xs text-slate-500 mt-2">
                                Controls the order in which categories appear on receipts.
                            </p>

                            @error('display_order')
                            <p class="text-xs font-medium text-red-600 mt-1.5">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-5 sm:px-6 py-4
                        border-t border-slate-200
                        bg-slate-50
                        flex flex-col-reverse sm:flex-row
                        sm:justify-end
                        gap-3">

                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center justify-center
                          px-5 py-2.5
                          rounded-lg
                          border border-slate-200
                          bg-white
                          text-sm font-medium text-slate-600
                          hover:bg-slate-50
                          transition-colors">

                        Cancel

                    </a>


                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                               px-5 py-2.5
                               rounded-lg
                               bg-violet-600
                               text-white
                               text-sm font-semibold
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

                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryType = document.getElementById('category_type');
            const parentWrapper = document.getElementById('parent_category_wrapper');
            const parentSelect = document.getElementById('parent_id');

            function toggleParentCategory() {
                const isSubcategory = categoryType.value === 'sub';

                parentWrapper.classList.toggle('hidden', !isSubcategory);
                parentSelect.required = isSubcategory;

                if (!isSubcategory) {
                    parentSelect.value = '';
                }
            }

            categoryType.addEventListener('change', toggleParentCategory);
            toggleParentCategory();
        });
    </script>

@endsection
