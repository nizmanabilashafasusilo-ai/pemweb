@extends('admin.layouts.master')

@section('page-title','Cancellation')

@section('content')
    <div class="container-fluid">
        <h4>Cancellation #{{ $cancellation->id }}</h4>
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Booking:</strong> {{ $cancellation->booking_id }} — {{ optional($cancellation->booking)->guest_name }}</p>
                <p><strong>Email:</strong> {{ $cancellation->guest_email }}</p>
                <p><strong>Reason:</strong><br>{{ $cancellation->reason }}</p>
                <p><strong>Requested:</strong> {{ $cancellation->requested_at }}</p>
                <p><strong>Status:</strong> {{ ucfirst($cancellation->status) }}</p>
            </div>
            <div class="card-footer text-end">
                @if($cancellation->status === 'pending')
                    <form action="{{ route('admin.cancellations.approve', $cancellation) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.cancellations.reject', $cancellation) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger">Reject</button>
                    </form>
                @endif
                <a href="{{ route('admin.cancellations.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
