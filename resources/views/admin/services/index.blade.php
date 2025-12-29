@extends('admin.layouts.master')

@section('page-title','Services')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">New Service</a>
        </div>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td class="text-break">{{ $s->name }}</td>
                                    <td>{{ $s->type }}</td>
                                    <td>Rp {{ number_format($s->price ?? 0,0,',','.') }}</td>
                                    <td>{{ $s->available ? 'Yes' : 'No' }}</td>
                                    <td class="text-end">
                                        <div class="d-none d-md-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.services.show', $s) }}" class="btn btn-sm btn-outline-secondary">Show</a>
                                            <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('admin.services.destroy', $s) }}" method="POST" class="m-0" onsubmit="return confirm('Delete service?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>

                                        <div class="d-inline-block d-md-none">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionsDropdownService{{ $s->id }}" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdownService{{ $s->id }}">
                                                    <li><a class="dropdown-item" href="{{ route('admin.services.show', $s) }}">Show</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.services.edit', $s) }}">Edit</a></li>
                                                    <li>
                                                        <form action="{{ route('admin.services.destroy', $s) }}" method="POST" class="m-0 px-3 py-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete service?')">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">{{ $services->links() }}</div>
    </div>
@endsection
