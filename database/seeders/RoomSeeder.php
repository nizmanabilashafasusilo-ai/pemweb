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
                'name' => 'Deluxe Room',
                'slug' => Str::slug('Deluxe Room'),
                'description' => 'Kamar Deluxe dengan pemandangan laut dan fasilitas lengkap.',
                'price_per_night' => 750000.00,
                'max_guests' => 2,
                'quantity' => 5,
                'main_image' => null,
                'amenities' => json_encode(['AC', 'TV', 'WiFi']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Family Suite',
                'slug' => Str::slug('Family Suite'),
                'description' => 'Suite luas untuk keluarga, dilengkapi ruang tamu terpisah.',
                'price_per_night' => 1200000.00,
                'max_guests' => 4,
                'quantity' => 2,
                'main_image' => null,
                'amenities' => json_encode(['AC', 'TV', 'WiFi', 'Kitchenette']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard Room',
                'slug' => Str::slug('Standard Room'),
                'description' => 'Kamar standar nyaman dengan fasilitas dasar.',
                'price_per_night' => 450000.00,
                'max_guests' => 2,
                'quantity' => 8,
                'main_image' => null,
                'amenities' => json_encode(['AC', 'WiFi']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($rooms as $r) {
            // Gunakan query langsung agar tidak tergantung pada fillable yang mungkin tidak cocok
            
            \Illuminate\Support\Facades\DB::table('rooms')->insert($r);
        }
    }
}
