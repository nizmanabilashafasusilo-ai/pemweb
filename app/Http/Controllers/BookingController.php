<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'number_of_guests' => 'required|integer|min:1',
        ]);

        $roomId = $request->room_id;
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $room = Room::findOrFail($roomId);
        
        // 2. Logic Cek Ketersediaan
        // Ambil jumlah booking terkonfirmasi/pending pada periode tanggal tersebut
        $bookedCount = Booking::where('room_id', $roomId)
            ->where(function($query) use ($checkIn, $checkOut) {
                // Mengecek tumpang tindih tanggal
                $query->where(function($q) use ($checkIn, $checkOut) {
                    $q->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
                });
            })
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        // Bandingkan dengan total kuantitas kamar
        if ($bookedCount >= $room->quantity) {
            return back()->with('error', 'Maaf, kamar ' . $room->name . ' tidak tersedia pada tanggal tersebut.');
        }

        // 3. Hitung Harga Total
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $days * $room->price_per_night;

        // 4. Simpan Booking
        Booking::create([
            'room_id' => $roomId,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'number_of_guests' => $request->number_of_guests,
            'total_price' => $totalPrice,
            'status' => 'pending', // Perlu konfirmasi admin/pembayaran
            // Tambahkan guest_phone
        ]);

        // 5. Beri Respon Sukses
        // TODO: Kirim email konfirmasi ke tamu
        return redirect()->route('home')->with('success', 'Reservasi berhasil dibuat! Silakan tunggu konfirmasi kami.');
    }
}