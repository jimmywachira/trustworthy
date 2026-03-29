<section class="min-h-screen bg-slate-50 pb-16 text-slate-800 transition-colors dark:bg-slate-950 dark:text-slate-200">
    @include('partials.marketing-nav')

    <div class="mx-auto max-w-7xl px-4 pt-10 sm:px-6 lg:px-8">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl dark:text-slate-100">Find Your Next Nairobi Property</h1>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ number_format($matchesCount) }} results matched your filters.</p>
            </div>
            <button wire:click="resetFilters" type="button" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                Clear Filters
            </button>
        </div>

        <div class="mb-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-premium dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3 dark:border-slate-800">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-800 dark:text-slate-200">Map View</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Pins update with your active filters</p>
            </div>
            <div
                x-data="propertyMap(@js($mapProperties), @js($neighborhoodCoordinates), @js($mapCenter))"
                x-init="initMap()"
                class="h-80 w-full"
            >
                <div x-ref="map" class="h-full w-full"></div>
            </div>
        </div>

        <div class="mb-4 flex flex-wrap gap-2">
            @foreach ($featuredNeighborhoods as $neighborhood)
                <button
                    type="button"
                    wire:click="setNeighborhood('{{ $neighborhood }}')"
                    class="rounded-full border px-3 py-1.5 text-xs font-semibold uppercase tracking-wide transition {{ strcasecmp(trim($location), $neighborhood) === 0 ? 'border-emerald-500 bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300' : 'border-slate-300 text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                >
                    {{ $neighborhood }}
                </button>
            @endforeach
        </div>

        <div class="mb-8 rounded-2xl bg-white p-4 shadow-premium ring-1 ring-slate-200/80 sm:p-6 dark:bg-slate-900 dark:ring-slate-800">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-8">
                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Min Price</span>
                    <input
                        type="number"
                        min="0"
                        wire:model.live.debounce.350ms="minPrice"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500"
                        placeholder="5000000"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Max Price</span>
                    <input
                        type="number"
                        min="0"
                        wire:model.live.debounce.350ms="maxPrice"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500"
                        placeholder="120000000"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Property Type</span>
                    <select
                        wire:model.live="propertyType"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="">Any</option>
                        <option value="rent">Rent</option>
                        <option value="sale">Sale</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Min Beds</span>
                    <select
                        wire:model.live="minBeds"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="">Any</option>
                        <option value="1">1+</option>
                        <option value="2">2+</option>
                        <option value="3">3+</option>
                        <option value="4">4+</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Amenity</span>
                    <select
                        wire:model.live="amenity"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="">Any</option>
                        <option value="Pool">Pool</option>
                        <option value="Gym">Gym</option>
                        <option value="Parking">Parking</option>
                        <option value="Smart Home">Smart Home</option>
                        <option value="24/7 Security">24/7 Security</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Location</span>
                    <input
                        type="text"
                        wire:model.live.debounce.350ms="location"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500"
                        placeholder="City or neighborhood"
                    >
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Map Center</span>
                    <select
                        wire:model.live="mapCenter"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="">Any</option>
                        @foreach (array_keys($neighborhoodCoordinates) as $center)
                            <option value="{{ $center }}">{{ $center }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Distance (KM)</span>
                    <select
                        wire:model.live="distanceKm"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="">Any</option>
                        <option value="2">2 KM</option>
                        <option value="5">5 KM</option>
                        <option value="10">10 KM</option>
                        <option value="15">15 KM</option>
                    </select>
                </label>

                <label class="space-y-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Sort By</span>
                    <select
                        wire:model.live="sortBy"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                    >
                        <option value="newest">Newest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="sqft_high">Largest SqFt</option>
                        <option value="nearest">Nearest to Map Center</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($properties as $property)
                <x-property-card :property="$property" :is-saved="in_array($property->id, $savedPropertyIds, true)" />
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
                    No properties matched your filters. Try broadening the price range or location.
                </div>
            @endforelse
        </div>

        <div class="mt-8 [&_nav]:text-slate-700 dark:[&_nav]:text-slate-200 [&_span]:rounded-lg [&_span]:px-2 [&_span]:py-1">
            {{ $properties->links() }}
        </div>
    </div>

    @include('partials.site-footer')

    @once
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            function propertyMap(properties, neighborhoods, selectedCenter) {
                return {
                    map: null,
                    markersLayer: null,
                    properties,
                    neighborhoods,
                    selectedCenter,
                    initMap() {
                        const defaultCenter = this.selectedCenter && this.neighborhoods[this.selectedCenter]
                            ? [this.neighborhoods[this.selectedCenter].lat, this.neighborhoods[this.selectedCenter].lng]
                            : [-1.286389, 36.817223];

                        this.map = L.map(this.$refs.map, {
                            zoomControl: true,
                            scrollWheelZoom: false,
                        }).setView(defaultCenter, 12);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(this.map);

                        this.markersLayer = L.layerGroup().addTo(this.map);

                        this.properties.forEach((property) => {
                            const marker = L.marker([property.lat, property.lng]);
                            marker.bindPopup(`<strong>${property.title}</strong><br>${property.price}<br><a href="${property.url}">View details</a>`);
                            marker.addTo(this.markersLayer);
                        });

                        if (this.properties.length > 0) {
                            const bounds = L.latLngBounds(this.properties.map((item) => [item.lat, item.lng]));
                            this.map.fitBounds(bounds.pad(0.2));
                        }
                    },
                }
            }
        </script>
    @endonce
</section>
