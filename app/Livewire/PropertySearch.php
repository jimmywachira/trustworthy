<?php

namespace App\Livewire;

use App\Models\Property;
use App\Models\User;
use App\Support\KenyaCurrency;
use App\Support\NairobiGeo;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PropertySearch extends Component
{
    use WithPagination;

    #[Url(as: 'min')]
    public ?int $minPrice = null;

    #[Url(as: 'max')]
    public ?int $maxPrice = null;

    #[Url(as: 'type')]
    public string $propertyType = '';

    #[Url(as: 'q')]
    public string $location = '';

    #[Url(as: 'beds')]
    public ?int $minBeds = null;

    #[Url(as: 'amenity')]
    public string $amenity = '';

    #[Url(as: 'sort')]
    public string $sortBy = 'newest';

    #[Url(as: 'center')]
    public string $mapCenter = '';

    #[Url(as: 'radius')]
    public ?int $distanceKm = null;

    /**
     * Quick Nairobi neighborhoods for one-click filtering.
     *
     * @var array<int, string>
     */
    public array $featuredNeighborhoods = [
        'Westlands',
        'Kilimani',
        'Lavington',
        'Kileleshwa',
        'Karen',
        'Runda',
        'Gigiri',
        'Parklands',
    ];

    /**
     * Available amenity options.
     *
     * @var array<int, string>
     */
    public array $amenityOptions = [
        'Pool',
        'Gym',
        'Parking',
        'Smart Home',
        '24/7 Security',
    ];

    /**
     * Reset pagination whenever filters change.
     */
    public function updated(string $property): void
    {
        if (in_array($property, ['minPrice', 'maxPrice', 'propertyType', 'location', 'minBeds', 'amenity', 'sortBy', 'mapCenter', 'distanceKm'], true)) {
            $this->resetPage();
        }

        if ($property === 'propertyType' && ! in_array($this->propertyType, ['', 'rent', 'sale'], true)) {
            $this->propertyType = '';
        }

        if ($property === 'sortBy' && ! in_array($this->sortBy, ['newest', 'price_low', 'price_high', 'sqft_high', 'nearest'], true)) {
            $this->sortBy = 'newest';
        }

        if ($property === 'mapCenter' && ! array_key_exists($this->mapCenter, NairobiGeo::neighborhoods()) && $this->mapCenter !== '') {
            $this->mapCenter = '';
        }
    }

    /**
     * Apply a neighborhood preset to the location filter.
     */
    public function setNeighborhood(string $neighborhood): void
    {
        $this->location = $neighborhood;
        $this->mapCenter = $neighborhood;
        $this->resetPage();
    }

    /**
     * Reset all filters to defaults.
     */
    public function resetFilters(): void
    {
        $this->reset(['minPrice', 'maxPrice', 'propertyType', 'location', 'minBeds', 'amenity', 'mapCenter', 'distanceKm']);
        $this->sortBy = 'newest';
        $this->resetPage();
    }

    /**
     * Base filtered query used by the listing.
     */
    protected function filteredQuery(): Builder
    {
        $query = Property::query()
            ->with('agent')
            ->where('status', 'available')
            ->when($this->minPrice, fn (Builder $query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn (Builder $query) => $query->where('price', '<=', $this->maxPrice))
            ->when(
                in_array($this->propertyType, ['rent', 'sale'], true),
                fn (Builder $query) => $query->where('type', $this->propertyType)
            )
            ->when($this->minBeds, fn (Builder $query) => $query->where('beds', '>=', $this->minBeds))
            ->when($this->amenity, fn (Builder $query) => $query->whereJsonContains('amenities', $this->amenity))
            ->when($this->location, function (Builder $query): void {
                $query->where(function (Builder $nestedQuery): void {
                    $nestedQuery
                        ->where('city', 'like', "%{$this->location}%")
                        ->orWhere('neighborhood', 'like', "%{$this->location}%")
                        ->orWhere('title', 'like', "%{$this->location}%")
                        ->orWhere('description', 'like', "%{$this->location}%");
                });
            });

        if ($this->mapCenter !== '' && $this->distanceKm) {
            $center = NairobiGeo::coordinatesFor($this->mapCenter);

            $distanceSql = '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))';

            $query
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->select('properties.*')
                ->selectRaw("{$distanceSql} as distance_km", [$center['lat'], $center['lng'], $center['lat']])
                ->having('distance_km', '<=', $this->distanceKm);
        }

        return $query;
    }

    /**
     * Build and render the filtered property listing.
     */
    public function render(): View
    {
        $query = $this->filteredQuery();

        match ($this->sortBy) {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'sqft_high' => $query->orderByDesc('sqft'),
            'nearest' => $query->orderBy('distance_km'),
            default => $query->latest(),
        };

        $properties = $query->paginate(9);

        $matchesCount = $properties->total();

        $mapProperties = collect($properties->items())
            ->filter(fn (Property $property): bool => (bool) $property->latitude && (bool) $property->longitude)
            ->map(fn (Property $property): array => [
                'id' => $property->id,
                'title' => $property->title,
                'price' => KenyaCurrency::format((float) $property->price),
                'lat' => (float) $property->latitude,
                'lng' => (float) $property->longitude,
                'url' => route('properties.show', $property),
            ])
            ->values();

        $currentUser = Auth::user();
        $savedPropertyIds = $currentUser instanceof User
            ? $currentUser->savedProperties()->pluck('properties.id')->all()
            : [];

        return view('livewire.property-search', [
            'properties' => $properties,
            'matchesCount' => $matchesCount,
            'mapProperties' => $mapProperties,
            'neighborhoodCoordinates' => NairobiGeo::neighborhoods(),
            'savedPropertyIds' => $savedPropertyIds,
        ]);
    }
}
