# 🖼️ PANDUAN MENGGUNAKAN GAMBAR DI WEBSITE

## Lokasi Folder Assets
```
public/
└── images/
    ├── rooms/              # Gambar kamar hotel
    ├── gallery/            # Foto fasilitas & pemandangan
    ├── backgrounds/        # Background images
    ├── logo/               # Logo & branding
    └── testimonials/       # Foto tamu & review
```

## Cara Menambahkan Gambar di Blade Template

### 1️⃣ Gambar Kamar (untuk halaman rooms)

**File:** `resources/views/rooms/show.blade.php`

```blade
<!-- Ganti bagian room-image dengan: -->
<div class="room-image-gallery">
    <img src="{{ asset('images/rooms/your-room-image.jpg') }}" alt="{{ $room->name }}">
</div>
```

**Contoh penggunaan di room card:**
```blade
<div class="room-image">
    <img src="{{ asset('images/rooms/deluxe-room.jpg') }}" alt="Deluxe Room" style="width: 100%; height: 100%; object-fit: cover;">
</div>
```

---

### 2️⃣ Background Hero Section

**File:** `resources/views/layouts/app.blade.php`

Saat ini menggunakan SVG gradient. Untuk mengganti dengan gambar:

```css
.hero-section {
    background-image: url('{{ asset('images/backgrounds/hero-beach.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    /* background-color untuk fallback */
}
```

---

### 3️⃣ Gallery Section (untuk menampilkan koleksi foto)

**Buat file baru:** `resources/views/gallery.blade.php`

```blade
@extends('layouts.app')

@section('content')

<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <h2 style="text-align: center; font-size: 2rem; margin-bottom: 50px; color: var(--primary-color);">
            <i class="fas fa-images"></i> Galeri Foto Resort
        </h2>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('images/gallery/lobby.jpg') }}" alt="Lobby" style="width: 100%; height: 250px; object-fit: cover;">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('images/gallery/pool.jpg') }}" alt="Pool" style="width: 100%; height: 250px; object-fit: cover;">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('images/gallery/beach.jpg') }}" alt="Beach" style="width: 100%; height: 250px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
```

---

### 4️⃣ Testimonials Section

**Contoh implementasi testimonial dengan foto:**

```blade
<div style="text-align: center; padding: 20px;">
    <img src="{{ asset('images/testimonials/customer-1.jpg') }}" 
         alt="Nama Customer" 
         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
    <h4>Nama Customer</h4>
    <p style="color: #f39c12;">⭐⭐⭐⭐⭐</p>
    <p>"Pengalaman menginap yang luar biasa! Sangat merekomendasikan Golden Wave Resort."</p>
</div>
```

---

### 5️⃣ Logo di Navigation

**File:** `resources/views/layouts/app.blade.php`

```blade
<a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('images/logo/logo.png') }}" alt="Golden Wave" style="height: 40px; margin-right: 10px;">
    Golden Wave
</a>
```

---

## 📋 Checklist File Gambar yang Diperlukan

### Essential Images:
- [ ] `images/logo/logo.png` - Logo resort
- [ ] `images/backgrounds/hero-bg.jpg` - Background hero section
- [ ] `images/rooms/room-1.jpg` - Minimal 1 foto kamar

### Recommended Images:
- [ ] `images/gallery/lobby.jpg` - Foto lobby
- [ ] `images/gallery/pool.jpg` - Foto kolam renang
- [ ] `images/gallery/restaurant.jpg` - Foto restoran
- [ ] `images/gallery/beach.jpg` - Foto pantai
- [ ] `images/rooms/room-2.jpg` - Foto kamar tipe 2
- [ ] `images/rooms/room-3.jpg` - Foto kamar tipe 3

### Optional Images:
- [ ] `images/testimonials/customer-*.jpg` - Foto tamu
- [ ] `images/backgrounds/pattern-*.jpg` - Pattern backgrounds

---

## 🎨 Tips Optimasi Gambar

### Ukuran File:
- Kompres gambar sebelum upload
- Gunakan tools: TinyPNG, ImageOptim, atau online compressor
- Target: 200-500KB per gambar

### Format:
- **Foto**: JPG (untuk quality + file size)
- **Logo/Icon**: PNG (untuk transparency)
- **Modern**: WebP (untuk browser modern)

### Dimensi:
| Tipe | Lebar | Tinggi | Ratio |
|------|-------|--------|-------|
| Room | 1200px | 800px | 16:9 |
| Gallery | 1200px | 800px | 16:9 |
| Testimonial | 300px | 300px | 1:1 |
| Hero Background | 1920px | 1080px | 16:9 |
| Logo | 200px | 60px | 3:1 |

---

## 💾 Backup & Maintenance

1. **Backup**: Simpan copy original gambar di folder terpisah
2. **Naming**: Gunakan nama deskriptif dan konsisten
3. **Versioning**: Jika update, gunakan nama baru (room-v2.jpg)
4. **SEO**: Jangan lupa alt text untuk semua gambar

---

## 🚀 Contoh Implementasi Lengkap

```blade
<!-- Section dengan background gambar -->
<section style="
    background-image: url('{{ asset('images/backgrounds/section-bg.jpg') }}');
    background-size: cover;
    background-position: center;
    padding: 80px 0;
    color: white;
">
    <div class="container">
        <h2>Fasilitas Kami</h2>
    </div>
</section>

<!-- Room Card dengan gambar -->
<div class="room-card">
    <div class="room-image">
        @if(file_exists(public_path('images/rooms/room-' . $room->id . '.jpg')))
            <img src="{{ asset('images/rooms/room-' . $room->id . '.jpg') }}" 
                 alt="{{ $room->name }}"
                 style="width: 100%; height: 250px; object-fit: cover;">
        @else
            <div style="background: #ddd; height: 250px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-image" style="font-size: 3rem; color: #999;"></i>
            </div>
        @endif
    </div>
</div>
```

---

Sekarang Anda siap menambahkan gambar ke folder-folder yang sudah disiapkan! 🎉
