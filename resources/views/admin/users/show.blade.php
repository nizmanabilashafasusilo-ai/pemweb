@extends('admin.layouts.master')

@section('page-title','User')

@section('content')
    <div class="container-fluid">
        <h4>User Details</h4>
        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
