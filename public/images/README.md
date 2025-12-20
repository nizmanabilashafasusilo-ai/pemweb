📁 FOLDER STRUKTUR GAMBAR - GOLDEN WAVE RESORT
==============================================

Folder ini berisi struktur organisasi untuk semua aset gambar website Golden Wave Resort.

## 📂 Struktur Folder:

### /rooms
Folder untuk menyimpan gambar kamar-kamar resort
- Gunakan untuk foto kamar individual dari berbagai tipe
- Nama file: room-1.jpg, room-2.jpg, dll
- Format: JPG/PNG (recommended: JPG untuk optimasi)
- Ukuran: Minimal 1200x800px

### /gallery
Folder untuk galeri foto umum resort
- Foto fasilitas umum (kolam renang, restoran, lobby, dll)
- Pemandangan pantai dan area sekitar
- Nama file: gallery-1.jpg, gallery-2.jpg, dll
- Format: JPG/PNG
- Ukuran: Minimal 1200x800px

### /backgrounds
Folder untuk background images
- Hero section background
- Section background patterns
- Overlay images
- Format: JPG/PNG
- Ukuran: Minimal 1920x1080px

### /logo
Folder untuk logo dan branding
- Logo resort
- Favicon
- Logo variations
- Format: PNG (untuk transparency)
- Ukuran: Sesuaikan per kebutuhan

### /testimonials
Folder untuk foto testimonial/tamu
- Foto profil dari customer reviews
- Foto tamu yang berkunjung
- Format: JPG/PNG
- Ukuran: Minimal 300x300px (untuk circular)

## 🖼️ Cara Menggunakan di Template:

### Untuk Gambar Kamar:
```html
<img src="{{ asset('images/rooms/room-1.jpg') }}" alt="Nama Kamar">
```

### Untuk Galeri:
```html
<img src="{{ asset('images/gallery/kolam-renang.jpg') }}" alt="Kolam Renang">
```

### Untuk Background:
```html
<div style="background-image: url('{{ asset('images/backgrounds/hero-bg.jpg') }}');">
```

### Untuk Logo:
```html
<img src="{{ asset('images/logo/logo.png') }}" alt="Logo Golden Wave">
```

### Untuk Testimonial:
```html
<img src="{{ asset('images/testimonials/customer-1.jpg') }}" alt="Nama Customer" class="rounded-circle">
```

## 📝 Catatan Penting:

1. **Kompresi Gambar**: Pastikan gambar sudah dikompres untuk loading lebih cepat
2. **Naming Convention**: Gunakan nama file yang deskriptif dan lowercase
3. **Format**: Preferensikan JPG untuk foto, PNG untuk logo/icon
4. **Alt Text**: Selalu sertakan alt text untuk SEO dan accessibility
5. **Responsive**: Upload gambar dengan ukuran yang cukup besar agar responsif di semua device

## 🔗 Struktur Lengkap:

```
public/images/
├── rooms/
│   ├── deluxe-room-1.jpg
│   ├── standard-room-1.jpg
│   └── ...
├── gallery/
│   ├── lobby.jpg
│   ├── pool.jpg
│   ├── restaurant.jpg
│   └── ...
├── backgrounds/
│   ├── hero-bg.jpg
│   └── section-bg.jpg
├── logo/
│   ├── logo.png
│   └── favicon.ico
└── testimonials/
    ├── customer-1.jpg
    ├── customer-2.jpg
    └── ...
```

Selamat menambahkan gambar Anda! 🎨
