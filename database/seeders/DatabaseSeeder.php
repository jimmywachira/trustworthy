<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Appointment;
use App\Models\LandListing;
use App\Models\Property;
use App\Models\User;
use App\Support\NairobiGeo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => 'password',
            'is_admin' => true,
            'role' => 'admin',
            'permissions' => ['*'],
        ]);

        if (! $user->is_admin || $user->role !== 'admin') {
            $user->update([
                'is_admin' => true,
                'role' => 'admin',
                'permissions' => ['*'],
            ]);
        }

        if (Property::query()->count() === 0) {
            Property::factory(36)->create();
        }

        $agents = [
            [
                'name' => 'Grace Wambui',
                'email' => 'grace@luxenest.co.ke',
                'phone' => '+254700111222',
                'specialty' => 'Premium Sales - Westlands & Kilimani',
                'bio' => 'Grace has 9+ years matching families and investors to premium homes across Nairobi.',
                'photo_url' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=600&q=80',
                'is_verified' => true,
            ],
            [
                'name' => 'David Kariuki',
                'email' => 'david@luxenest.co.ke',
                'phone' => '+254700333444',
                'specialty' => 'Luxury Rentals - Lavington & Kileleshwa',
                'bio' => 'David supports executives and expats finding high-comfort rentals with fast turnaround.',
                'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'is_verified' => true,
            ],
            [
                'name' => 'Achieng Otieno',
                'email' => 'achieng@luxenest.co.ke',
                'phone' => '+254700555666',
                'specialty' => 'Family Estates - Karen & Runda',
                'bio' => 'Achieng specializes in family-focused neighborhoods with security and lifestyle convenience.',
                'photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=600&q=80',
                'is_verified' => true,
            ],
        ];

        foreach ($agents as $agentData) {
            Agent::query()->updateOrCreate(
                ['email' => $agentData['email']],
                $agentData,
            );
        }

        $agentIds = Agent::query()->pluck('id')->all();

        Property::query()->get()->each(function (Property $property) use ($agentIds): void {
            $coordinates = NairobiGeo::coordinatesFor((string) $property->neighborhood);

            $property->update([
                'city' => 'Nairobi',
                'latitude' => $coordinates['lat'],
                'longitude' => $coordinates['lng'],
                'agent_id' => $property->agent_id ?? ($agentIds[array_rand($agentIds)] ?? null),
            ]);
        });

        $investmentAssets = [
            [
                'title' => '2.1 Acre Development Land - Karen Green Belt',
                'description' => 'Prime freehold land with strong road access, ideal for gated community or boutique residence development with long-term capital appreciation outlook.',
                'price' => 165000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Karen',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 0,
                'sqft' => 91476,
                'status' => 'available',
                'amenities' => ['Tarmac Access', 'Water On Site', 'Electricity Nearby'],
            ],
            [
                'title' => 'Prime Residential Plot - Runda Estate',
                'description' => 'High-value residential plot in a secure diplomatic zone suitable for premium custom home construction and family estate projects.',
                'price' => 98000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Runda',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 0,
                'sqft' => 21780,
                'status' => 'available',
                'amenities' => ['Controlled Access', 'Underground Utilities', 'Security'],
            ],
            [
                'title' => 'Mixed-Use Commercial Building - Westlands Core',
                'description' => 'Income-generating commercial building with office and retail floors, positioned for stable tenant demand and strong annual yield.',
                'price' => 420000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Westlands',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 8,
                'sqft' => 25400,
                'status' => 'available',
                'amenities' => ['Parking', 'Backup Generator', '24/7 Security'],
            ],
            [
                'title' => 'Grade-A Office Floor Investment - Kilimani',
                'description' => 'Modern office asset with premium finishes and long-term leasing potential for regional and multinational tenants.',
                'price' => 195000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Kilimani',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 4,
                'sqft' => 12800,
                'status' => 'available',
                'amenities' => ['Fiber Internet', 'Backup Power', 'Parking'],
            ],
            [
                'title' => 'Retail & Hospitality Site - Parklands',
                'description' => 'Strategic corner property suited for retail, food and beverage, or hospitality redevelopment in a high-traffic corridor.',
                'price' => 235000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Parklands',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 2,
                'sqft' => 17800,
                'status' => 'available',
                'amenities' => ['Corner Frontage', 'High Footfall', 'Parking'],
            ],
            [
                'title' => '1.3 Acre Redevelopment Land - Lavington',
                'description' => 'Prestige infill land parcel with planning flexibility for upscale apartments or townhouse cluster development.',
                'price' => 285000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Lavington',
                'type' => 'sale',
                'beds' => 0,
                'baths' => 0,
                'sqft' => 56628,
                'status' => 'available',
                'amenities' => ['Sewer Connection', 'Water Connection', 'Mature Neighborhood'],
            ],
        ];

        foreach ($investmentAssets as $index => $asset) {
            $coordinates = NairobiGeo::coordinatesFor((string) $asset['neighborhood']);

            Property::query()->updateOrCreate(
                ['title' => $asset['title'], 'type' => $asset['type']],
                [
                    ...$asset,
                    'latitude' => $coordinates['lat'],
                    'longitude' => $coordinates['lng'],
                    'agent_id' => $agentIds[$index % max(count($agentIds), 1)] ?? null,
                ],
            );
        }

        $landListings = [
            [
                'title' => '2.1 Acre Development Land - Karen Green Belt',
                'reference_code' => 'LAND-KAR-2101',
                'price' => 165000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Karen',
                'parcel_size_acres' => 2.10,
                'zoning' => 'Low Density Residential',
                'tenure_type' => 'Freehold',
                'title_deed_status' => 'Clean Title',
                'road_access' => 'Tarmac',
                'utilities' => ['Water On Site', 'Electricity Nearby', 'Fiber Ready'],
                'permitted_use' => 'Gated Community / Villas',
                'topography' => 'Flat with mature trees',
                'description' => 'Institution-grade land parcel with strong access and premium neighborhood profile, suitable for phased luxury development.',
                'status' => 'available',
                'featured' => true,
            ],
            [
                'title' => 'Prime Residential Plot - Runda Estate',
                'reference_code' => 'LAND-RUN-1044',
                'price' => 98000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Runda',
                'parcel_size_acres' => 0.50,
                'zoning' => 'Single Family Residential',
                'tenure_type' => 'Leasehold (99 years)',
                'title_deed_status' => 'Verified Transferable Title',
                'road_access' => 'Tarmac',
                'utilities' => ['Water Connection', 'Power Connection', 'Sewer Nearby'],
                'permitted_use' => 'Executive Home Construction',
                'topography' => 'Flat',
                'description' => 'High-value parcel in a diplomatic enclave with robust security profile and premium resale liquidity.',
                'status' => 'available',
                'featured' => true,
            ],
            [
                'title' => '1.3 Acre Redevelopment Land - Lavington',
                'reference_code' => 'LAND-LAV-1307',
                'price' => 285000000,
                'city' => 'Nairobi',
                'neighborhood' => 'Lavington',
                'parcel_size_acres' => 1.30,
                'zoning' => 'Medium Density Residential',
                'tenure_type' => 'Freehold',
                'title_deed_status' => 'Clean Title',
                'road_access' => 'Tarmac',
                'utilities' => ['Water Connection', 'Sewer Connection', 'Power Connection'],
                'permitted_use' => 'Apartments / Townhouses',
                'topography' => 'Gentle Slope',
                'description' => 'Prestige infill redevelopment site with strong demand drivers and high-end neighborhood comps.',
                'status' => 'available',
                'featured' => false,
            ],
        ];

        foreach ($landListings as $index => $landData) {
            $coordinates = NairobiGeo::coordinatesFor((string) $landData['neighborhood']);
            $size = (float) $landData['parcel_size_acres'];
            $price = (float) $landData['price'];

            LandListing::query()->updateOrCreate(
                ['reference_code' => $landData['reference_code']],
                [
                    ...$landData,
                    'price_per_acre' => $size > 0 ? ($price / $size) : null,
                    'latitude' => $coordinates['lat'],
                    'longitude' => $coordinates['lng'],
                    'agent_id' => $agentIds[$index % max(count($agentIds), 1)] ?? null,
                ],
            );
        }

        $demoUsers = [
            [
                'name' => 'Demo Buyer',
                'email' => 'buyer@luxenest-demo.co.ke',
                'phone' => '+254711000111',
            ],
            [
                'name' => 'Demo Renter',
                'email' => 'renter@luxenest-demo.co.ke',
                'phone' => '+254722000222',
            ],
            [
                'name' => 'Demo Investor',
                'email' => 'investor@luxenest-demo.co.ke',
                'phone' => '+254733000333',
            ],
        ];

        $seededUsers = collect($demoUsers)->map(function (array $demoUser): User {
            return User::query()->firstOrCreate(
                ['email' => $demoUser['email']],
                [
                    'name' => $demoUser['name'],
                    'password' => 'password',
                    'is_admin' => false,
                    'role' => 'user',
                    'permissions' => null,
                ],
            );
        });

        $propertyIds = Property::query()->inRandomOrder()->take(12)->pluck('id')->values();

        if ($propertyIds->isNotEmpty()) {
            foreach ($seededUsers as $index => $demoUser) {
                $slice = $propertyIds->slice($index * 3, 3)->all();

                if ($slice !== []) {
                    $demoUser->savedProperties()->syncWithoutDetaching($slice);
                }
            }
        }

        if (Appointment::query()->count() === 0) {
            $appointmentsSeed = [
                [
                    'status' => 'pending',
                    'preferred_at' => now()->addDay()->setTime(10, 30),
                    'message' => 'Would like to confirm parking and security details before viewing.',
                ],
                [
                    'status' => 'confirmed',
                    'preferred_at' => now()->addDays(2)->setTime(14, 0),
                    'message' => 'Please share estate gate access instructions in advance.',
                ],
                [
                    'status' => 'cancelled',
                    'preferred_at' => now()->addDays(3)->setTime(11, 0),
                    'message' => 'Scheduling conflict, will rebook next week.',
                ],
                [
                    'status' => 'pending',
                    'preferred_at' => now()->addDays(4)->setTime(16, 30),
                    'message' => 'Interested in school access and neighborhood amenities nearby.',
                ],
            ];

            foreach ($appointmentsSeed as $index => $seed) {
                $property = Property::query()->inRandomOrder()->first();
                $demoUser = $seededUsers[$index % $seededUsers->count()] ?? null;

                if (! $property || ! $demoUser) {
                    continue;
                }

                Appointment::query()->create([
                    'property_id' => $property->id,
                    'agent_id' => $property->agent_id,
                    'user_id' => $demoUser->id,
                    'name' => $demoUser->name,
                    'email' => $demoUser->email,
                    'phone' => $demoUsers[$index % count($demoUsers)]['phone'],
                    'preferred_at' => $seed['preferred_at'],
                    'message' => $seed['message'],
                    'status' => $seed['status'],
                ]);
            }
        }
    }
}
