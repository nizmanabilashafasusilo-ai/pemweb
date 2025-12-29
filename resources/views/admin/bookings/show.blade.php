@extends('admin.layouts.master')

@section('page-title','Booking Detail')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Booking Detail</h3>

                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

                        <dl class="row mb-3">
                            <dt class="col-sm-4 text-muted">Guest</dt>
                            <dd class="col-sm-8">{{ $booking->guest_name }} <small class="text-muted">({{ $booking->guest_email }})</small></dd>

                            <dt class="col-sm-4 text-muted">Room</dt>
                            <dd class="col-sm-8">{{ $booking->room->name ?? '—' }}</dd>

                            <dt class="col-sm-4 text-muted">Check-in</dt>
                            <dd class="col-sm-8">{{ $booking->check_in_date->format('Y-m-d') }}</dd>

                            <dt class="col-sm-4 text-muted">Check-out</dt>
                            <dd class="col-sm-8">{{ $booking->check_out_date->format('Y-m-d') }}</dd>

                            <dt class="col-sm-4 text-muted">Status</dt>
                            <dd class="col-sm-8"><span class="badge bg-info text-dark">{{ ucfirst($booking->status) }}</span></dd>
                        </dl>

                        <div class="mb-3">
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="d-inline" onsubmit="return confirm('Batalkan booking ini?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="cancel">
                                <button type="submit" class="btn btn-danger btn-sm" aria-label="Batalkan booking">Batalkan Booking</button>
                            </form>
                        </div>

                        <hr>
                        <h5 class="mb-3">Reschedule</h5>
                        <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="reschedule">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-in</label>
                                    <input type="date" name="check_in_date" class="form-control" value="{{ $booking->check_in_date->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-out</label>
                                    <input type="date" name="check_out_date" class="form-control" value="{{ $booking->check_out_date->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Reschedule</button>
                            </div>
                        </form>

                        <div class="mt-3">
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                                &larr;&nbsp;Kembali ke bookings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
