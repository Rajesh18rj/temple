@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        $start = max($currentPage - 1, 1);
        $end = min($currentPage + 1, $lastPage);

        if ($currentPage <= 2) {
            $end = min(3, $lastPage);
        }

        if ($currentPage >= $lastPage - 1) {
            $start = max($lastPage - 2, 1);
        }
    @endphp

    <nav role="navigation"
         aria-label="Pagination Navigation"
         class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        {{-- ===================================================== --}}
        {{-- LEFT : RESULTS SUMMARY --}}
        {{-- ===================================================== --}}
        <div class="flex flex-wrap items-center gap-3">
            <div class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i class="fa-solid fa-table-list text-sm"></i>
                </div>

                <div class="text-sm leading-6 text-slate-500">
                    <span>Showing</span>
                    <span class="font-bold text-slate-800">{{ $paginator->firstItem() }}</span>
                    <span>to</span>
                    <span class="font-bold text-slate-800">{{ $paginator->lastItem() }}</span>
                    <span>of</span>
                    <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
                    <span>profiles</span>
                </div>
            </div>

            <div class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-600 shadow-sm">
                Page {{ $currentPage }} of {{ $lastPage }}
            </div>
        </div>

        {{-- ===================================================== --}}
        {{-- RIGHT : PAGINATION --}}
        {{-- ===================================================== --}}
        <div class="flex flex-wrap items-center gap-2">

            {{-- PREVIOUS --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-300 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    Prev
                </a>
            @endif

            {{-- FIRST PAGE --}}
            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}"
                   class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                    1
                </a>

                @if ($start > 2)
                    <span class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-400 shadow-sm">
                        ...
                    </span>
                @endif
            @endif

            {{-- PAGE WINDOW --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $currentPage)
                    <span class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-3 text-sm font-bold text-white shadow-lg shadow-emerald-200/60">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}"
                       class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            {{-- LAST PAGE --}}
            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <span class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-400 shadow-sm">
                        ...
                    </span>
                @endif

                <a href="{{ $paginator->url($lastPage) }}"
                   class="inline-flex h-10 min-w-[40px] items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                    {{ $lastPage }}
                </a>
            @endif

            {{-- NEXT --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                    Next
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            @else
                <span class="inline-flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-300 cursor-not-allowed">
                    Next
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
