@if ($paginator->hasPages())

    <nav class="flex items-center gap-1.5"
         aria-label="Pagination">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())

            <span
                class="flex h-9 w-9 items-center justify-center
                       rounded-xl border border-slate-200
                       bg-slate-50 text-slate-300">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>

                </svg>

            </span>

        @else

            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="flex h-9 w-9 items-center justify-center
                      rounded-xl border border-slate-200
                      bg-white text-slate-500
                      transition-all duration-200
                      hover:border-violet-200
                      hover:bg-violet-50
                      hover:text-violet-600">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>

                </svg>

            </a>

        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

            {{-- Dots --}}
            @if (is_string($element))

                <span
                    class="flex h-9 min-w-9 items-center justify-center
                           rounded-xl px-2
                           text-xs font-semibold text-slate-400">
                    {{ $element }}
                </span>

            @endif


            {{-- Page Numbers --}}
            @if (is_array($element))

                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())

                        {{-- Active --}}
                        <span
                            aria-current="page"
                            class="flex h-9 min-w-9 items-center justify-center
                                   rounded-xl bg-violet-600 px-3
                                   text-xs font-bold text-white
                                   shadow-sm shadow-violet-200">
                            {{ $page }}
                        </span>

                    @else

                        {{-- Inactive --}}
                        <a href="{{ $url }}"
                           class="flex h-9 min-w-9 items-center justify-center
                                  rounded-xl border border-slate-200
                                  bg-white px-3
                                  text-xs font-semibold text-slate-600
                                  transition-all duration-200
                                  hover:border-violet-200
                                  hover:bg-violet-50
                                  hover:text-violet-600">

                            {{ $page }}

                        </a>

                    @endif

                @endforeach

            @endif

        @endforeach


        {{-- Next --}}
        @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="flex h-9 w-9 items-center justify-center
                      rounded-xl border border-slate-200
                      bg-white text-slate-500
                      transition-all duration-200
                      hover:border-violet-200
                      hover:bg-violet-50
                      hover:text-violet-600">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7"/>

                </svg>

            </a>

        @else

            <span
                class="flex h-9 w-9 items-center justify-center
                       rounded-xl border border-slate-200
                       bg-slate-50 text-slate-300">

                <svg class="h-4 w-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7"/>

                </svg>

            </span>

        @endif

    </nav>

@endif
