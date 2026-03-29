<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'phone', 'specialty', 'bio', 'photo_url', 'is_verified'])]
class Agent extends Model
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
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Properties represented by the agent.
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Land listings represented by the agent.
     */
    public function landListings(): HasMany
    {
        return $this->hasMany(LandListing::class);
    }

    /**
     * Appointments assigned to the agent.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
