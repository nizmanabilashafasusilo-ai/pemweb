<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Summary counters for the user
        $total = Booking::where('guest_email', $user->email)->count();
        $confirmed = Booking::where('guest_email', $user->email)->where('status', 'confirmed')->count();
        $cancelled = Booking::where('guest_email', $user->email)->where('status', 'cancelled')->count();
        $upcoming = Booking::where('guest_email', $user->email)
            ->where('check_in_date', '>=', now()->startOfDay())->count();

        // Monthly bookings and cancellations (last 6 months)
        $months = [];
        $bookingCounts = [];
        $cancellationCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $label = $m->format('M Y');
            $months[] = $label;
            $start = $m->copy()->startOfMonth();
            $end = $m->copy()->endOfMonth();

            $bookingCounts[] = Booking::where('guest_email', $user->email)
                ->whereBetween('created_at', [$start, $end])->count();

            $cancellationCounts[] = Booking::where('guest_email', $user->email)
                ->where('status', 'cancelled')
                ->whereBetween('created_at', [$start, $end])->count();
        }

        // Occupancy estimate for next 30 days (hotel-wide, confirmed bookings)
        $days = 30;
        $startDay = Carbon::now()->startOfDay();
        $totalRooms = Room::count();
        $totalBookedRoomNights = 0;

        for ($d = 0; $d < $days; $d++) {
            $date = $startDay->copy()->addDays($d);
            $bookedThatDate = Booking::where('status', 'confirmed')
                ->where('check_in_date', '<', $date->copy()->addDay())
                ->where('check_out_date', '>', $date)
                ->count();
            $totalBookedRoomNights += $bookedThatDate;
        }

        $availableRoomNights = $totalRooms * $days;
        $occupancyRate = $availableRoomNights > 0 ? round($totalBookedRoomNights / $availableRoomNights * 100, 1) : 0;

        return view('dashboard.user', compact(
            'months', 'bookingCounts', 'cancellationCounts',
            'total', 'confirmed', 'cancelled', 'upcoming', 'occupancyRate'
        ));
    }
}
