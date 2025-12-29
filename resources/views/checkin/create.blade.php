@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(
            135deg,
            rgba(203, 208, 210, 0.8) 0%,
            rgba(15, 61, 82, 0.8) 100%
        );
    }

    h1 {
        color: var(--primary-color);
    }

    .card {
        background-color: #ffffff;
    }

    .form-control {
        border-radius: 12px;
        padding: 0.65rem 0.9rem;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.15rem rgba(15, 61, 82, 0.25);
    }

    #checkinButton {
        background-color: var(--secondary-color);
        border: none;
        color: #fff;
    }

    #checkinButton:hover {
        filter: brightness(1.1);
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            {{-- Header --}}
            <div class="text-center mb-4">
                <h1 class="fw-bold">Check-in Online</h1>
                <p class="text-muted">
                    Masukkan ID booking dan email untuk melakukan check-in
                    sebelum kedatangan Anda.
                </p>
            </div>

            {{-- Card --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkin.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Booking</label>
                            <input type="number"
                                   name="booking_id"
                                   class="form-control"
                                   required
                                   value="{{ old('booking_id') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Pemesan</label>
                            <input type="email"
                                   name="guest_email"
                                   class="form-control"
                                   required
                                   value="{{ old('guest_email') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                No. Telepon <span class="text-muted">(opsional)</span>
                            </label>
                            <input type="text"
                                   name="guest_phone"
                                   class="form-control"
                                   value="{{ old('guest_phone') }}">
                        </div>

                        <button
                            id="checkinButton"
                            class="btn btn-warning btn-lg w-100 rounded-pill fw-semibold">
                            Check In Sekarang
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
