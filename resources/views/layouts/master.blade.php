<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Temple Project' }}</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

<div class="min-h-screen bg-[#f5f7fb]">
    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Mobile sidebar overlay --}}
    <div id="mobileSidebarOverlay" class="fixed inset-0 z-40 hidden bg-slate-900/40 lg:hidden"></div>

    {{-- Main content --}}
    <div class="lg:pl-[290px] min-h-screen flex flex-col">
        @include('layouts.partials.header')

        <main class="flex-1 px-4 py-5 sm:px-6 lg:px-8 lg:py-8">
            @yield('content')
        </main>
    </div>
</div>


@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: @json(session('success')),
                showConfirmButton: false,
                timer: 2800,
                timerProgressBar: true,
                background: '#f0fdf4',
                color: '#14532d',
                iconColor: '#22c55e',
                customClass: {
                    popup: 'rounded-2xl border border-emerald-200 shadow-[0_18px_45px_rgba(16,185,129,0.18)] px-3 py-2',
                    title: 'text-sm font-semibold'
                }
            });
        });
    </script>
@endif

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
                    popup: 'rounded-2xl border border-rose-200 shadow-[0_18px_45px_rgba(239,68,68,0.16)] px-3 py-2',
                    title: 'text-sm font-semibold'
                }
            });
        });
    </script>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.delete-form').forEach(function (form) {

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }

                });

            });

        });

    });
</script>

    @stack('scripts')
</body>
</html>
