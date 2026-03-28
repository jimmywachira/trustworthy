<x-layouts.marketing :title="'Home - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-12 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl bg-slate-900 px-6 py-12 text-white shadow-sm sm:px-10 lg:px-12">
            <p class="mb-4 inline-flex rounded-full border border-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-300">Premium Real Estate Platform</p>
            <h1 class="max-w-3xl text-4xl font-semibold tracking-tight sm:text-5xl">{{ $heroTitle }}</h1>
            <p class="mt-5 max-w-2xl text-slate-300">{{ $heroSubtitle }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('buy') }}" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500">Explore Homes</a>
                <a href="{{ route('sell') }}" class="rounded-xl border border-white/20 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">List Your Property</a>
            </div>
        </div>

        <section class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Active Listings</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($totalListings) }}</p>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">For Sale</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($saleListings) }}</p>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">For Rent</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($rentListings) }}</p>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Avg Sale Price</p>
                <p class="mt-2 text-2xl font-semibold text-slate-900"><x-price :amount="$avgSalePrice" /></p>
            </article>
        </section>

        <section class="mt-10">
            <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight text-slate-900">Top Nairobi Neighborhoods</h2>
                    <p class="mt-1 text-sm text-slate-500">Explore where serious buyers and renters are searching this week.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($hotNeighborhoods as $hotspot)
                    <a href="{{ route('properties.index', ['q' => $hotspot->neighborhood]) }}" class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:shadow-md">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Hotspot</p>
                        <h3 class="mt-2 text-lg font-semibold text-slate-900">{{ $hotspot->neighborhood }}</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ number_format($hotspot->listings_count) }} active listings</p>
                        <p class="mt-4 text-sm font-semibold text-slate-700 transition group-hover:text-emerald-700">Browse neighborhood</p>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="mt-12">
            <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight text-slate-900">Featured Listings</h2>
                    <p class="mt-1 text-sm text-slate-500">Hand-picked Nairobi opportunities updated daily.</p>
                </div>
                <a href="{{ route('properties.index') }}" class="text-sm font-semibold text-emerald-700 transition hover:text-emerald-600">View all listings</a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        </section>

        <section class="mt-12">
            <div class="mb-5">
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900">What Nairobi Clients Say</h2>
                <p class="mt-1 text-sm text-slate-500">Social proof from buyers, renters, and sellers using LuxeNest Kenya.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @foreach ($testimonials as $item)
                    <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                        <p class="text-sm leading-relaxed text-slate-600">"{{ $item['quote'] }}"</p>
                        <p class="mt-4 text-sm font-semibold text-slate-900">{{ $item['name'] }}</p>
                        <p class="text-xs text-slate-500">{{ $item['role'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </section>
</x-layouts.marketing>
