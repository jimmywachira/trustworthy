<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display paginated properties.
     */
    public function index(): View
    {
        return view('admin.properties.index', [
            'properties' => Property::query()->latest()->paginate(15),
        ]);
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created property.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProperty($request);
        $validated['amenities'] = $this->parseAmenities($request->string('amenities')->toString());

        Property::query()->create($validated);

        return redirect()->route('admin.properties.index')->with('status', 'Property created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Property $property): View
    {
        return view('admin.properties.edit', [
            'property' => $property,
            'amenitiesText' => implode(', ', $property->amenities ?? []),
        ]);
    }

    /**
     * Update property.
     */
    public function update(Request $request, Property $property): RedirectResponse
    {
        $validated = $this->validateProperty($request);
        $validated['amenities'] = $this->parseAmenities($request->string('amenities')->toString());

        $property->update($validated);

        return redirect()->route('admin.properties.index')->with('status', 'Property updated successfully.');
    }

    /**
     * Delete property.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();

        return redirect()->route('admin.properties.index')->with('status', 'Property deleted.');
    }

    /**
     * Validate property payload.
     *
     * @return array<string, mixed>
     */
    protected function validateProperty(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'city' => ['required', 'string', 'max:255'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:rent,sale'],
            'beds' => ['required', 'integer', 'min:0', 'max:20'],
            'baths' => ['required', 'numeric', 'min:0', 'max:20'],
            'sqft' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:available,sold'],
        ]);
    }

    /**
     * Parse amenities CSV input to array.
     *
     * @return array<int, string>
     */
    protected function parseAmenities(string $amenities): array
    {
        return collect(explode(',', $amenities))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
