@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title mb-3">Daftar Akun Baru</h2>

                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary btn-lg rounded-pill px-4">Daftar</button>
                            <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
