@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); padding:60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h3 class="mb-3">Pembayaran</h3>

                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th style="width:180px">Booking ID</th>
                                    <td>#{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <th>Kamar</th>
                                    <td>{{ $booking->room->name ?? 'Kamar' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $booking->guest_name }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>Rp {{ number_format($booking->total_price,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <form method="POST" action="{{ route('booking.payment.confirm', $booking->id) }}">
                            @csrf
                            <p class="text-muted">Klik tombol di bawah untuk mensimulasikan transaksi pembayaran berhasil.</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-outline-secondary">Kembali</a>
                                <button class="btn btn-success">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
