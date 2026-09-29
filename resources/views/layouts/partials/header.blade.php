<header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/85 backdrop-blur-xl">
    <div class="px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Left section --}}
            <div class="flex items-start gap-3 sm:items-center">
                {{-- Mobile sidebar toggle --}}
                <button id="openSidebar"
                        class="mt-0.5 inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:-translate-y-[1px] hover:bg-slate-50 hover:shadow md:h-12 md:w-12 lg:hidden">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>

                {{-- Page title block --}}
                <div class="flex min-w-0 items-start gap-3 sm:gap-4">
                    @php
                        $pageTitleValue = $pageTitle ?? 'Admin Dashboard';

                        $pageConfig = match (strtolower($pageTitleValue)) {
                            'dashboard' => [
                                'icon' => 'fa-chart-pie',
                                'iconBg' => 'from-indigo-600 via-violet-600 to-fuchsia-500',
                                'shadow' => 'shadow-indigo-200/60',
                                'badge' => 'Dashboard',
                                'badgeClass' => 'border-indigo-100 bg-indigo-50 text-indigo-600',
                                'subtitle' => 'Overview of your matrimony administration workspace',
                            ],

                            'profiles' => [
                                'icon' => 'fa-address-card',
                                'iconBg' => 'from-rose-500 via-pink-500 to-amber-400',
                                'shadow' => 'shadow-rose-200/60',
                                'badge' => 'Profiles',
                                'badgeClass' => 'border-rose-100 bg-rose-50 text-rose-600',
                                'subtitle' => 'Manage profiles, filters, and matrimony records from one place',
                            ],

                            'manage profiles' => [
                                'icon' => 'fa-user-gear',
                                'iconBg' => 'from-emerald-500 via-teal-500 to-cyan-500',
                                'shadow' => 'shadow-emerald-200/60',
                                'badge' => 'Manage Profiles',
                                'badgeClass' => 'border-emerald-100 bg-emerald-50 text-emerald-600',
                                'subtitle' => 'Manage profile records, active status, paid members, and profile actions from one place',
                            ],


                            'settings' => [
                                'icon' => 'fa-gear',
                                'iconBg' => 'from-slate-600 via-slate-700 to-slate-900',
                                'shadow' => 'shadow-slate-200/60',
                                'badge' => 'Settings',
                                'badgeClass' => 'border-slate-200 bg-slate-100 text-slate-700',
                                'subtitle' => 'Configure your matrimony admin preferences and system settings',
                            ],

                            default => [
                                'icon' => 'fa-heart-circle-check',
                                'iconBg' => 'from-rose-500 via-pink-500 to-amber-400',
                                'shadow' => 'shadow-rose-200/60',
                                'badge' => 'Temple Project',
                                'badgeClass' => 'border-rose-100 bg-rose-50 text-rose-600',
                                'subtitle' => 'Temple Project',
                            ],
                        };
                    @endphp

                    <div class="flex min-w-0 items-start gap-3 sm:gap-4">
                        <div
                            class="hidden sm:flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br {{ $pageConfig['iconBg'] }} text-white shadow-lg {{ $pageConfig['shadow'] }}">
                            <i class="fa-solid {{ $pageConfig['icon'] }} text-lg"></i>
                        </div>

                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <h2 class="truncate text-xl font-bold tracking-tight text-slate-800 sm:text-2xl">
                                    {{ strtoupper($pageTitleValue) }}
                                </h2>

                                <span
                                    class="inline-flex items-center rounded-full border px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.12em] {{ $pageConfig['badgeClass'] }}">
                {{ $pageConfig['badge'] }}
            </span>
                            </div>

                            <p class="mt-1 text-sm text-slate-500 sm:text-[15px]">
                                {{ $pageConfig['subtitle'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right section --}}
            <div class="flex flex-wrap items-center justify-between gap-3 sm:justify-end">

                {{-- User dropdown --}}
                <div class="shrink-0">
                    @include('layouts.partials.user-dropdown')
                </div>
            </div>
        </div>
    </div>
</header>
