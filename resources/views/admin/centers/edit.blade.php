@extends('admin.layouts.admin')

@section('title', 'Edit Center')
@section('page-title', 'Edit Training Center')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.centers.update', $center) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Banner Image</label>
                @if($center->banner)
                    <div class="mb-2">
                        <img src="{{ asset($center->banner) }}" alt="Banner" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" name="banner" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current banner. Recommended size: 1200x400px. Max: 2MB.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Center Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $center->name) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">District</label>
                <select name="district_id" class="form-select" required>
                    <option value="" disabled>Select District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id', $center->district_id) == $district->id ? 'selected' : '' }}>
                            {{ $district->name }} ({{ $district->bn_name }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $center->address) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $center->phone) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $center->email) }}">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', $center->is_active) ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
            <button type="submit" class="btn btn-success">Update Center</button>
            <a href="{{ route('admin.centers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
