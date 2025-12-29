<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Menyambut Liburan: Panduan Singkat Untuk Tamu',
                'excerpt' => 'Tips dan rekomendasi untuk menikmati liburan di Golden Wave Resort.',
                'body' => '<p>Selamat datang! Berikut adalah beberapa tips untuk mendapatkan pengalaman terbaik selama menginap di Golden Wave Resort...</p>',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Fasilitas Baru: Spa & Kolam Privat',
                'excerpt' => 'Kami memperkenalkan layanan spa premium dan kolam privat untuk tamu tertentu.',
                'body' => '<p>Golden Wave kini memiliki fasilitas spa terbaru...</p>',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Panduan Pemesanan: Cara Mendapatkan Diskon',
                'excerpt' => 'Strategi sederhana untuk mendapatkan harga terbaik saat memesan kamar.',
                'body' => '<p>Untuk mendapatkan diskon, coba pesan langsung melalui situs ini dan gunakan kode promosi kami...</p>',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($articles as $a) {
            Article::updateOrCreate(['slug' => Str::slug($a['title'])], array_merge($a, ['slug' => Str::slug($a['title'])]));
        }
    }
}
