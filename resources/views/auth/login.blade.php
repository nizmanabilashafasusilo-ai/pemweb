@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);
    }
</style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="card-title mb-3">Masuk ke akun Anda</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">{!! nl2br(e($errors->first())) !!}</div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary btn-lg rounded-pill px-4">Masuk</button>
                            <a href="{{ route('register') }}" class="text-decoration-none">Belum punya akun? Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
