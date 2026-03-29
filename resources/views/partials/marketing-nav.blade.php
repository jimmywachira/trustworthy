<header x-data="{ mobileOpen: false }" class="sticky top-0 text-2xl z-40 border-b border-slate-200/80 bg-white/88 shadow-sm backdrop-blur-lg transition-colors lg:bg-white/78 lg:backdrop-blur-xl dark:border-slate-800/90 dark:bg-slate-950/90 dark:lg:bg-slate-950/82">
    <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight text-slate-900 dark:text-slate-100">LuxeNest</a>

            <nav class="ml-4 hidden items-center gap-1 lg:flex">
                <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="inline-flex items-center gap-1.5 rounded-full px-3 py-2 text-sm transition {{ request()->routeIs('properties.index') && request()->query('type') === 'sale' ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}"><ion-icon size="large" name="trending-up-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Buy</a>
                <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="inline-flex items-center gap-1.5 rounded-full px-3 py-2 text-sm transition {{ request()->routeIs('properties.index') && request()->query('type') === 'rent' ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}"><ion-icon size="large" name="key-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Rent</a>
                <a href="{{ route('sell') }}" class="inline-flex items-center gap-1.5 rounded-full px-3 py-2 text-sm transition {{ request()->routeIs('sell') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}"><ion-icon size="large" name="pricetags-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Sell</a>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-1.5 rounded-full px-3 py-2 text-sm transition {{ request()->routeIs('about') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}"><ion-icon size="large" name="planet-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>About Us</a>
                @auth
                    <a href="{{ route('saved-properties.index') }}" class="inline-flex items-center gap-1.5 rounded-full px-3 py-2 text-sm transition {{ request()->routeIs('saved-properties.*') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}"><ion-icon size="large" name="bookmark-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Saved</a>
                @endauth
            </nav>

            <div class="ml-auto flex items-center gap-2 sm:gap-3">
                <x-theme-toggle />

                <div class="hidden lg:flex lg:items-center lg:gap-3">
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">Admin Panel</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-200">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">Sign In</a>
                    @endauth
                </div>

                <button
                    type="button"
                    @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen.toString()"
                    aria-controls="mobile-nav-panel"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 text-slate-700 transition hover:bg-slate-100 lg:hidden dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    <span class="sr-only">Toggle navigation menu</span>
                    <ion-icon :name="mobileOpen ? 'close-outline' : 'menu-outline'" class="h-5 w-5" aria-hidden="true"></ion-icon>
                </button>
            </div>
        </div>

        <div
            id="mobile-nav-panel"
            x-cloak
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="mt-3 rounded-2xl border border-slate-200/90 bg-white/95 p-3 shadow-premium backdrop-blur-md lg:hidden dark:border-slate-800/90 dark:bg-slate-900/95"
        >
            <nav class="grid gap-1">
                <a @click="mobileOpen = false" href="{{ route('properties.index', ['type' => 'sale']) }}" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('properties.index') && request()->query('type') === 'sale' ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}"><ion-icon name="trending-up-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Buy</a>
                <a @click="mobileOpen = false" href="{{ route('properties.index', ['type' => 'rent']) }}" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('properties.index') && request()->query('type') === 'rent' ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}"><ion-icon name="key-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Rent</a>
                <a @click="mobileOpen = false" href="{{ route('sell') }}" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('sell') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}"><ion-icon name="pricetags-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Sell</a>
                <a @click="mobileOpen = false" href="{{ route('about') }}" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('about') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}"><ion-icon name="planet-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>About Us</a>
                @auth
                    <a @click="mobileOpen = false" href="{{ route('saved-properties.index') }}" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('saved-properties.*') ? 'bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}"><ion-icon name="bookmark-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>Saved</a>
                @endauth
            </nav>

            <div class="mt-3 border-t border-slate-200 pt-3 dark:border-slate-800">
                @auth
                    @if (auth()->user()->is_admin)
                        <a @click="mobileOpen = false" href="{{ route('admin.dashboard') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">Admin Panel</a>
                    @else
                        <a @click="mobileOpen = false" href="{{ route('dashboard') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-200">Dashboard</a>
                    @endif
                @else
                    <a @click="mobileOpen = false" href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</header>
