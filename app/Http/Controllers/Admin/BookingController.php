<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // Hanya menampilkan dan update status booking
    public function index() { /* Logic tampilkan daftar booking */ return view('admin.bookings.index'); }
    public function update(Request $request, Booking $booking) { /* Logic ubah status booking */ }
    // ...
}
