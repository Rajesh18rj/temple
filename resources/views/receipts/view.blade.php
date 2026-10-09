@extends('layouts.master')

@section('content')

    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
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

                    <span>View Receipt</span>
                </div>

                <h1 class="text-2xl font-semibold text-slate-800">
                    Receipt Details
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    View receipt and payment information
                </p>
            </div>


            {{-- Actions --}}
            <div class="flex items-center gap-2">

                {{-- Back --}}
                <a href="{{ route('receipts.index') }}"
                   class="inline-flex items-center gap-2
                      px-4 py-2.5
                      rounded-lg
                      border border-slate-200
                      bg-white
                      text-slate-600
                      text-sm font-medium
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

                    Back

                </a>


                {{-- Download PDF --}}
                <a href="{{ route('receipts.download-pdf', $receipt) }}"
                   class="inline-flex items-center gap-2
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
                              stroke-width="1.8"
                              d="M6 9V3h12v6M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v7H6v-7z"/>

                    </svg>

                    Download PDF

                </a>

            </div>

        </div>


        {{-- Receipt Summary --}}
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

            <div class="px-5 sm:px-6 py-4 border-b border-slate-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Receipt Information
                        </h2>

                        <p class="text-sm text-slate-500 mt-0.5">
                            Basic details of this receipt
                        </p>
                    </div>


                    <div class="flex items-center gap-2">

                    <span class="inline-flex items-center
                                 px-3 py-1.5
                                 rounded-md
                                 bg-violet-50
                                 text-violet-700
                                 text-xs
                                 font-medium">

                        Receipt No: {{ $receipt->receipt_number }}

                    </span>

                        <span class="inline-flex items-center
                                 px-3 py-1.5
                                 rounded-md
                                 bg-emerald-50
                                 text-emerald-700
                                 text-xs
                                 font-medium">

                        Completed

                    </span>

                    </div>

                </div>

            </div>


            {{-- Donor Information --}}
            {{-- Donor Information --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-5
                gap-5">


                    {{-- Name --}}
                    <div>

                        <p class="text-xs font-medium
                      uppercase tracking-wide
                      text-slate-400">
                            Name
                        </p>

                        <p class="mt-1.5
                      text-sm font-medium
                      text-slate-800
                      break-words">

                            {{ $receipt->name }}

                        </p>

                    </div>


                    {{-- Mobile --}}
                    <div>

                        <p class="text-xs font-medium
                      uppercase tracking-wide
                      text-slate-400">
                            Mobile
                        </p>

                        <p class="mt-1.5
                      text-sm font-medium
                      text-slate-800">

                            {{ $receipt->mobile ?? '-' }}

                        </p>

                    </div>


                    {{-- City --}}
                    <div>

                        <p class="text-xs font-medium
                      uppercase tracking-wide
                      text-slate-400">
                            City
                        </p>

                        <p class="mt-1.5
                      text-sm font-medium
                      text-slate-800">

                            {{ $receipt->city?->name ?? '-' }}

                        </p>

                    </div>


                    {{-- Date --}}
                    <div>

                        <p class="text-xs font-medium
                      uppercase tracking-wide
                      text-slate-400">
                            Date
                        </p>

                        <p class="mt-1.5
                      text-sm font-medium
                      text-slate-800">

                            {{ $receipt->date
                                ? $receipt->date->format('d M Y')
                                : '-' }}

                        </p>

                    </div>


                    {{-- Address --}}
                    <div>

                        <p class="text-xs font-medium
                      uppercase tracking-wide
                      text-slate-400">
                            Address
                        </p>

                        <p class="mt-1.5
                      text-sm font-medium
                      leading-5
                      text-slate-700">

                            {{ $receipt->address ?? '-' }}

                        </p>

                    </div>

                </div>

            </div>
        </div>


        {{-- Main Content --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


            {{-- Donation Details --}}
            <div class="xl:col-span-2
                    bg-white
                    border border-slate-200
                    rounded-xl
                    shadow-sm
                    overflow-hidden">


                {{-- Card Header --}}
                <div class="px-5 sm:px-6 py-4
                        border-b border-slate-200
                        flex items-center
                        justify-between">

                    <div>

                        <h2 class="text-base font-semibold text-slate-800">
                            Donation Details
                        </h2>

                        <p class="text-sm text-slate-500 mt-0.5">
                            Contribution breakdown
                        </p>

                    </div>


                    <span class="inline-flex items-center
                             px-3 py-1.5
                             rounded-md
                             bg-slate-50
                             border border-slate-200
                             text-slate-600
                             text-xs
                             font-medium">

                    {{ $receipt->receiptDetails->count() }} Items

                </span>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

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

                                Category

                            </th>

                            <th class="px-5 py-3
                                       text-right
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wide
                                       text-slate-500">

                                Amount

                            </th>

                        </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                        @php
                            $total = 0;
                        @endphp


                        @forelse($receipt->receiptDetails as $detail)

                            @php
                                $total += $detail->amount;
                            @endphp


                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-5 py-4
                                           text-sm
                                           text-slate-500">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="px-5 py-4">

                                    <span class="text-sm
                                                 font-medium
                                                 text-slate-800">

<div class="text-sm font-medium text-slate-800">
    {{ $detail->category?->name ?? 'Unknown Category' }}
</div>

@if($detail->category?->parent)
                                            <p class="mt-1 text-xs text-slate-400">
        {{ $detail->category->parent->name }}
    </p>
                                        @endif
                                    </span>

                                </td>


                                <td class="px-5 py-4
                                           text-right">

                                    <span class="text-sm
                                                 font-medium
                                                 text-slate-700">

                                        ₹{{ number_format($detail->amount, 2) }}

                                    </span>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="3"
                                    class="px-5 py-10
                                           text-center
                                           text-sm
                                           text-slate-400">

                                    No donation details found.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>


                        {{-- Total --}}
                        <tfoot>

                        <tr class="bg-slate-50
                                   border-t
                                   border-slate-200">

                            <td colspan="2"
                                class="px-5 py-4
                                       text-right">

                                <span class="text-sm
                                             font-semibold
                                             text-slate-600">

                                    Total Amount

                                </span>

                            </td>

                            <td class="px-5 py-4
                                       text-right">

                                <span class="text-lg
                                             font-bold
                                             text-violet-700">

                                    ₹{{ number_format($total, 2) }}

                                </span>

                            </td>

                        </tr>

                        </tfoot>

                    </table>

                </div>

            </div>


            {{-- Payment Proof --}}
            <div class="bg-white
                    border border-slate-200
                    rounded-xl
                    shadow-sm
                    overflow-hidden">


                {{-- Card Header --}}
                <div class="px-5 sm:px-6 py-4
                        border-b border-slate-200
                        flex items-center
                        justify-between">

                    <div>

                        <h2 class="text-base font-semibold text-slate-800">
                            Payment Proof
                        </h2>

                        <p class="text-sm text-slate-500 mt-0.5">
                            Payment confirmation
                        </p>

                    </div>


                    @if($receipt->image)

                        <span class="inline-flex items-center
                                 px-2.5 py-1
                                 rounded-md
                                 bg-emerald-50
                                 text-emerald-700
                                 text-xs
                                 font-medium">

                        Uploaded

                    </span>

                    @endif

                </div>


                {{-- Image --}}
                <div class="p-5 sm:p-6">

                    @if($receipt->image)

                        <div class="rounded-lg
                                border border-slate-200
                                bg-slate-50
                                p-3">

                            <div class="bg-white
                                    rounded-md
                                    border border-slate-200
                                    p-2
                                    flex items-center
                                    justify-center">

                                <img src="{{ asset($receipt->image) }}"
                                     alt="Payment Proof"
                                     class="w-full
                                        max-h-[420px]
                                        rounded
                                        object-contain">

                            </div>

                        </div>

                    @else

                        <div class="min-h-[220px]
                                rounded-lg
                                border border-dashed
                                border-slate-300
                                bg-slate-50
                                flex items-center
                                justify-center">

                            <div class="text-center">

                                <div class="w-10 h-10
                                        mx-auto mb-3
                                        rounded-full
                                        bg-slate-100
                                        flex items-center
                                        justify-center">

                                    <svg class="w-5 h-5 text-slate-400"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.7"
                                              d="M4 16l4-4a2 2 0 012.83 0L14 15l2-2a2 2 0 012.83 0L20 14M14 8h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"/>

                                    </svg>

                                </div>

                                <p class="text-sm
                                      font-medium
                                      text-slate-600">

                                    No payment proof uploaded

                                </p>

                                <p class="text-xs
                                      text-slate-400
                                      mt-1">

                                    No image is available for this receipt.

                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


@endsection
