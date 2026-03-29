@props([
    'property',
    'isSaved' => false,
])

<article class="overflow-hidden rounded-2xl bg-white/92 shadow-premium ring-1 ring-slate-200/90 backdrop-blur-sm transition hover:-translate-y-0.5 hover:shadow-[0_22px_48px_-30px_rgb(15_23_42/0.45)] lg:bg-white/86 dark:bg-slate-900/92 dark:ring-slate-800/95 dark:hover:ring-slate-700">
    <div class="relative">
        <div class="aspect-4/3 w-full overflow-hidden bg-slate-200 dark:bg-slate-800">
            <img
                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80"
                alt="{{ $property->title }}"
                class="h-full w-full object-cover"
                loading="lazy"
            >
        </div>

        <x-price :amount="$property->price" :period="$property->type === 'rent' ? 'month' : null" class="absolute left-4 top-4 rounded-full bg-emerald-600 px-4 py-1.5 text-sm font-semibold text-white shadow-sm" />

        <div class="absolute right-4 top-4 space-y-2">
            <div class="rounded-full bg-white/92 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700 backdrop-blur dark:bg-slate-900/92 dark:text-slate-200">
                {{ $property->type }}
            </div>

            @auth
                <form method="POST" action="{{ route('saved-properties.toggle', $property) }}">
                    @csrf
                    <button type="submit" class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide backdrop-blur transition {{ $isSaved ? 'bg-emerald-600 text-white dark:bg-emerald-500' : 'bg-white/92 text-slate-700 hover:bg-white dark:bg-slate-900/92 dark:text-slate-200 dark:hover:bg-slate-800' }}">
                        {{ $isSaved ? 'Saved' : 'Save' }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="inline-flex rounded-full bg-white/92 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700 backdrop-blur transition hover:bg-white dark:bg-slate-900/92 dark:text-slate-200 dark:hover:bg-slate-800">
                    Save
                </a>
            @endauth
        </div>
    </div>

    <div class="space-y-4 p-5">
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ $property->title }}</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $property->city }}, {{ $property->neighborhood }}</p>
        </div>

        <div class="grid grid-cols-3 gap-2 rounded-xl bg-slate-50/90 p-3 text-sm text-slate-700 dark:bg-slate-950/85 dark:text-slate-300">
            <div class="flex items-center gap-2">
                <ion-icon name="bed-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>
                <span>{{ $property->beds }} Beds</span>
            </div>
            <div class="flex items-center gap-2">
                <ion-icon name="water-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>
                <span>{{ rtrim(rtrim(number_format((float) $property->baths, 1), '0'), '.') }} Baths</span>
            </div>
            <div class="flex items-center gap-2">
                <ion-icon name="expand-outline" class="h-4 w-4 text-emerald-600 dark:text-emerald-400" aria-hidden="true"></ion-icon>
                <span>{{ number_format($property->sqft) }} SqFt</span>
            </div>
        </div>

        <p class="line-clamp-2 text-sm text-slate-600 dark:text-slate-300">{{ $property->description }}</p>

        <a
            href="{{ route('properties.show', $property) }}"
            wire:navigate
            data-seo-title="{{ $property->title }} - {{ $property->neighborhood }}, {{ $property->city }} | {{ config('app.name') }}"
            data-seo-description="{{ \Illuminate\Support\Str::limit(strip_tags((string) $property->description), 160) }}"
            class="inline-flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:focus:ring-emerald-400 dark:focus:ring-offset-slate-900"
        >
            Request Viewing
        </a>
    </div>
</article>
