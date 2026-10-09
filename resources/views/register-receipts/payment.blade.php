@extends('layouts.register')

@section('content')
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">

            {{-- PAGE HEADER --}}
            <div class="mb-8 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-700 text-white shadow-sm">
                    <i class="fa-solid fa-credit-card text-xl"></i>
                </div>

                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    கட்டண விவரங்கள்
                </h1>

                <p class="mt-1 text-sm font-semibold text-emerald-700">
                    Complete Your Payment
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Review your donation and complete your payment.
                </p>
            </div>

            {{-- PAYMENT SUMMARY CARD --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- CARD HEADER --}}
                <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div>
                        <h2 class="font-bold text-slate-900">
                            நன்கொடை சுருக்கம்
                        </h2>
                        <p class="mt-0.5 text-sm text-slate-500">
                            Donation Summary
                        </p>
                    </div>

                    <span class="rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    Step 2 of 2
                </span>
                </div>

                <div class="space-y-6 p-5 sm:p-6">

                    {{-- DONOR INFORMATION --}}
                    <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-700 shadow-sm">
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">
                                பதிவு செய்தவர் / Registered Name
                            </p>
                            <p class="mt-1 truncate text-sm font-bold text-slate-800">
                                {{ $receipt->name }}
                            </p>
                        </div>
                    </div>

                    {{-- DONATION DETAILS --}}
                    <div>
                        <div class="mb-3">
                            <h3 class="text-sm font-bold text-slate-800">
                                நன்கொடை விவரங்கள்
                            </h3>
                            <p class="mt-0.5 text-xs text-slate-500">
                                Donation Details
                            </p>
                        </div>

                        <div class="overflow-hidden rounded-xl border border-slate-200">

                            @forelse($receipt->receiptDetails as $detail)
                                <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-4 py-3.5 last:border-b-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-slate-700">
                                            {{ $detail->category->name }}
                                        </p>

                                        @if($detail->category->parent)
                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $detail->category->parent->name }}
                                            </p>
                                        @endif
                                    </div>

                                    <span class="shrink-0 text-sm font-semibold text-slate-800">
                                    ₹{{ number_format($detail->amount, 2) }}
                                </span>
                                </div>
                            @empty
                                <div class="p-4 text-sm text-slate-500">
                                    No donation details found.
                                </div>
                            @endforelse

                            {{-- TOTAL --}}
                            <div class="flex items-center justify-between gap-4 border-t border-emerald-100 bg-emerald-50 px-4 py-4">
                                <div>
                                    <p class="text-sm font-bold text-slate-800">
                                        மொத்த தொகை
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Total Amount
                                    </p>
                                </div>

                                <span class="text-xl font-extrabold text-emerald-700">
                                ₹{{ number_format($receipt->receiptDetails->sum('amount'), 2) }}
                            </span>
                            </div>
                        </div>
                    </div>

                    {{-- PAYMENT METHOD --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200">

                        <div class="flex items-center gap-3 border-b border-slate-100 px-4 py-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-800">
                                    பணம் செலுத்துதல்
                                </h3>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    Payment Details · UPI Payment
                                </p>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5">

                            {{-- AMOUNT TO PAY --}}
                            <div class="mb-5 rounded-xl bg-emerald-50 px-4 py-4 text-center">
                                <p class="text-xs font-semibold text-emerald-800">
                                    செலுத்த வேண்டிய தொகை / Amount to Pay
                                </p>

                                <p class="mt-2 text-3xl font-extrabold tracking-tight text-emerald-700">
                                    ₹{{ number_format($receipt->receiptDetails->sum('amount'), 2) }}
                                </p>
                            </div>

                            {{-- QR CODE --}}
                            <div class="text-center">
                                <p class="text-sm font-semibold text-slate-800">
                                    Scan QR Code to Pay
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    கீழே உள்ள QR குறியீட்டை ஸ்கேன் செய்து பணம் செலுத்தவும்.
                                </p>

                                <div class="mx-auto mt-4 inline-flex rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                                    <img
                                        src="{{ asset('images/qr1.png') }}"
                                        alt="Payment QR Code"
                                        class="w-52 max-w-full object-contain"
                                    >
                                </div>
                            </div>

                            {{-- PAYMENT INSTRUCTIONS --}}
                            <div class="mt-5 rounded-xl border border-amber-200 bg-amber-50 p-4">
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-info mt-0.5 text-amber-600"></i>

                                    <div>
                                        <p class="text-sm font-semibold text-amber-900">
                                            கட்டண வழிமுறைகள் / Payment Instructions
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-amber-800">
                                            Please pay the exact amount shown above. After completing the payment, upload a screenshot of the successful transaction below.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- PAYMENT PROOF FORM --}}
                    <form
                        action="{{ route('register-receipts.payment.store', $receipt) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="paymentForm"
                    >
                        @csrf

                        <div class="mb-3">
                            <h3 class="text-sm font-bold text-slate-800">
                                கட்டண ஆதாரம்
                            </h3>

                            <p class="mt-0.5 text-sm font-semibold text-slate-700">
                                Upload Payment Proof
                                <span class="ml-1 text-xs font-normal text-slate-400">(Optional)</span>
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                Upload a screenshot of your successful payment.
                            </p>
                        </div>

                        {{-- UPLOAD AREA --}}
                        <label
                            for="image"
                            id="uploadBox"
                            class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 px-5 py-8 text-center transition hover:border-emerald-400 hover:bg-emerald-50/40"
                        >
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-slate-400 shadow-sm transition group-hover:text-emerald-700">
                                <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Click to upload payment proof
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                JPG, JPEG, PNG or WEBP · Maximum 2 MB
                            </p>

                            <p
                                id="fileName"
                                class="mt-3 hidden max-w-full break-all rounded-lg bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-800"
                            ></p>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="hidden"
                            >
                        </label>

                        @error('image')
                        <p class="mt-2 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                        {{-- SUBMIT --}}
                        <button
                            type="submit"
                            id="submitButton"
                            class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                        <span id="submitText">
                            கட்டண ஆதாரத்தை சமர்ப்பிக்கவும் / Submit Payment Proof
                        </span>

                            <i id="submitIcon" class="fa-solid fa-arrow-right text-xs"></i>
                        </button>

                    </form>

                </div>
            </div>

            {{-- SECURITY NOTE --}}
            <div class="mt-5 flex items-center justify-center gap-2 text-center text-xs text-slate-400">
                <i class="fa-solid fa-lock"></i>
                <span>
                Your payment proof will be submitted for verification.
            </span>
            </div>

        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const fileName = document.getElementById('fileName');
            const uploadBox = document.getElementById('uploadBox');
            const paymentForm = document.getElementById('paymentForm');
            const submitButton = document.getElementById('submitButton');
            const submitText = document.getElementById('submitText');
            const submitIcon = document.getElementById('submitIcon');

            if (!input || !paymentForm) {
                return;
            }

            // Display the selected filename.
            input.addEventListener('change', function () {
                const file = this.files && this.files.length
                    ? this.files[0]
                    : null;

                if (!file) {
                    fileName.textContent = '';
                    fileName.classList.add('hidden');

                    uploadBox.classList.remove(
                        'border-emerald-400',
                        'bg-emerald-50/40'
                    );

                    return;
                }

                fileName.textContent = file.name;
                fileName.classList.remove('hidden');

                uploadBox.classList.add(
                    'border-emerald-400',
                    'bg-emerald-50/40'
                );
            });

            // Prevent duplicate submission when uploading a file.
            paymentForm.addEventListener('submit', function () {
                if (!input.files || !input.files.length) {
                    return;
                }

                submitButton.disabled = true;

                submitButton.classList.add(
                    'cursor-not-allowed',
                    'opacity-70'
                );

                submitText.textContent = 'Uploading...';
                submitIcon.className = 'fa-solid fa-spinner fa-spin text-xs';
            });
        });
    </script>
@endsection
