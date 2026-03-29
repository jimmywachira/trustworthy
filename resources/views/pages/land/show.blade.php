<x-layouts.marketing :title="$landListing->title.' - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('land.index') }}" class="inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-600">Back to land listings</a>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900">{{ $landListing->title }}</h1>
                    <p class="mt-2 text-sm text-slate-600">{{ $landListing->city }}, {{ $landListing->neighborhood }}</p>
                    <p class="mt-1 text-xs text-slate-500">Reference: {{ $landListing->reference_code ?: 'N/A' }}</p>
                </div>
                <x-price :amount="$landListing->price" class="rounded-full bg-emerald-600 px-5 py-2 text-lg font-semibold text-white" />
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Parcel Size</span><strong>{{ number_format((float) $landListing->parcel_size_acres, 2) }} acres</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Price per Acre</span><strong><x-price :amount="(float) ($landListing->price_per_acre ?? 0)" /></strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Permitted Use</span><strong>{{ $landListing->permitted_use ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Zoning</span><strong>{{ $landListing->zoning ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Tenure</span><strong>{{ $landListing->tenure_type ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Title Status</span><strong>{{ $landListing->title_deed_status ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Road Access</span><strong>{{ $landListing->road_access ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Topography</span><strong>{{ $landListing->topography ?: 'N/A' }}</strong></div>
                <div class="rounded-xl bg-slate-50 p-4 text-sm"><span class="block text-xs text-slate-500">Status</span><strong class="uppercase">{{ $landListing->status }}</strong></div>
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200 p-4">
                <h2 class="text-base font-semibold text-slate-900">Utilities</h2>
                <div class="mt-2 flex flex-wrap gap-2">
                    @forelse (($landListing->utilities ?? []) as $utility)
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $utility }}</span>
                    @empty
                        <span class="text-sm text-slate-500">Utilities not provided.</span>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                <article class="lg:col-span-2">
                    <h2 class="text-base font-semibold text-slate-900">Listing Notes</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $landListing->description ?: 'No additional listing notes available.' }}</p>
                </article>

                <aside class="rounded-2xl border border-slate-200 p-4">
                    <h2 class="text-base font-semibold text-slate-900">Advisor Contact</h2>
                    @if ($landListing->agent)
                        <p class="mt-2 text-sm font-semibold text-slate-900">{{ $landListing->agent->name }}</p>
                        <p class="text-xs text-slate-500">{{ $landListing->agent->specialty }}</p>
                        <a href="mailto:{{ $landListing->agent->email }}" class="mt-3 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-500">Email Advisor</a>
                    @else
                        <p class="mt-2 text-sm text-slate-600">Contact our acquisition desk:</p>
                        <a href="mailto:hello@luxenest.co.ke" class="mt-2 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-500">Contact Team</a>
                    @endif
                </aside>
            </div>
        </div>
    </section>
</x-layouts.marketing>
