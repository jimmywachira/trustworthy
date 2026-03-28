<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'title',
    'description',
    'price',
    'city',
    'neighborhood',
    'type',
    'beds',
    'baths',
    'sqft',
    'status',
    'amenities',
])]
class Property extends Model
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
            'baths' => 'decimal:1',
            'amenities' => 'array',
        ];
    }

    /**
     * Get the inquiry leads for this property.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
