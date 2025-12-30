@extends('admin.layouts.master')

@section('page-title', 'Edit Room')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Room</h4>

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $room->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $room->description) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $room->price) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}">
                            </div>
                            <div class="col-md-6 mb-3"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Main Image</label>
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
                                <div class="mb-2">
                                    <img src="{{ $url }}" alt="main" class="img-thumbnail" style="max-width:200px">
                                </div>
                            @endif
                            <input type="file" name="main_image" class="form-control" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp,image/svg+xml">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>

                    <hr>
                    <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" onsubmit="return confirm('Hapus kamar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
