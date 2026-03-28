<header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/70 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center gap-5 px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight text-slate-900">LuxeNest</a>

        <nav class="hidden items-center gap-1 md:flex">
            <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Home</a>
            <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('properties.index') && request()->query('type') === 'sale' ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Buy</a>
            <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('properties.index') && request()->query('type') === 'rent' ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Rent</a>
            <a href="{{ route('sell') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('sell') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">Sell</a>
            <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('about') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">About Us</a>
        </nav>

        <div class="ml-auto">
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Admin Panel</a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Sign In</a>
            @endauth
        </div>
    </div>
</header>
