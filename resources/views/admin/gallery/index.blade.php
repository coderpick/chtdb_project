@extends('admin.layouts.admin')

@section('title', 'Gallery')
@section('page-title', 'Manage Gallery')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">Gallery Images</h6>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus"></i> Add Image</a>
        </div>
        <div class="row g-3">
            @forelse($gallery as $item)
            <div class="col-md-3 col-sm-4 col-6">
                <div class="card h-100">
                    <img src="{{ asset($item->image_path) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2">
                        <p class="mb-1 small">{{ $item->title ?: 'Untitled' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Order: {{ $item->order }}</small>
                            <div>
                                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No gallery images.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
