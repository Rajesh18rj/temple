@extends('layouts.register')

@section('content')

    <div class="min-h-screen px-4 py-10 sm:px-6 lg:px-8">

        <div class="mx-auto flex min-h-[calc(100vh-180px)] max-w-xl
                items-center justify-center">

            <div class="w-full text-center">

                {{-- SUCCESS ICON --}}
                <div class="mx-auto flex h-20 w-20 items-center justify-center
                        rounded-full bg-emerald-100">

                    <div class="flex h-14 w-14 items-center justify-center
                            rounded-full bg-emerald-500 text-white
                            shadow-lg shadow-emerald-200">

                        <i class="fa-solid fa-check text-2xl"></i>

                    </div>

                </div>


                {{-- TITLE --}}
                <h1 class="mt-7 text-2xl font-bold tracking-tight text-slate-900
                       sm:text-3xl">

                    Registration Completed

                </h1>


                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500">

                    Thank you for your contribution. Your registration and
                    payment proof have been successfully submitted.

                </p>


                {{-- RECEIPT INFO --}}
                <div class="mt-7 overflow-hidden rounded-3xl border
                        border-slate-200 bg-white text-left shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center justify-between gap-4">

                            <div>

                                <p class="text-xs font-medium uppercase
                                      tracking-wider text-slate-400">

                                    Registration Number

                                </p>

                                <p class="mt-1 text-lg font-bold text-slate-900">

                                    #{{ $receipt->id }}

                                </p>

                            </div>


                            <span class="inline-flex items-center gap-1.5
                                     rounded-full bg-emerald-50
                                     px-3 py-1.5 text-xs font-semibold
                                     text-emerald-600">

                            <span class="h-1.5 w-1.5 rounded-full
                                         bg-emerald-500"></span>

                            Submitted

                        </span>

                        </div>

                    </div>


                    <div class="space-y-4 px-6 py-6">

                        {{-- NAME --}}
                        <div class="flex items-start justify-between gap-4">

                        <span class="text-sm text-slate-400">
                            Name
                        </span>

                            <span class="text-right text-sm font-semibold
                                     text-slate-700">

                            {{ $receipt->name }}

                        </span>

                        </div>


                        {{-- MOBILE --}}
                        @if($receipt->mobile)

                            <div class="flex items-start justify-between gap-4">

                            <span class="text-sm text-slate-400">
                                Mobile
                            </span>

                                <span class="text-right text-sm font-semibold
                                         text-slate-700">

                                {{ $receipt->mobile }}

                            </span>

                            </div>

                        @endif


                        {{-- DATE --}}
                        <div class="flex items-start justify-between gap-4">

                            <span class="text-sm text-slate-400">
                                Date
                            </span>

                                                    <span class="text-right text-sm font-semibold text-slate-700">
                                {{ $receipt->date
                                    ? $receipt->date->format('d-m-Y')
                                    : '-' }}
                            </span>

                        </div>


                        {{-- CATEGORY DETAILS --}}
                        <div class="border-t border-slate-100 pt-4">

                            <p class="mb-3 text-sm font-semibold text-slate-700">
                                Contribution Details
                            </p>

                            <div class="space-y-2">

                                @foreach($receipt->receiptDetails as $detail)

                                    <div class="flex items-center justify-between gap-4 rounded-xl bg-slate-50 px-3 py-2.5">

                <span class="text-sm text-slate-600">
                    {{ $detail->category->name }}
                </span>

                                        <span class="shrink-0 text-sm font-semibold text-slate-800">
                    ₹{{ number_format($detail->amount, 2) }}
                </span>

                                    </div>

                                @endforeach

                            </div>

                        </div>


                        {{-- TOTAL --}}
                        <div class="border-t border-slate-100 pt-4">

                            <div class="flex items-center justify-between gap-4">

        <span class="text-sm font-semibold text-slate-700">
            Total Contribution
        </span>

                                <span class="text-xl font-bold text-emerald-600">
            ₹{{ number_format(
                $receipt->receiptDetails->sum('amount'),
                2
            ) }}
        </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- MESSAGE --}}
                <div class="mt-5 rounded-2xl border border-emerald-100
                        bg-emerald-50/60 px-5 py-4">

                    <div class="flex items-start gap-3 text-left">

                        <div class="mt-0.5 shrink-0 text-emerald-600">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>

                        <p class="text-xs leading-5 text-emerald-700">

                            Your payment proof has been received successfully.
                            The submitted details will be verified by the temple
                            administration.

                        </p>

                    </div>

                </div>


                {{-- END MESSAGE --}}
                <p class="mt-7 text-sm font-medium text-slate-500">
                    Thank you for your valuable contribution.
                </p>


                {{-- REGISTER AGAIN LINK --}}
                <div class="mt-4">

                    <a
                        href="{{ route('register-receipts.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl
               bg-emerald-600 px-5 py-3
               text-sm font-semibold text-white
               shadow-sm shadow-emerald-200
               transition
               hover:bg-emerald-700
               hover:shadow-md
               focus:outline-none
               focus:ring-2 focus:ring-emerald-500
               focus:ring-offset-2"
                    >

                        <i class="fa-solid fa-plus text-xs"></i>

                        Register Another Contribution

                    </a>

                </div>



            </div>

        </div>

    </div>

@endsection
