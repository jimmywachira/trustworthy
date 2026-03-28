@props(['property'])

<article
    x-data="{
        key: 'luxenest_saved_properties',
        propertyId: {{ (int) $property->id }},
        saved: false,
        init() {
            const current = JSON.parse(localStorage.getItem(this.key) || '[]');
            this.saved = current.includes(this.propertyId);
        },
        toggleSaved() {
            const current = JSON.parse(localStorage.getItem(this.key) || '[]');
            if (current.includes(this.propertyId)) {
                const next = current.filter(id => id !== this.propertyId);
                localStorage.setItem(this.key, JSON.stringify(next));
                this.saved = false;
                return;
            }

            current.push(this.propertyId);
            localStorage.setItem(this.key, JSON.stringify(current));
            this.saved = true;
        }
    }"
    class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/80 transition hover:-translate-y-0.5 hover:shadow-md"
>
    <div class="relative">
        <div class="aspect-4/3 w-full overflow-hidden bg-slate-200">
            <img
                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80"
                alt="{{ $property->title }}"
                class="h-full w-full object-cover"
                loading="lazy"
            >
        </div>

        <x-price :amount="$property->price" :period="$property->type === 'rent' ? 'month' : null" class="absolute left-4 top-4 rounded-full bg-emerald-600 px-4 py-1.5 text-sm font-semibold text-white shadow-sm" />

        <div class="absolute right-4 top-4 space-y-2">
            <div class="rounded-full bg-white/85 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700 backdrop-blur">
                {{ $property->type }}
            </div>
            <button
                type="button"
                @click="toggleSaved"
                :class="saved ? 'bg-emerald-600 text-white' : 'bg-white/85 text-slate-700'"
                class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide backdrop-blur transition"
            >
                <span x-text="saved ? 'Saved' : 'Save'"></span>
            </button>
        </div>
    </div>

    <div class="space-y-4 p-5">
        <div>
            <h3 class="text-lg font-semibold text-slate-900">{{ $property->title }}</h3>
            <p class="mt-1 text-sm text-slate-500">{{ $property->city }}, {{ $property->neighborhood }}</p>
        </div>

        <div class="grid grid-cols-3 gap-2 rounded-xl bg-slate-50 p-3 text-sm text-slate-700">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4 text-emerald-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 11.25h16.5m-16.5 0v7.5h16.5v-7.5M3.75 11.25l2.1-5.25h12.3l2.1 5.25" />
                </svg>
                <span>{{ $property->beds }} Beds</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4 text-emerald-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 6.75h9m-9 5.25h9m-9 5.25h4.5m3.75-12v12a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h6a1.5 1.5 0 0 1 1.5 1.5Z" />
                </svg>
                <span>{{ rtrim(rtrim(number_format((float) $property->baths, 1), '0'), '.') }} Baths</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4 text-emerald-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h6v6h-6v-6Zm10.5 0h6v6h-6v-6Zm-10.5 10.5h6v6h-6v-6Zm10.5 3h6" />
                </svg>
                <span>{{ number_format($property->sqft) }} SqFt</span>
            </div>
        </div>

        <p class="line-clamp-2 text-sm text-slate-600">{{ $property->description }}</p>

        <a href="{{ route('properties.show', $property) }}" class="inline-flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2">
            Request Viewing
        </a>
    </div>
</article>
