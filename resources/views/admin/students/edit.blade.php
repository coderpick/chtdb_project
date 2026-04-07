@extends('admin.layouts.admin')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Update Student Profile</h5>
                <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <form action="{{ route('admin.students.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Name <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required
                            value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Email <span
                                class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required
                            value="{{ old('email', $user->email) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $user->studentProfile->phone ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="male"
                                {{ old('gender', $user->studentProfile->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female"
                                {{ old('gender', $user->studentProfile->gender ?? '') == 'female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="other"
                                {{ old('gender', $user->studentProfile->gender ?? '') == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">District</label>
                        <select name="district_id" id="district_id" class="form-select">
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district_id', $user->studentProfile->district_id ?? '') == $district->id ? 'selected' : '' }}>
                                    {{ $district->bn_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Upazila</label>
                        <select name="upazila_id" id="upazila_id" class="form-select">
                            <option value="">Select Upazila</option>
                            @foreach ($upazilas as $upazila)
                                <option value="{{ $upazila->id }}"
                                    {{ old('upazila_id', $user->studentProfile->upazila_id ?? '') == $upazila->id ? 'selected' : '' }}>
                                    {{ $upazila->bn_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Date of Birth</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="text" name="dob" id="dob" class="form-control border-start-0"
                                value="{{ old('dob', $user->studentProfile->dob ?? '') }}" placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        {{-- bio --}}
                        <label class="form-label fw-bold small text-uppercase text-muted">Bio</label>
                        <textarea name="bio" id="bio" class="form-control" rows="3">{{ old('bio', $user->studentProfile->bio ?? '') }}</textarea>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i> Update Student
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-light px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr
            flatpickr('#dob', {
                dateFormat: 'Y-m-d',
                maxDate: 'today'
            });

            // District change logic
            const districtSelect = document.getElementById('district_id');
            const upazilaSelect = document.getElementById('upazila_id');

            if (districtSelect && upazilaSelect) {
                districtSelect.addEventListener('change', function() {
                    const districtId = this.value;

                    // Clear upazila select
                    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';

                    if (districtId) {
                        fetch(`/admin/districts/${districtId}/upazilas`)
                            .then(response => {
                                if (!response.ok) throw new Error('Network error');
                                return response.json();
                            })
                            .then(data => {
                                let options = '<option value="">Select Upazila</option>';
                                data.forEach(upazila => {
                                    options +=
                                        `<option value="${upazila.id}">${upazila.bn_name}</option>`;
                                });
                                upazilaSelect.innerHTML = options;
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
@endpush
