@extends('admin.layouts.master')

@section('page-title', 'Room Preview')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Room Preview</h4>

                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="form-control-plaintext">{{ $room->name }}</div>
                    </div>

                    @if($room->main_image)
                        @php
                            $img = $room->main_image;
                            if (preg_match('/^https?:\/\//', $img)) {
                                $url = $img;
                            } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                                $url = asset($img);
                            } else {
                                $url = \Illuminate\Support\Facades\Storage::url($img);
                            }
                        @endphp
                        <div class="mb-3 text-center">
                            <img src="{{ $url }}" alt="main" class="img-fluid" style="max-height:320px;object-fit:cover;border-radius:8px">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div class="form-control-plaintext">{!! nl2br(e($room->description)) !!}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <div class="form-control-plaintext">{{ $room->price !== null ? number_format($room->price, 2) : '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Capacity</label>
                            <div class="form-control-plaintext">{{ $room->capacity ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
