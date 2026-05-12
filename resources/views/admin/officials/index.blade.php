@extends('admin.layouts.admin')

@section('title', 'Project Officials')
@section('page-title', 'Manage Project Officials')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0 fw-bold">Officials List</h5>
                <a href="{{ route('admin.officials.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add
                    Official</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">Order</th>
                            <th width="100">Image</th>
                            <th>Name & Designation</th>
                            <th>Organization</th>
                            <th>Sequence</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($officials as $official)
                            <tr>
                                <td class="fw-bold">{{ $official->order }}</td>
                                <td>
                                    @if ($official->image)
                                        <img src="{{ asset($official->image) }}" alt="{{ $official->name }}" class="rounded"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-person text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $official->name }}</div>
                                    <div class="text-muted small">{{ $official->designation }}</div>
                                </td>
                                <td>{{ $official->organization ?: '-' }}</td>
                                <td>
                                    <div class="fw-bold">{{ $official->order }}</div>
                                </td>
                                <td>
                                    @if ($official->status)
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="">
                                        <a href="{{ route('admin.officials.edit', $official) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.officials.destroy', $official) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this official?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No officials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
