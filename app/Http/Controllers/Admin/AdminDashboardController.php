<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = now()->year;

        $ordersCount = Booking::count();
        $approvedCount = Booking::where('status', 'confirmed')->count();
        $usersCount = User::count();
        $revenue = Booking::whereYear('created_at', $year)->sum('total_price');

        // Sales totals per month (sum of total_price)
        $sales = DB::table('bookings')
            ->selectRaw('MONTH(created_at) as month, COALESCE(SUM(total_price),0) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Bookings count per month
        $activity = DB::table('bookings')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as cnt')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('cnt', 'month')
            ->toArray();

        // Build full 12-month arrays
        $salesData = [];
        $activityData = [];
        for ($m = 1; $m <= 12; $m++) {
            $salesData[] = isset($sales[$m]) ? (float) $sales[$m] : 0;
            $activityData[] = isset($activity[$m]) ? (int) $activity[$m] : 0;
        }

        $recentOrders = Booking::with('room')->orderBy('created_at', 'desc')->limit(6)->get();

        return view('admin.dashboard', compact(
            'ordersCount', 'approvedCount', 'usersCount', 'revenue', 'salesData', 'activityData', 'recentOrders'
        ));
    }
}
