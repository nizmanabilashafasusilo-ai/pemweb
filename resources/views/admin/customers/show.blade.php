@extends('admin.layouts.master')

@section('page-title','Customer')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            @if($customer)
                <h4>{{ $customer->guest_name ?? ($customer->name ?? 'Customer') }}</h4>
                <p><strong>Email:</strong> {{ $customer->guest_email ?? $customer->email ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $customer->guest_phone ?? '—' }}</p>

                <h5 class="mt-4">Bookings</h5>
                @if(isset($bookings) && $bookings->count())
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead><tr><th>ID</th><th>Room</th><th>Check-in</th><th>Check-out</th><th>Total</th><th>Status</th></tr></thead>
                            <tbody>
                            @foreach($bookings as $b)
                                <tr>
                                    <td>{{ $b->id }}</td>
                                    <td>{{ \App\Models\Room::find($b->room_id)->name ?? '—' }}</td>
                                    <td>{{ $b->check_in_date }}</td>
                                    <td>{{ $b->check_out_date }}</td>
                                    <td>Rp {{ number_format($b->total_price ?? 0,0,',','.') }}</td>
                                    <td>{{ $b->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">No bookings for this customer.</div>
                @endif
            @else
                <div class="alert alert-warning">Customer not found.</div>
            @endif
        </div>
    </div>
</div>
@endsection
