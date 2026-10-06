@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-semibold text-slate-800">
                    Receipts
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Manage temple receipts.
                </p>
            </div>

            {{-- New Receipt --}}
            <a href="{{ route('receipts.create') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5
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

                New Receipt

            </a>

        </div>

        <div class="flex flex-wrap items-center gap-2">

            {{-- Download All --}}
            <a href="{{ route('receipts.export.all') }}"
               class="inline-flex items-center justify-center gap-2
              px-4 py-2.5
              rounded-lg
              bg-emerald-600
              text-white
              text-sm font-medium
              hover:bg-emerald-700
              transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3
                     M4 19h16
                     M5 5h14
                     a2 2 0 012 2v12
                     a2 2 0 01-2 2H5
                     a2 2 0 01-2-2V7
                     a2 2 0 012-2z"/>

                </svg>

                Download All
            </a>


            {{-- Download Filtered --}}
            <a href="{{ route('receipts.export', request()->query()) }}"
               class="inline-flex items-center justify-center gap-2
              px-4 py-2.5
              rounded-lg
              bg-violet-600
              text-white
              text-sm font-medium
              hover:bg-violet-700
              transition">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3
                     M4 19h16
                     M5 5h14
                     a2 2 0 012 2v12
                     a2 2 0 01-2 2H5
                     a2 2 0 01-2-2V7
                     a2 2 0 012-2z"/>

                </svg>

                Download Filtered
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

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between
                            gap-4">

                    {{-- Title --}}
                    <div>

                        <h2 class="text-base font-semibold text-slate-800">
                            Receipt List
                        </h2>

                        <p class="text-sm text-slate-500 mt-0.5">
                            View and manage temple receipts
                        </p>

                    </div>


                    {{-- Filters --}}
                    <form method="GET"
                          action="{{ route('receipts.index') }}"
                          class="flex flex-col sm:flex-row
                                 sm:flex-wrap
                                 items-stretch sm:items-center
                                 gap-2">

                        {{-- Mobile Search --}}
                        <div class="relative">

                            <svg class="absolute left-3 top-1/2
                                        -translate-y-1/2
                                        w-4 h-4 text-slate-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M21 21l-4.35-4.35
                                         m2.35-5.65
                                         a8 8 0 11-16 0
                                         8 8 0 0116 0z"/>

                            </svg>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ request('mobile') }}"
                                placeholder="Mobile number"
                                class="w-full sm:w-44
                                       pl-9 pr-3 py-2
                                       rounded-lg
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       placeholder:text-slate-400
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-violet-100
                                       focus:border-violet-400"
                            >

                        </div>


                        {{-- City Filter --}}
                        <select
                            name="city_id"
                            class="w-full sm:w-40
                                   px-3 py-2
                                   rounded-lg
                                   border border-slate-200
                                   bg-white
                                   text-sm text-slate-700
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-violet-100
                                   focus:border-violet-400">

                            <option value="">
                                All Cities
                            </option>

                            @foreach($cities as $city)

                                <option value="{{ $city->id }}"
                                    {{ request('city_id') == $city->id ? 'selected' : '' }}>

                                    {{ $city->name }}

                                </option>

                            @endforeach

                        </select>


                        {{-- From Date --}}
                        <div class="relative">

                            <input
                                type="date"
                                name="from_date"
                                value="{{ request('from_date') }}"
                                title="From Date"
                                class="w-full sm:w-36
                                       px-3 py-2
                                       rounded-lg
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-violet-100
                                       focus:border-violet-400"
                            >

                        </div>


                        {{-- To Date --}}
                        <div class="relative">

                            <input
                                type="date"
                                name="to_date"
                                value="{{ request('to_date') }}"
                                title="To Date"
                                class="w-full sm:w-36
                                       px-3 py-2
                                       rounded-lg
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-violet-100
                                       focus:border-violet-400"
                            >

                        </div>


                        {{-- Search Button --}}
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center
                                   gap-1.5
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
                                      d="M21 21l-4.35-4.35
                                         M11 19a8 8 0 100-16
                                         8 8 0 000 16z"/>

                            </svg>

                            Search

                        </button>


                        {{-- Clear Filters --}}
                        @if(request()->hasAny([
                            'mobile',
                            'city_id',
                            'from_date',
                            'to_date'
                        ]))

                            <a href="{{ route('receipts.index') }}"
                               class="inline-flex items-center justify-center
                                      px-4 py-2
                                      rounded-lg
                                      border border-slate-200
                                      bg-white
                                      text-slate-600
                                      text-sm
                                      font-medium
                                      hover:bg-slate-50
                                      transition">

                                Clear

                            </a>

                        @endif

                    </form>

                </div>


                {{-- Result Count --}}
                <div class="mt-3">

                    <span class="inline-flex items-center gap-2
                                 px-3 py-1.5
                                 rounded-lg
                                 bg-slate-50
                                 border border-slate-200">

                        <span class="w-2 h-2 rounded-full bg-violet-500"></span>

                        <span class="text-xs font-medium text-slate-600">
                            {{ $receipts->total() }} Receipts
                        </span>

                    </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    {{-- Table Header --}}
                    <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        {{-- # --}}
                        <th class="px-5 py-3
                                       text-left
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            #

                        </th>


                        {{-- Name --}}
                        <th class="px-5 py-3
                                       text-left
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            Name

                        </th>


                        {{-- Mobile --}}
                        <th class="px-5 py-3
                                       text-left
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            Mobile

                        </th>


                        {{-- Date --}}
                        <th class="px-5 py-3
                                       text-left
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            Date

                        </th>

                        {{-- City --}}
                        <th class="px-5 py-3
                           text-left
                           text-xs
                           font-semibold
                           uppercase
                           tracking-wide
                           text-slate-500">
                            City
                        </th>


                        {{-- Type --}}
                        <th class="px-5 py-3
                                       text-center
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            Type

                        </th>


                        {{-- Action --}}
                        <th class="px-5 py-3
                                       text-center
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                            Action

                        </th>

                    </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-100">

                    @forelse($receipts as $receipt)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}
                            <td class="px-5 py-4
                                       text-sm
                                       text-slate-500">

                                {{ $receipts->firstItem() + $loop->index }}

                            </td>


                            {{-- Name --}}
                            <td class="px-5 py-4">

                                <div>

                                    <p class="text-sm
                                              font-medium
                                              text-slate-800">

                                        {{ $receipt->name }}

                                    </p>

                                    <p class="text-xs
                                              text-slate-400
                                              mt-0.5">

                                        Receipt #{{ $receipt->id }}

                                    </p>

                                </div>

                            </td>


                            {{-- Mobile --}}
                            <td class="px-5 py-4">

                                @if($receipt->mobile)

                                    <span class="text-sm text-slate-600">
                                        {{ $receipt->mobile }}
                                    </span>

                                @else

                                    <span class="text-sm text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td class="px-5 py-4">

                                <span class="text-sm text-slate-600">

                                    {{ $receipt->date
                                        ? $receipt->date->format('d-m-Y')
                                        : '-' }}

                                </span>

                            </td>

                            {{-- City --}}
                            <td class="px-5 py-4 text-left">

                                @if($receipt->city)

                                    <span class="text-sm text-slate-600">
                                        {{ $receipt->city->name }}
                                    </span>

                                                            @else

                                                                <span class="text-sm text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Type --}}
                            <td class="px-5 py-4 text-center">

                                @if($receipt->receipt_type === 'walk_in')

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full
                                                 bg-emerald-50
                                                 px-2.5 py-1
                                                 text-xs
                                                 font-semibold
                                                 text-emerald-600">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-emerald-500">
                                        </span>

                                        Walk-in

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full
                                                 bg-violet-50
                                                 px-2.5 py-1
                                                 text-xs
                                                 font-semibold
                                                 text-violet-600">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-violet-500">
                                        </span>

                                        Registered

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4 text-center">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('receipts.view', $receipt) }}"
                                       class="inline-flex items-center gap-1.5
                                              px-3 py-1.5
                                              rounded-md
                                              border border-violet-200
                                              text-violet-600
                                              text-xs
                                              font-medium
                                              hover:bg-violet-50
                                              transition">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M2.5 12s3.5-6 9.5-6
                                                     9.5 6 9.5 6-3.5 6-9.5 6
                                                     -9.5-6-9.5-6z"/>

                                            <circle cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                    stroke-width="1.8"/>

                                        </svg>

                                        View

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('receipts.edit', $receipt) }}"
                                       class="inline-flex items-center gap-1.5
                                              px-3 py-1.5
                                              rounded-md
                                              border border-blue-200
                                              text-blue-600
                                              text-xs
                                              font-medium
                                              hover:bg-blue-50
                                              transition">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M11 5H6a2 2 0 00-2 2v11
                                                     a2 2 0 002 2h11a2 2 0 002-2v-5
                                                     M18.5 2.5a2.121 2.121 0 013 3L12 15
                                                     l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('receipts.destroy', $receipt) }}"
                                          method="POST"
                                          class="delete-form">

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
                                                      d="M19 7l-.867 12.142
                                                         A2 2 0 0116.138 21H7.862
                                                         a2 2 0 01-1.995-1.858L5 7
                                                         m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4
                                                         a1 1 0 011 1v3m-9 0h14"/>

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

                            <td colspan="6"
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
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5
                                                     a2 2 0 012-2h5.586a1 1 0 01.707.293
                                                     l5.414 5.414a1 1 0 01.293.707V19
                                                     a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>


                                    <h3 class="text-base
                                               font-semibold
                                               text-slate-800">

                                        No receipts found

                                    </h3>


                                    <p class="text-sm
                                              text-slate-500
                                              mt-1">

                                        @if(request()->hasAny([
                                            'mobile',
                                            'city_id',
                                            'from_date',
                                            'to_date'
                                        ]))

                                            No receipts match your filters.

                                        @else

                                            Create your first temple receipt
                                            to get started.

                                        @endif

                                    </p>


                                    {{-- Clear Filters --}}
                                    @if(request()->hasAny([
                                        'mobile',
                                        'city_id',
                                        'from_date',
                                        'to_date'
                                    ]))

                                        <a href="{{ route('receipts.index') }}"
                                           class="mt-4
                                                  inline-flex
                                                  items-center
                                                  gap-2
                                                  px-4 py-2
                                                  rounded-lg
                                                  border border-slate-200
                                                  text-slate-600
                                                  text-sm
                                                  font-medium
                                                  hover:bg-slate-50
                                                  transition">

                                            Clear Filters

                                        </a>

                                    @else

                                        {{-- New Receipt --}}
                                        <a href="{{ route('receipts.create') }}"
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

                                            New Receipt

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($receipts->hasPages())

                <div class="px-5 sm:px-6 py-4 border-t border-slate-200">

                    {{ $receipts->links() }}

                </div>

            @endif


        </div>

    </div>

@endsection
