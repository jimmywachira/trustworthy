<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $property->title }} - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-slate-900 text-slate-100 antialiased">
        <header class="sticky top-0 z-40 border-b border-slate-700/80 bg-slate-900/85 backdrop-blur-xl">
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

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <a href="{{ route('properties.index') }}" class="mb-6 inline-flex items-center text-sm text-slate-300 transition hover:text-white">Back to listings</a>

            <div class="mb-8 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-white">{{ $property->title }}</h1>
                    <p class="mt-1 text-slate-300">{{ $property->city }}, {{ $property->neighborhood }}</p>
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
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Estimated Monthly Budget</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900"><x-price :amount="$estimatedMonthly" /></p>
                    <p class="mt-1 text-xs text-slate-500">{{ $property->type === 'sale' ? 'Approximate 10% annual financing estimate' : 'Monthly rental cost estimate' }}</p>
                </article>
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Local Convenience</p>
                    <p class="mt-2 text-sm text-slate-600">Near business hubs, schools, and healthcare access across Nairobi commuter routes.</p>
                </article>
                <article class="rounded-2xl bg-white p-5 text-slate-800 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Need Fast Support?</p>
                    <a href="https://wa.me/254700123456?text={{ $whatsAppText }}" target="_blank" class="mt-2 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Chat on WhatsApp</a>
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
                            class="overflow-hidden rounded-2xl bg-slate-800 shadow-sm"
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
                <article class="rounded-2xl bg-white p-6 text-slate-800 shadow-sm">
                    <h2 class="mb-4 text-xl font-semibold text-slate-900">About this property</h2>
                    <p class="mb-6 leading-relaxed text-slate-600">{{ $property->description }}</p>
                    <div class="grid grid-cols-3 gap-3 text-sm">
                        <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Beds</span><strong>{{ $property->beds }}</strong></div>
                        <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Baths</span><strong>{{ rtrim(rtrim(number_format((float) $property->baths, 1), '0'), '.') }}</strong></div>
                        <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">SqFt</span><strong>{{ number_format($property->sqft) }}</strong></div>
                    </div>
                </article>

                <aside class="rounded-2xl bg-white p-6 shadow-sm">
                    <livewire:property-lead-form :property="$property" />
                </aside>
            </div>

            <section class="mt-10">
                <h2 class="mb-4 text-xl font-semibold text-white">Nearby Lifestyle Highlights</h2>
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl bg-slate-800/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-300">Commuting</p>
                        <p class="mt-2 text-sm text-slate-200">Access major Nairobi roads and key business districts with flexible route options.</p>
                    </article>
                    <article class="rounded-2xl bg-slate-800/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-300">Schools & Family</p>
                        <p class="mt-2 text-sm text-slate-200">Close to reputable schools, family recreation spots, and everyday essentials.</p>
                    </article>
                    <article class="rounded-2xl bg-slate-800/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-300">Security & Comfort</p>
                        <p class="mt-2 text-sm text-slate-200">Popular neighborhoods with strong residential security and managed access amenities.</p>
                    </article>
                </div>
            </section>
        </main>

        @include('partials.site-footer', ['dark' => true])

        @livewireScripts
    </body>
</html>
