<div id="mobileSidebarOverlay" class="fixed inset-0 z-40 hidden bg-slate-900/40 backdrop-blur-[2px] lg:hidden"></div>

<aside id="mobileSidebar"
       class="fixed inset-y-0 left-0 z-50 w-[88%] max-w-[320px] -translate-x-full bg-white shadow-2xl transition-transform duration-300 lg:hidden">
    <div class="flex h-full flex-col">

        {{-- Mobile top --}}
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-rose-500 to-pink-500 text-white flex items-center justify-center font-bold shadow-md">
                    M
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">Matrimony</h2>
                    <p class="text-xs text-slate-500">Panel Menu</p>
                </div>
            </div>

            <button id="closeMobileSidebar" class="rounded-xl border border-slate-200 p-2 text-slate-600">
                ✕
            </button>
        </div>

        {{-- Mobile links --}}
        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="mobile-link {{ request()->routeIs('dashboard') ? 'mobile-link-active' : '' }}">
                <span>🏠</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="mobile-link {{ request()->routeIs('profile.index') ? 'mobile-link-active' : '' }}">
                <span>👤</span>
                <span>My Profile</span>
            </a>

            <a href="#" class="mobile-link">
                <span>💞</span>
                <span>Matches</span>
            </a>

            <a href="#" class="mobile-link">
                <span>❤️</span>
                <span>Interests</span>
            </a>

            <a href="#" class="mobile-link">
                <span>💬</span>
                <span>Messages</span>
            </a>

            <a href="#" class="mobile-link">
                <span>💎</span>
                <span>Membership</span>
            </a>

            <a href="#" class="mobile-link">
                <span>⚙️</span>
                <span>Settings</span>
            </a>
        </div>

        <div class="border-t border-slate-100 p-4">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="font-semibold text-slate-800">Rj</p>
                <p class="text-sm text-slate-500">Premium Member</p>
            </div>
        </div>
    </div>
</aside>
