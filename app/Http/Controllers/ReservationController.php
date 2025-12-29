<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class ReservationController extends Controller
{
    /**
     * Show a reservation form that posts to the booking store.
     */
   public function create(Request $request)
{
    $rooms = Room::orderBy('price_per_night', 'asc')->get();
    $selectedRoom = null;

    if ($request->has('room')) {
        $selectedRoom = Room::find($request->room);
    }

    // fetch available services for user reservation page
    if (Schema::hasColumn('services', 'sort_order')) {
        $services = Service::where('available', true)->orderBy('sort_order')->get();
    } else {
        $services = Service::where('available', true)->orderBy('created_at', 'desc')->get();
    }

    return view('reservation.create', compact('rooms', 'selectedRoom', 'services'));
}

}
