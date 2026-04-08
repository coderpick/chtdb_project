@extends('admin.layouts.admin')

@section('title', 'Add Center')
@section('page-title', 'Add New Training Center')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.centers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Banner Image</label>
                <input type="file" name="banner" class="form-control" accept="image/*">
                <small class="text-muted">Recommended size: 1200x400px. Max: 2MB.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Center Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">District</label>
                <select name="district_id" class="form-select" required>
                    <option value="" disabled selected>Select District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }} ({{ $district->bn_name }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
            <button type="submit" class="btn btn-success">Create Center</button>
            <a href="{{ route('admin.centers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
