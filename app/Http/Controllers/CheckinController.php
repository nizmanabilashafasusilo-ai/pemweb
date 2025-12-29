<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CheckinController extends Controller
{
    // Show the check-in form
    public function create()
    {
        return view('checkin.create');
    }

    // Handle check-in submission
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'guest_email' => 'required|email',
            'guest_phone' => 'nullable|string',
        ]);

        $booking = Booking::where('id', $data['booking_id'])
            ->where('guest_email', $data['guest_email'])
            ->first();

        if (! $booking) {
            return back()->withErrors(['booking_id' => 'Booking tidak ditemukan dengan data yang diberikan.'])->withInput();
        }

        // Mark as checked in
        $booking->status = 'checked_in';
        $booking->save();

        return redirect()->route('home')->with('status', 'Check-in berhasil. Selamat menikmati masa inap Anda!');
    }
}
