@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); padding:60px 0;">
    <div class="container">
    <h2 class="mb-4">Reservasi Saya</h2>

    {{-- Infografis / Rekap singkat --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Reservasi</h6>
                    <div class="h3">{{ $total ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h6 class="text-muted">Terkonfirmasi</h6>
                    <div class="h3 text-success">{{ $confirmed ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <h6 class="text-muted">Pembatalan</h6>
                    <div class="h3 text-danger">{{ $cancelled ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h6 class="text-muted">Upcoming</h6>
                    <div class="h3 text-primary">{{ $upcoming ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik ringkasan (6 bulan terakhir) --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Grafik Reservasi (6 bulan terakhir)</h5>
                    <canvas id="bookingChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    @if($bookings->isEmpty())
        <div class="alert alert-info">Anda belum memiliki reservasi.</div>
    @else
        <div class="row">
            @foreach($bookings as $b)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $b->room->name ?? 'Kamar' }} <span class="badge bg-secondary">{{ ucfirst($b->status) }}</span></h5>
                            <p class="mb-1"><strong>Tamu:</strong> {{ $b->guest_name }}</p>
                            <p class="mb-1"><strong>Telepon:</strong> {{ $b->guest_phone ?? '-' }}</p>

                            <a href="{{ route('bookings.show', $b->id) }}" class="btn btn-primary btn-sm mt-2">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const ctx = document.getElementById('bookingChart');
        if(!ctx) return;
        const months = {!! json_encode($months ?? []) !!};
        const counts = {!! json_encode($monthCounts ?? []) !!};
        new Chart(ctx, {
            type: 'bar',
            data: { labels: months, datasets: [{ label: 'Reservasi dibuat', data: counts, backgroundColor: '#469595' }] },
            options: { responsive: true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
        });
    });
</script>
@endpush
