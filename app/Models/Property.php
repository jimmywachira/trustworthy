<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'description',
    'price',
    'city',
    'neighborhood',
    'latitude',
    'longitude',
    'type',
    'beds',
    'baths',
    'sqft',
    'status',
    'agent_id',
    'amenities',
])]
class Property extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (self $property): void {
            if ($property->slug === null || $property->slug === '' || $property->isDirty('title')) {
                $property->slug = self::generateUniqueSlug((string) $property->title, $property->getKey());
            }
        });
    }

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
            'latitude' => 'float',
            'longitude' => 'float',
            'amenities' => 'array',
        ];
    }

    /**
     * Use slug for route model binding and URL generation.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Build a unique slug for property URLs.
     */
    protected static function generateUniqueSlug(string $title, int|string|null $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base !== '' ? $base : 'property';
        $original = $slug;
        $counter = 2;

        while (
            self::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Agent assigned to this property.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get the inquiry leads for this property.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Appointments scheduled for this property.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Users who saved this property.
     */
    public function savers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_properties')
            ->withTimestamps();
    }
}
