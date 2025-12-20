<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $table = 'rooms'; // Pastikan nama tabel benar
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
        'price_per_night',
        'max_guests',
        'size',
        'main_image',
        'image_path',
        'amenities'
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    // Compatibility accessors so views that use `price`/`capacity` work
    public function getPriceAttribute()
    {
        return $this->attributes['price'] ?? $this->attributes['price_per_night'] ?? null;
    }

    public function getCapacityAttribute()
    {
        return $this->attributes['capacity'] ?? $this->attributes['max_guests'] ?? null;
    }
}