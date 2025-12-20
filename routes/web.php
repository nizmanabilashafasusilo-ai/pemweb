<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// --- Fitur Utama Publik ---

// 1. Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Informasi Kamar
Route::resource('rooms', RoomController::class)->only(['index', 'show']);

// 3. Fitur Booking / Reservasi
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// 4. Halaman Statis (Kontak & Lokasi, Tentang Kami)
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// --- Autentikasi Pengguna (Login / Register) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 5. Galeri
// Asumsikan Anda membuat controller GalleryController
// Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// 6. Daftar Kamar (Halaman Terpisah)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');


// --- Admin Area (Perlu instalasi autentikasi seperti Breeze/Jetstream) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::view('/', 'admin.dashboard')->name('dashboard');

    // CRUD Kamar
    Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);

    // CRUD Booking
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index', 'show', 'update']);
    
    // ... Fasilitas, Testimoni, Promo
});