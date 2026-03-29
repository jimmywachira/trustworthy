<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id',
    'agent_id',
    'user_id',
    'name',
    'email',
    'phone',
    'preferred_at',
    'message',
    'status',
])]
class Appointment extends Model
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
            'preferred_at' => 'datetime',
        ];
    }

    /**
     * Property associated with this appointment.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Agent associated with this appointment.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * User associated with this appointment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
