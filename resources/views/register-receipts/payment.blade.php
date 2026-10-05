@extends('layouts.register')

@section('content')

    <div class="min-h-screen px-4 py-8 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-2xl">

            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="mb-8 text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center
                        rounded-2xl bg-emerald-500 text-white
                        shadow-lg shadow-emerald-200">

                    <i class="fa-solid fa-credit-card text-2xl"></i>

                </div>

                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    Complete Your Payment
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Choose your preferred payment method and complete your payment.
                </p>

            </div>


            {{-- =====================================================
                 MAIN CARD
            ====================================================== --}}

            <div class="overflow-hidden rounded-3xl border border-slate-200
                    bg-white shadow-sm">


                {{-- =================================================
                     CARD HEADER
                ================================================== --}}

                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wider
                                  text-slate-400">
                                Registration
                            </p>

                            <h2 class="mt-1 text-lg font-bold text-slate-900">
                                Payment Summary
                            </h2>

                        </div>


                        <span class="rounded-full bg-emerald-50 px-3 py-1.5
                                 text-xs font-semibold text-emerald-600">

                        Step 2 of 2

                    </span>

                    </div>

                </div>


                <div class="px-6 py-6 sm:px-8">


                    {{-- =================================================
                         DONOR INFORMATION
                    ================================================== --}}

                    <div class="mb-6 rounded-2xl bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center
                                    justify-center rounded-xl bg-white
                                    text-slate-500 shadow-sm">

                                <i class="fa-regular fa-user"></i>

                            </div>


                            <div class="min-w-0">

                                <p class="text-xs text-slate-400">
                                    Registered Name
                                </p>

                                <p class="truncate text-sm font-semibold text-slate-800">
                                    {{ $receipt->name }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DONATION DETAILS
                    ================================================== --}}

                    <div>

                        <h3 class="mb-3 text-sm font-bold text-slate-800">
                            Donation Details
                        </h3>


                        <div class="overflow-hidden rounded-2xl border border-slate-200">

                            @foreach($receipt->receiptDetails as $detail)

                                <div class="flex items-center justify-between
                                        gap-4 border-b border-slate-100
                                        px-4 py-3.5 last:border-b-0">

                                <span class="text-sm text-slate-600">
                                    {{ $detail->category->name }}
                                </span>


                                    <span class="shrink-0 text-sm font-semibold
                                             text-slate-800">

                                    ₹{{ number_format($detail->amount, 2) }}

                                </span>

                                </div>

                            @endforeach


                            {{-- TOTAL --}}

                            <div class="flex items-center justify-between
                                    gap-4 bg-emerald-50 px-4 py-4">

                            <span class="text-sm font-bold text-slate-800">
                                Total Amount
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


                    {{-- =================================================
                         PAYMENT DETAILS
                    ================================================== --}}

                    <div class="mt-6 overflow-hidden rounded-3xl
                            border border-slate-200 bg-white">


                        {{-- PAYMENT HEADER --}}

                        <div class="border-b border-slate-100 px-5 py-4 sm:px-6">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-emerald-50 text-emerald-600">

                                    <i class="fa-solid fa-building-columns"></i>

                                </div>


                                <div>

                                    <h3 class="text-sm font-bold text-slate-800">
                                        Payment Details
                                    </h3>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        Pay using UPI or bank transfer
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="px-5 py-6 sm:px-6">


                            {{-- =================================================
                                 AMOUNT
                            ================================================== --}}

                            <div class="mb-6 rounded-2xl bg-emerald-50
                                    px-5 py-4 text-center">

                                <p class="text-[11px] font-medium uppercase
                                      tracking-wider text-emerald-600">

                                    Amount to Pay

                                </p>


                                <p class="mt-1 text-2xl font-bold text-emerald-700">

                                    ₹{{ number_format(
                                    $receipt->receiptDetails->sum('amount'),
                                    2
                                ) }}

                                </p>

                            </div>


                            {{-- =================================================
                                 UPI PAYMENT
                            ================================================== --}}

                            <div class="grid grid-cols-1 gap-5">

                                <div class="rounded-2xl border border-slate-200 bg-white p-5">

                                    {{-- Header --}}
                                    <div class="mb-5 flex items-center gap-3">

                                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-slate-800">
                                                UPI Payment
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                Scan or use the UPI ID
                                            </p>
                                        </div>

                                    </div>


                                    {{-- QR CODE --}}
                                    <div class="flex justify-center">

                                        <div class="flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">

                                            <img
                                                src="{{ asset('images/qr1.png') }}"
                                                alt="Payment QR Code"
                                                class="w-56 max-w-full object-contain"
                                            >

                                        </div>

                                    </div>


                                    {{-- UPI ID --}}

                                </div>

                            </div>

                            {{-- =================================================
                                 PAYMENT INSTRUCTION
                            ================================================== --}}

                            <div class="mt-5 flex items-start gap-3 rounded-2xl
                                    border border-amber-200 bg-amber-50 p-4">

                                <div class="mt-0.5 shrink-0 text-amber-600">

                                    <i class="fa-solid fa-circle-info"></i>

                                </div>


                                <div>

                                    <p class="text-xs font-semibold text-amber-800">
                                        Payment Instructions
                                    </p>


                                    <p class="mt-1 text-xs leading-5 text-amber-700">

                                        Pay the exact amount shown above using UPI
                                        or bank transfer. After completing the
                                        payment, take a screenshot of the successful
                                        transaction and upload it below.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         PAYMENT PROOF FORM
                    ================================================== --}}

                    <form
                        action="{{ route('register-receipts.payment.store', $receipt) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="mt-6"
                        id="paymentForm"
                    >

                        @csrf


                        {{-- PAYMENT PROOF HEADER --}}

                        <div class="mb-3">

                            <h3 class="text-sm font-bold text-slate-800">

                                Upload Payment Proof

                                <span class="text-red-500">*</span>

                            </h3>


                            <p class="mt-1 text-xs text-slate-400">

                                Upload a screenshot of your successful payment

                            </p>

                        </div>


                        {{-- UPLOAD BOX --}}

                        <label
                            for="image"
                            id="uploadBox"
                            class="group flex cursor-pointer flex-col
                               items-center justify-center rounded-2xl
                               border-2 border-dashed border-slate-200
                               bg-slate-50 px-6 py-10 text-center
                               transition hover:border-emerald-300
                               hover:bg-emerald-50/30"
                        >

                            {{-- ICON --}}

                            <div class="flex h-14 w-14 items-center justify-center
                                    rounded-2xl bg-white text-slate-400
                                    shadow-sm transition
                                    group-hover:text-emerald-500">

                                <i class="fa-solid fa-cloud-arrow-up text-xl"></i>

                            </div>


                            {{-- TEXT --}}

                            <p class="mt-4 text-sm font-semibold text-slate-700">

                                Click to upload payment proof

                            </p>


                            <p class="mt-1 text-xs text-slate-400">

                                JPG, JPEG, PNG or WEBP · Maximum 2 MB

                            </p>


                            {{-- FILE NAME --}}

                            <p
                                id="fileName"
                                class="mt-3 hidden rounded-lg bg-emerald-50
                                   px-3 py-1.5 text-xs font-medium
                                   text-emerald-600"
                            >
                            </p>


                            {{-- FILE INPUT --}}

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept=".jpg,.jpeg,.png,.webp,image/*"
                                class="hidden"
                            >

                        </label>


                        {{-- VALIDATION ERROR --}}

                        @error('image')

                        <p class="mt-2 text-xs font-medium text-red-600">

                            {{ $message }}

                        </p>

                        @enderror


                        {{-- SUBMIT BUTTON --}}

                        <button
                            type="submit"
                            id="submitButton"
                            class="mt-6 flex w-full items-center justify-center
                               gap-2 rounded-2xl bg-emerald-600 px-6 py-3.5
                               text-sm font-semibold text-white
                               shadow-lg shadow-emerald-200
                               transition hover:bg-emerald-700
                               hover:shadow-xl
                               focus:outline-none
                               focus:ring-2 focus:ring-emerald-500
                               focus:ring-offset-2"
                        >

                        <span id="submitText">
                            Submit Payment Proof
                        </span>


                            <i
                                id="submitIcon"
                                class="fa-solid fa-arrow-right text-xs"
                            ></i>

                        </button>

                    </form>

                </div>

            </div>


            {{-- =====================================================
                 SECURITY NOTE
            ====================================================== --}}

            <div class="mt-5 flex items-center justify-center gap-2
                    text-center text-xs text-slate-400">

                <i class="fa-solid fa-lock"></i>

                <span>
                Your payment proof is securely submitted for verification.
            </span>

            </div>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const input = document.getElementById('image');

            const fileName = document.getElementById('fileName');

            const uploadBox = document.getElementById('uploadBox');

            const paymentForm = document.getElementById('paymentForm');

            const submitButton = document.getElementById('submitButton');

            const submitText = document.getElementById('submitText');

            const submitIcon = document.getElementById('submitIcon');


            /*
            |--------------------------------------------------------------------------
            | File Selection
            |--------------------------------------------------------------------------
            */

            input.addEventListener('change', function () {

                if (!this.files || !this.files.length) {

                    fileName.textContent = '';

                    fileName.classList.add('hidden');

                    uploadBox.classList.remove(
                        'border-emerald-300',
                        'bg-emerald-50/30'
                    );

                    return;
                }


                const file = this.files[0];


                fileName.textContent = file.name;

                fileName.classList.remove('hidden');


                uploadBox.classList.add(
                    'border-emerald-300',
                    'bg-emerald-50/30'
                );

            });


            /*
            |--------------------------------------------------------------------------
            | Prevent Double Submit
            |--------------------------------------------------------------------------
            */

            paymentForm.addEventListener('submit', function () {

                if (!input.files || !input.files.length) {
                    return;
                }


                submitButton.disabled = true;

                submitButton.classList.add(
                    'cursor-not-allowed',
                    'opacity-75'
                );


                submitText.textContent = 'Uploading...';


                submitIcon.className =
                    'fa-solid fa-spinner fa-spin text-xs';

            });

        });


        /*
        |--------------------------------------------------------------------------
        | Copy UPI ID
        |--------------------------------------------------------------------------
        */

        function copyUpiId() {

            const upiElement = document.getElementById('upiId');

            const copyButton = document.getElementById('copyUpiButton');

            const copyText = document.getElementById('copyUpiText');

            const copyIcon = document.getElementById('copyUpiIcon');


            const upiId = upiElement.textContent.trim();


            /*
            |--------------------------------------------------------------------------
            | Modern Clipboard API
            |--------------------------------------------------------------------------
            */

            if (navigator.clipboard && window.isSecureContext) {

                navigator.clipboard.writeText(upiId)
                    .then(function () {

                        showCopiedState();

                    })
                    .catch(function () {

                        fallbackCopy(upiId);

                    });

            } else {

                fallbackCopy(upiId);

            }


            /*
            |--------------------------------------------------------------------------
            | Show Copied State
            |--------------------------------------------------------------------------
            */

            function showCopiedState() {

                copyText.textContent = 'Copied';

                copyIcon.className = 'fa-solid fa-check';


                copyButton.classList.remove(
                    'text-emerald-600'
                );

                copyButton.classList.add(
                    'text-green-600',
                    'bg-green-50'
                );


                setTimeout(function () {

                    copyText.textContent = 'Copy';

                    copyIcon.className = 'fa-regular fa-copy';


                    copyButton.classList.remove(
                        'text-green-600',
                        'bg-green-50'
                    );

                    copyButton.classList.add(
                        'text-emerald-600'
                    );

                }, 2000);

            }


            /*
            |--------------------------------------------------------------------------
            | Fallback Copy
            |--------------------------------------------------------------------------
            */

            function fallbackCopy(text) {

                const textarea = document.createElement('textarea');

                textarea.value = text;

                textarea.style.position = 'fixed';

                textarea.style.left = '-9999px';

                textarea.style.top = '0';

                document.body.appendChild(textarea);

                textarea.focus();

                textarea.select();


                try {

                    document.execCommand('copy');

                    showCopiedState();

                } catch (error) {

                    copyText.textContent = 'Copy failed';

                }


                document.body.removeChild(textarea);

            }

        }

    </script>

@endsection
