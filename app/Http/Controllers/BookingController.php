<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;
use App\Models\AdminActivity;

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
            'services' => 'nullable|array',
            'services.*' => 'nullable|exists:services,id',
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
        $roomQuantity = $room->quantity ?? 1;
        if ($bookedCount >= $roomQuantity) {
            return back()->with('error', 'Maaf, kamar ' . $room->name . ' tidak tersedia pada tanggal tersebut.');
        }

        // 3. Hitung Harga Total
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $days * $room->price_per_night;

        // add selected services prices (only available services)
        $servicesTotal = 0;
        if ($request->has('services') && is_array($request->services) && count($request->services)) {
            $servicesTotal = Service::whereIn('id', $request->services)->where('available', true)->sum('price');
        }
        $totalPrice += $servicesTotal;

        // 4. Simpan Booking
        $booking = Booking::create([
            'room_id' => $roomId,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone ?? '',
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'number_of_guests' => $request->number_of_guests,
            'total_price' => $totalPrice,
            'status' => 'pending', // Perlu konfirmasi admin/pembayaran
        ]);

        // 4b. Sync customer record (create or update)
        try {
            Customer::updateOrCreate(
                ['email' => $booking->guest_email],
                [
                    'name' => $booking->guest_name,
                    'phone' => $booking->guest_phone,
                ]
            );
        } catch (\Exception $e) {
            \Log::error('Failed to sync customer: ' . $e->getMessage());
        }

        // 5. Beri Respon Sukses
        // Send notification to admin
        try {
            $admin = env('ADMIN_EMAIL', config('mail.from.address'));
            if ($admin) {
                Mail::to($admin)->send(new BookingNotification($booking));
            }
        } catch (\Exception $e) {
            // Log and continue — don't block user on mail failures
            \Log::error('Failed to send booking notification: ' . $e->getMessage());
        }

        // 6. Simpan log aktivitas untuk admin (agar tercatat di DB)
        try {
            AdminActivity::create([
                'user_id' => auth()->id(),
                'action' => 'booking_created',
                'details' => [
                    'booking_id' => $booking->id,
                    'room_id' => $booking->room_id,
                    'guest_email' => $booking->guest_email,
                    'total_price' => $booking->total_price,
                ],
                'ip' => request()->ip(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to write admin activity: ' . $e->getMessage());
        }

        $message = 'Kamar berhasil dipesan! Reservasi Anda telah diterima dan sedang diproses. Kami akan mengirimkan konfirmasi melalui email. Terima kasih telah memesan di Golden Wave.';
        // Redirect ke daftar kamar (lihat kamar lainnya) dan sertakan booking id untuk akses cepat
        return redirect()->route('booking.payment.show', $booking->id)
        ->with('success', 'Reservasi berhasil dibuat. Silakan lanjutkan pembayaran.');
    }

    /**
     * Tampilkan daftar booking milik user saat ini.
     */
    public function index()
    {
        $user = auth()->user();
        $bookings = Booking::where('guest_email', $user->email)->with('room')->orderBy('created_at', 'desc')->get();

        // Summary counters for infographics
        $total = $bookings->count();
        $confirmed = $bookings->where('status', 'confirmed')->count();
        $cancelled = $bookings->where('status', 'cancelled')->count();
        $upcoming = $bookings->where('check_in_date', '>=', now()->startOfDay())->count();

        // Monthly bookings (last 6 months) for chart
        $months = [];
        $monthCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = \Carbon\Carbon::now()->subMonths($i);
            $label = $m->format('M Y');
            $months[] = $label;
            $start = $m->copy()->startOfMonth();
            $end = $m->copy()->endOfMonth();
            $monthCounts[] = Booking::where('guest_email', $user->email)
                ->whereBetween('created_at', [$start, $end])
                ->count();
        }

        return view('bookings.index', compact('bookings','total','confirmed','cancelled','upcoming','months','monthCounts'));
    }

    /**
     * Tampilkan detail booking (hanya jika milik user)
     */
    public function show(Booking $booking)
    {
        $user = auth()->user();
        if ($booking->guest_email !== $user->email) {
            abort(403);
        }
        $booking->load('room');
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show sandbox payment page for a booking (only owner)
     */
    public function paymentSandbox(Booking $booking)
    {
        $user = auth()->user();
        if ($booking->guest_email !== $user->email) {
            abort(403);
        }
        if ($booking->status === 'confirmed') {
            return redirect()->route('bookings.show', $booking)->with('error', 'Booking sudah terkonfirmasi.');
        }
        return view('payments.sandbox', compact('booking'));
    }

    /**
     * Handle sandbox payment confirmation (mark booking as confirmed)
     */
    public function paymentSandboxConfirm(Booking $booking)
    {
        $user = auth()->user();
        if ($booking->guest_email !== $user->email) {
            abort(403);
        }

        // Simulate payment processing delay
        try {
            $booking->status = 'confirmed';
            $booking->save();

            // Log admin activity
            try {
                \App\Models\AdminActivity::create([
                    'user_id' => auth()->id(),
                    'action' => 'booking_confirmed_via_sandbox',
                    'details' => ['booking_id' => $booking->id, 'amount' => $booking->total_price],
                    'ip' => request()->ip(),
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to write admin activity: ' . $e->getMessage());
            }

            // send admin notification
            try {
                $admin = env('ADMIN_EMAIL', config('mail.from.address'));
                if ($admin) {
                    Mail::to($admin)->send(new BookingNotification($booking));
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send booking notification after sandbox payment: ' . $e->getMessage());
            }

            return redirect()->route('bookings.show', $booking)->with('success', 'Pembayaran berhasil (sandbox). Reservasi dikonfirmasi.');
        } catch (\Exception $e) {
            \Log::error('Sandbox payment failed: ' . $e->getMessage());
            return redirect()->route('bookings.show', $booking)->with('error', 'Terjadi kesalahan saat memproses pembayaran sandbox.');
        }
    }
}