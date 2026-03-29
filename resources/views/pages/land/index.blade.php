<x-layouts.marketing :title="'Land Listings - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-8 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Professional Land Listings</h1>
            <p class="mt-3 max-w-3xl text-slate-600">Dedicated land inventory with key due-diligence data for developers and institutional investors: parcel size, zoning, tenure, utilities, and title status.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @forelse ($landListings as $land)
                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-3 flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">{{ $land->title }}</h2>
                            <p class="mt-1 text-xs text-slate-500">{{ $land->reference_code ?: 'Reference pending' }}</p>
                        </div>
                        @if ($land->featured)
                            <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-emerald-700">Featured</span>
                        @endif
                    </div>

                    <p class="text-sm text-slate-600">{{ $land->city }}, {{ $land->neighborhood }}</p>

                    <div class="mt-4 grid grid-cols-2 gap-2 rounded-xl bg-slate-50 p-3 text-xs text-slate-700">
                        <div><span class="block text-slate-500">Parcel Size</span><strong>{{ number_format((float) $land->parcel_size_acres, 2) }} acres</strong></div>
                        <div><span class="block text-slate-500">Price / Acre</span><strong><x-price :amount="(float) ($land->price_per_acre ?? 0)" /></strong></div>
                        <div><span class="block text-slate-500">Zoning</span><strong>{{ $land->zoning ?: 'N/A' }}</strong></div>
                        <div><span class="block text-slate-500">Tenure</span><strong>{{ $land->tenure_type ?: 'N/A' }}</strong></div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <x-price :amount="$land->price" class="text-lg font-semibold text-slate-900" />
                        <a href="{{ route('land.show', $land) }}" class="inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">View Land Profile</a>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">No land listings available yet.</div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $landListings->links() }}
        </div>
    </section>
</x-layouts.marketing>
