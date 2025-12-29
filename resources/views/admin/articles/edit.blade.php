@extends('admin.layouts.master')

@section('page-title','Edit Article')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Title</label>
                <input name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
            </div>
            <div class="mb-3">
                <label>Excerpt</label>
                <input name="excerpt" class="form-control" value="{{ old('excerpt', $article->excerpt) }}">
            </div>
            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" rows="10" class="form-control">{{ old('body', $article->body) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Publish At</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ optional($article->published_at)->format('Y-m-d\TH:i') }}">
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
