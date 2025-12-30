@extends('layouts.app')

@section('content')

<style>
    html, body { margin: 0; padding: 0; background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%); }
    .booking-form-box {
        background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: sticky;
        top: 20px;
    }
    
    .booking-form-box h3 {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        color: white;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-group input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .form-group input:focus {
        outline: none;
        border-color: var(--secondary-color);
        background: rgba(255, 255, 255, 0.15);
    }
    
    .room-detail-header {
        background: linear-gradient(135deg, #1a5f7a 0%, #27769aff 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
    }
    
    .room-detail-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .room-detail-content {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .room-image-gallery {
        margin-bottom: 30px;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .room-image-gallery img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    
    .price-tag {
        font-size: 2rem;
        color: var(--secondary-color);
        font-weight: 700;
        margin: 20px 0;
    }
    
    .amenities-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .amenity-item {
        display: flex;
        align-items: center;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        color: var(--primary-color);
    }
    
    .amenity-item i {
        margin-right: 12px;
        font-size: 1.2rem;
    }
    .room-card {
        border: none;
        border-radius: 0;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        height: 100%;
        background: white;
        display: flex;
        flex-direction: column;
    }
    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }
    .room-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .room-card:hover .room-image img { transform: scale(1.05); }
    .room-badges {
        position: absolute;
        top: 12px;
        left: 12px;
        right: 12px;
        display: flex;
        justify-content: space-between;
        z-index: 2;
    }
    .badge-item {
        background: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .badge-luxury { 
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); 
        color: white; 
    }
    .room-content { 
        padding: 22px;
        flex: 1 1 auto; 
    }
    .room-content h3 { 
        font-size: 1.4rem;
        margin-bottom: 8px; 
        color: #2c3e50; 
        font-family: 'Playfair Display', serif; 
    }
    .room-content p { 
        color: #7f8c8d; 
        font-size: 0.95rem; 
        line-height: 1.6; 
        margin-bottom: 18px; 
    }
    .room-footer { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-top: 8px; 
    }
    .room-price { 
        display: flex;
        flex-direction: column; 
    }
    .room-price .amount { 
        font-size: 1.4rem; 
        font-weight: 700; 
        color: #2c3e50; 
        font-family: 'Playfair Display', serif; 
    }
    .room-price .period { 
        font-size: 0.85rem; 
        color: #7f8c8d; 
    }
    .btn-view-details { 
        background: #00bcd4; 
        color: white; 
        padding: 8px 14px; 
        border-radius: 6px; 
        text-decoration: none; 
        font-weight: 600; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
    }
    .btn-view-details:hover { 
        background: #0097a7; 
        color: white; 
    }
</style>

<!-- Header Section -->
<section class="room-detail-header">
    <div class="container">
        <h1>{{ $room->name }}</h1>
        <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">Pengalaman menginap yang luar biasa menanti Anda</p>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Room Image -->
            <div class="room-image-gallery">
                @if(isset($room->main_image) && $room->main_image)
                    @php
                        $img = $room->main_image;
                        if (preg_match('/^https?:\/\//', $img)) {
                            $url = $img;
                        } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                            $url = asset($img);
                        } else {
                            $url = asset('storage/' . $img);
                        }
                    @endphp
                    <img src="{{ $url }}" alt="{{ $room->name }}">
                @else
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); height: 400px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 5rem; color: white; opacity: 0.5;"></i>
                    </div>
                @endif
            </div>

            <!-- Room Details -->
            <div class="room-detail-content">
                <div class="price-tag">
                    Rp {{ number_format($room->price, 0, ',', '.') }} <span style="font-size: 0.5em; color: #7f8c8d;">/ malam</span>
                </div>

                <!-- Description -->
                <h3 style="color: var(--primary-color); margin-top: 30px; margin-bottom: 15px; font-size: 1.5rem;">
                    <i class="fas fa-info-circle"></i> Deskripsi Kamar
                </h3>
                <p style="color: #555; line-height: 1.8; margin-bottom: 30px;">{{ $room->description }}</p>

                <!-- Room Info -->
                <div style="background: #f8f9fa; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="margin-bottom: 20px;">
                                <strong style="color: var(--primary-color);"><i class="fas fa-ruler-combined"></i> Ukuran Kamar</strong>
                                <p style="margin-top: 5px; color: #555;">{{ $room->size ?? '25 m²' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 20px;">
                                <strong style="color: var(--primary-color);"><i class="fas fa-users"></i> Kapasitas</strong>
                                <p style="margin-top: 5px; color: #555;">{{ $room->capacity ?? '2' }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <h3 style="color: var(--primary-color); margin-bottom: 20px; font-size: 1.5rem;">
                    <i class="fas fa-star"></i> Fasilitas & Amenities
                </h3>
                <div class="amenities-list">
                    @if(!empty($room->amenities))
    @foreach($room->amenities as $amenity)
        <div class="amenity-item">
            <i class="fas fa-check-circle"></i>
            <span>{{ $amenity }}</span>
        </div>
    @endforeach
@else
    <div class="amenity-item"><i class="fas fa-check-circle"></i> AC / Pendingin Udara</div>
    <div class="amenity-item"><i class="fas fa-check-circle"></i> TV Flat Screen</div>
    <div class="amenity-item"><i class="fas fa-check-circle"></i> Kamar Mandi Pribadi</div>
    <div class="amenity-item"><i class="fas fa-check-circle"></i> WiFi Gratis</div>
    <div class="amenity-item"><i class="fas fa-check-circle"></i> Balkon / Teras</div>
    <div class="amenity-item"><i class="fas fa-check-circle"></i> Mini Bar</div>
@endif
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="col-lg-4">
            <div class="booking-form-box">

                @if(session('error'))
                    <div style="background: rgba(231, 76, 60, 0.2); border-left: 4px solid #e74c3c; padding: 15px; border-radius: 5px; margin-bottom: 20px; color: white;">
                        <strong><i class="fas fa-exclamation-circle"></i> Error:</strong> {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div style="background: rgba(46, 204, 113, 0.2); border-left: 4px solid #2ecc71; padding: 15px; border-radius: 5px; margin-bottom: 20px; color: white;">
                        <strong><i class="fas fa-check-circle"></i> Sukses:</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="booking-form-box text-center">
                    
                <h3>Reservasi Kamar Ini</h3>
                    <p style="opacity:0.9;">
                        Pesan kamar dengan mudah melalui halaman reservasi.</p> 
                        
                        @auth
                        
                        <a href="{{ route('reservation.create', ['room' => $room->id]) }}"
                        class="btn btn-light w-100 mt-3"
                        style="font-weight:700;">
                        <i class="fas fa-calendar-check"></i> Lanjutkan Reservasi
                    </a>
                    
                    @else
                    
                    <p class="mt-3">
                        
                    Silakan <a href="{{ route('login') }}">login</a> atau
                    <a href="{{ route('register') }}">daftar</a> untuk reservasi.</p>
                    
                    <a href="{{ route('login') }}" class="btn btn-light w-100 mt-2">Login</a>
                    @endauth
                </div>
            </div>

            <!-- Contact Info -->
            <div style="background: white; border-radius: 15px; padding: 25px; margin-top: 20px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                <h4 style="color: var(--primary-color); margin-bottom: 20px;">Butuh Bantuan?</h4>
                <div style="margin-bottom: 15px;">
                    <p style="color: #7f8c8d; font-size: 0.9rem; margin-bottom: 5px;"><i class="fas fa-phone"></i> Hubungi</p>
                    <strong style="color: var(--primary-color); font-size: 1.1rem;">+62 812 3456 7890</strong>
                </div>
                <div>
                    <p style="color: #7f8c8d; font-size: 0.9rem; margin-bottom: 5px;"><i class="fas fa-envelope"></i> Email</p>
                    <strong style="color: var(--primary-color); font-size: 1.1rem;">info@goldenwave.com</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Rooms -->
<section style="padding: 60px 0; background: transparent; margin-top: 0;">
    <div class="container">
        <h2 style="text-align: center; font-size: 2rem; color: var(--primary-color); margin-bottom: 40px;">
            <i class="fas fa-door-open"></i> Kamar Lainnya
        </h2>
        <div class="row">
            @php $otherRooms = \App\Models\Room::where('id', '!=', $room->id)->limit(3)->get(); @endphp
            @forelse($otherRooms as $otherRoom)
                <div class="col-md-4 mb-4">
                        <div class="room-card">
                            <div class="room-image">
                                @if(isset($otherRoom->main_image) && $otherRoom->main_image)
                                    @php
                                        $img = $otherRoom->main_image;
                                        if (preg_match('/^https?:\/\//', $img)) {
                                            $url = $img;
                                        } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                                            $url = asset($img);
                                        } else {
                                            $url = \Illuminate\Support\Facades\Storage::url($img);
                                        }
                                    @endphp
                                    <img src="{{ $url }}" alt="{{ $otherRoom->name }}">
                                @else
                                    <i class="fas fa-door-open" style="font-size: 4rem; color: white; opacity: 0.8;"></i>
                                @endif

                                <div class="room-badges">
                                    @php $orp = $otherRoom->price ?? 0; @endphp
                                    <span class="badge-item @if($orp >= 900000) badge-luxury @endif">
                                        @if($orp < 600000)
                                            Economy
                                        @elseif($orp < 900000)
                                            Standard
                                        @else
                                            Luxury
                                        @endif
                                    </span>

                                    <span class="badge-item">
                                        <i class="fas fa-ruler"></i> {{ $otherRoom->size ?? '900 Sqft' }}
                                    </span>
                                </div>
                            </div>

                            <div class="room-content">
                                <h3>{{ $otherRoom->name }}</h3>
                                <p>{{ Str::limit($otherRoom->description ?? '', 80) }}</p>
                                <div class="room-footer">
                                    <div class="room-price">
                                        <span class="amount">Rp {{ number_format($otherRoom->price, 0, ',', '.') }}</span>
                                        <span class="period">/malam</span>
                                    </div>
                                    <a href="{{ route('rooms.show', $otherRoom->id) }}" class="btn-view-details">
                                        Lihat
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>

@endsection