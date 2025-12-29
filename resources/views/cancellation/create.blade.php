@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); padding:60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h1 class="fw-bold">Permintaan Pembatalan Reservasi</h1>
                    <p class="text-muted">Masukkan ID booking dan email yang sama dengan saat pemesanan untuk mengajukan pembatalan.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('cancellation.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="booking_id" class="form-label">ID Booking</label>
                                <input type="number" name="booking_id" id="booking_id" class="form-control" required value="{{ old('booking_id', request('booking_id')) }}">
                            </div>

                            <div class="mb-3">
                                <label for="guest_email" class="form-label">Email Pemesan</label>
                                <input type="email" name="guest_email" id="guest_email" class="form-control" required value="{{ old('guest_email', request('guest_email')) }}">
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Alasan Pembatalan (opsional)</label>
                                <textarea name="reason" id="reason" rows="4" class="form-control">{{ old('reason') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-danger">Ajukan Pembatalan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
