@extends('admin.layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);
    }
</style>
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.register.post') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Register as Admin</button>
        </div>
    </form>

    <div class="mt-3 text-center">
        <a href="{{ route('admin.login') }}">Already have an admin account? Login</a>
    </div>
@endsection
