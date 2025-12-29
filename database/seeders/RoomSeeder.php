<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Str;


class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data kamar untuk development
        $rooms = [
            [
                'name' => 'Garden View Room',
                'slug' => Str::slug('Garden View Room'),
                'description' => 'Kamar nyaman dengan suasana taman tropis yang menenangkan.',
                'price_per_night' => 450000.00,
                'max_guests' => 2,
                'quantity' => 5,
                'main_image' => 'images/rooms/garden-view-room.jpg',
                'amenities' => json_encode([
                    'AC', 'TV', 'WiFi',
                    'View Taman',
                    'Balkon Pribadi'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sea View Room',
                'slug' => Str::slug('Sea View Room'),
                'description' => 'Kamar dengan pemandangan laut indah langsung dari balkon pribadi.',
                'price_per_night' => 750000.00,
                'max_guests' => 4,
                'quantity' => 2,
                'main_image' => 'images/rooms/sea-view-room.jpg',
                'amenities' => json_encode([
                    'AC', 'TV', 'WiFi',
                    'View Laut',
                    'Balkon Pribadi',
                    'Coffee & Tea Maker'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deluxe Room',
                'slug' => Str::slug('Deluxe Room'),
                'description' => 'Kamar luas dengan fasilitas lengkap untuk kenyamanan ekstra.',
                'price_per_night' => 900000.00,
                'max_guests' => 3,
                'quantity' => 8,
                'main_image' => 'images/rooms/deluxe-room.jpg',
                'amenities' => json_encode([
                    'AC', 'TV', 'WiFi',
                    'Sofa Santai',
                    'Balkon Luas',
                    'Coffee & Tea Maker'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beachfront Room',
                'slug' => Str::slug('Beachfront Room'),
                'description' => 'Kamar eksklusif dengan akses langsung ke pantai dan pemandangan laut.',
                'price_per_night' => 1100000.00,
                'max_guests' => 2,
                'quantity' => 8,
                'main_image' => 'images/rooms/beachfront-room.jpg',
                'amenities' => json_encode([
                    'AC', 'TV', 'WiFi',
                    'Akses Langsung ke Pantai',
                    'Sun Chair',
                    'Teras Pantai',
                    'Coffee & Tea Maker'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Private Villa',
                'slug' => Str::slug('Private Villa'),
                'description' => 'Hunian eksklusif dengan privasi maksimal untuk pengalaman menginap istimewa.',
                'price_per_night' => 1500000.00,
                'max_guests' => 4,
                'quantity' => 8,
                'main_image' => 'images/rooms/private-villa.jpg',
                'amenities' => json_encode([
                    'AC', 'TV', 'WiFi',
                    'Ruang Tamu Pribadi',
                    'Bathtub',
                    'kitchenette',
                    'Kolam Renang Pribadi'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($rooms as $r) {
            // Use updateOrInsert so seeding multiple times won't cause duplicate key errors
            \Illuminate\Support\Facades\DB::table('rooms')->updateOrInsert(
                ['slug' => $r['slug']],
                $r
            );
        }
    }
}
