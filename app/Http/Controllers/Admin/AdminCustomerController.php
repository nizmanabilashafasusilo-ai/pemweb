<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class AdminCustomerController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        try {
            $query = DB::table('bookings')
                ->selectRaw('guest_email as id, guest_name, guest_phone, COUNT(*) as bookings_count, MAX(created_at) as last_booking_at')
                ->groupBy('guest_email', 'guest_name', 'guest_phone');

            if ($q) {
                $like = '%' . $q . '%';
                $query->havingRaw('guest_name LIKE ? OR guest_email LIKE ? OR guest_phone LIKE ?', [$like, $like, $like]);
            }

            $items = $query->orderByDesc('last_booking_at')->paginate(15)->withQueryString();
        } catch (QueryException $e) {
            $items = collect();
        }
        return view('admin.customers.index', ['customers' => $items]);
    }

    public function show($id)
    {
        // Here $id is guest_email (used as id in index). Show customer's bookings and details.
        try {
            $email = $id;
            $bookings = DB::table('bookings')->where('guest_email', $email)->orderByDesc('created_at')->get();
            $customer = null;
            if ($bookings->count()) {
                $first = $bookings->first();
                $customer = (object)[
                    'guest_name' => $first->guest_name,
                    'guest_email' => $first->guest_email,
                    'guest_phone' => $first->guest_phone,
                ];
            }
        } catch (QueryException $e) {
            $bookings = collect();
            $customer = null;
        }
        return view('admin.customers.show', ['customer' => $customer, 'bookings' => $bookings]);
    }
}
