<div class="relative" id="userDropdownWrap">
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

    <button id="userDropdownButton"
            class="group relative flex items-center gap-3 rounded-[22px] border border-slate-200/80 bg-white/95 px-3 py-2.5 shadow-sm transition duration-200 hover:-translate-y-[1px] hover:border-slate-300 hover:bg-white hover:shadow-md">

        {{-- soft glow --}}
        <div class="pointer-events-none absolute inset-0 rounded-[22px] bg-gradient-to-r from-indigo-50/0 via-white to-pink-50/0 opacity-0 transition duration-300 group-hover:opacity-100"></div>

        {{-- User text --}}
        <div class="relative z-10 hidden sm:block text-right leading-tight">
            <p class="max-w-[140px] truncate text-sm font-semibold text-slate-800">
                {{ $userName }}
            </p>
            <p class="mt-0.5 text-[11px] font-medium uppercase tracking-[0.14em] text-slate-400">
                {{ $userRole }}
            </p>
        </div>

        {{-- Avatar --}}
        <div
            class="relative z-10 flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-500 text-sm font-bold text-white shadow-md shadow-indigo-200/60 ring-1 ring-white/70">
            {{ $initials }}

            {{-- online dot --}}
            <span class="absolute -bottom-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full border-2 border-white bg-emerald-500 shadow-sm">
            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
        </span>
        </div>

        {{-- Arrow section --}}
        <div
            class="relative z-10 flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-400 transition duration-200 group-hover:border-slate-300 group-hover:bg-white group-hover:text-slate-600">
            <i class="fa-solid fa-angle-down text-xs transition duration-200" id="userDropdownArrow"></i>
        </div>
    </button>

    {{-- Dropdown --}}
    @php
        $user = auth()->user();

        $userName = $user?->name ?? 'User';
        $userEmail = $user?->email ?? 'user@example.com';

        // Build initials from name
        $nameParts = collect(explode(' ', trim($userName)))->filter();
        $initials = $nameParts->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('');

        // If no initials somehow
        $initials = $initials ?: 'U';

        // Optional role text
        $userRole = $user?->role ?? 'Administrator';
    @endphp

    <div id="userDropdownMenu"
         class="absolute right-0 mt-3 hidden w-[290px] overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_24px_60px_rgba(15,23,42,0.16)]">

        {{-- Top profile section --}}
        <div class="relative overflow-hidden border-b border-slate-100 px-5 py-5">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-50 via-white to-pink-50"></div>

            <div class="relative z-10 flex items-center gap-4">
                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-500 text-base font-bold text-white shadow-md shadow-indigo-200/60">
                    {{ $initials }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-base font-bold text-slate-800">{{ $userName }}</p>
                    <p class="truncate text-sm text-slate-500">{{ $userEmail }}</p>

                    <div class="mt-2 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Active {{ $userRole }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu links --}}
        <div class="p-2.5">
            <a href="#"
               class="group flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition group-hover:bg-indigo-50 group-hover:text-indigo-600">
                <i class="fa-regular fa-user text-sm"></i>
            </span>
                <div>
                    <p class="font-semibold text-slate-700">My Account</p>
                    <p class="text-xs text-slate-400">Profile and account details</p>
                </div>
            </a>
        </div>

        {{-- Footer --}}
        <div class="border-t border-slate-100 p-2.5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-left text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-500">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                </span>
                    <div>
                        <p>Logout</p>
                        <p class="text-xs font-medium text-rose-400">Sign out from admin panel</p>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
