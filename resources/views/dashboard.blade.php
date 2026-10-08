@extends('layouts.master')

@section('content')

    <div class="space-y-8">

        <form method="GET"
              action="{{ route('dashboard') }}"
              class="flex items-center gap-2">

            {{-- From Date --}}
            <div class="relative">
                <input
                    type="date"
                    id="from_date"
                    name="from_date"
                    value="{{ $fromDate }}"
                    class="h-10 w-[145px] rounded-xl border border-slate-200
                   bg-white px-3 text-xs font-medium text-slate-600
                   shadow-sm outline-none transition
                   hover:border-slate-300
                   focus:border-violet-400
                   focus:ring-2 focus:ring-violet-100">

                <span class="pointer-events-none absolute -top-2 left-3
                     bg-slate-50 px-1 text-[9px] font-semibold
                     uppercase tracking-wider text-slate-400">
            From
        </span>
            </div>


            {{-- To Date --}}
            <div class="relative">
                <input
                    type="date"
                    id="to_date"
                    name="to_date"
                    value="{{ $toDate }}"
                    class="h-10 w-[145px] rounded-xl border border-slate-200
                   bg-white px-3 text-xs font-medium text-slate-600
                   shadow-sm outline-none transition
                   hover:border-slate-300
                   focus:border-violet-400
                   focus:ring-2 focus:ring-violet-100">

                <span class="pointer-events-none absolute -top-2 left-3
                     bg-slate-50 px-1 text-[9px] font-semibold
                     uppercase tracking-wider text-slate-400">
            To
        </span>
            </div>


            {{-- Filter --}}
            <button
                type="submit"
                class="inline-flex h-10 items-center gap-2 rounded-xl
               bg-violet-600 px-4 text-xs font-semibold text-white
               shadow-sm shadow-violet-200 transition
               hover:bg-violet-700 hover:shadow-md">

                <i class="fa-solid fa-filter text-[10px]"></i>

                Filter
            </button>


            {{-- Clear --}}
            @if($fromDate || $toDate)

                <a href="{{ route('dashboard') }}"
                   class="inline-flex h-10 w-10 items-center justify-center
                  rounded-xl border border-slate-200 bg-white
                  text-slate-400 shadow-sm transition
                  hover:border-red-200 hover:bg-red-50
                  hover:text-red-500">

                    <i class="fa-solid fa-xmark text-xs"></i>

                </a>

            @endif

        </form>

        {{-- ========================================================= --}}
        {{-- SUMMARY CARDS --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

            {{-- Total Receipts --}}
            <div class="group relative overflow-hidden rounded-3xl border border-indigo-100
                    bg-white p-6 shadow-sm transition duration-300
                    hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-100/60">

                <div class="absolute right-0 top-0 h-32 w-32 rounded-full
                        bg-indigo-50 opacity-70 blur-2xl"></div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total Receipts
                            </p>

                            <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                {{ number_format($totalReceipts) }}
                            </h3>

                            <div class="mt-3 flex items-center gap-2">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-indigo-50">
                                <i class="fa-solid fa-arrow-up text-[9px] text-indigo-600"></i>
                            </span>

                                <span class="text-xs font-medium text-slate-500">
                                Receipts generated
                            </span>
                            </div>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-gradient-to-br from-indigo-600
                                via-violet-600 to-fuchsia-500 text-white
                                shadow-lg shadow-indigo-200/60
                                transition duration-300
                                group-hover:scale-105">

                            <i class="fa-solid fa-receipt text-xl"></i>

                        </div>

                    </div>

                    <div class="mt-6 h-1 w-full overflow-hidden rounded-full bg-indigo-50">
                        <div class="h-full w-2/3 rounded-full
                                bg-gradient-to-r from-indigo-500 to-violet-500">
                        </div>
                    </div>

                </div>
            </div>


            {{-- Cities Covered --}}
            <div class="group relative overflow-hidden rounded-3xl border border-emerald-100
                    bg-white p-6 shadow-sm transition duration-300
                    hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/60">

                <div class="absolute right-0 top-0 h-32 w-32 rounded-full
                        bg-emerald-50 opacity-70 blur-2xl"></div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Cities Covered
                            </p>

                            <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                                {{ number_format($totalCities) }}
                            </h3>

                            <div class="mt-3 flex items-center gap-2">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-50">
                                <i class="fa-solid fa-location-dot text-[9px] text-emerald-600"></i>
                            </span>

                                <span class="text-xs font-medium text-slate-500">
                                Cities with contributions
                            </span>
                            </div>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-gradient-to-br from-emerald-500
                                via-teal-500 to-cyan-500 text-white
                                shadow-lg shadow-emerald-200/60
                                transition duration-300
                                group-hover:scale-105">

                            <i class="fa-solid fa-city text-xl"></i>

                        </div>

                    </div>

                    <div class="mt-6 h-1 w-full overflow-hidden rounded-full bg-emerald-50">
                        <div class="h-full w-2/3 rounded-full
                                bg-gradient-to-r from-emerald-500 to-teal-500">
                        </div>
                    </div>

                </div>
            </div>


            {{-- Total Amount --}}
            <div class="group relative overflow-hidden rounded-3xl border border-amber-100
                    bg-white p-6 shadow-sm transition duration-300
                    hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-100/60
                    md:col-span-2 xl:col-span-1">

                <div class="absolute right-0 top-0 h-32 w-32 rounded-full
                        bg-amber-50 opacity-70 blur-2xl"></div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div class="min-w-0">

                            <p class="text-sm font-medium text-slate-500">
                                Total Amount
                            </p>

                            <h3 class="mt-3 truncate text-3xl font-bold tracking-tight text-slate-900">
                                ₹{{ number_format($totalAmount, 2) }}
                            </h3>

                            <div class="mt-3 flex items-center gap-2">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-amber-50">
                                <i class="fa-solid fa-indian-rupee-sign text-[9px] text-amber-600"></i>
                            </span>

                                <span class="text-xs font-medium text-slate-500">
                                Total contribution received
                            </span>
                            </div>

                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-gradient-to-br from-amber-500
                                via-orange-500 to-rose-500 text-white
                                shadow-lg shadow-amber-200/60
                                transition duration-300
                                group-hover:scale-105">

                            <i class="fa-solid fa-indian-rupee-sign text-xl"></i>

                        </div>

                    </div>

                    <div class="mt-6 h-1 w-full overflow-hidden rounded-full bg-amber-50">
                        <div class="h-full w-full rounded-full
                                bg-gradient-to-r from-amber-400 to-orange-500">
                        </div>
                    </div>

                </div>
            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CATEGORY-WISE CONTRIBUTION --}}
        {{-- ========================================================= --}}
        <div class="overflow-hidden rounded-[28px] border border-slate-200/70 bg-white shadow-sm">

            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="relative overflow-hidden border-b border-slate-100 px-6 py-6 sm:px-7">

                {{-- Soft background decoration --}}
                <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32
                    rounded-full bg-violet-100/60 blur-2xl">
                </div>

                <div class="relative flex items-center justify-between gap-4">

                    <div class="flex items-center gap-3.5">

                        {{-- Icon --}}
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center
                            rounded-2xl bg-gradient-to-br from-violet-500
                            to-fuchsia-500 text-white
                            shadow-lg shadow-violet-200/50">

                            <i class="fa-solid fa-chart-column text-sm"></i>

                        </div>

                        <div>

                            <h3 class="text-[15px] font-bold tracking-tight text-slate-800">
                                Category-wise Contribution
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Contribution collected by category
                            </p>

                        </div>

                    </div>


                    {{-- Category count --}}
                    <div class="flex shrink-0 items-center gap-2 rounded-full
                        border border-violet-100 bg-violet-50/70
                        px-3 py-1.5">

                        <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span>

                        <span class="text-[10px] font-bold uppercase
                             tracking-wider text-violet-600">

                    {{ $categoryTotals->count() }} Categories

                </span>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CATEGORY LIST --}}
            {{-- ========================================================= --}}

            <div class="px-4 py-3 sm:px-5">

                @forelse($categoryTotals as $index => $category)

                    @php

                        $percentage = $totalAmount > 0
                            ? ($category['total'] / $totalAmount) * 100
                            : 0;

                        $colors = [
                            [
                                'dot' => 'bg-violet-500',
                                'bar' => 'bg-violet-500',
                                'soft' => 'bg-violet-50',
                                'text' => 'text-violet-600',
                            ],
                            [
                                'dot' => 'bg-emerald-500',
                                'bar' => 'bg-emerald-500',
                                'soft' => 'bg-emerald-50',
                                'text' => 'text-emerald-600',
                            ],
                            [
                                'dot' => 'bg-amber-500',
                                'bar' => 'bg-amber-500',
                                'soft' => 'bg-amber-50',
                                'text' => 'text-amber-600',
                            ],
                            [
                                'dot' => 'bg-fuchsia-500',
                                'bar' => 'bg-fuchsia-500',
                                'soft' => 'bg-fuchsia-50',
                                'text' => 'text-fuchsia-600',
                            ],
                        ];

                        $color = $colors[$index % count($colors)];

                    @endphp


                    {{-- Category Item --}}
                    <div class="group rounded-2xl px-3 py-4 transition-all duration-200
                        hover:bg-slate-50 sm:px-4">

                        <div class="flex items-center gap-4">

                            {{-- Category indicator --}}
                            <div class="flex h-10 w-10 shrink-0 items-center
                                justify-center rounded-xl {{ $color['soft'] }}">

                        <span class="h-2.5 w-2.5 rounded-full
                                     {{ $color['dot'] }}
                                     ring-4 ring-white">
                        </span>

                            </div>


                            {{-- Category information --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-center justify-between gap-3">

                                    <p class="truncate text-sm font-semibold text-slate-700">
                                        {{ $category['name'] }}
                                    </p>

                                    <span class="shrink-0 rounded-full
                                         {{ $color['soft'] }}
                                         px-2 py-1 text-[10px]
                                         font-bold {{ $color['text'] }}">

                                {{ number_format($percentage, 1) }}%

                            </span>

                                </div>


                                {{-- Progress --}}
                                <div class="mt-2.5 flex items-center gap-3">

                                    <div class="h-1.5 flex-1 overflow-hidden rounded-full
                                        bg-slate-100">

                                        <div
                                            class="h-full rounded-full {{ $color['bar'] }}
                                           transition-all duration-700"
                                            style="width: {{ min($percentage, 100) }}%">
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Amount --}}
                            <div class="shrink-0 text-right">

                                <p class="text-sm font-bold tracking-tight text-slate-800">
                                    ₹{{ number_format($category['total'], 2) }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-14 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center
                            rounded-2xl bg-slate-50 text-slate-400">

                            <i class="fa-solid fa-chart-column text-lg"></i>

                        </div>

                        <p class="mt-4 text-sm font-semibold text-slate-600">
                            No contribution data
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Category amounts will appear here.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- ========================================================= --}}
            {{-- TOTAL --}}
            {{-- ========================================================= --}}

            <div class="border-t border-slate-100 bg-slate-50/60 px-6 py-5 sm:px-7">

                <div class="flex items-center justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center
                            rounded-xl bg-slate-900 text-white shadow-sm">

                            <i class="fa-solid fa-indian-rupee-sign text-xs"></i>

                        </div>

                        <div>

                            <p class="text-sm font-bold text-slate-800">
                                Total Contribution
                            </p>

                            <p class="mt-0.5 text-[10px] text-slate-400">
                                Across all categories
                            </p>

                        </div>

                    </div>


                    <div class="text-right">

                        <p class="text-xl font-extrabold tracking-tight text-slate-900">
                            ₹{{ number_format($totalAmount, 2) }}
                        </p>

                        <p class="mt-0.5 text-[10px] font-medium text-emerald-500">
                            100% of total contribution
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- PIE CHART --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-3xl border border-slate-200/80
                bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-100 px-6 py-6 sm:px-8">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center
                        sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center
                                rounded-2xl bg-gradient-to-br from-fuchsia-500
                                to-rose-500 text-white shadow-lg
                                shadow-fuchsia-200/60">

                            <i class="fa-solid fa-chart-pie text-lg"></i>

                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-slate-800">
                                Contribution Distribution
                            </h3>

                            <p class="mt-1 text-sm text-slate-400">
                                Visual breakdown of category-wise contributions
                            </p>

                        </div>

                    </div>

                    <div class="inline-flex w-fit items-center gap-2 rounded-full
                            border border-fuchsia-100 bg-fuchsia-50
                            px-3.5 py-2 text-xs font-semibold text-fuchsia-600">

                        <i class="fa-solid fa-chart-pie text-[10px]"></i>

                        Contribution Overview

                    </div>

                </div>

            </div>


            {{-- Chart area --}}
            <div class="p-6 sm:p-8">

                <div class="flex min-h-[420px] items-center justify-center">

                    <div class="relative h-[380px] w-full max-w-[650px]">

                        <canvas id="categoryContributionChart"></canvas>

                    </div>

                </div>

            </div>


        </div>

        {{-- Recent Receipts --}}
        <div class="mt-6 overflow-hidden rounded-[30px] border border-slate-200/70 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.04)]">

            {{-- Header --}}
            <div class="relative overflow-hidden border-b border-slate-100">

                {{-- Soft background glow --}}
                <div class="pointer-events-none absolute -right-16 -top-20 h-44 w-44
                    rounded-full bg-violet-100/50 blur-3xl"></div>

                <div class="relative flex items-center justify-between gap-4 px-6 py-6 sm:px-7">

                    <div class="flex items-center gap-4">

                        {{-- Icon --}}
                        <div class="relative flex h-12 w-12 shrink-0 items-center justify-center
                            rounded-2xl
                            bg-gradient-to-br from-violet-500 to-fuchsia-500
                            text-white
                            shadow-lg shadow-violet-200/50">

                            <i class="fa-solid fa-receipt text-sm"></i>

                            {{-- Small status dot --}}
                            <span class="absolute -right-1 -top-1 flex h-4 w-4
                                 items-center justify-center rounded-full
                                 border-2 border-white bg-emerald-500">

                        <span class="h-1.5 w-1.5 rounded-full bg-white"></span>

                    </span>

                        </div>

                        {{-- Heading --}}
                        <div>

                            <div class="flex items-center gap-2">

                                <h3 class="text-[15px] font-bold tracking-tight text-slate-800">
                                    Recent Receipts
                                </h3>

                                <span class="rounded-full bg-violet-50 px-2 py-0.5
                                     text-[9px] font-bold uppercase
                                     tracking-wider text-violet-600">
                            Latest
                        </span>

                            </div>

                            <p class="mt-1 text-xs text-slate-400">
                                Your latest 10 receipt transactions
                            </p>

                        </div>

                    </div>


                    {{-- View All --}}
                    <a href="{{ route('receipts.index') }}"
                       class="group hidden items-center gap-2 rounded-xl
                      border border-slate-200 bg-white px-3.5 py-2
                      text-xs font-semibold text-slate-500
                      shadow-sm transition-all duration-200
                      hover:border-violet-200
                      hover:bg-violet-50
                      hover:text-violet-600
                      sm:inline-flex">

                        <span>View All</span>

                        <span class="flex h-5 w-5 items-center justify-center
                             rounded-md bg-slate-50
                             transition group-hover:bg-violet-100">

                    <i class="fa-solid fa-arrow-right text-[8px]
                              transition-transform duration-200
                              group-hover:translate-x-0.5"></i>

                </span>

                    </a>

                </div>

            </div>


            {{-- Receipt List --}}
            <div class="p-3 sm:p-4">

                @forelse($recentReceipts as $index => $receipt)

                    <a href="{{ route('receipts.view', $receipt) }}"
                       class="group relative mb-1 block overflow-hidden rounded-2xl
                      border border-transparent
                      px-3 py-3.5
                      transition-all duration-200
                      hover:border-violet-100
                      hover:bg-gradient-to-r
                      hover:from-violet-50/70
                      hover:to-white
                      hover:shadow-sm
                      sm:px-4">

                        {{-- Hover accent --}}
                        <span class="absolute left-0 top-1/2 h-0 w-1
                             -translate-y-1/2 rounded-full
                             bg-violet-500
                             transition-all duration-200
                             group-hover:h-10"></span>


                        <div class="flex items-center gap-3.5 sm:gap-4">

                            {{-- Number --}}
                            <div class="hidden w-7 shrink-0 text-center sm:block">

                        <span class="text-[10px] font-bold tracking-wider
                                     text-slate-300
                                     transition-colors
                                     group-hover:text-violet-400">

                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                        </span>

                            </div>


                            {{-- Receipt Icon --}}
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center
                                rounded-2xl
                                border border-slate-100
                                bg-slate-50
                                text-slate-400
                                transition-all duration-200
                                group-hover:border-violet-100
                                group-hover:bg-violet-100
                                group-hover:text-violet-600">

                                <i class="fa-solid fa-file-invoice text-sm"></i>

                            </div>


                            {{-- Main Content --}}
                            <div class="min-w-0 flex-1">

                                {{-- Name + Receipt Number --}}
                                <div class="flex flex-col gap-1.5
                                    sm:flex-row sm:items-center sm:gap-2.5">

                                    {{-- Name --}}
                                    <p class="truncate text-sm font-bold text-slate-700
                                      transition-colors
                                      group-hover:text-violet-600">

                                        {{ $receipt->name }}

                                    </p>


                                    {{-- Receipt Number --}}
                                    <span class="w-fit rounded-lg
                                         border border-violet-100
                                         bg-violet-50
                                         px-2 py-1
                                         font-mono text-[9px]
                                         font-bold tracking-wide
                                         text-violet-600">

                                {{ $receipt->receipt_number }}

                            </span>

                                </div>


                                {{-- City + Date --}}
                                <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1.5">

                                    {{-- City --}}
                                    <span class="inline-flex items-center gap-1.5
                                         text-[10px] font-medium text-slate-400">

                                <i class="fa-solid fa-location-dot
                                          text-[8px] text-slate-300"></i>

                                {{ $receipt->city?->name ?? '—' }}

                            </span>


                                    {{-- Separator --}}
                                    <span class="hidden h-1 w-1 rounded-full
                                         bg-slate-300 sm:block"></span>


                                    {{-- Date --}}
                                    <span class="inline-flex items-center gap-1.5
                                         text-[10px] font-medium text-slate-400">

                                <i class="fa-regular fa-calendar
                                          text-[8px] text-slate-300"></i>

                                {{ $receipt->date
                                    ? $receipt->date->format('d M Y')
                                    : '—' }}

                            </span>

                                </div>

                            </div>


                            {{-- Amount --}}
                            <div class="hidden shrink-0 text-right sm:block">

                                <p class="text-sm font-bold text-slate-700">
                                    ₹{{ number_format($receipt->receiptDetails->sum('amount'), 2) }}
                                </p>

                                <p class="mt-0.5 text-[9px] font-medium
                                  uppercase tracking-wider text-slate-400">
                                    Amount
                                </p>

                            </div>


                            {{-- Type --}}
                            <div class="hidden shrink-0 lg:block">

                                @if($receipt->receipt_type === 'walk_in')

                                    <span class="inline-flex items-center gap-2
                                         rounded-full
                                         border border-emerald-100
                                         bg-emerald-50/80
                                         px-3 py-1.5
                                         text-[9px] font-bold
                                         text-emerald-600">

                                <span class="relative flex h-1.5 w-1.5">

                                    <span class="absolute inline-flex h-full w-full
                                                 animate-ping rounded-full
                                                 bg-emerald-400 opacity-50"></span>

                                    <span class="relative inline-flex h-1.5 w-1.5
                                                 rounded-full bg-emerald-500"></span>

                                </span>

                                Walk-in

                            </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                         rounded-full
                                         border border-violet-100
                                         bg-violet-50/80
                                         px-3 py-1.5
                                         text-[9px] font-bold
                                         text-violet-600">

                                <span class="h-1.5 w-1.5 rounded-full
                                             bg-violet-500"></span>

                                Registered

                            </span>

                                @endif

                            </div>


                            {{-- Arrow --}}
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center
                                rounded-xl
                                border border-transparent
                                text-slate-300
                                transition-all duration-200
                                group-hover:border-violet-100
                                group-hover:bg-white
                                group-hover:text-violet-600
                                group-hover:shadow-sm">

                                <i class="fa-solid fa-chevron-right text-[9px]
                                  transition-transform duration-200
                                  group-hover:translate-x-0.5"></i>

                            </div>

                        </div>

                    </a>

                @empty

                    {{-- Empty State --}}
                    <div class="px-6 py-14 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center
                            rounded-[20px]
                            bg-gradient-to-br from-violet-50 to-fuchsia-50
                            text-violet-400">

                            <i class="fa-solid fa-receipt text-xl"></i>

                        </div>

                        <p class="mt-4 text-sm font-bold text-slate-700">
                            No recent receipts
                        </p>

                        <p class="mx-auto mt-1 max-w-xs text-xs leading-5 text-slate-400">
                            Receipts will appear here automatically once they are created.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Footer --}}
            @if($recentReceipts->count())

                <div class="border-t border-slate-100
                    bg-slate-50/40 px-6 py-3.5 sm:px-7">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex items-center gap-2">

                    <span class="flex h-6 w-6 items-center justify-center
                                 rounded-lg bg-emerald-50 text-emerald-500">

                        <i class="fa-solid fa-bolt text-[9px]"></i>

                    </span>

                            <span class="text-[10px] font-medium text-slate-400">
                        Showing latest activity
                    </span>

                        </div>


                        {{-- Mobile View All --}}
                        <a href="{{ route('receipts.index') }}"
                           class="inline-flex items-center gap-1.5
                          text-[10px] font-bold text-violet-500
                          transition hover:text-violet-700 sm:hidden">

                            View All

                            <i class="fa-solid fa-arrow-right text-[8px]"></i>

                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- CHART.JS --}}
    {{-- ============================================================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const canvas = document.getElementById('categoryContributionChart');

            if (!canvas) {
                return;
            }

            // Use the SAME data already used by the category table
            const categoryTotals = @json($categoryTotals);

            const labels = categoryTotals.map(category => category.name);

            const data = categoryTotals.map(category => {
                return Number(category.total);
            });

            console.log('Category Totals:', categoryTotals);
            console.log('Chart Labels:', labels);
            console.log('Chart Data:', data);

            const total = data.reduce(
                (sum, value) => sum + value,
                0
            );

            // Don't create an empty chart
            if (total <= 0) {
                canvas.parentElement.innerHTML = `
            <div class="flex h-full items-center justify-center">
                <div class="text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center
                                rounded-2xl bg-slate-100 text-slate-400">
                        <i class="fa-solid fa-chart-pie text-xl"></i>
                    </div>

                    <p class="mt-4 text-sm font-semibold text-slate-600">
                        No contribution data
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Category amounts will appear here.
                    </p>
                </div>
            </div>
        `;

                return;
            }

            new Chart(canvas, {

                type: 'doughnut',

                data: {

                    labels: labels,

                    datasets: [{
                        data: data,

                        backgroundColor: [
                            '#6366F1', // Indigo
                            '#10B981', // Emerald
                            '#F59E0B', // Amber
                            '#EC4899', // Pink
                            '#06B6D4', // Cyan
                            '#8B5CF6', // Violet
                            '#F97316', // Orange
                            '#14B8A6'  // Teal
                        ],

                        borderColor: '#ffffff',

                        borderWidth: 4,

                        hoverOffset: 12
                    }]
                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '62%',

                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 900
                    },

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                usePointStyle: true,

                                pointStyle: 'circle',

                                padding: 18,

                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        },

                        tooltip: {

                            padding: 12,

                            callbacks: {

                                label: function (context) {

                                    const value = Number(
                                        context.raw || 0
                                    );

                                    const percentage = (
                                        (value / total) * 100
                                    ).toFixed(1);

                                    return (
                                        ' ₹' +
                                        value.toLocaleString('en-IN', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        }) +
                                        '  •  ' +
                                        percentage +
                                        '%'
                                    );
                                }
                            }
                        }
                    }
                }
            });

        });
    </script>
@endsection
