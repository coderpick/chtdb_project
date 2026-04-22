@extends('admin.layouts.admin')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student Record')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Update Information for: <span
                                class="text-primary">{{ $student->name }}</span></h5>
                        <a href="{{ route('admin.student.show', $student->id) }}" class="btn btn-light btn-sm rounded-2">
                            <i class="bi bi-eye me-1"></i> View Details
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.student.update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Section: Basic Info -->
                                <div class="col-12">
                                    <h6 class="text-primary fw-bold border-bottom pb-2 mb-0">Basic Information</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-medium">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $student->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="gender" class="form-label fw-medium">Gender <span
                                            class="text-danger">*</span></label>
                                    <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="male"
                                            {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female"
                                            {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other"
                                            {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="phone" class="form-label fw-medium">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $student->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="father_name" class="form-label fw-medium">Father's Name</label>
                                    <input type="text" name="father_name" id="father_name" class="form-control"
                                        value="{{ old('father_name', $student->father_name) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="mother_name" class="form-label fw-medium">Mother's Name</label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control"
                                        value="{{ old('mother_name', $student->mother_name) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-medium">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $student->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Section: Assignment -->
                                <div class="col-12 mt-5">
                                    <h6 class="text-primary fw-bold border-bottom pb-2 mb-0">Location & Batch</h6>
                                </div>

                                <div class="col-md-4">
                                    <label for="district_id" class="form-label fw-medium">District <span
                                            class="text-danger">*</span></label>
                                    <select name="district_id" id="district_id"
                                        class="form-select @error('district_id') is-invalid @enderror" required>
                                        <option value="">Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id', $student->district_id) == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="upazila_id" class="form-label fw-medium">Upazila <span
                                            class="text-danger">*</span></label>
                                    <select name="upazila_id" id="upazila_id"
                                        class="form-select @error('upazila_id') is-invalid @enderror" required>
                                        <option value="">Select Upazila</option>
                                        @if ($student->upazila)
                                            <option value="{{ $student->upazila_id }}" selected>
                                                {{ $student->upazila->name }}</option>
                                        @endif
                                    </select>
                                    @error('upazila_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="batch_id" class="form-label fw-medium">Batch <span
                                            class="text-danger">*</span></label>
                                    <select name="batch_id" id="batch_id"
                                        class="form-select @error('batch_id') is-invalid @enderror" required>
                                        <option value="">Select Batch</option>
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}"
                                                @if ($student->batch_id == $batch->id) selected @endif>{{ $batch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('batch_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Section: Additional Details -->
                                <div class="col-12 mt-5">
                                    <h6 class="text-primary fw-bold border-bottom pb-2 mb-0">Additional Details</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="academic_qualification" class="form-label fw-medium">Academic
                                        Qualification</label>
                                    <input type="text" name="academic_qualification" id="academic_qualification"
                                        class="form-control"
                                        value="{{ old('academic_qualification', $student->academic_qualification) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="income_source" class="form-label fw-medium">Income Source</label>
                                    <input type="text" name="income_source" id="income_source" class="form-control"
                                        value="{{ old('income_source', $student->income_source) }}">
                                </div>

                                <div class="col-12">
                                    <label for="freelancer_profile_url" class="form-label fw-medium">Freelancer Profile
                                        URL</label>
                                    <input type="url" name="freelancer_profile_url" id="freelancer_profile_url"
                                        class="form-control"
                                        value="{{ old('freelancer_profile_url', $student->freelancer_profile_url) }}"
                                        placeholder="https://...">
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label fw-medium">Full Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $student->address) }}</textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-3">
                                            <i class="bi bi-check-circle me-2"></i> Save Changes
                                        </button>
                                        <a href="{{ route('admin.student_record') }}"
                                            class="btn btn-light px-4 py-2 rounded-3 border">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const districtSelect = document.getElementById('district_id');
            const upazilaSelect = document.getElementById('upazila_id');
            const batchSelect = document.getElementById('batch_id');

            const oldUpazilaId = "{{ old('upazila_id', $student->upazila_id) }}";
            const oldBatchId = "{{ old('batch_id', $student->batch_id) }}";

            function loadUpazilas(districtId, selectedId = null) {
                if (!districtId) return;
                fetch(`/admin/districts/${districtId}/upazilas`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '<option value="">Select Upazila</option>';
                        data.forEach(upazila => {
                            html +=
                                `<option value="${upazila.id}" ${upazila.id == selectedId ? 'selected' : ''}>${upazila.name}</option>`;
                        });
                        upazilaSelect.innerHTML = html;
                    });
            }

            function loadBatches(districtId, selectedId = null) {
                if (!districtId) return;
                fetch(`/admin/get-batches/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '<option value="">Select Batch</option>';
                        data.forEach(batch => {
                            html +=
                                `<option value="${batch.id}" ${batch.id == selectedId ? 'selected' : ''}>${batch.name}</option>`;
                        });
                        batchSelect.innerHTML = html;
                    });
            }

            districtSelect.addEventListener('change', function() {
                const districtId = this.value;
                upazilaSelect.innerHTML = '<option value="">Loading...</option>';
                batchSelect.innerHTML = '<option value="">Loading...</option>';
                loadUpazilas(districtId);
                loadBatches(districtId);
            });

            // Initialize if district is already selected (for validation errors or edit page)
            if (districtSelect.value) {
                loadUpazilas(districtSelect.value, oldUpazilaId);
                loadBatches(districtSelect.value, oldBatchId);
            }
        });
    </script>
@endpush
