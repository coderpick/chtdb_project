@extends('admin.layouts.admin')

@section('title', 'Edit Slider')
@section('page-title', 'Edit Hero Slider')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4 text-center">
                            <label class="form-label d-block fw-bold">Current Image</label>
                            <img src="{{ asset($slider->image) }}" class="rounded shadow-sm" style="max-width: 100%; height: 200px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Update Image (Optional)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text text-muted">Leave empty to keep current image. Recommended size: 1200x600px.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Title (Optional)</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter slider title" value="{{ old('title', $slider->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Subtitle (Optional)</label>
                            <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" placeholder="Enter slider subtitle" value="{{ old('subtitle', $slider->subtitle) }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Display Order</label>
                                <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $slider->order) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $slider->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $slider->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Update Slider</button>
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
