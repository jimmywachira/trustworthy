<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cityNeighborhoods = [
            'Nairobi' => ['Westlands', 'Kilimani', 'Lavington', 'Kileleshwa', 'Karen', 'Runda', 'Gigiri', 'Parklands'],
        ];

        $city = fake()->randomKey($cityNeighborhoods);
        $neighborhood = fake()->randomElement($cityNeighborhoods[$city]);
        $type = fake()->randomElement(['rent', 'sale']);
        $beds = fake()->numberBetween(1, 6);

        $titlePrefix = $type === 'rent' ? 'Luxury Apartment' : 'Premium Residence';

        return [
            'title' => $titlePrefix.' in '.$neighborhood,
            'description' => fake()->paragraphs(2, true),
            'price' => $type === 'rent'
                ? fake()->numberBetween(70000, 450000)
                : fake()->numberBetween(8500000, 220000000),
            'city' => $city,
            'neighborhood' => $neighborhood,
            'type' => $type,
            'beds' => $beds,
            'baths' => fake()->randomElement([1, 1.5, 2, 2.5, 3, 3.5, 4]),
            'sqft' => fake()->numberBetween(650, 5600),
            'status' => fake()->boolean(85) ? 'available' : 'sold',
            'amenities' => fake()->randomElements([
                'Pool',
                'Gym',
                'Concierge',
                'Rooftop Deck',
                'Pet Friendly',
                'EV Charging',
                'Smart Home',
                'Parking',
                'In-Unit Laundry',
                '24/7 Security',
            ], fake()->numberBetween(3, 6)),
        ];
    }
}
