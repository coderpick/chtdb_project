@extends('admin.layouts.admin')

@section('title', 'Students')
@section('page-title', 'Manage Students')

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
    </style>
@endpush

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Filter Students</h5>
            <form action="{{ route('admin.students.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small text-uppercase fw-bold text-muted">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Name or Email..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-uppercase fw-bold text-muted">District</label>
                    <select name="district_id" id="filter_district_id" class="form-select select2">
                        <option value="">All Districts</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                {{ $district->bn_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-uppercase fw-bold text-muted">Upazila</label>
                    <select name="upazila_id" id="filter_upazila_id" class="form-select select2">
                        <option value="">All Upazilas</option>
                        @if (request('district_id'))
                            @foreach (\App\Models\Upazila::where('district_id', request('district_id'))->get() as $upazila)
                                <option value="{{ $upazila->id }}"
                                    {{ request('upazila_id') == $upazila->id ? 'selected' : '' }}>
                                    {{ $upazila->bn_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-uppercase fw-bold text-muted">Course</label>
                    <select name="course_id" class="form-select select2">
                        <option value="">All Courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    @if (request()->anyFilled(['search', 'district_id', 'upazila_id', 'course_id']))
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->studentProfile->district->bn_name ?? '—' }}</td>
                                <td>{{ $student->studentProfile->upazila->bn_name ?? '—' }}</td>
                                <td>{{ $student->training->course->name ?? '—' }}</td>
                                <td>
                                    @if ($student->training)
                                        <span class="badge bg-success">{{ $student->training->status }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">No Training</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.students.show', $student) }}"
                                        class="btn btn-sm btn-outline-info">View</a>
                                    <a href="{{ route('admin.students.edit', $student) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $students->links() }}
            </div>
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
                width: '100%'
            });

            // Live Search (auto-submit on typing)
            let searchTimer;
            $('input[name="search"]').on('keyup', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    $(this).closest('form').submit();
                }, 500);
            });

            // Auto-submit on select change
            $('.select2').on('change', function() {
                $(this).closest('form').submit();
            });

            // Dynamic Upazila Loading for Filter
            $('#filter_district_id').on('change', function() {
                const districtId = this.value;
                const upazilaSelect = document.getElementById('filter_upazila_id');

                upazilaSelect.innerHTML = '<option value="">All Upazilas</option>';

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
