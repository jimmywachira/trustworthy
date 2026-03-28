<x-layouts.marketing :title="'Sell - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-slate-900 px-8 py-12 text-white shadow-sm">
            <h1 class="text-3xl font-semibold tracking-tight">Sell at the right price, with enterprise-grade presentation.</h1>
            <p class="mt-3 max-w-3xl text-slate-300">We package your Nairobi listing with cinematic media, buyer-intent targeting, and live inquiry routing to maximize conversion.</p>
            <a href="{{ Route::has('register') ? route('register') : route('login') }}" class="mt-7 inline-flex rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500">Start selling</a>
        </div>

        <section class="mt-10 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">1. Strategic Pricing</h2>
                <p class="mt-2 text-sm text-slate-600">Dynamic market comps and demand trend analysis to launch at the strongest possible value point.</p>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">2. Premium Exposure</h2>
                <p class="mt-2 text-sm text-slate-600">Your listing is showcased across search, social, and partner channels with performance-grade analytics.</p>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">3. Fast Qualification</h2>
                <p class="mt-2 text-sm text-slate-600">Inquiries are captured in real time and matched with readiness signals so your team focuses on serious buyers.</p>
            </article>
        </section>
    </section>
</x-layouts.marketing>
