@extends('layouts.app')

@section('content')

<style>
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url("images/backgrounds/hero-room-bg.jpeg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 120px 0;
        min-height: 600px;
        display: flex;
        align-items: center;
        position: relative;
        justify-content: center;
        color: white;
        text-align: center;
    }
    
    .hero-content h1 {
        font-size: 3.5rem;
        font-family: 'Playfair Display', serif;
        font-weight: 400;
        margin-bottom: 1rem;
        letter-spacing: 2px;
    }
    
    .hero-content .subtitle {
        font-size: 2rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #15dffeff;
        margin-bottom: 0.5rem;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 50px;
        padding-top: 80px;
    }

    .section-header .subtitle {
        color: #e18d33ff;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    
    .section-header h2 {
        font-size: 2.5rem;
        font-family: 'Playfair Display', serif;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    
    .room-card {
        border: none;
        border-radius: 0;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        height: 100%;
        background: white;
        display: flex;
        flex-direction: column;
    }
    
    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    
    /* Uniform square thumbnails */
    .room-image {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1; /* square */
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
        display: block;
    }
    
    .room-card:hover .room-image img {
        transform: scale(1.1);
    }
    
    .room-badges {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        display: flex;
        justify-content: space-between;
        z-index: 2;
    }
    
    .badge-item {
        background: white;
        padding: 8px 15px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .badge-luxury {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        color: white;
    }
    
    .room-content {
        padding: 20px 18px;
        flex: 1; /* make content area grow so cards align */
    }
    
    .room-content h3 {
        font-size: 1.5rem;
        font-family: 'Playfair Display', serif;
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .room-content p {
        color: #7f8c8d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .room-specs {
        display: flex;
        gap: 15px;
        margin: 20px 0;
        padding: 20px 0;
        border-top: 1px solid #ecf0f1;
        border-bottom: 1px solid #ecf0f1;
    }
    
    .spec-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #34495e;
    }
    
    .spec-item i {
        color: #00bcd4;
        font-size: 1rem;
    }
    
    .room-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }
    
    .room-price {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .room-price .amount {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }

    .room-price .amount .currency {
        font-size: 0.95rem;
        color: #2c3e50;
        font-weight: 600;
    }

    .room-price .amount .value {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2c3e50;
        font-family: 'Playfair Display', serif;
    }

    .room-price .period {
        font-size: 0.85rem;
        color: #7f8c8d;
        margin-top: 2px;
    }
    
    .btn-view-details {
        background: #00bcd4;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-view-details:hover {
        background: #0097a7;
        color: white;
        transform: translateX(5px);
    }
    
    .cta-section {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #d1850aff 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
    }
    
    .cta-section h2 {
        font-size: 2.5rem;
        font-family: 'Playfair Display', serif;
        margin-bottom: 20px;
    }
    
    .cta-section p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }
    
    .btn-cta {
        background: white;
        color: #010208ff;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    .empty-state {
        text-align: center;
        padding: 100px 0;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #bdc3c7;
        margin-bottom: 20px;
    }
    
    .empty-state p {
        font-size: 1.2rem;
        color: #7f8c8d;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="subtitle">REST, RELAX, RECHARGE</div>
        <h1>Pengalaman Kemewahan dan Kenyamanan<br>Di Setiap Sudut</h1>
    </div>
</section>

<!-- Rooms Section -->
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);">
    <div class="container">
        <div class="section-header">
            <div class="subtitle">REST, RELAX, RECHARGE</div>
            <h2>Pengalaman Kemewahan dan Kenyamanan<br>Di Setiap Sudut</h2>
        </div>
        
        <div class="row">
            @forelse ($rooms as $room)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card room-card">
                        <div class="room-image">
                            @php
                                $img = $room->main_image ?? 'images/rooms/placeholder.jpg';
                                if (preg_match('/^https?:\/\//', $img)) {
                                    $url = $img;
                                } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                                    $url = asset($img);
                                } else {
                                    $url = asset('storage/' . $img);
                                }
                            @endphp
                            <img src="{{ $url }}" alt="{{ $room->name }}">

                            <div class="room-badges">
                                @php $rp = $room->price_per_night ?? $room->price ?? 0; @endphp
                                <span class="badge-item @if($rp >= 900000) badge-luxury @endif">
                                    @if($rp < 600000)
                                        Economy
                                    @elseif($rp < 900000)
                                        Standard
                                    @else
                                        Luxury
                                    @endif
                                </span>
                                
                                <span class="badge-item">
                                    <i class="fas fa-ruler"></i> {{ $room->size ?? '900 Sqft' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="room-content">
                            <h3>{{ $room->name }}</h3>
                            <p>{{ Str::limit($room->description ?? 'Kamar yang nyaman dengan fasilitas lengkap dan modern untuk pengalaman menginap yang tak terlupakan', 100) }}</p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $room->max_guests ?? $room->capacity ?? '4' }} Guest</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="room-price">
                                    <span class="amount"><span class="currency">Rp</span>&nbsp;<span class="value">{{ number_format($room->price_per_night ?? $room->price ?? 0, 0, ',', '.') }}</span></span>
                                    <span class="period">/ malam</span>
                                </div>
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn-view-details">
                                    Detail
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada kamar tersedia saat ini</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Tidak Menemukan Kamar yang Sesuai?</h2>
        <p>Hubungi kami untuk mendapatkan informasi lebih lanjut atau paket khusus yang sesuai dengan kebutuhan Anda</p>
        <a href="{{ route('contact') }}" class="btn-cta">
            <i class="fas fa-phone"></i>
            Hubungi Kami
        </a>
    </div>
</section>

@endsection