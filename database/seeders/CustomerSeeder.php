<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = \Illuminate\Support\Facades\DB::table('bookings')
            ->select('guest_name', 'guest_email', 'guest_phone')
            ->groupBy('guest_email', 'guest_name', 'guest_phone')
            ->get();

        foreach ($bookings as $b) {
            \Illuminate\Support\Facades\DB::table('customers')->updateOrInsert(
                ['email' => $b->guest_email],
                ['name' => $b->guest_name, 'phone' => $b->guest_phone, 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
