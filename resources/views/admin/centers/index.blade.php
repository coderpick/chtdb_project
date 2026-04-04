@extends('admin.layouts.admin')

@section('title', 'Training Centers')
@section('page-title', 'Manage Training Centers')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">All Centers</h6>
            <a href="{{ route('admin.centers.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus"></i> Add Center</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($centers as $center)
                    <tr>
                        <td>{{ $center->id }}</td>
                        <td>{{ $center->name }}</td>
                        <td>{{ ucfirst($center->district) }}</td>
                        <td>{{ $center->phone }}</td>
                        <td>{{ $center->email }}</td>
                        <td>
                            @if($center->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.centers.edit', $center) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.centers.destroy', $center) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">No centers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
