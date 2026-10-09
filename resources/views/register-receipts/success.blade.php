@extends('layouts.register')

@section('content')

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 sm:py-12">

        <div class="mx-auto max-w-2xl">

            {{-- SUCCESS MESSAGE --}}
            <div class="mb-8 text-center">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 ring-8 ring-emerald-50">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-600 text-white shadow-md">
                        <i class="fa-solid fa-check text-2xl"></i>
                    </div>
                </div>

                <h1 class="mt-7 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    பதிவு வெற்றிகரமாக முடிந்தது
                </h1>

                <p class="mt-2 text-sm font-semibold text-emerald-700">
                    Registration Completed Successfully
                </p>

                <p class="mx-auto mt-4 max-w-lg text-sm leading-6 text-slate-500">
                    உங்கள் பங்களிப்பிற்கு நன்றி. உங்கள் பதிவு மற்றும் கட்டண ஆதாரம் வெற்றிகரமாக சமர்ப்பிக்கப்பட்டது.
                </p>

                <p class="mx-auto mt-1 max-w-lg text-sm leading-6 text-slate-500">
                    Thank you for your contribution. Your registration and payment proof have been submitted successfully.
                </p>

            </div>


            {{-- RECEIPT CARD --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg shadow-slate-200/50">

                {{-- RECEIPT TOP HEADER --}}
                <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-800 to-emerald-700 px-5 py-6 text-white sm:px-8">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <div class="flex items-center gap-2 text-emerald-100">
                                <i class="fa-solid fa-receipt"></i>
                                <span class="text-xs font-medium uppercase tracking-widest">
                                Registration Receipt
                            </span>
                            </div>

                            <p class="mt-3 text-xs text-emerald-100">
                                பதிவு எண் / Registration Number
                            </p>

                            <h2 class="mt-1 break-all text-2xl font-extrabold tracking-wide sm:text-3xl">
                                #{{ $receipt->receipt_number }}
                            </h2>
                        </div>

                        <div class="shrink-0 rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-center backdrop-blur-sm">
                            <i class="fa-solid fa-circle-check text-xl text-emerald-100"></i>

                            <p class="mt-1 text-xs font-semibold">
                                Submitted
                            </p>
                        </div>

                    </div>

                </div>


                {{-- RECEIPT CONTENT --}}
                <div class="space-y-7 p-5 sm:p-8">

                    {{-- PERSONAL INFORMATION --}}
                    <section>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fa-solid fa-user text-base"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-900">
                                    தனிப்பட்ட தகவல்கள்
                                </h3>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    Personal Information
                                </p>
                            </div>

                        </div>

                        <div class="rounded-xl border border-slate-200">

                            {{-- NAME --}}
                            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-4 py-4 sm:px-5">

                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-id-card w-4 text-center text-slate-400"></i>
                                    <span class="text-sm text-slate-500">
                                    பெயர் / Name
                                </span>
                                </div>

                                <span class="max-w-[60%] break-words text-right text-sm font-semibold text-slate-800">
                                {{ $receipt->name }}
                            </span>

                            </div>

                            {{-- MOBILE --}}
                            @if($receipt->mobile)
                                <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-4 py-4 sm:px-5">

                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-phone w-4 text-center text-slate-400"></i>
                                        <span class="text-sm text-slate-500">
                                        கைபேசி / Mobile
                                    </span>
                                    </div>

                                    <span class="text-right text-sm font-semibold text-slate-800">
                                    {{ $receipt->mobile }}
                                </span>

                                </div>
                            @endif

                            {{-- DATE --}}
                            <div class="flex items-start justify-between gap-4 px-4 py-4 sm:px-5">

                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-calendar w-4 text-center text-slate-400"></i>
                                    <span class="text-sm text-slate-500">
                                    தேதி / Date
                                </span>
                                </div>

                                <span class="text-right text-sm font-semibold text-slate-800">
                                {{ $receipt->date ? $receipt->date->format('d-m-Y') : '-' }}
                            </span>

                            </div>

                        </div>

                    </section>


                    {{-- CONTRIBUTION DETAILS --}}
                    <section>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fa-solid fa-hand-holding-heart text-base"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-900">
                                    நன்கொடை விவரங்கள்
                                </h3>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    Contribution Details
                                </p>
                            </div>

                        </div>

                        <div class="overflow-hidden rounded-xl border border-slate-200">

                            {{-- TABLE HEADER --}}
                            <div class="flex items-center justify-between gap-4 bg-slate-50 px-4 py-3 sm:px-5">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                Category
                            </span>

                                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                Amount
                            </span>
                            </div>

                            {{-- CONTRIBUTION ITEMS --}}
                            @forelse($receipt->receiptDetails as $detail)

                                <div class="flex items-center justify-between gap-4 border-t border-slate-100 px-4 py-4 sm:px-5">

                                    <div class="flex min-w-0 items-start gap-3">

                                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                                            <i class="fa-solid fa-check text-xs"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <p class="break-words text-sm font-semibold text-slate-800">
                                                {{ $detail->category->name }}
                                            </p>

                                            @if($detail->category->parent)
                                                <p class="mt-1 break-words text-xs text-slate-500">
                                                    {{ $detail->category->parent->name }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                    <span class="shrink-0 text-sm font-bold tabular-nums text-slate-800">
                                    ₹{{ number_format($detail->amount, 2) }}
                                </span>

                                </div>

                            @empty

                                <div class="border-t border-slate-100 px-4 py-6 text-center text-sm text-slate-500">
                                    No contribution details found.
                                </div>

                            @endforelse


                            {{-- TOTAL AMOUNT --}}
                            <div class="border-t border-emerald-100 bg-emerald-50/80 px-4 py-5 sm:px-5">

                                <div class="flex items-center justify-between gap-4">

                                    <div>
                                        <p class="text-sm font-bold text-slate-800">
                                            மொத்த பங்களிப்பு
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Total Contribution
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-xs font-medium text-emerald-700">
                                            TOTAL AMOUNT
                                        </p>

                                        <p class="mt-1 text-2xl font-extrabold tracking-tight text-emerald-800 sm:text-3xl">
                                            ₹{{ number_format($receipt->receiptDetails->sum('amount'), 2) }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- PAYMENT VERIFICATION NOTICE --}}
                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 sm:p-5">

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                                <i class="fa-solid fa-clock"></i>
                            </div>

                            <div class="min-w-0">

                                <h3 class="text-sm font-bold text-amber-900">
                                    கட்டணச் சரிபார்ப்பு
                                </h3>

                                <p class="mt-1 text-xs font-semibold text-amber-800">
                                    Payment Verification
                                </p>

                                <p class="mt-2 text-sm leading-6 text-amber-900/80">
                                    Your payment proof has been received and is awaiting verification by the temple administration.
                                </p>

                                <p class="mt-1 text-sm leading-6 text-amber-900/80">
                                    உங்கள் கட்டண ஆதாரம் கோவில் நிர்வாகத்தால் சரிபார்க்கப்படும்.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- THANK YOU MESSAGE --}}
            <div class="py-7 text-center">

                <div class="mb-2 flex items-center justify-center gap-2 text-emerald-700">
                    <i class="fa-solid fa-heart text-sm"></i>
                    <span class="text-sm font-bold">
                    உங்கள் மதிப்புமிக்க பங்களிப்பிற்கு நன்றி.
                </span>
                </div>

                <p class="text-sm text-slate-500">
                    Thank you for your valuable contribution.
                </p>

            </div>


            {{-- ACTION BUTTON --}}
            <a
                href="{{ route('register-receipts.create') }}"
                class="group flex w-full items-center justify-center gap-2.5 rounded-xl bg-emerald-700 px-5 py-4 text-sm font-bold text-white shadow-md shadow-emerald-900/10 transition duration-200 hover:bg-emerald-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
            >
                <i class="fa-solid fa-plus text-sm transition-transform duration-200 group-hover:rotate-90"></i>
                <span>மற்றொரு பதிவு / Register Another Contribution</span>
            </a>


            {{-- FOOTER NOTE --}}
            <div class="mt-5 flex items-center justify-center gap-2 pb-3 text-center text-xs text-slate-400">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Your submitted information is available for verification.</span>
            </div>

        </div>

    </div>

@endsection
