@php
    $user = auth()->user();

    $userName = $user?->name ?? 'User';
    $userRole = $user?->role ?? 'Administrator';

    $nameParts = collect(explode(' ', trim($userName)))->filter();
    if ($nameParts->count() >= 2) {
        $initials = strtoupper(substr($nameParts->first(), 0, 1) . substr($nameParts->last(), 0, 1));
    } else {
        $initials = strtoupper(substr($userName, 0, 2));
    }
@endphp

<aside id="sidebar"
       class="fixed top-0 left-0 z-50 h-screen w-[290px] -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0">

    <div class="flex h-full flex-col border-r border-slate-200 bg-white shadow-[8px_0_30px_rgba(15,23,42,0.05)]">

        {{-- Brand --}}
        <div class="relative overflow-hidden border-b border-slate-100 px-5 py-5">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-indigo-50 via-white to-rose-50"></div>

            <div class="relative z-10 flex items-center gap-4">

                {{-- Logo --}}
                <div class="shrink-0">
                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Saivas Matrimony"
                        class="h-16 w-auto object-contain">
                </div>

                {{-- Brand Text --}}
                <div class="min-w-0">
                    <h1 class="text-md font-bold tracking-wide text-slate-800">
                        ஸ்ரீ வீரபையம்மாள் திருக்கோவில்
                    </h1>

                    <p class="mt-1 text-xs text-slate-500">
                    </p>
                </div>

            </div>
        </div>

        {{-- Scrollable content --}}
        <div class="custom-scroll flex-1 overflow-y-auto px-4 py-5">

            <div class="space-y-6">

                {{-- MAIN --}}
                <div>
                    <p class="mb-3 px-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Main
                    </p>

                    <div class="space-y-2">

                        {{-- Dashboard --}}
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium transition
                           {{ request()->routeIs('dashboard')
                                ? 'bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-500 text-white shadow-lg shadow-indigo-200/70'
                                : 'text-slate-700 hover:bg-slate-50' }}">

                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl transition
                                {{ request()->routeIs('dashboard')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-100 text-slate-600 group-hover:bg-indigo-50 group-hover:text-indigo-600' }}">
                                <i class="fa-solid fa-pie-chart text-sm"></i>
                            </span>

                            <span class="flex-1">Dashboard</span>

                            @if (request()->routeIs('dashboard'))
                                <span class="h-2.5 w-2.5 rounded-full bg-white/90"></span>
                            @endif
                        </a>

                        {{-- Dashboard --}}
                        <a href="{{ route('categories.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium transition
                           {{ request()->routeIs('categories.*')
                                ? 'bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-500 text-white shadow-lg shadow-indigo-200/70'
                                : 'text-slate-700 hover:bg-slate-50' }}">

                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl transition
                                {{ request()->routeIs('categories.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-100 text-slate-600 group-hover:bg-indigo-50 group-hover:text-indigo-600' }}">
                                <i class="fa-solid fa-layer-group text-sm"></i>
                            </span>

                            <span class="flex-1">Category</span>

                            @if (request()->routeIs('categories.*'))
                                <span class="h-2.5 w-2.5 rounded-full bg-white/90"></span>
                            @endif
                        </a>

                        {{-- Profiles --}}
                        <a href="{{ route('receipts.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium transition
                           {{ request()->routeIs('receipts.*')
                                ? 'bg-gradient-to-r from-rose-500 via-pink-500 to-amber-500 text-white shadow-lg shadow-rose-200/70'
                                : 'text-slate-700 hover:bg-slate-50' }}">

                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl transition
                                {{ request()->routeIs('receipts.*')
                                    ? 'bg-white/15 text-white'
                                    : 'bg-slate-100 text-slate-600 group-hover:bg-rose-50 group-hover:text-rose-600' }}">
                                <i class="fas fa-receipt text-sm"></i>
                            </span>

                            <span class="flex-1">Receipts</span>

                            @if (request()->routeIs('receipts.*'))
                                <span class="h-2.5 w-2.5 rounded-full bg-white/90"></span>
                            @endif
                        </a>

                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom admin card --}}
        <div class="border-t border-slate-100 p-4">
            <div class="rounded-[24px] border border-slate-200 bg-gradient-to-r from-slate-50 to-white p-3.5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-500 text-sm font-bold text-white shadow-md shadow-indigo-200/60">
                        {{ $initials }}
                        <span class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500"></span>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ $userName }}</p>
                        <p class="truncate text-xs text-slate-500">{{ $userRole }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-rose-50 hover:text-rose-600">
                            <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>
