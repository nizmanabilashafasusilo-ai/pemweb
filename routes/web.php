<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC AREA
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Informasi Kamar
Route::resource('rooms', RoomController::class)->only(['index', 'show']);

// Blog
Route::get('/blog', [\App\Http\Controllers\ArticleController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('blog.show');

// Halaman statis
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact/send', [\App\Http\Controllers\ContactMessageController::class, 'store'])->name('contact.send');

// Check-in online
Route::get('/checkin', [\App\Http\Controllers\CheckinController::class, 'create'])->name('checkin.create');
Route::post('/checkin', [\App\Http\Controllers\CheckinController::class, 'store'])->name('checkin.store');

// Cancellation
Route::get('/cancellation', [\App\Http\Controllers\CancellationController::class, 'create'])->name('cancellation.create');
Route::post('/cancellation', [\App\Http\Controllers\CancellationController::class, 'store'])->name('cancellation.store');
Route::get('/cancellation/thanks', [\App\Http\Controllers\CancellationController::class, 'thanks'])->name('cancellation.thanks');

/*
|--------------------------------------------------------------------------
| AUTH USER (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER AREA (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Halaman Reservasi
    Route::get('/reservation', [ReservationController::class, 'create'])
        ->name('reservation.create');

    // Simpan booking
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    // Booking milik user
    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');

    // Payment sandbox
    Route::get('/booking/{booking}/payment-sandbox', [BookingController::class, 'paymentSandbox'])
        ->name('booking.payment.show');

    Route::post('/booking/{booking}/payment-sandbox', [BookingController::class, 'paymentSandboxConfirm'])
        ->name('booking.payment.confirm');

    // Dashboard user
    Route::get('/dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', function () {
        return view('profile', ['user' => auth()->user()]);
    })->name('profile');

    Route::post('/profile', function (Request $request) {
        $user = auth()->user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:50',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'email', 'phone');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        \App\Models\Customer::updateOrCreate(
            ['email' => $user->email],
            ['name' => $user->name, 'phone' => $user->phone]
        );

        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (HARUS LOGIN ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('rooms', \App\Http\Controllers\Admin\AdminRoomController::class);
        Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);
        Route::resource('articles', \App\Http\Controllers\Admin\AdminArticleController::class)->except(['show']);
        Route::resource('services', \App\Http\Controllers\Admin\AdminServiceController::class);

        // Bookings (SEMUA booking tampil, pending & confirmed)
        Route::resource('bookings', \App\Http\Controllers\Admin\AdminBookingController::class)
            ->only(['index', 'show', 'update']);

        // Customers
        Route::get('customers', [\App\Http\Controllers\Admin\AdminCustomerController::class, 'index'])
            ->name('customers.index');
        Route::get('customers/{id}', [\App\Http\Controllers\Admin\AdminCustomerController::class, 'show'])
            ->name('customers.show');

        // Cancellations
        Route::get('cancellations', [\App\Http\Controllers\Admin\AdminCancellationController::class, 'index'])
            ->name('cancellations.index');
        Route::get('cancellations/{cancellation}', [\App\Http\Controllers\Admin\AdminCancellationController::class, 'show'])
            ->name('cancellations.show');
        Route::post('cancellations/{cancellation}/approve', [\App\Http\Controllers\Admin\AdminCancellationController::class, 'approve'])
            ->name('cancellations.approve');
        Route::post('cancellations/{cancellation}/reject', [\App\Http\Controllers\Admin\AdminCancellationController::class, 'reject'])
            ->name('cancellations.reject');

        // Activity log
        Route::get('activity', [\App\Http\Controllers\Admin\AdminActivityController::class, 'index'])
            ->name('activity.index');

        // Messages
        Route::get('messages', [\App\Http\Controllers\ContactMessageController::class, 'index'])
            ->name('messages.index');
        Route::get('messages/{message}', [\App\Http\Controllers\ContactMessageController::class, 'show'])
            ->name('messages.show');
        Route::delete('messages/{message}', [\App\Http\Controllers\ContactMessageController::class, 'destroy'])
            ->name('messages.destroy');
    });
