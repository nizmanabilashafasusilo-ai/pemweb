@extends('layouts.app')

@section('content')
<style>
    .booking-page {
        background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%);
        padding: 60px 0;
    }
    .booking-card {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    .booking-meta p { 
        margin-bottom: .4rem; 
    }
    .booking-actions .btn { 
        min-width: 160px; 
    }
</style>

<div class="booking-page">
    <div class="container">
        <h2 class="mb-4">Detail Reservasi</h2>

        <div class="card booking-card">
            <div class="card-body">
            <h4>{{ $booking->room->name ?? 'Kamar' }} <small class="text-muted">#{{ $booking->id }}</small></h4>
            <div class="booking-meta mb-3">
                <table class="table table-sm mb-0">
                    <tbody>
                        <tr>
                            <th style="width:200px;">Status</th>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                        <tr>
                            <th>Tamu</th>
                            <td>{{ $booking->guest_name }} ({{ $booking->guest_email }})</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $booking->guest_phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Check-in</th>
                            <td>{{ $booking->check_in_date->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Check-out</th>
                            <td>{{ $booking->check_out_date->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah tamu</th>
                            <td>{{ $booking->number_of_guests }}</td>
                        </tr>
                        <tr>
                            <th>Total dibayar</th>
                            <td>Rp {{ number_format($booking->total_price,0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <h5>Informasi Kamar</h5>
            @if($booking->room)
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th style="width:180px;">Nama</th>
                            <td>{{ $booking->room->name }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $booking->room->description }}</td>
                        </tr>
                        <tr>
                            <th>Harga / malam</th>
                            <td>Rp {{ number_format($booking->room->price,0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('rooms.show', $booking->room->id) }}" class="btn btn-outline-primary">Lihat Kamar</a>
            @else
                <p>Kamar tidak ditemukan.</p>
            @endif

            <div class="mt-3 booking-actions d-flex gap-2">
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">Kembali ke Reservasi Saya</a>
                <div class="ms-auto">
                    @auth
                        @if($booking->status !== 'cancelled')
                            <a href="{{ route('cancellation.create', ['booking_id' => $booking->id, 'guest_email' => $booking->guest_email]) }}" class="btn btn-warning">Ajukan Pembatalan</a>
                        @endif

                        @if($booking->status === 'pending')
                            <a href="{{ route('booking.payment.show', $booking->id) }}" class="btn btn-success">Bayar (Sandbox)</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
