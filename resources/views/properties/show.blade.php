<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            (function () {
                const storageKey = 'trustworthy-theme';

                try {
                    const stored = localStorage.getItem(storageKey);
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const isDark = stored ? stored === 'dark' : prefersDark;

                    document.documentElement.classList.toggle('dark', isDark);
                    document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
                } catch {
                    document.documentElement.classList.toggle('dark', window.matchMedia('(prefers-color-scheme: dark)').matches);
                }
            })();
        </script>
        <title>{{ $seo['title'] ?? ($property->title.' - '.config('app.name')) }}</title>
        <x-seo.meta :seo="$seo ?? []" :title="$property->title" />
        <x-seo.real-estate-listing-schema :property="$property" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="relative isolate bg-slate-50 text-slate-800 antialiased transition-colors dark:bg-slate-950 dark:text-slate-200">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,rgba(148,163,184,0.18)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.18)_1px,transparent_1px)] bg-size-[6rem_4rem] dark:bg-[linear-gradient(to_right,rgba(51,65,85,0.35)_1px,transparent_1px),linear-gradient(to_bottom,rgba(51,65,85,0.35)_1px,transparent_1px)]"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-linear-to-b from-slate-900/6 to-transparent dark:from-emerald-500/10"></div>

        @include('partials.marketing-nav')

        <main class="relative z-10 mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <a href="{{ route('properties.index') }}" class="mb-6 inline-flex items-center text-sm text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-slate-100">Back to listings</a>

            <div class="mb-8 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">{{ $property->title }}</h1>
                    <p class="mt-1 text-slate-600 dark:text-slate-300">{{ $property->city }}, {{ $property->neighborhood }}</p>
                </div>
                <x-price :amount="$property->price" class="rounded-full bg-emerald-600 px-5 py-2 text-lg font-semibold text-white shadow-sm" />
            </div>

            @php
                $estimatedMonthly = $property->type === 'sale'
                    ? round(((float) $property->price * 0.10) / 12)
                    : (float) $property->price;
                $whatsAppText = rawurlencode('Hello LuxeNest, I am interested in '.$property->title.' in '.$property->neighborhood.'.');
            @endphp

            <div class="mb-8 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-premium ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-800">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Estimated Monthly Budget</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-slate-100"><x-price :amount="$estimatedMonthly" /></p>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $property->type === 'sale' ? 'Approximate 10% annual financing estimate' : 'Monthly rental cost estimate' }}</p>
                </article>
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-premium ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-800">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Local Convenience</p>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Near business hubs, schools, and healthcare access across Nairobi commuter routes.</p>
                </article>
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-premium ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-800">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Need Fast Support?</p>
                    <a href="https://wa.me/254700123456?text={{ $whatsAppText }}" target="_blank" class="mt-2 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">Chat on WhatsApp</a>
                </article>
            </div>

            @php
                $gallery = [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80',
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1600&q=80',
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=1600&q=80',
                    'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1600&q=80',
                    'https://images.unsplash.com/photo-1600607687644-c7171b42498f?auto=format&fit=crop&w=1600&q=80',
                    'https://images.unsplash.com/photo-1600047509795-2f5f56f6f9a8?auto=format&fit=crop&w=1600&q=80',
                ];
            @endphp

            <section
                x-data="{ open: false, active: 0, images: @js($gallery) }"
                class="mb-10"
            >
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach ($gallery as $image)
                        <button
                            type="button"
                            @click="active = {{ $loop->index }}; open = true"
                            class="overflow-hidden rounded-2xl bg-slate-200 shadow-sm dark:bg-slate-800"
                        >
                            <img src="{{ $image }}" alt="Property image {{ $loop->iteration }}" class="h-full w-full object-cover transition duration-300 hover:scale-105">
                        </button>
                    @endforeach
                </div>

                <div
                    x-show="open"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 px-4"
                    @keydown.escape.window="open = false"
                >
                    <div class="absolute inset-0" @click="open = false"></div>
                    <div class="relative z-10 w-full max-w-5xl">
                        <img :src="images[active]" alt="Large preview" class="max-h-[80vh] w-full rounded-2xl object-cover shadow-sm">
                    </div>
                </div>
            </section>

            <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
                <article class="rounded-2xl bg-white p-6 text-slate-800 shadow-premium ring-1 ring-slate-200/80 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-800">
                    <h2 class="mb-4 text-xl font-semibold text-slate-900 dark:text-slate-100">About this property</h2>
                    <p class="mb-6 leading-relaxed text-slate-600 dark:text-slate-300">{{ $property->description }}</p>
                    <div class="grid grid-cols-3 gap-3 text-sm">
                        <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-950"><span class="block text-slate-500 dark:text-slate-400">Beds</span><strong class="text-slate-900 dark:text-slate-100">{{ $property->beds }}</strong></div>
                        <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-950"><span class="block text-slate-500 dark:text-slate-400">Baths</span><strong class="text-slate-900 dark:text-slate-100">{{ rtrim(rtrim(number_format((float) $property->baths, 1), '0'), '.') }}</strong></div>
                        <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-950"><span class="block text-slate-500 dark:text-slate-400">SqFt</span><strong class="text-slate-900 dark:text-slate-100">{{ number_format($property->sqft) }}</strong></div>
                    </div>
                </article>

                <aside class="rounded-2xl bg-white p-6 shadow-premium ring-1 ring-slate-200/80 dark:bg-slate-900 dark:ring-slate-800">
                    @if ($property->agent)
                        <div class="mb-6 rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <div class="flex items-start gap-3">
                                <img src="{{ $property->agent->photo_url ?: 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=300&q=80' }}" alt="{{ $property->agent->name }}" class="h-14 w-14 rounded-xl object-cover">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $property->agent->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $property->agent->specialty }}</p>
                                    @if ($property->agent->is_verified)
                                        <span class="mt-2 inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-emerald-700">Verified Agent</span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('agents.show', $property->agent) }}" class="mt-3 inline-flex text-xs font-semibold text-emerald-700 hover:text-emerald-600">View Agent Profile</a>
                        </div>
                    @endif

                    <livewire:property-lead-form :property="$property" />

                    <div class="mt-4">
                        <livewire:appointment-scheduler :property="$property" />
                    </div>
                </aside>
            </div>

            <section class="mt-10">
                <h2 class="mb-4 text-xl font-semibold text-slate-900 dark:text-slate-100">Nearby Lifestyle Highlights</h2>
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl bg-white p-4 shadow-premium ring-1 ring-slate-200/80 dark:bg-slate-900 dark:ring-slate-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">Commuting</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Access major Nairobi roads and key business districts with flexible route options.</p>
                    </article>
                    <article class="rounded-2xl bg-white p-4 shadow-premium ring-1 ring-slate-200/80 dark:bg-slate-900 dark:ring-slate-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">Schools & Family</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Close to reputable schools, family recreation spots, and everyday essentials.</p>
                    </article>
                    <article class="rounded-2xl bg-white p-4 shadow-premium ring-1 ring-slate-200/80 dark:bg-slate-900 dark:ring-slate-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">Security & Comfort</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Popular neighborhoods with strong residential security and managed access amenities.</p>
                    </article>
                </div>
            </section>
        </main>

        <div class="relative z-10">
            @include('partials.site-footer')
        </div>

        @livewireScripts
    </body>
</html>
