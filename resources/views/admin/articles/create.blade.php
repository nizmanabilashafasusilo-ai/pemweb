@extends('admin.layouts.master')

@section('page-title','New Article')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label>Excerpt</label>
                <input name="excerpt" class="form-control" value="{{ old('excerpt') }}">
            </div>
            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" rows="10" class="form-control">{{ old('body') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Publish At</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
            </div>
            <button class="btn btn-primary">Publish</button>
        </form>
    </div>
@endsection
