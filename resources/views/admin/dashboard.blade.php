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
            <h6 class="text-muted mb-1">Testimonials</h6>
            <h3>{{ $stats['testimonials'] ?? 0 }}</h3>
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
                            <td>{{ $student->profile->district ?? '-' }}</td>
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
        <div class="card p-3">
            <h6 class="mb-3">Quick Links</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-success"><i class="bi bi-plus"></i> Add Course</a>
                <a href="{{ route('admin.centers.create') }}" class="btn btn-outline-success"><i class="bi bi-plus"></i> Add Training Center</a>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-success"><i class="bi bi-plus"></i> Add Testimonial</a>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-outline-success"><i class="bi bi-plus"></i> Upload Gallery Image</a>
            </div>
        </div>
    </div>
</div>
@endsection
