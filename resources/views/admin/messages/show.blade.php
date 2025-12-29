@extends('admin.layouts.master')

@section('page-title','Message Detail')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>{{ $message->subject ?? 'No subject' }}</h4>
                <p class="text-muted">From: {{ $message->name }} — {{ $message->email }} @if($message->phone) • {{ $message->phone }} @endif</p>
                <hr>
                <pre style="white-space:pre-wrap; word-break:break-word;">{{ $message->message }}</pre>
                <div class="mt-3">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete message?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
