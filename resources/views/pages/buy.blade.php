<x-layouts.marketing :title="'Buy - '.config('app.name')">
    <section class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
        <div class="mb-8 overflow-hidden rounded-3xl bg-slate-900 p-8 text-white shadow-sm sm:p-10">
            <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-200">Investor Acquisition Desk</p>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Acquire Nairobi real estate with global-investor clarity.</h1>
            <p class="mt-3 max-w-3xl text-sm text-slate-200 sm:text-base">Explore high-conviction residential, land, and commercial opportunities curated for local and international buyers seeking long-term appreciation, strong rental fundamentals, and strategic location advantage.</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl bg-white/10 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-300">For Sale Inventory</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ number_format($saleCount) }}</p>
                </article>
                <article class="rounded-2xl bg-white/10 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-300">Land Opportunities</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ number_format($landCount) }}</p>
                </article>
                <article class="rounded-2xl bg-white/10 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-300">Average Sale Ticket</p>
                    <p class="mt-2 text-2xl font-semibold text-white"><x-price :amount="$avgSalePrice" /></p>
                </article>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-400">
                    <ion-icon name="options-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                    Open Full Sale Filters
                </a>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                    <ion-icon name="call-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                    Contact Investment Advisory
                </a>
            </div>
        </div>

        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-slate-900">Residential Capital Growth</h2>
                <p class="mt-2 text-sm text-slate-600">Apartments, villas, and family homes in prime Nairobi neighborhoods with sustained buyer demand.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-slate-900">Land Banking & Development</h2>
                <p class="mt-2 text-sm text-slate-600">Plots and land parcels suitable for phased development and long-horizon value appreciation.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-slate-900">Commercial Yield Assets</h2>
                <p class="mt-2 text-sm text-slate-600">Office and mixed-use opportunities positioned for rental yield and enterprise demand.</p>
            </article>
        </div>

        <div class="mb-10 grid gap-6 lg:grid-cols-[1.2fr_1fr]">
            <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold tracking-tight text-slate-900">Investor Download Pack</h2>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">PDF-Ready Brief</span>
                </div>
                <p class="text-sm text-slate-600">Get a concise acquisition snapshot for Nairobi sale opportunities including inventory depth, neighborhood concentration, and pricing benchmarks.</p>

                <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Included In The Pack</p>
                    <ul class="mt-2 space-y-1 text-sm text-slate-700">
                        <li>1. Sale inventory and segment overview</li>
                        <li>2. Land and commercial opportunity snapshot</li>
                        <li>3. Prime neighborhood activity summary</li>
                        <li>4. Recommended next-step acquisition workflow</li>
                    </ul>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ route('buy.investor-pack.brief') }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                        <ion-icon name="download-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                        Open PDF Brief
                    </a>
                    <a href="{{ route('buy.investor-pack.brief') }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <ion-icon name="document-text-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                        Preview Summary Card
                    </a>
                </div>
            </article>

            <aside class="rounded-3xl bg-slate-900 p-6 text-slate-100 shadow-sm sm:p-7">
                <h3 class="text-lg font-semibold tracking-tight text-white">Request Investor Pack</h3>
                <p class="mt-1 text-sm text-slate-300">Share your profile and our advisory desk will follow up with tailored opportunities.</p>

                @if (session('investor_pack_status'))
                    <div class="mt-4 rounded-xl border border-emerald-300/40 bg-emerald-500/15 px-3 py-2 text-sm text-emerald-100">
                        {{ session('investor_pack_status') }}
                    </div>
                @endif

                @if ($errors->has('investor_pack'))
                    <div class="mt-4 rounded-xl border border-red-300/40 bg-red-500/15 px-3 py-2 text-sm text-red-100">
                        {{ $errors->first('investor_pack') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('buy.investor-pack.request') }}" class="mt-4 space-y-3">
                    @csrf

                    <label class="block space-y-1.5">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Name</span>
                        <input name="name" value="{{ old('name') }}" type="text" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30" placeholder="Investor name" required>
                        @error('name') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                    </label>

                    <label class="block space-y-1.5">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Email</span>
                        <input name="email" value="{{ old('email') }}" type="email" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30" placeholder="you@fund.com" required>
                        @error('email') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                    </label>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="block space-y-1.5">
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Phone</span>
                            <input name="phone" value="{{ old('phone') }}" type="text" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30" placeholder="+254...">
                            @error('phone') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                        </label>

                        <label class="block space-y-1.5">
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Country</span>
                            <input name="country" value="{{ old('country') }}" type="text" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30" placeholder="UAE, UK, USA...">
                            @error('country') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="block space-y-1.5">
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Budget Range</span>
                            <select name="budget_range" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30">
                                <option value="" class="text-slate-900">Select budget range</option>
                                <option value="Below KSh 50M" class="text-slate-900" @selected(old('budget_range') === 'Below KSh 50M')>Below KSh 50M</option>
                                <option value="KSh 50M - 150M" class="text-slate-900" @selected(old('budget_range') === 'KSh 50M - 150M')>KSh 50M - 150M</option>
                                <option value="KSh 150M - 300M" class="text-slate-900" @selected(old('budget_range') === 'KSh 150M - 300M')>KSh 150M - 300M</option>
                                <option value="Above KSh 300M" class="text-slate-900" @selected(old('budget_range') === 'Above KSh 300M')>Above KSh 300M</option>
                            </select>
                            @error('budget_range') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                        </label>

                        <label class="block space-y-1.5">
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-300">Asset Focus</span>
                            <select name="asset_focus" class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30">
                                <option value="" class="text-slate-900">Select focus</option>
                                <option value="Residential" class="text-slate-900" @selected(old('asset_focus') === 'Residential')>Residential</option>
                                <option value="Land" class="text-slate-900" @selected(old('asset_focus') === 'Land')>Land</option>
                                <option value="Commercial" class="text-slate-900" @selected(old('asset_focus') === 'Commercial')>Commercial</option>
                                <option value="Mixed Portfolio" class="text-slate-900" @selected(old('asset_focus') === 'Mixed Portfolio')>Mixed Portfolio</option>
                            </select>
                            @error('asset_focus') <span class="text-xs text-red-200">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <button type="submit" class="mt-1 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-400">
                        <ion-icon name="paper-plane-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                        Request Pack + Advisor Callback
                    </button>
                </form>
            </aside>
        </div>

        <div class="mb-6 flex items-end justify-between">
            <h2 class="text-xl font-semibold text-slate-900">Featured Properties for Sale</h2>
            <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-600">Open smart filters</a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($properties as $property)
                <x-property-card :property="$property" :is-saved="in_array($property->id, $savedPropertyIds, true)" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">No sale listings yet.</div>
            @endforelse
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-2">
            <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Land For Sale</h3>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">Development Focus</span>
                </div>

                <div class="space-y-3">
                    @forelse ($landProperties as $property)
                        <a href="{{ route('land.show', $property) }}" class="flex items-start justify-between gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $property->title }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $property->city }}, {{ $property->neighborhood }} · {{ number_format((float) $property->parcel_size_acres, 2) }} acres</p>
                            </div>
                            <x-price :amount="$property->price" class="text-sm font-semibold text-emerald-700" />
                        </a>
                    @empty
                        <p class="rounded-xl border border-dashed border-slate-300 p-4 text-sm text-slate-500">Land opportunities are being curated. Check back shortly.</p>
                    @endforelse

                    <a href="{{ route('land.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-600">
                        <ion-icon name="map-outline" class="h-4 w-4" aria-hidden="true"></ion-icon>
                        Browse full land database
                    </a>
                </div>
            </article>

            <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Commercial & Mixed-Use</h3>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700">Yield Potential</span>
                </div>

                <div class="space-y-3">
                    @forelse ($commercialProperties as $property)
                        <a href="{{ route('properties.show', $property) }}" class="flex items-start justify-between gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50/40">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $property->title }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $property->city }}, {{ $property->neighborhood }}</p>
                            </div>
                            <x-price :amount="$property->price" class="text-sm font-semibold text-emerald-700" />
                        </a>
                    @empty
                        <p class="rounded-xl border border-dashed border-slate-300 p-4 text-sm text-slate-500">Commercial inventory is currently limited. Our advisory team can source off-market options.</p>
                    @endforelse
                </div>
            </article>
        </div>

        <div class="mt-12 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
            <h3 class="text-xl font-semibold text-slate-900">Prime Investment Neighborhoods</h3>
            <p class="mt-2 text-sm text-slate-600">Nairobi zones with consistent transaction activity and investor attention.</p>

            <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($primeNeighborhoods as $neighborhood)
                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-sm font-semibold text-slate-900">{{ $neighborhood->neighborhood }}</p>
                        <p class="text-xs text-slate-500">{{ number_format((int) $neighborhood->listings_count) }} active sale listings</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Neighborhood insights are currently being compiled.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.marketing>
