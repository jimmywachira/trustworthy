<?php

namespace App\Livewire;

use App\Models\Property;
use Illuminate\Contracts\View\View;
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
     * Reset pagination whenever filters change.
     */
    public function updated(string $property): void
    {
        if (in_array($property, ['minPrice', 'maxPrice', 'propertyType', 'location', 'minBeds', 'amenity', 'sortBy'], true)) {
            $this->resetPage();
        }

        if ($property === 'propertyType' && ! in_array($this->propertyType, ['', 'rent', 'sale'], true)) {
            $this->propertyType = '';
        }

        if ($property === 'sortBy' && ! in_array($this->sortBy, ['newest', 'price_low', 'price_high', 'sqft_high'], true)) {
            $this->sortBy = 'newest';
        }
    }

    /**
     * Apply a neighborhood preset to the location filter.
     */
    public function setNeighborhood(string $neighborhood): void
    {
        $this->location = $neighborhood;
        $this->resetPage();
    }

    /**
     * Reset all filters to defaults.
     */
    public function resetFilters(): void
    {
        $this->reset(['minPrice', 'maxPrice', 'propertyType', 'location', 'minBeds', 'amenity']);
        $this->sortBy = 'newest';
        $this->resetPage();
    }

    /**
     * Build and render the filtered property listing.
     */
    public function render(): View
    {
        $query = Property::query()
            ->where('status', 'available')
            ->when($this->minPrice, fn ($query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn ($query) => $query->where('price', '<=', $this->maxPrice))
            ->when(
                in_array($this->propertyType, ['rent', 'sale'], true),
                fn ($query) => $query->where('type', $this->propertyType)
            )
            ->when($this->minBeds, fn ($query) => $query->where('beds', '>=', $this->minBeds))
            ->when($this->amenity, fn ($query) => $query->whereJsonContains('amenities', $this->amenity))
            ->when($this->location, function ($query): void {
                $query->where(function ($nestedQuery): void {
                    $nestedQuery
                        ->where('city', 'like', "%{$this->location}%")
                        ->orWhere('neighborhood', 'like', "%{$this->location}%");
                });
            });

        match ($this->sortBy) {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'sqft_high' => $query->orderByDesc('sqft'),
            default => $query->latest(),
        };

        $properties = $query->paginate(9);

        $matchesCount = (clone $query)->count();

        return view('livewire.property-search', [
            'properties' => $properties,
            'matchesCount' => $matchesCount,
        ]);
    }
}
