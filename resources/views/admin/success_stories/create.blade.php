@extends('admin.layouts.admin')

@section('title', 'Add Success Story')
@section('page-title', 'Add New Success Story')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 8px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        .status-radio-group .btn-check:checked+.btn-outline-success {
            background-color: #198754;
            color: white;
        }

        .status-radio-group .btn-check:checked+.btn-outline-warning {
            background-color: #ffc107;
            color: black;
        }

        .status-radio-group .btn-check:checked+.btn-outline-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.success-stories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Student <span class="text-danger">*</span></label>
                    <select name="user_id" class="form-select select2 @error('user_id') is-invalid @enderror" required>
                        <option value="">Search Student...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name ?? 'Unknown' }} ({{ $user->email ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">District <span class="text-danger">*</span></label>
                        <select name="district_id" id="district_id"
                            class="form-select @error('district_id') is-invalid @enderror" required>
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                    {{ $district->bn_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Upazila</label>
                        <select name="upazila_id" id="upazila_id"
                            class="form-select @error('upazila_id') is-invalid @enderror">
                            <option value="">Select Upazila</option>
                        </select>
                        @error('upazila_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Story Text <span class="text-danger">*</span></label>
                    <textarea name="story_text" rows="5" class="form-control @error('story_text') is-invalid @enderror" required>{{ old('story_text') }}</textarea>
                    @error('story_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label d-block text-secondary fw-bold small text-uppercase mb-3">Status <span
                            class="text-danger">*</span></label>
                    <div class="btn-group status-radio-group w-100" role="group">
                        <input type="radio" class="btn-check" name="status" id="statusPending" value="pending"
                            {{ old('status', 'pending') == 'pending' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-warning py-2" for="statusPending">
                            <i class="bi bi-clock-history me-1"></i> Pending
                        </label>

                        <input type="radio" class="btn-check" name="status" id="statusApproved" value="approved"
                            {{ old('status') == 'approved' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success py-2" for="statusApproved">
                            <i class="bi bi-check-circle me-1"></i> Approved
                        </label>

                        <input type="radio" class="btn-check" name="status" id="statusRejected" value="rejected"
                            {{ old('status') == 'rejected' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger py-2" for="statusRejected">
                            <i class="bi bi-x-circle me-1"></i> Rejected
                        </label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.success-stories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Add Success Story</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Search Student...",
                allowClear: true,
                width: '100%'
            });

            // District change logic
            $('#district_id').on('change', function() {
                const districtId = this.value;
                const upazilaSelect = document.getElementById('upazila_id');

                upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';

                if (districtId) {
                    fetch(`/admin/districts/${districtId}/upazilas`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(upazila => {
                                const option = document.createElement('option');
                                option.value = upazila.id;
                                option.textContent = upazila.bn_name;
                                upazilaSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
@endpush
