<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'title',
    'reference_code',
    'price',
    'price_per_acre',
    'city',
    'neighborhood',
    'latitude',
    'longitude',
    'parcel_size_acres',
    'zoning',
    'tenure_type',
    'title_deed_status',
    'road_access',
    'utilities',
    'permitted_use',
    'topography',
    'description',
    'status',
    'featured',
    'agent_id',
])]
class LandListing extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'price_per_acre' => 'decimal:2',
            'latitude' => 'float',
            'longitude' => 'float',
            'parcel_size_acres' => 'float',
            'utilities' => 'array',
            'featured' => 'boolean',
        ];
    }

    /**
     * Agent responsible for this land listing.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
