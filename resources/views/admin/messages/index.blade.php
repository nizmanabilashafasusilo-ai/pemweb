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
                                        <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete message?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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
