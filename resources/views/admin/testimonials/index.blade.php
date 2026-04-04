@extends('admin.layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">All Testimonials</h6>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus"></i>
                    Add Testimonial</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Quote</th>
                            <th>Approved</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>{{ $testimonial->id }}</td>
                                <td>{{ $testimonial->user->name ?? '—' }}</td>
                                <td>{{ Str::limit($testimonial->quote, 80) }}</td>
                                <td>
                                    @if ($testimonial->is_approved)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-warning text-dark">No</span>
                                    @endif
                                </td>
                                <td>{{ $testimonial->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
