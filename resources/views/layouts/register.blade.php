<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'ஸ்ரீ வீரபையம்மாள் திருக்கோவில்' }}</title>


    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />


    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
        rel="stylesheet"
    >


    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body
    class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.10),_transparent_32%),radial-gradient(circle_at_right,_rgba(6,182,212,0.08),_transparent_28%),#f8fafc] font-['Inter'] text-slate-800"
>


{{-- ===================================================== --}}
{{-- PUBLIC HEADER --}}
{{-- ===================================================== --}}

<header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur">

    <div class="mx-auto flex h-20 max-w-7xl items-center
                justify-between px-4 sm:px-6 lg:px-8">

        {{-- LOGO + TEMPLE NAME --}}

        <div class="flex min-w-0 items-center gap-3 sm:gap-4">

            {{-- Logo --}}

            <div class="flex h-12 w-12 shrink-0 items-center
                        justify-center overflow-hidden rounded-xl
                        border border-slate-200 bg-white
                        shadow-sm sm:h-14 sm:w-14">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Temple Logo"
                    class="h-full w-full object-contain p-1.5"
                >

            </div>


            {{-- Name --}}

            <div class="min-w-0">

                <h1 class="truncate text-sm font-bold text-slate-900
                           sm:text-base">

                    ஸ்ரீ வீரபையம்மாள் திருக்கோவில்

                </h1>

                <p class="mt-0.5 truncate text-[11px] text-slate-400 sm:text-xs">

                    Contribution & Payment Portal

                </p>

            </div>

        </div>


        {{-- HEADER RIGHT SIDE --}}

        <div class="hidden items-center gap-2 text-xs font-medium
                    text-slate-500 sm:flex">

            <div class="flex h-8 w-8 items-center justify-center
                        rounded-lg bg-emerald-50 text-emerald-600">

                <i class="fa-solid fa-shield-heart"></i>

            </div>

            <span>
                Secure Registration
            </span>

        </div>

    </div>

</header>


{{-- ===================================================== --}}
{{-- PAGE CONTENT --}}
{{-- ===================================================== --}}

<main class="min-h-[calc(100vh-220px)]">

    @yield('content')

</main>


{{-- ===================================================== --}}
{{-- PUBLIC FOOTER --}}
{{-- ===================================================== --}}

<footer class="border-t border-slate-200 bg-white">

    <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">


        {{-- TOP FOOTER --}}

        <div class="flex flex-col items-center justify-between
                    gap-5 text-center sm:flex-row sm:text-left">


            {{-- BRAND --}}

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center
                            justify-center overflow-hidden rounded-xl
                            border border-slate-200 bg-white shadow-sm">

                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Temple Logo"
                        class="h-full w-full object-contain p-1"
                    >

                </div>


                <div>

                    <p class="text-sm font-semibold text-slate-800">
                        ஸ்ரீ வீரபையம்மாள் திருக்கோவில்
                    </p>

                    <p class="mt-0.5 text-xs text-slate-400">
                        Contribution & Payment Portal
                    </p>

                </div>

            </div>


            {{-- THANK YOU --}}

            <div class="flex items-center gap-2 text-xs text-slate-400">

                <div class="flex h-8 w-8 items-center justify-center
                            rounded-full bg-emerald-50 text-emerald-500">

                    <i class="fa-solid fa-heart text-xs"></i>

                </div>

                <span>
                    Thank you for your contribution
                </span>

            </div>

        </div>


        {{-- DIVIDER --}}

        <div class="my-5 border-t border-slate-100"></div>


        {{-- COPYRIGHT --}}

        <div class="flex flex-col items-center justify-between
                    gap-2 text-center sm:flex-row">

            <p class="text-xs text-slate-400">

                © {{ date('Y') }}. All rights reserved.

            </p>


            <div class="flex items-center gap-2 text-[11px] text-slate-400">

                <i class="fa-solid fa-lock text-emerald-500"></i>

                <span>
                    Secure payment & registration
                </span>

            </div>

        </div>

    </div>

</footer>


{{-- ===================================================== --}}
{{-- SWEET ALERT - SUCCESS --}}
{{-- ===================================================== --}}

@if (session('success'))

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'success',

                title: @json(session('success')),

                showConfirmButton: false,

                timer: 3000,

                timerProgressBar: true,

                background: '#f0fdf4',

                color: '#14532d',

                iconColor: '#22c55e',

                customClass: {

                    popup:
                        'rounded-2xl border border-emerald-200 shadow-[0_18px_45px_rgba(16,185,129,0.18)] px-3 py-2',

                    title:
                        'text-sm font-semibold'

                }

            });

        });

    </script>

@endif


{{-- ===================================================== --}}
{{-- SWEET ALERT - ERROR --}}
{{-- ===================================================== --}}

@if (session('error'))

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'error',

                title: @json(session('error')),

                showConfirmButton: false,

                timer: 3200,

                timerProgressBar: true,

                background: '#fef2f2',

                color: '#991b1b',

                iconColor: '#ef4444',

                customClass: {

                    popup:
                        'rounded-2xl border border-rose-200 shadow-[0_18px_45px_rgba(239,68,68,0.16)] px-3 py-2',

                    title:
                        'text-sm font-semibold'

                }

            });

        });

    </script>

@endif


{{-- ===================================================== --}}
{{-- SWEET ALERT - VALIDATION ERRORS --}}
{{-- ===================================================== --}}

@if ($errors->any())

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            Swal.fire({

                icon: 'warning',

                title: 'Validation Error',

                html: `
                    <div class="text-left">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                            @endforeach
                </ul>
            </div>
`,

                confirmButtonText: 'OK',

                confirmButtonColor: '#10b981',

            });

        });

    </script>

@endif


@stack('scripts')


</body>

</html>
