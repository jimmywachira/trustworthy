<x-layouts.marketing :title="$agent->name.' - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-8 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <img src="{{ $agent->photo_url ?: 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=300&q=80' }}" alt="{{ $agent->name }}" class="h-20 w-20 rounded-2xl object-cover">
                    <div>
                        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">{{ $agent->name }}</h1>
                        <p class="text-sm text-slate-600">{{ $agent->specialty }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            @if ($agent->is_verified)
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">Verified Agent</span>
                            @endif
                            <span class="text-xs text-slate-500">{{ $agent->email }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 text-sm">
                    <a href="mailto:{{ $agent->email }}" class="block rounded-xl border border-slate-200 px-4 py-2 font-semibold text-slate-700 transition hover:bg-slate-50">Email Agent</a>
                    @if ($agent->phone)
                        <a href="tel:{{ $agent->phone }}" class="block rounded-xl bg-emerald-600 px-4 py-2 font-semibold text-white transition hover:bg-emerald-500">Call {{ $agent->phone }}</a>
                    @endif
                </div>
            </div>

            <p class="mt-5 text-sm leading-relaxed text-slate-600">{{ $agent->bio }}</p>
        </div>

        <div class="mb-4 flex items-end justify-between">
            <h2 class="text-xl font-semibold text-slate-900">Listings by {{ $agent->name }}</h2>
            <p class="text-sm text-slate-500">{{ $properties->total() }} active listings</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($properties as $property)
                <x-property-card :property="$property" :is-saved="auth()->check() ? in_array($property->id, auth()->user()->savedProperties()->pluck('properties.id')->all()) : false" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">No active listings for this agent yet.</div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $properties->links() }}
        </div>
    </section>
</x-layouts.marketing>
