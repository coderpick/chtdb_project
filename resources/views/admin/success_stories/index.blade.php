@extends('admin.layouts.admin')

@section('title', 'Manage Success Stories')
@section('page-title', 'Manage Success Stories')

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
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">All Success Stories</h5>
                <a href="{{ route('admin.success-stories.create') }}" class="btn btn-success">
                    <i class="bi bi-plus"></i> Add Success Story
                </a>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('admin.success-stories.index') }}" method="GET" class="bg-light p-3 rounded-4 mb-2">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small text-uppercase fw-bold text-muted">Student Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Search by name..." value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-uppercase fw-bold text-muted">District</label>
                        <select name="district_id" id="filter_district_id" class="form-select select2">
                            <option value="">All Districts</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                    {{ $district->bn_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-uppercase fw-bold text-muted">Upazila</label>
                        <select name="upazila_id" id="filter_upazila_id" class="form-select select2">
                            <option value="">All Upazilas</option>
                            @if(request('district_id'))
                                @foreach(\App\Models\Upazila::where('district_id', request('district_id'))->get() as $upazila)
                                    <option value="{{ $upazila->id }}" {{ request('upazila_id') == $upazila->id ? 'selected' : '' }}>
                                        {{ $upazila->bn_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request()->anyFilled(['name', 'district_id', 'upazila_id']))
                            <a href="{{ route('admin.success-stories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Location/Center</th>
                            <th>Story</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($successStories as $story)
                            <tr>
                                <td>{{ $story->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($story->user->studentProfile && $story->user->studentProfile->photo)
                                            <img src="{{ asset($story->user->studentProfile->photo) }}" alt="Photo"
                                                class="rounded-circle me-2"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center text-white"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $story->user->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $story->career->designation ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $story->district->name ?? 'N/A' }}
                                    <br>
                                    <small class="text-muted">{{ $story->upazila->name ?? '' }}</small>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#storyModal" data-story="{{ $story->story_text }}"
                                        data-student="{{ $story->user->name }}">
                                        <i class="bi bi-journal-text"></i> View Story
                                    </button>
                                </td>
                                <td>
                                    @if ($story->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($story->status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.success-stories.edit', $story->id) }}"
                                        class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                    @if ($story->status !== 'approved')
                                        <form action="{{ route('admin.success-stories.approve', $story->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i
                                                    class="bi bi-check-circle"></i></button>
                                        </form>
                                    @endif
                                    @if ($story->status !== 'rejected')
                                        <form action="{{ route('admin.success-stories.reject', $story->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-warning"><i
                                                    class="bi bi-x-circle"></i></button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.success-stories.destroy', $story->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this success story?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No success stories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $successStories->links() }}
            </div>
        </div>
    </div>

    <!-- Modal for Viewing Story -->
    <div class="modal fade" id="storyModal" tabindex="-1" aria-labelledby="storyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="storyModalLabel">Success Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalStudentName" class="text-muted mb-3 fw-bold"></p>
                    <div id="modalStoryText" class="p-3 bg-light rounded" style="white-space: pre-wrap;"></div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 8px;">Close</button>
                </div>
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

            // Modal for Viewing Story
            const storyModal = document.getElementById('storyModal');
            if (storyModal) {
                storyModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    const story = button.getAttribute('data-story');
                    const student = button.getAttribute('data-student');

                    const modalStudent = storyModal.querySelector('#modalStudentName');
                    const modalBody = storyModal.querySelector('#modalStoryText');

                    modalStudent.textContent = "Student: " + student;
                    modalBody.textContent = story;
                });
            }
        });
    </script>
@endpush
