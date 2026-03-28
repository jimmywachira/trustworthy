<x-layouts.marketing :title="'About Us - '.config('app.name')">
    <section class="mx-auto max-w-5xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 sm:p-10">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-900">About LuxeNest Kenya</h1>
            <p class="mt-4 text-slate-600">{{ $aboutIntro }}</p>
            <p class="mt-4 text-slate-600">{{ $aboutBody }}</p>
            <p class="mt-4 text-slate-600">Think Zillow-scale discovery with Airbnb-level elegance, tailored for premium market segments across Nairobi and Kenya.</p>
        </div>
    </section>
</x-layouts.marketing>
