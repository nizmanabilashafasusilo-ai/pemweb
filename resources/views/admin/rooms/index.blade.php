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
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Capacity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td style="width:100px">
                            @if($room->main_image)
                                @php
                                    $img = $room->main_image;
                                    if (preg_match('/^https?:\/\//', $img)) {
                                        $url = $img;
                                    } elseif (preg_match('/^(storage\/|images\/|\/)/', $img)) {
                                        $url = asset($img);
                                    } else {
                                        $url = \Illuminate\Support\Facades\Storage::url($img);
                                    }
                                @endphp
                                <img src="{{ $url }}" alt="thumb" style="max-width:80px;max-height:60px;object-fit:cover;border-radius:6px">
                            @else
                                <div class="text-muted small">-</div>
                            @endif
                        </td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>
                            <!-- Inline buttons on md+ screens -->
                            <div class="d-none d-md-flex gap-2">
                                <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kamar ini?')">Delete</button>
                                </form>
                            </div>

                            <!-- Compact dropdown on small screens -->
                            <div class="d-inline-block d-md-none">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionsDropdown{{ $room->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdown{{ $room->id }}">
                                        <li><a class="dropdown-item" href="{{ route('admin.rooms.show', $room) }}">View</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.rooms.edit', $room) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="m-0 px-3 py-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Hapus kamar ini?')">Delete</button>
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

        <div class="mt-3">{{ $rooms->links() }}</div>
    @else
        <div class="alert alert-info">Tidak ada kamar.</div>
    @endif

</div>
@endsection
