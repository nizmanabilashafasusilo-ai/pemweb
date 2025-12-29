<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
// using helper redirect() instead of Redirect facade

class AdminBookingController extends Controller
{
    // Tampilkan daftar booking
    public function index(Request $request)
    {
        $bookings = Booking::with('room')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.bookings.index', compact('bookings'));
    }

    // Lihat detail booking
    public function show(Booking $booking)
    {
        $booking->load('room');
        return view('admin.bookings.show', compact('booking'));
    }

    // Update booking: cancel atau reschedule
    public function update(Request $request, Booking $booking)
    {
        $action = $request->input('action');

        if ($action === 'cancel') {
            $booking->status = 'cancelled';
            $booking->save();
            return redirect()->route('admin.bookings.index')->with('success', 'Booking dibatalkan.');
        }

        if ($action === 'reschedule') {
            $data = $request->validate([
                'check_in_date' => ['required', 'date'],
                'check_out_date' => ['required', 'date'],
            ]);

            $booking->check_in_date = $data['check_in_date'];
            $booking->check_out_date = $data['check_out_date'];
            $booking->status = 'rescheduled';
            $booking->save();
            return redirect()->route('admin.bookings.show', $booking)->with('success', 'Booking berhasil dijadwal ulang.');
        }

        return redirect()->back()->withErrors(['action' => 'Aksi tidak dikenali']);
    }
}