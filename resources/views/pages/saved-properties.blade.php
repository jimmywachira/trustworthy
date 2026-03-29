<x-layouts.marketing :title="'Saved Properties - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Saved Properties</h1>
                <p class="mt-1 text-sm text-slate-500">Your shortlisted Nairobi homes in one place.</p>
            </div>
            <a href="{{ route('properties.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Continue Browsing
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($savedProperties as $property)
                <x-property-card :property="$property" :is-saved="true" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                    <p class="text-slate-600">You have not saved any properties yet.</p>
                    <a href="{{ route('properties.index') }}" class="mt-4 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">
                        Explore Listings
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $savedProperties->links() }}
        </div>
    </section>
</x-layouts.marketing>
