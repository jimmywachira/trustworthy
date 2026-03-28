@props([
    'action',
    'method' => 'POST',
    'property' => null,
    'amenitiesText' => '',
])

<form method="POST" action="{{ $action }}" class="space-y-5">
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Title</span>
            <input type="text" name="title" value="{{ old('title', $property?->title) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('title') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Price (KSh)</span>
            <input type="number" min="0" name="price" value="{{ old('price', $property?->price) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('price') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>
    </div>

    <label class="block space-y-2">
        <span class="text-sm font-medium text-slate-700">Description</span>
        <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>{{ old('description', $property?->description) }}</textarea>
        @error('description') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
    </label>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">City</span>
            <input type="text" name="city" value="{{ old('city', $property?->city ?? 'Nairobi') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('city') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Neighborhood</span>
            <input type="text" name="neighborhood" value="{{ old('neighborhood', $property?->neighborhood) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5">
            @error('neighborhood') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Type</span>
            <select name="type" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
                @php($type = old('type', $property?->type ?? 'sale'))
                <option value="sale" @selected($type === 'sale')>Sale</option>
                <option value="rent" @selected($type === 'rent')>Rent</option>
            </select>
            @error('type') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Status</span>
            <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
                @php($status = old('status', $property?->status ?? 'available'))
                <option value="available" @selected($status === 'available')>Available</option>
                <option value="sold" @selected($status === 'sold')>Sold</option>
            </select>
            @error('status') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Beds</span>
            <input type="number" min="0" name="beds" value="{{ old('beds', $property?->beds ?? 3) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('beds') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">Baths</span>
            <input type="number" min="0" step="0.5" name="baths" value="{{ old('baths', $property?->baths ?? 2) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('baths') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="space-y-2">
            <span class="text-sm font-medium text-slate-700">SqFt</span>
            <input type="number" min="0" name="sqft" value="{{ old('sqft', $property?->sqft ?? 1600) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" required>
            @error('sqft') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
        </label>
    </div>

    <label class="block space-y-2">
        <span class="text-sm font-medium text-slate-700">Amenities (comma separated)</span>
        <input type="text" name="amenities" value="{{ old('amenities', $amenitiesText) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5" placeholder="Pool, Gym, Smart Home">
    </label>

    <div class="flex items-center gap-3">
        <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Save Property</button>
        <a href="{{ route('admin.properties.index') }}" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
</form>
