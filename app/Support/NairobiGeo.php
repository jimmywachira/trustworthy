<?php

namespace App\Support;

class NairobiGeo
{
    /**
     * Neighborhood coordinates map.
     *
     * @return array<string, array{lat: float, lng: float}>
     */
    public static function neighborhoods(): array
    {
        return [
            'Westlands' => ['lat' => -1.2676, 'lng' => 36.8108],
            'Kilimani' => ['lat' => -1.2923, 'lng' => 36.7836],
            'Lavington' => ['lat' => -1.2835, 'lng' => 36.7641],
            'Kileleshwa' => ['lat' => -1.2797, 'lng' => 36.7830],
            'Karen' => ['lat' => -1.3197, 'lng' => 36.7061],
            'Runda' => ['lat' => -1.2249, 'lng' => 36.8033],
            'Gigiri' => ['lat' => -1.2322, 'lng' => 36.8030],
            'Parklands' => ['lat' => -1.2545, 'lng' => 36.8218],
        ];
    }

    /**
     * Get neighborhood coordinates with fallback to city center.
     *
     * @return array{lat: float, lng: float}
     */
    public static function coordinatesFor(string $neighborhood): array
    {
        return self::neighborhoods()[$neighborhood] ?? ['lat' => -1.286389, 'lng' => 36.817223];
    }
}
