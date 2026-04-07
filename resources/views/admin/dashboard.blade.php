@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <h6 class="text-muted mb-1">Total Students</h6>
            <h3>{{ $stats['students'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h6 class="text-muted mb-1">Total Courses</h6>
            <h3>{{ $stats['courses'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h6 class="text-muted mb-1">Training Centers</h6>
            <h3>{{ $stats['centers'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <h6 class="text-muted mb-1">Success Stories</h6>
            <h3>{{ $stats['success_stories'] ?? 0 }}</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card p-3">
            <h6 class="mb-3">Recent Students</h6>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>District</th>
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentStudents as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->studentProfile->district->name ?? '-' }}</td>
                            <td>{{ $student->training->course->name ?? '-' }}</td>
                            <td>
                                @if($student->training)
                                    <span class="badge bg-success">{{ $student->training->status }}</span>
                                @else
                                    <span class="badge bg-warning">No Training</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-primary">View All Students</a>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="fw-bold"><i class="bi bi-lightning-charge text-warning"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-primary"><i class="bi bi-plus"></i> Add Course</a>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-info"><i class="bi bi-search"></i> Find Student</a>
                    <a href="{{ route('admin.centers.create') }}" class="btn btn-outline-warning"><i class="bi bi-geo-alt"></i> Add Center</a>
                    <a href="{{ route('admin.success-stories.create') }}" class="btn btn-outline-success"><i class="bi bi-plus"></i> Add Success Story</a>
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-outline-secondary"><i class="bi bi-image"></i> Upload Photo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
