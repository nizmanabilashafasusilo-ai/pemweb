<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cancellation;
use App\Models\Booking;
use App\Models\AdminActivity;

class AdminCancellationController extends Controller
{
    public function index()
    {
        $cancellations = Cancellation::with('booking')->orderBy('requested_at', 'desc')->paginate(20);
        return view('admin.cancellations.index', compact('cancellations'));
    }

    public function show(Cancellation $cancellation)
    {
        return view('admin.cancellations.show', compact('cancellation'));
    }

    public function approve(Cancellation $cancellation)
    {
        $cancellation->status = 'approved';
        $cancellation->processed_at = now();
        $cancellation->save();

        $booking = $cancellation->booking;
        if ($booking) {
            $booking->status = 'cancelled';
            $booking->save();
        }

        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'approve_cancellation', 'details' => 'Approved cancellation '.$cancellation->id, 'ip' => request()->ip()]);

        return redirect()->route('admin.cancellations.index')->with('status', 'Cancellation approved');
    }

    public function reject(Cancellation $cancellation)
    {
        $cancellation->status = 'rejected';
        $cancellation->processed_at = now();
        $cancellation->save();

        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'reject_cancellation', 'details' => 'Rejected cancellation '.$cancellation->id, 'ip' => request()->ip()]);

        return redirect()->route('admin.cancellations.index')->with('status', 'Cancellation rejected');
    }
}
