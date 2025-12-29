@extends('admin.layouts.master')

@section('page-title','Articles')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">New Article</a>
        </div>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $a)
                                <tr>
                                    <td>{{ $a->id }}</td>
                                    <td class="text-break">{{ $a->title }}</td>
                                    @php
                                        $pub = null;
                                        if (! empty($a->published_at)) {
                                            try {
                                                $pub = \Illuminate\Support\Carbon::parse($a->published_at);
                                            } catch (\Exception $e) {
                                                $pub = null;
                                            }
                                        }
                                    @endphp
                                    <td><small class="text-muted">{{ $pub ? $pub->format('d M Y') : '' }}</small></td>
                                    <td class="text-end">
                                        <a href="{{ route('blog.show', $a->slug) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                        <a href="{{ route('admin.articles.edit', $a) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete article?')">
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
        <div class="mt-3">{{ $articles->links() }}</div>
    </div>
@endsection
