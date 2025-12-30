@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <h1 style="animation: slideInLeft 0.8s ease-out;">Selamat Datang di Golden Wave Resort</h1>
                <p style="animation: slideInLeft 0.8s ease-out 0.2s both;">Nikmati pengalaman menginap yang tak terlupakan dengan pemandangan laut yang memukau dan fasilitas kelas dunia</p>
                <div style="animation: slideInLeft 0.8s ease-out 0.4s both;">
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary me-3">
                        <i class="fas fa-door-open"></i> Pesan Kamar Sekarang
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light">
                        <i class="fas fa-phone"></i> Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-5" style="animation: slideInRight 0.8s ease-out 0.3s both;">
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms Section -->
<section class="featured-section">
    <div class="container">
        <div class="section-title">
            <h2>Kamar Unggulan Kami</h2>
            <p>Pilihan kamar terbaik dengan harga yang terjangkau dan fasilitas lengkap</p>
        </div>

        <div class="row">
            @forelse($featured_rooms as $room)
                    <div class="col-md-6 col-lg-4 mb-4">
                    <div class="Room-card">
                        <div class="Room-image" style="position:relative; height:220px; overflow:hidden; background:#f5f5f5;">
                            @php
                                $img = $room->main_image ?? null;
                                if ($img) {
                                    if (preg_match('/^https?:\/\//', $img)) {
                                        $url = $img;
                                    } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                                        $url = asset($img);
                                    } else {
                                        $url = \Illuminate\Support\Facades\Storage::url($img);
                                    }
                                } else {
                                    $url = asset('images/rooms/placeholder.jpg');
                                }
                            @endphp
                            <img src="{{ $url }}" alt="{{ $room->name ?? 'Kamar' }}" style="width:100%; height:100%; object-fit:cover; display:block;" />

                            <div class="Room-badges" style="position:absolute; top:16px; left:16px; right:16px; display:flex; justify-content:space-between; z-index:2;">
                                @php $rp = $room->price ?? 0; @endphp
                                <span class="Badge-item" style="background:white; padding:6px 12px; border-radius:20px;text-align:center;display:flex;align-items:center;justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                                    @if($rp < 600000)
                                        Economy
                                    @elseif($rp < 900000)
                                        Standard
                                    @else
                                        Luxury
                                    @endif
                                </span>

                                <span class="Badge-item" style="background:white; padding:6px 12px; border-radius:20px;text-align:center;display:flex;align-items:center;justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                                    <i class="fas fa-ruler"></i> {{ $room->size ?? '900 Sqft' }}
                                </span>
                            </div>
                        </div>

                        <div class="room-content">
                            <h3>{{ $room->name ?? 'Kamar Standar' }}</h3>
                            <p>{{ Str::limit($room->description ?? 'Kamar yang nyaman dengan fasilitas lengkap', 100) }}</p>
                            <div class="room-footer">
                                <div class="price">Rp {{ number_format($room->price ?? 600000, 0, ',', '.') }}</div>
                                <a href="{{ route('rooms.show', $room->id ?? '#') }}" class="btn btn-sm">
                                    Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilkan demo placeholder jika tidak ada data di DB --}}
                @for($i = 1; $i <= 3; $i++)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="room-card">
                            <div class="room-image" style="background-image: url('{{ asset("images/rooms/room{$i}.jpg") }}'); background-size: cover; background-position: center;">
                                {{-- fallback icon --}}
                            </div>
                            <div class="room-content">
                                <h3>Sample Room {{ $i }}</h3>
                                <p>Kamar contoh untuk preview desain dan animasi. Tambahkan data nyata melalui admin panel.</p>
                                <div class="room-footer">
                                    <div class="price">Rp 750.000</div>
                                    <a href="#" class="btn btn-sm btn-primary">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-eye"></i> Lihat Semua Kamar
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title" style="margin-bottom: 60px">
            <h2 style="color: white; margin-bottom: 1rem;">
                Mengapa Memilih Kami?
            </h2>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Fasilitas Premium</h3>
                    <p>Nikmati berbagai fasilitas modern dan lengkap untuk kenyamanan Anda</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Layanan Terbaik</h3>
                    <p>Tim profesional kami siap melayani Anda dengan sepenuh hati 24 jam sehari</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <h3>Lokasi Strategis</h3>
                    <p>Terletak di lokasi yang indah dengan akses mudah ke berbagai tempat wisata</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3>Harga Kompetitif</h3>
                    <p>Dapatkan penawaran terbaik dengan paket spesial dan diskon menarik</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section (tilted cards) -->
<section class="facilities-section">
    <div class="container">
        <div class="section-title">
            <h2>Fasilitas Unggulan</h2>
            <p>Menikmati layanan lengkap selama menginap di Golden Wave</p>
        </div>

        <div class="facility-row">
            <div class="facility-card stand-left">
                <div class="icon-large"><i class="fas fa-wifi"></i></div>
                <h5>WiFi Gratis</h5>
                <p>Akses internet cepat di seluruh area hotel untuk bekerja maupun berlibur.</p>
            </div>

            <div class="facility-card stand-mid">
                <div class="icon-large"><i class="fas fa-swimmer"></i></div>
                <h5>Piscina & Kolam</h5>
                <p>Kolam renang outdoor dengan pemandangan laut dan area santai keluarga.</p>
            </div>

            <div class="facility-card tilt-left">
                <div class="icon-large"><i class="fas fa-utensils"></i></div>
                <h5>Restoran & Bar</h5>
                <p>Restoran menyajikan masakan lokal dan internasional, dengan bar untuk bersantai.</p>
            </div>

            <div class="facility-card stand-right">
                <div class="icon-large"><i class="fas fa-spa"></i></div>
                <h5>Spa & Wellness</h5>
                <p>Perawatan spa profesional untuk relaksasi dan peremajaan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Promo Natal / Akhir Tahun -->
<section class="promo-section">
    <div class="promo-inner container">
        <div class="promo-left">
            <small class="promo-badge">PROMO AKHIR TAHUN</small>
            <h3>Diskon Spesial Natal 25% Untuk Menginap 2 Malam</h3>
            <p>
                Nikmati liburan Natal bersama keluarga dengan paket eksklusif
                termasuk sarapan dan akses kolam privat.
            </p>
            <ul>
                <li>Diskon 25% untuk periode 20 Des – 31 Des</li>
                <li>Early check-in & late checkout (tergantung ketersediaan)</li>
                <li>Gratis sarapan untuk 2 orang</li>
            </ul>
        </div>

        <div class="promo-right">
            <div class="promo-offer">
                Hemat hingga <strong>25%</strong><br>
                Gunakan kode: <span>NATAL25</span>
            </div>
            <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-lg">
                Pesan Sekarang
            </a>
        </div>
    </div>
</section>


<!-- Testimonials -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-title">
            <h2>Apa Kata Mereka</h2>
            <p>Ulasan tamu kami yang menikmati pengalaman menginap di Golden Wave</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="testimonial-card">
                    <img src="{{ asset('images/profil/bahlil.png') }}" alt="Tamu 1" class="testimonial-img" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}'">
                    <div>
                        <p class="testimonial-quote">"Pelayanan ramah, kamar bersih, dan pemandangan yang menakjubkan — kami pasti kembali!"</p>
                        <p class="mb-0"><strong class="testimonial-name">Bahlil S.</strong> — Pasangan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="testimonial-card">
                    <img src="{{ asset('images/profil/owi.png') }}" alt="Tamu 2" class="testimonial-img" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}'">
                    <div>
                        <p class="testimonial-quote">"Anak-anak sangat suka kolam dan area bermain. Makanan juga enak dan variatif."</p>
                        <p class="mb-0"><strong class="testimonial-name">Mas Owi.</strong> — Keluarga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Siap Untuk Berkunjung?</h2>
        <p>Pesan kamar impian Anda sekarang dan dapatkan diskon hingga 20% untuk pemesanan langsung</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-light btn-lg">
            <i class="fas fa-calendar-check"></i> Pesan Sekarang
        </a>
    </div>
</section>

@endsection
