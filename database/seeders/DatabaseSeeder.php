<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoomSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a test user if one doesn't already exist (avoid duplicate email errors)
        \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                // provide a default password for the seeded user
                'password' => bcrypt('password')
            ]
        );
        // Seed rooms for development
        $this->call([RoomSeeder::class]);
        // Seed blog articles
        $this->call([\Database\Seeders\ArticleSeeder::class]);
        // Seed customers from existing bookings
        $this->call([\Database\Seeders\CustomerSeeder::class]);
    }
}
