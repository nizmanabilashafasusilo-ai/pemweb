@extends('admin.layouts.master')

@section('page-title','Service')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $service->name }}</p>
                <p><strong>Type:</strong> {{ $service->type }}</p>
                <p><strong>Price:</strong> Rp {{ number_format($service->price ?? 0,0,',','.') }}</p>
                <p><strong>Available:</strong> {{ $service->available ? 'Yes' : 'No' }}</p>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
