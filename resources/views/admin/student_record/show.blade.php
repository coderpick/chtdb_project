@extends('admin.layouts.admin')

@section('title', 'Student Details')
@section('page-title', 'Student Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Info Card -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Personal Information</h5>
                        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-primary btn-sm rounded-3">
                            <i class="bi bi-pencil me-1"></i> Edit Record
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Full Name</label>
                                <p class="fs-5 fw-bold text-dark mb-0">{{ $student->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Gender</label>
                                <p class="text-dark mb-0">{{ ucfirst($student->gender) }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Father's Name</label>
                                <p class="text-dark mb-0">{{ $student->father_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Mother's Name</label>
                                <p class="text-dark mb-0">{{ $student->mother_name }}</p>
                            </div>
                            <div class="col-12">
                                <hr class="my-2 opacity-10">
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Phone Number</label>
                                <p class="text-dark mb-0">
                                    <a href="tel:{{ $student->phone }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-telephone me-1 text-primary"></i> {{ $student->phone }}
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Email Address</label>
                                <p class="text-dark mb-0">
                                    <a href="mailto:{{ $student->email }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-envelope me-1 text-primary"></i> {{ $student->email }}
                                    </a>
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Permanent
                                    Address</label>
                                <p class="text-dark mb-0">{{ $student->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Academic & Professional</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Academic
                                    Qualification</label>
                                <p class="text-dark mb-0">{{ $student->academic_qualification ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Income Source</label>
                                <p class="text-dark mb-0">{{ $student->income_source ?? 'N/A' }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-secondary small text-uppercase fw-semibold mb-1">Freelancer Profile
                                    URL</label>
                                <p class="mb-0">
                                    @if ($student->getFreelancerUrl())
                                        <a href="{{ $student->getFreelancerUrl() }}" target="_blank"
                                            class="text-primary text-decoration-none">
                                            <i class="bi bi-link-45deg me-1"></i> {{ $student->freelancer_profile_url }}
                                        </a>
                                    @else
                                        <span class="text-muted">Not Provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="bg-primary py-5 text-center">
                        <div class="avatar-lg bg-white bg-opacity-25 text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                            @if ($student->profile_photo)
                                <img src="{{ asset($student->profile_photo) }}"
                                    class="rounded-circle w-100 h-100 object-fit-cover">
                            @else
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            @endif
                        </div>
                        <h5 class="text-white mb-0 fw-bold">{{ $student->name }}</h5>
                        <p class="text-white text-opacity-75 small mb-0">Student ID: #{{ $student->id }}</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="text-secondary small text-uppercase fw-semibold d-block mb-1">Assigned
                                Batch</label>
                            <span
                                class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-medium w-100 text-start">
                                <i class="bi bi-mortarboard me-2"></i> {{ $student->batch->name ?? 'Unassigned' }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="text-secondary small text-uppercase fw-semibold d-block mb-1">District</label>
                            <p class="text-dark mb-0 fw-medium">
                                <i class="bi bi-geo-alt me-2 text-primary"></i> {{ $student->district->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="mb-0">
                            <label class="text-secondary small text-uppercase fw-semibold d-block mb-1">Upazila</label>
                            <p class="text-dark mb-0 fw-medium">
                                <i class="bi bi-geo me-2 text-primary"></i> {{ $student->upazila->name ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 text-center py-3">
                        <a href="{{ route('admin.student_record') }}"
                            class="btn btn-link text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Back to Student List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
