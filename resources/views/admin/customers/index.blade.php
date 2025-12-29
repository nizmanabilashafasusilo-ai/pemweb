@extends('admin.layouts.master')

@section('page-title','Customers')

@section('content')
<div class="container-fluid">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <form class="d-flex" method="GET">
            <input name="q" class="form-control form-control-sm me-2" placeholder="Search name / email / phone" value="{{ request('q') }}">
            <button class="btn btn-sm btn-primary">Search</button>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
        </form>
    </div>

    @if($customers->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Bookings</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($customers as $c)
                    <tr>
                        <td class="text-break"><small class="text-muted">{{ $c->id }}</small></td>
                        <td class="text-break">{{ $c->guest_name ?? ($c->name ?? '—') }}</td>
                        <td>{{ $c->guest_phone ?? '—' }}</td>
                        <td>{{ $c->bookings_count ?? 0 }}</td>
                        <td class="text-end"><a href="{{ route('admin.customers.show', $c->id) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $customers->links() }}</div>
    @else
        <div class="alert alert-info">No customers yet.</div>
    @endif
</div>
@endsection
