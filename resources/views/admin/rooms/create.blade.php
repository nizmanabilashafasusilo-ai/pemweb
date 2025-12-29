@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create Room</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Main Image</label>
                            <input type="file" name="main_image" class="form-control" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp,image/svg+xml">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>

                    @if(isset($rooms) && $rooms->count())
                        <hr>
                        <h5 class="mt-3">Existing Rooms</h5>
                        <div class="table-responsive">
                            <table class="table table-sm mt-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->capacity ?? '-' }}</td>
                                            <td>{{ $room->price !== null ? number_format($room->price, 2) : '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mt-3">No rooms to display.</div>
                    @endif

                    <div class="mt-3"><a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-outline-secondary">&larr; Back to rooms</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
