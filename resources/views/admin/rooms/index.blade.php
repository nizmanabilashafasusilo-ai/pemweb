@extends('admin.layouts.master')

@section('page-title','Rooms')

@section('content')
<div class="container">
    <p><a href="{{ route('admin.rooms.create') }}" class="btn btn-sm btn-primary">Create New Room</a></p>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    @if(isset($rooms) && $rooms->count())
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Capacity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>
                            <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kamar ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $rooms->links() }}</div>
    @else
        <div class="alert alert-info">Tidak ada kamar.</div>
    @endif

</div>
@endsection
