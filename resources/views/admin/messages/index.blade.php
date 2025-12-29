@extends('admin.layouts.master')

@section('page-title','Messages')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr><th>#</th><th>When</th><th>From</th><th>Subject</th><th>Preview</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $m)
                                <tr class="{{ $m->read_at ? '' : 'table-warning' }}">
                                    <td>{{ $m->id }}</td>
                                    <td>{{ $m->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $m->name }}<br><small class="text-muted">{{ $m->email }} • {{ $m->phone }}</small></td>
                                    <td>{{ $m->subject }}</td>
                                    <td class="text-truncate" style="max-width:280px;">{{ Illuminate\Support\Str::limit($m->message, 120) }}</td>
                                    <td class="text-end">
                                        <div class="d-none d-md-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="m-0" onsubmit="return confirm('Delete message?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>

                                        <div class="d-inline-block d-md-none">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionsDropdownMessage{{ $m->id }}" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdownMessage{{ $m->id }}">
                                                    <li><a class="dropdown-item" href="{{ route('admin.messages.show', $m) }}">View</a></li>
                                                    <li>
                                                        <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="m-0 px-3 py-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete message?')">Delete</button>
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
        <div class="mt-3">{{ $messages->links() }}</div>
    </div>
@endsection
