@extends('admin.layouts.master')

@section('page-title','Bookings')

@section('content')
<div class="container">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(isset($bookings) && $bookings->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->guest_name }}<br><small class="text-muted">{{ $booking->guest_email }}</small></td>
                        <td>{{ $booking->room->name ?? '—' }}</td>
                        <td>{{ $booking->check_in_date->format('Y-m-d') }}</td>
                        <td>{{ $booking->check_out_date->format('Y-m-d') }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $bookings->links() }}</div>
    @else
        <div class="alert alert-info">Tidak ada booking.</div>
    @endif
</div>
@endsection
