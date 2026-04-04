@extends('admin.layouts.admin')

@section('title', 'Students')
@section('page-title', 'Manage Students')

@section('content')
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
                        <td>{{ $student->profile->district ?? '—' }}</td>
                        <td>{{ $student->training->course->name ?? '—' }}</td>
                        <td>
                            @if($student->training)
                                <span class="badge bg-success">{{ $student->training->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">No Training</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">No students found.</td></tr>
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
