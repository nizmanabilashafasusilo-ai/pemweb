<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Deluxe, Cottage, etc.
            $table->string('slug')->unique(); // Untuk URL yang ramah SEO
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->integer('max_guests');
            $table->integer('quantity'); // Jumlah kamar tipe ini yang tersedia
            $table->string('main_image')->nullable(); // Foto utama
            $table->json('amenities')->nullable(); // JSON untuk fasilitas spesifik kamar (AC, balkon, dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};