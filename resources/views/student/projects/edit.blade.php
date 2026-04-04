@extends('layouts.student')

@section('title', 'Edit Project')
@section('page-title', 'প্রজেক্ট আপডেট করুন')

@section('content')
<div class="dash-content-card border-0">
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
        <i class="bi bi-pencil-square text-primary fs-3 me-2"></i>
        <h5 class="mb-0 text-primary">প্রজেক্ট আপডেট করুন</h5>
    </div>

    <form action="{{ route('student.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="dash-form-label">Project Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="dash-form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->name ?? $project->title) }}" required>
                @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">Technologies (কমা দিয়ে আলাদা করুন)</label>
                <input type="text" name="technologies" class="dash-form-control @error('technologies') is-invalid @enderror" value="{{ old('technologies', $project->technologies) }}">
                @error('technologies')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">Project URL (Live Link)</label>
                <input type="url" name="project_url" class="dash-form-control @error('project_url') is-invalid @enderror" value="{{ old('project_url', $project->project_url) }}">
                @error('project_url')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">GitHub URL</label>
                <input type="url" name="github_url" class="dash-form-control @error('github_url') is-invalid @enderror" value="{{ old('github_url', $project->github_url) }}">
                @error('github_url')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">Project Image / Screenshot</label>
                <input type="file" name="image" class="dash-form-control @error('image') is-invalid @enderror" accept="image/*" style="padding: 9px 16px;">
                @if($project->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$project->image) }}" alt="Preview" style="height: 60px; border-radius:8px; border:1px solid #ddd;">
                    </div>
                @endif
                @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6 d-flex align-items-center mt-md-4 pt-md-2">
                <div class="form-check form-switch ms-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} style="cursor:pointer;width:3em;height:1.5em;">
                    <label class="form-check-label ms-2 mt-1" for="is_featured" style="font-size:0.92rem;font-weight:600;">Mark as featured</label>
                </div>
            </div>

            <div class="col-12 mt-2">
                <label class="dash-form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="dash-form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $project->description) }}</textarea>
                @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4 pt-2 d-flex gap-2">
            <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>আপডেট করুন</button>
            <a href="{{ route('student.projects.index') }}" class="btn btn-outline-secondary" style="border-radius:12px; padding:12px 24px; font-weight:600;">বাতিল</a>
        </div>
    </form>
</div>
@endsection
