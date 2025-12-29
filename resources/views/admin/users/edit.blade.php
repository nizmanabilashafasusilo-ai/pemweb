@extends('admin.layouts.master')

@section('page-title','Edit User')

@section('content')
    <div class="container-fluid">
        <h4>Edit User</h4>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label>Password (leave blank to keep)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select">
                    <option value="user" {{ ($user->role ?? '') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="staff" {{ ($user->role ?? '') === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="admin" {{ ($user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
