@extends('admin.layouts.admin')

@section('title', 'Edit Gallery Image')
@section('page-title', 'Edit Gallery Image')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="{{ asset('storage/' . $gallery->image_path) }}" style="max-height: 150px;">
            </div>
            <div class="mb-3">
                <label class="form-label">Replace Image (leave blank to keep)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $gallery->order) }}">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
