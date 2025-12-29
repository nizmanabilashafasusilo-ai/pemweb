@extends('admin.layouts.master')

@section('page-title','Cancellations')

@section('content')
    <div class="container-fluid">
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking</th>
                                <th>Email</th>
                                <th>Requested</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cancellations as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td class="text-break">{{ $c->booking_id }}<br><small class="text-muted">{{ optional($c->booking)->guest_name }}</small></td>
                                    <td>{{ $c->guest_email }}</td>
                                    <td><small class="text-muted">{{ $c->requested_at->format('d M Y H:i') }}</small></td>
                                    <td><span class="badge bg-secondary">{{ ucfirst($c->status) }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.cancellations.show', $c) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">{{ $cancellations->links() }}</div>
    </div>
@endsection
