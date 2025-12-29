@extends('admin.layouts.master')

@section('page-title','Analytics')

@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-12 col-md-3">
                <div class="card card-analytic small-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Orders</small>
                            <div class="h4 mb-0">{{ number_format($ordersCount ?? 0) }}</div>
                        </div>
                        <div class="text-success">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-analytic small-card">
                    <small class="text-muted">Users</small>
                    <div class="h4">{{ number_format($usersCount ?? 0) }}</div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-analytic small-card">
                    <small class="text-muted">Revenue ({{ now()->year }})</small>
                    <div class="h4">Rp {{ number_format($revenue ?? 0,2,',','.') }}</div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-8">
                <div class="kanban">
                    <h5>Sales dynamics</h5>
                    <canvas id="salesChart" height="140"></canvas>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="kanban mb-3">
                    <h6>Customer orders</h6>
            <ul class="list-unstyled mb-0">
                @forelse($recentOrders ?? [] as $o)
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <div>
                            <strong>{{ $o->guest_name }}</strong><br>
                            <small class="text-muted">{{ $o->guest_email }} • {{ $o->created_at->format('d.m.Y') }}</small>
                        </div>
                        <div class="text-end">
                            <div>Rp {{ number_format($o->total_price,0,',','.') }}</div>
                            <span class="badge mt-1 {{ $o->status === 'cancelled' ? 'bg-danger' : ($o->status === 'confirmed' ? 'bg-success' : 'bg-warning') }}">{{ ucfirst($o->status) }}</span>
                        </div>
                    </li>
                @empty
                    <li class="text-muted py-2">No recent orders</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

        <div class="row g-3 mt-3">
    <div class="col-12 col-lg-8">
        <div class="kanban">
            <h6>Overall User Activity</h6>
            <canvas id="activityChart" height="120"></canvas>
        </div>
    </div>
</div>
    </div>

@push('scripts')
<script>
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        const salesData = {!! json_encode($salesData ?? []) !!};
        new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{ label:'Sales', data: salesData, backgroundColor:'#4f46e5' }]
            }, options:{ responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
        });
    }

    const actCtx = document.getElementById('activityChart');
    if (actCtx) {
        const activityData = {!! json_encode($activityData ?? []) !!};
        new Chart(actCtx, {
            type:'line', data:{ labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], datasets:[{ label:'Bookings', data: activityData, borderColor:'#06b6d4', backgroundColor:'rgba(6,182,212,0.12)', fill:true }] }, options:{ plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
        });
    }
</script>
@endpush

@endsection
