@extends('admin.layouts.admin')

@section('title', 'Edit Center')
@section('page-title', 'Edit Training Center')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.centers.update', $center) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Center Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $center->name) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">District</label>
                <input type="text" name="district" class="form-control" required value="{{ old('district', $center->district) }}">
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
