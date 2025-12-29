@extends('admin.layouts.master')

@section('page-title','Users')

@section('content')
    <div class="container-fluid">
        <div class="mb-3 text-end">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
        </div>

        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role ?? 'user' }}</td>
                                <td>{{ $u->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete user?')">
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

        <div class="mt-3">{{ $users->links() }}</div>
    </div>
@endsection
