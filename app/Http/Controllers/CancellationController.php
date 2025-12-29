<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cancellation;

class CancellationController extends Controller
{
    public function create()
    {
        return view('cancellation.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'guest_email' => 'required|email',
            'reason' => 'nullable|string|max:2000',
        ]);

        // verify booking belongs to email
        $booking = Booking::where('id', $data['booking_id'])->first();
        if (! $booking || strtolower($booking->guest_email) !== strtolower($data['guest_email'])) {
            return back()->withErrors(['booking_id' => 'Booking tidak ditemukan dengan email yang diberikan.'])->withInput();
        }

        $cancellation = Cancellation::create([
            'booking_id' => $booking->id,
            'guest_email' => $data['guest_email'],
            'reason' => $data['reason'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('cancellation.thanks')->with('status', 'Permintaan pembatalan Anda telah diterima.');
    }

    public function thanks()
    {
        return view('cancellation.thanks');
    }
}
