<x-admin.layout title="Admin Dashboard">
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm text-slate-500">Total Properties</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($propertiesCount) }}</p>
        </article>
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm text-slate-500">Available Listings</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($availableCount) }}</p>
        </article>
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm text-slate-500">Sold Listings</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($soldCount) }}</p>
        </article>
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm text-slate-500">Total Leads</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($leadsCount) }}</p>
        </article>
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm text-slate-500">Appointments</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($appointmentsCount) }}</p>
        </article>
    </section>

    <section class="mt-6 grid gap-6 xl:grid-cols-2">
        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Leads</h2>
                <a href="{{ route('admin.leads.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-600">Manage leads</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentLeads as $lead)
                    <div class="rounded-xl border border-slate-200 p-3 text-sm">
                        <p class="font-semibold text-slate-900">{{ $lead->name }} <span class="font-normal text-slate-500">({{ $lead->email }})</span></p>
                        <p class="mt-1 text-slate-600">Property: {{ $lead->property?->title ?? 'N/A' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No leads yet.</p>
                @endforelse
            </div>
        </article>

        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Properties</h2>
                <a href="{{ route('admin.properties.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-600">Manage properties</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentProperties as $property)
                    <div class="rounded-xl border border-slate-200 p-3 text-sm">
                        <p class="font-semibold text-slate-900">{{ $property->title }}</p>
                        <p class="mt-1 text-slate-600">{{ $property->city }}, {{ $property->neighborhood }} - <x-price :amount="$property->price" /></p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No properties yet.</p>
                @endforelse
            </div>
        </article>
    </section>
</x-admin.layout>
