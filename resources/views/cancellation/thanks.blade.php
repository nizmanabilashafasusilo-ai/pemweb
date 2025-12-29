@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); min-height:70vh; display:flex; align-items:center; padding:60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="text-success bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0z"/>
                                <path d="M10.97 5.97a.235.235 0 0 0-.02-.022L7.477 9.417 5.384 7.323a.75.75 0 1 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.078-.02l3.5-4a.75.75 0 0 0-.412-1.002z"/>
                            </svg>
                        </div>
                        <h1 class="h3 mb-2">Terima Kasih</h1>
                        <p class="text-muted mb-4">Permintaan pembatalan Anda telah diterima. Tim kami akan meninjau permintaan dan menghubungi Anda melalui email.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
