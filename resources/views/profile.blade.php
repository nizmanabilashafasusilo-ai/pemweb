@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); padding:60px 0;">
    <div class="container">
    <h2 class="mb-4">Profil Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Informasi Pribadi</h5>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}">
                            @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Riwayat Reservasi</h5>
                    <p>Lihat riwayat reservasi dan status pembatalan Anda.</p>
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary">Lihat Reservasi Saya</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
