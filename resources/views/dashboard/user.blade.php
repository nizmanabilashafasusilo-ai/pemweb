@extends('layouts.app')

@section('content')
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%); padding:40px 0;">
    <div class="container">
        <h1 class="mb-4">Dashboard Reservasi</h1>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Booking</h5>
                <div class="display-6">{{ $total }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Confirmed</h5>
                <div class="display-6 text-success">{{ $confirmed }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Cancelled</h5>
                <div class="display-6 text-danger">{{ $cancelled }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Upcoming</h5>
                <div class="display-6 text-primary">{{ $upcoming }}</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tren Bulanan (6 bulan terakhir)</h5>
                    <canvas id="bookingsChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card p-3 text-center">
                <h5>Okupansi (estimasi 30 hari)</h5>
                <div class="display-4">{{ $occupancyRate }}%</div>
                <canvas id="occupancyDonut" height="140"></canvas>
            </div>
        </div>
    </div>

    </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = {!! json_encode($months) !!};
    const bookings = {!! json_encode($bookingCounts) !!};
    const cancellations = {!! json_encode($cancellationCounts) !!};

    const ctx = document.getElementById('bookingsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Bookings',
                    data: bookings,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.05)',
                    tension: 0.3
                },
                {
                    label: 'Cancellations',
                    data: cancellations,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220,53,69,0.05)',
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } }
        }
    });

    const occCtx = document.getElementById('occupancyDonut').getContext('2d');
    new Chart(occCtx, {
        type: 'doughnut',
        data: {
            labels: ['Occupied', 'Available'],
            datasets: [{
                data: [{{ $occupancyRate }}, 100 - {{ $occupancyRate }}],
                backgroundColor: ['#198754', '#e9ecef']
            }]
        },
        options: { cutout: '70%' }
    });
</script>

@endsection
