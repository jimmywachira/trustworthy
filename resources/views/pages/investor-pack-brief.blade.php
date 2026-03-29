<!DOCTYPE html>
<html lang="en">
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
        <title>Investor Brief - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css'])
        <script type="module" src="https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.js"></script>
        <style>
            @media print {
                .no-print {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="relative isolate bg-slate-50 text-slate-900 antialiased transition-colors dark:bg-slate-950 dark:text-slate-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,rgba(148,163,184,0.18)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.18)_1px,transparent_1px)] bg-size-[6rem_4rem] dark:bg-[linear-gradient(to_right,rgba(51,65,85,0.35)_1px,transparent_1px),linear-gradient(to_bottom,rgba(51,65,85,0.35)_1px,transparent_1px)]"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-linear-to-b from-slate-900/6 to-transparent dark:from-emerald-500/10"></div>

        <main class="relative z-10 mx-auto max-w-4xl p-6 sm:p-10">
            <header class="rounded-3xl bg-slate-900 p-8 text-white shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-200">Investor Download Pack</p>
                <h1 class="mt-3 text-3xl font-semibold tracking-tight">Nairobi Investment Brief</h1>
                <p class="mt-2 text-sm text-slate-200">Prepared for acquisition-focused investors reviewing residential, land, and commercial opportunities.</p>
                <p class="mt-4 text-xs text-slate-300">Generated: {{ $generatedAt->format('M j, Y H:i') }} EAT</p>
            </header>

            <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">For Sale Inventory</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['saleCount']) }}</p>
                </article>
                <article class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Average Sale Ticket</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900"><x-price :amount="$summary['avgSalePrice']" /></p>
                </article>
                <article class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Land Opportunities</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['landCount']) }}</p>
                </article>
                <article class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Commercial Opportunities</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['commercialCount']) }}</p>
                </article>
            </section>

            <section class="mt-6 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900">Prime Neighborhood Snapshot</h2>
                <p class="mt-1 text-sm text-slate-600">Top sale-active zones with indicative listing depth and average pricing.</p>

                <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3">Neighborhood</th>
                                <th class="px-4 py-3">Listings</th>
                                <th class="px-4 py-3">Average Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($primeNeighborhoods as $row)
                                <tr class="border-t border-slate-100">
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ $row->neighborhood }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ number_format((int) $row->listings_count) }}</td>
                                    <td class="px-4 py-3 text-slate-600"><x-price :amount="(float) $row->avg_price" /></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-5 text-center text-slate-500">No summary data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="mt-6 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900">Next Steps</h2>
                <ul class="mt-3 space-y-2 text-sm text-slate-700">
                    <li>1. Request tailored underwriting assumptions by asset class.</li>
                    <li>2. Book a virtual or in-person acquisition consultation.</li>
                    <li>3. Receive curated on-market and off-market shortlist options.</li>
                </ul>
            </section>

            <div class="no-print mt-6 flex flex-wrap gap-3">
                <button onclick="window.print()" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Download as PDF</button>
                <a href="{{ route('buy') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Back to Buy Page</a>
            </div>
        </main>
    </body>
</html>
