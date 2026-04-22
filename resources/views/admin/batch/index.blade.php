@extends('admin.layouts.admin')

@section('title', 'Batches')
@section('page-title', 'Manage Batches')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">All Batches</h6>
                <a href="{{ route('admin.batch.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus"></i> Add
                    Batch</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Center</th>
                            <th>Enrollment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($batches as $batch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $batch->name }}</td>
                                <td>{{ $batch->shift }}</td>
                                <td>{{ $batch->center->name ?? '' }}</td>
                                <td>{{ $batch->enrolled_count }} / {{ $batch->capacity ?? 'N/A' }}</td>
                                <td>
                                    @if ($batch->status == 'upcoming')
                                        <span class="badge bg-secondary">Upcoming</span>
                                    @elseif ($batch->status == 'ongoing')
                                        <span class="badge bg-info">Ongoing</span>
                                    @else
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.batch.edit', $batch->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.batch.destroy', $batch->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

