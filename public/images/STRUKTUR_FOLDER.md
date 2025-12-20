📁 STRUKTUR FOLDER ASSETS GOLDEN WAVE RESORT
=============================================

Berikut adalah struktur lengkap folder untuk menyimpan semua gambar/aset website Anda.

## 📂 Lokasi Folder Utama:
```
goldenwave/
└── public/
    └── images/
        ├── backgrounds/        ← Background images untuk sections
        ├── gallery/            ← Foto fasilitas & umum resort
        ├── logo/               ← Logo & branding
        ├── rooms/              ← Foto kamar-kamar
        ├── testimonials/       ← Foto tamu/customer reviews
        └── README.md           ← Dokumentasi
```

## 🎯 Kegunaan Setiap Folder:

### 1. `/rooms` - Gambar Kamar
```
images/rooms/
├── deluxe-room-1.jpg        (1200x800px, 150-300KB)
├── deluxe-room-2.jpg
├── standard-room-1.jpg
├── standard-room-2.jpg
├── budget-room-1.jpg
└── budget-room-2.jpg
```
**Digunakan untuk:** Halaman kamar, room detail, room cards
**Format:** JPG
**Ukuran:** Minimal 1200x800px

### 2. `/gallery` - Galeri Foto Resort
```
images/gallery/
├── lobby.jpg               (1200x800px, 150-300KB)
├── pool.jpg
├── restaurant.jpg
├── beach.jpg
├── spa.jpg
├── conference-room.jpg
├── resort-overview.jpg
└── sunset.jpg
```
**Digunakan untuk:** Gallery page, about section, testimonial background
**Format:** JPG
**Ukuran:** Minimal 1200x800px

### 3. `/backgrounds` - Background Images
```
images/backgrounds/
├── hero-beach.jpg          (1920x1080px, 300-500KB)
├── hero-sunset.jpg
├── section-pattern.jpg
├── wave-pattern.jpg
└── footer-bg.jpg
```
**Digunakan untuk:** Hero section, section backgrounds
**Format:** JPG
**Ukuran:** 1920x1080px atau lebih

### 4. `/logo` - Logo & Branding
```
images/logo/
├── logo.png                (200x60px dengan transparency)
├── logo-white.png
├── favicon.ico             (32x32px)
├── icon-square.png         (512x512px)
└── watermark.png
```
**Digunakan untuk:** Navigation bar, header, footer
**Format:** PNG (dengan transparency)
**Ukuran:** Sesuaikan dengan kebutuhan

### 5. `/testimonials` - Foto Tamu/Reviews
```
images/testimonials/
├── customer-1.jpg          (300x300px, 50-100KB)
├── customer-2.jpg
├── customer-3.jpg
├── customer-4.jpg
├── customer-5.jpg
└── customer-6.jpg
```
**Digunakan untuk:** Testimonial section, review cards
**Format:** JPG
**Ukuran:** 300x300px (untuk circular crop)

---

## 🚀 Cara Menggunakan di Template Laravel Blade:

### Contoh 1: Gambar di Halaman Kamar
```blade
<img src="{{ asset('images/rooms/deluxe-room-1.jpg') }}" alt="Deluxe Room">
```

### Contoh 2: Background di Hero Section
```blade
<div style="background-image: url('{{ asset('images/backgrounds/hero-beach.jpg') }}');">
    <!-- Content -->
</div>
```

### Contoh 3: Logo di Navigation
```blade
<img src="{{ asset('images/logo/logo.png') }}" alt="Golden Wave Logo" style="height: 40px;">
```

### Contoh 4: Galeri Foto
```blade
@foreach(['lobby', 'pool', 'beach'] as $item)
    <img src="{{ asset('images/gallery/' . $item . '.jpg') }}" alt="{{ $item }}">
@endforeach
```

### Contoh 5: Testimonial dengan Foto
```blade
<img src="{{ asset('images/testimonials/customer-1.jpg') }}" 
     alt="Customer Name" 
     style="border-radius: 50%; width: 80px; height: 80px;">
```

---

## 📋 Daftar File yang Wajib Ada:

| File | Lokasi | Status | Catatan |
|------|--------|--------|---------|
| Logo | images/logo/logo.png | ⚠️ Perlu | Minimal requirement |
| Hero BG | images/backgrounds/hero-beach.jpg | ⚠️ Perlu | Untuk hero section |
| Room 1 | images/rooms/room-1.jpg | ⚠️ Perlu | Minimal 1 kamar |
| Pool | images/gallery/pool.jpg | ✅ Opsional | Tapi recommended |
| Testimonial | images/testimonials/customer-1.jpg | ✅ Opsional | Untuk review section |

---

## 💾 Langkah-Langkah Menambahkan Gambar:

### 1. Siapkan Gambar
```
- Kompres gambar (gunakan TinyPNG atau ImageOptim)
- Pastikan ukuran sesuai dengan kebutuhan
- Gunakan format JPG atau PNG
```

### 2. Upload ke Folder yang Sesuai
```
Contoh:
D:\laragon\www\goldenwave\public\images\rooms\deluxe-room.jpg
```

### 3. Update Template
```blade
<!-- Ganti placeholder dengan path gambar Anda -->
<img src="{{ asset('images/rooms/deluxe-room.jpg') }}" alt="Deluxe Room">
```

### 4. Test di Browser
```
Buka halaman dan pastikan gambar tampil dengan baik
Cek di multiple browsers dan devices
```

---

## 🎨 Naming Convention (Penamaan File):

**Format:** `jenis-deskripsi-nomor.jpg`

### Contoh Baik:
```
✅ deluxe-room-1.jpg
✅ lobby-daytime.jpg
✅ pool-overview.jpg
✅ beach-sunset.jpg
✅ customer-1.jpg
```

### Contoh Kurang Baik:
```
❌ DSCN0001.jpg
❌ Foto 1.jpg
❌ image.jpg
❌ DSC_2024.jpg
❌ room new.jpg
```

**Aturan:**
- Gunakan lowercase
- Gunakan hyphen (-) untuk separator, bukan underscore
- Hindari spasi
- Gunakan deskripsi yang meaningful
- Jangan gunakan special characters

---

## 🖼️ Ukuran & Format Referensi:

| Tipe | Format | Ukuran | File Size |
|------|--------|--------|-----------|
| Room Photo | JPG | 1200x800 | 200-300KB |
| Gallery | JPG | 1200x800 | 200-300KB |
| Hero BG | JPG | 1920x1080 | 300-500KB |
| Logo | PNG | 200x60 | 50-100KB |
| Testimonial | JPG | 300x300 | 30-50KB |
| Icon | PNG | 512x512 | 100-150KB |

---

## 📊 Struktur Database untuk Gambar:

Jika ingin simpan path gambar di database:

```sql
-- Migration untuk rooms table
Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->string('image_path')->nullable(); 
    // Contoh: 'images/rooms/deluxe-1.jpg'
    $table->timestamps();
});
```

Gunakan di Blade:
```blade
<img src="{{ asset($room->image_path) }}" alt="{{ $room->name }}">
```

---

## ✅ Checklist Setup Gambar:

- [ ] Buat semua folder di `/public/images/`
- [ ] Siapkan logo dan simpan di `/images/logo/`
- [ ] Siapkan hero background simpan di `/images/backgrounds/`
- [ ] Upload foto kamar ke `/images/rooms/`
- [ ] Upload foto galeri ke `/images/gallery/`
- [ ] Update path di template Blade files
- [ ] Test semua halaman di browser
- [ ] Compress semua gambar
- [ ] Backup gambar original

---

## 🔧 Tips & Tricks:

### 1. Menggunakan Conditional Image
```blade
@if(file_exists(public_path('images/rooms/room-' . $room->id . '.jpg')))
    <img src="{{ asset('images/rooms/room-' . $room->id . '.jpg') }}" alt="{{ $room->name }}">
@else
    <div class="placeholder">No Image Available</div>
@endif
```

### 2. Responsive Images
```blade
<picture>
    <source media="(max-width: 768px)" srcset="{{ asset('images/rooms/mobile-room.jpg') }}">
    <img src="{{ asset('images/rooms/room.jpg') }}" alt="Room">
</picture>
```

### 3. Lazy Loading
```blade
<img src="{{ asset('images/gallery/pool.jpg') }}" 
     alt="Pool" 
     loading="lazy">
```

### 4. Image Srcset (untuk Retina)
```blade
<img src="{{ asset('images/gallery/pool.jpg') }}"
     srcset="{{ asset('images/gallery/pool@2x.jpg') }} 2x"
     alt="Pool">
```

---

## 🚨 Troubleshooting:

### Gambar tidak tampil?
1. Periksa path gambar di `public/images/`
2. Pastikan nama file sesuai persis (case-sensitive)
3. Lakukan `php artisan cache:clear`
4. Check console browser untuk error

### Gambar loading lambat?
1. Compress gambar dengan TinyPNG
2. Gunakan format JPG untuk foto
3. Resize gambar sesuai kebutuhan
4. Implement lazy loading

### Gambar tidak responsive?
1. Gunakan `width: 100%` di CSS
2. Gunakan `max-width` untuk kontrol
3. Gunakan `object-fit: cover` untuk maintain ratio
4. Test di berbagai ukuran screen

---

Sekarang Anda siap menambahkan gambar ke website Golden Wave Resort! 📸✨
