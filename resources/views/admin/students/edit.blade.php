@extends('admin.layouts.admin')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.students.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>
            <h6 class="mt-4">Profile</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->profile->phone ?? '') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <input type="text" name="gender" class="form-control" value="{{ old('gender', $user->profile->gender ?? '') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">District</label>
                    <input type="text" name="district" class="form-control" value="{{ old('district', $user->profile->district ?? '') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Upazila</label>
                    <input type="text" name="upazila" class="form-control" value="{{ old('upazila', $user->profile->upazila ?? '') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->profile->dob ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Student</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
