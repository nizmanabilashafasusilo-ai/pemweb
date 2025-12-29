@extends('admin.layouts.master')

@section('page-title','Edit Service')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.services.index') }}" class="btn btn-light text-dark" style="border:1px solid rgba(0,0,0,0.08);">Back to list</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" value="{{ old('type', $service->type) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $service->price) }}" step="0.01">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Available</label>
                            <select name="available" class="form-control">
                                <option value="1" {{ old('available', $service->available) == '1' ? 'selected' : ($service->available ? 'selected' : '') }}>Yes</option>
                                <option value="0" {{ old('available', $service->available) == '0' ? 'selected' : (!$service->available ? 'selected' : '') }}>No</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary me-2" type="button" onclick="location.href='{{ route('admin.services.index') }}'">Cancel</button>
                        <button class="btn btn-primary" type="submit">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
