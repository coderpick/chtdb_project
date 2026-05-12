@extends('admin.layouts.admin')

@section('title', 'Hero Sliders')
@section('page-title', 'Manage Hero Sliders')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0 fw-bold">Sliders List</h5>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Slider</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">Order</th>
                            <th width="200">Image</th>
                            <th>Title & Subtitle</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td class="fw-bold">{{ $slider->order }}</td>
                                <td>
                                    <img src="{{ asset($slider->image) }}" alt="Slider Image" class="rounded"
                                        style="width: 180px; height: 100px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-truncate" style="max-width: 300px;">{{ $slider->title ?: 'No Title' }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 300px;">{{ $slider->subtitle ?: 'No Subtitle' }}</div>
                                </td>
                                <td>
                                    @if ($slider->status)
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.sliders.edit', $slider) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this slider?')">
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
                                <td colspan="5" class="text-center py-4 text-muted">No sliders found. Click "Add Slider" to create one.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
