<x-layouts.marketing :title="'Buy - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-10 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Buy premium homes with confidence.</h1>
            <p class="mt-3 max-w-3xl text-slate-600">Get clear valuations, Nairobi neighborhood intelligence, and listings that match your exact budget and lifestyle profile.</p>
        </div>

        <div class="mb-6 flex items-end justify-between">
            <h2 class="text-xl font-semibold text-slate-900">Available for Purchase</h2>
            <a href="{{ route('properties.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-600">Open smart filters</a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($properties as $property)
                <x-property-card :property="$property" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">No sale listings yet.</div>
            @endforelse
        </div>
    </section>
</x-layouts.marketing>
