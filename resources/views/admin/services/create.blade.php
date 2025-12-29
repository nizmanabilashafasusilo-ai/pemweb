@extends('admin.layouts.master')

@section('page-title','Create Service')

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
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control form-control-sm" value="{{ old('price',0) }}" step="0.01">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Type</label>
                                <input type="text" name="type" class="form-control form-control-sm" value="{{ old('type') }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Available</label>
                                <select name="available" class="form-select form-select-sm">
                                    <option value="1" {{ old('available','1') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-outline-secondary me-2" type="button" onclick="location.href='{{ route('admin.services.index') }}'">Cancel</button>
                        <button class="btn btn-primary" type="submit">Create Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
