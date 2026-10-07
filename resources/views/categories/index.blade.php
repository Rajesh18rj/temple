@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        {{-- Page Header --}}
        <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- Title --}}
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center
                    rounded-2xl bg-violet-50 text-violet-600">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M4 6.75A2.75 2.75 0 016.75 4h10.5A2.75 2.75 0 0120 6.75v10.5A2.75 2.75 0 0117.25 20H6.75A2.75 2.75 0 014 17.25V6.75z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M8 9h8M8 13h5M8 17h3"/>

                    </svg>

                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                        Category Master
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Manage receipt categories and their amounts.
                    </p>
                </div>

            </div>


            {{-- Add Category --}}
            <a href="{{ route('categories.create') }}"
               class="group inline-flex items-center justify-center gap-2
              rounded-xl bg-violet-600 px-4 py-2.5
              text-sm font-semibold text-white
              shadow-sm shadow-violet-200
              transition-all duration-200
              hover:bg-violet-700
              hover:shadow-md hover:shadow-violet-200">

        <span class="flex h-7 w-7 items-center justify-center
                     rounded-lg bg-white/15">

            <svg class="h-4 w-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>

            </svg>

        </span>

                Add Category

            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="mb-5 rounded-lg
                    border border-emerald-200
                    bg-emerald-50
                    px-4 py-3">

                <div class="flex items-center gap-2">

                    <svg class="w-5 h-5 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    <p class="text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Main Container --}}
        <div class="bg-white
                border border-slate-200
                rounded-xl
                shadow-sm
                overflow-hidden">


            {{-- Section Header --}}
            <div class="px-5 sm:px-6 py-4
                    border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800">
                    Categories List
                </h2>

                <p class="text-sm text-slate-500 mt-0.5">
                    All available receipt categories
                </p>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px]">

                    {{-- Table Header --}}
                    <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            #
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Category Name
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Amount
                        </th>

                        <th class="px-5 py-3
                                   text-left
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Display Order
                        </th>

                        <th class="px-5 py-3
                                   text-right
                                   text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wide
                                   text-slate-500">
                            Actions
                        </th>

                    </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-100">

                    @forelse($categories as $category)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}
                            <td class="px-5 py-4
                                       text-sm
                                       text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Category Name --}}
                            <td class="px-5 py-4">

                                <p class="text-sm
                                          font-medium
                                          text-slate-800">

                                    {{ $category->name }}

                                </p>

                            </td>


                            {{-- Amount --}}
                            <td class="px-5 py-4">

                                @if($category->amount !== null)

                                    <span class="text-sm
                                                 font-medium
                                                 text-emerald-600">

                                        ₹{{ number_format($category->amount, 2) }}

                                    </span>

                                @else

                                    <span class="text-sm
                                                 text-amber-600">

                                        Manual Amount

                                    </span>

                                @endif

                            </td>


                            {{-- Display Order --}}
                            <td class="px-5 py-4
                                       text-sm
                                       text-slate-600">

                                {{ $category->display_order }}

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center
                                            justify-end gap-2">


                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="inline-flex items-center gap-1.5
                                              px-3 py-1.5
                                              rounded-md
                                              border border-slate-200
                                              text-slate-600
                                              text-xs
                                              font-medium
                                              hover:bg-slate-100
                                              hover:text-slate-800
                                              transition">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('categories.destroy', $category) }}"
                                          method="POST"
                                          class="delete-form"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1.5
                                                       rounded-md
                                                       border border-red-200
                                                       text-red-600
                                                       text-xs
                                                       font-medium
                                                       hover:bg-red-50
                                                       transition">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.8"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="5"
                                class="px-5 py-12 text-center">

                                <div class="max-w-sm mx-auto">


                                    {{-- Empty Icon --}}
                                    <div class="w-12 h-12
                                                mx-auto mb-3
                                                rounded-full
                                                bg-slate-100
                                                flex items-center
                                                justify-center">

                                        <svg class="w-6 h-6 text-slate-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.5"
                                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m14 0l-3.5 3.5a2 2 0 01-2.828 0L12 14l-1.672 1.672a2 2 0 01-2.828 0L4 12m16 1v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>

                                        </svg>

                                    </div>


                                    <h3 class="text-base
                                               font-semibold
                                               text-slate-800">

                                        No categories found

                                    </h3>


                                    <p class="text-sm
                                              text-slate-500
                                              mt-1">

                                        Create your first receipt category
                                        to get started.

                                    </p>


                                    {{-- Add Category --}}
                                    <a href="{{ route('categories.create') }}"
                                       class="mt-4
                                              inline-flex
                                              items-center
                                              gap-2
                                              px-4 py-2
                                              rounded-lg
                                              bg-violet-600
                                              text-white
                                              text-sm
                                              font-medium
                                              hover:bg-violet-700
                                              transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 4v16m8-8H4"/>

                                        </svg>

                                        Add Category

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
