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
                                <th></th>
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
                                        <div class="d-none d-md-flex gap-2 justify-content-end">
                                            <a href="{{ route('blog.show', $a->slug) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                            <a href="{{ route('admin.articles.edit', $a) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('admin.articles.destroy', $a) }}" method="POST" class="m-0" onsubmit="return confirm('Delete article?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>

                                        <div class="d-inline-block d-md-none">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionsDropdownArticle{{ $a->id }}" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdownArticle{{ $a->id }}">
                                                    <li><a class="dropdown-item" href="{{ route('blog.show', $a->slug) }}">View</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.articles.edit', $a) }}">Edit</a></li>
                                                    <li>
                                                        <form action="{{ route('admin.articles.destroy', $a) }}" method="POST" class="m-0 px-3 py-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete article?')">Delete</button>
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
        <div class="mt-3">{{ $articles->links() }}</div>
    </div>
@endsection
