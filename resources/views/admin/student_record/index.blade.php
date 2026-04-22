@extends('admin.layouts.admin')

@section('title', 'Student Records')
@section('page-title', 'Student Records List')

@section('content')
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.student_record') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="name" class="form-label fw-medium text-secondary">Student Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="name" id="name"
                                class="form-control bg-light border-start-0 ps-0" placeholder="Search by name..."
                                value="{{ request('name') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="district_id" class="form-label fw-medium text-secondary">District</label>
                        <select name="district_id" id="district_id" class="form-select bg-light">
                            <option value="">All Districts</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="batch_id" class="form-label fw-medium text-secondary">Batch</label>
                        <select name="batch_id" id="batch_id" class="form-select bg-light">
                            <option value="">All Batches</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1 rounded-3 fw-semibold">
                            <i class="bi bi-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.student_record') }}" class="btn btn-warning rounded-3 px-3"
                            title="Clear Filters">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Students <span
                        class="badge bg-primary-subtle text-primary ms-2 rounded-pill fw-medium fs-6">{{ $students->total() }}
                        total</span></h5>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-secondary fw-semibold">Student Name</th>
                                <th class="py-3 text-secondary fw-semibold">Batch</th>
                                <th class="py-3 text-secondary fw-semibold">District</th>
                                <th class="py-3 text-secondary fw-semibold">Phone</th>
                                <th class="py-3 text-secondary fw-semibold">Email</th>
                                <th class="pe-4 py-3 text-end text-secondary fw-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 38px; height: 38px;">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $student->name }}</div>
                                                <small class="text-muted">{{ $student->gender }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info px-2 py-1 rounded-pill fw-medium">
                                            {{ $student->batch->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark">{{ $student->district->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $student->upazila->name ?? '' }}</small>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $student->phone }}" class="text-decoration-none text-dark">
                                            <i class="bi bi-telephone text-muted me-1"></i> {{ $student->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $student->email }}" class="text-decoration-none text-dark">
                                            <i class="bi bi-envelope text-muted me-1"></i> {{ $student->email }}
                                        </a>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-circle border-0" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a class="dropdown-item py-2"
                                                        href="{{ route('admin.student.show', $student->id) }}">
                                                        <i class="bi bi-eye me-2 text-primary"></i> View Details
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item py-2"
                                                        href="{{ route('admin.student.edit', $student->id) }}">
                                                        <i class="bi bi-pencil me-2 text-info"></i> Edit
                                                    </a>
                                                </li>
                                                {{-- <li>
                                                    <hr class="dropdown-divider">
                                                </li> --}}
                                                {{-- <li>
                                                    <form action="#" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item py-2 text-danger"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <i class="bi bi-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people fs-1 d-block mb-3 opacity-25"></i>
                                        No student records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($students->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of
                            {{ $students->total() }} results
                        </div>
                        <div>
                            {{ $students->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .avatar-sm {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .table thead th {
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .pagination {
            margin-bottom: 0;
        }

        .dropdown-item {
            font-size: 0.9rem;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const districtSelect = document.getElementById('district_id');
            const batchSelect = document.getElementById('batch_id');
            const selectedBatch = "{{ request('batch_id') }}";

            function loadBatches(districtId) {
                if (!districtId) {
                    batchSelect.innerHTML = '<option value="">All Batches</option>';
                    return;
                }

                // Show loading state
                batchSelect.innerHTML = '<option value="">Loading...</option>';

                const url = "{{ route('admin.get.batches', ['district_id' => ':id']) }}".replace(':id', districtId);

                fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    let html = '<option value="">All Batches</option>';
                    data.forEach(batch => {
                        const selected = batch.id == selectedBatch ? 'selected' : '';
                        html += `<option value="${batch.id}" ${selected}>${batch.name}</option>`;
                    });
                    batchSelect.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching batches:', error);
                    batchSelect.innerHTML = '<option value="">Error loading batches</option>';
                });
            }

            // Load batches on district change
            districtSelect.addEventListener('change', function() {
                loadBatches(this.value);
            });

            // Initial load if district is already selected
            if (districtSelect.value) {
                loadBatches(districtSelect.value);
            }

            // Name search with delay (debounce)
            const nameInput = document.getElementById('name');
            const filterForm = nameInput.closest('form');
            let typingTimer;
            const doneTypingInterval = 500; // 500ms delay

            nameInput.addEventListener('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    filterForm.submit();
                }, doneTypingInterval);
            });

            // Prevent submission on every keydown (like Enter) if already handled by timer,
            // but usually Enter should submit immediately.
            nameInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    clearTimeout(typingTimer);
                }
            });
        });
    </script>
@endpush
