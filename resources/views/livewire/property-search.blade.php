<section class="min-h-screen bg-slate-900 pb-16 text-slate-100">
    <header
        x-data="{ scrolled: false }"
        @scroll.window="scrolled = window.scrollY > 8"
        :class="scrolled ? 'bg-slate-900/85 backdrop-blur-xl border-slate-700/80' : 'bg-slate-900/40 border-transparent'"
        class="sticky top-0 z-30 border-b transition-all duration-300"
    >
        <div class="mx-auto flex max-w-7xl items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight text-white">LuxeNest</a>

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Home</a>
                <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Buy</a>
                <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Rent</a>
                <a href="{{ route('sell') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">Sell</a>
                <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/10 hover:text-white">About Us</a>
            </nav>

            <div class="ml-auto">
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Admin Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-white/20">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Sign In</a>
                @endauth
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 pt-10 sm:px-6 lg:px-8">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Find Your Next Nairobi Property</h1>
                <p class="mt-1 text-sm text-slate-300">{{ number_format($matchesCount) }} results matched your filters.</p>
            </div>
            <button wire:click="resetFilters" type="button" class="rounded-xl border border-slate-600 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                Clear Filters
            </button>
        </div>

        <div class="mb-4 flex flex-wrap gap-2">
            @foreach ($featuredNeighborhoods as $neighborhood)
                <button
                    type="button"
                    wire:click="setNeighborhood('{{ $neighborhood }}')"
                    class="rounded-full border px-3 py-1.5 text-xs font-semibold uppercase tracking-wide transition {{ strcasecmp(trim($location), $neighborhood) === 0 ? 'border-emerald-500 bg-emerald-500/20 text-emerald-200' : 'border-slate-600 text-slate-300 hover:bg-slate-800' }}"
                >
                    {{ $neighborhood }}
                </button>
            @endforeach
        </div>

        <div class="mb-8 rounded-2xl bg-white p-4 shadow-sm sm:p-6">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-6">
                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Min Price</span>
                    <input
                        type="number"
                        min="0"
                        wire:model.live.debounce.350ms="minPrice"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                        placeholder="5000000"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Max Price</span>
                    <input
                        type="number"
                        min="0"
                        wire:model.live.debounce.350ms="maxPrice"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                        placeholder="120000000"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Property Type</span>
                    <select
                        wire:model.live="propertyType"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                    >
                        <option value="">Any</option>
                        <option value="rent">Rent</option>
                        <option value="sale">Sale</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Min Beds</span>
                    <select
                        wire:model.live="minBeds"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                    >
                        <option value="">Any</option>
                        <option value="1">1+</option>
                        <option value="2">2+</option>
                        <option value="3">3+</option>
                        <option value="4">4+</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Amenity</span>
                    <select
                        wire:model.live="amenity"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                    >
                        <option value="">Any</option>
                        <option value="Pool">Pool</option>
                        <option value="Gym">Gym</option>
                        <option value="Parking">Parking</option>
                        <option value="Smart Home">Smart Home</option>
                        <option value="24/7 Security">24/7 Security</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Location</span>
                    <input
                        type="text"
                        wire:model.live.debounce.350ms="location"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                        placeholder="City or neighborhood"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Sort By</span>
                    <select
                        wire:model.live="sortBy"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20"
                    >
                        <option value="newest">Newest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="sqft_high">Largest SqFt</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($properties as $property)
                <x-property-card :property="$property" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-600 bg-slate-800/60 p-8 text-center text-slate-300">
                    No properties matched your filters. Try broadening the price range or location.
                </div>
            @endforelse
        </div>

        <div class="mt-8 [&_nav]:text-slate-200 [&_span]:rounded-lg [&_span]:px-2 [&_span]:py-1">
            {{ $properties->links() }}
        </div>
    </div>

    @include('partials.site-footer', ['dark' => true])
</section>
