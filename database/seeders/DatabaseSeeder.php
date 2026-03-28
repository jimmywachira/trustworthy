<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
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
    }
}
