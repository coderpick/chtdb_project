@extends('admin.layouts.admin')

@section('title', 'Add Testimonial')
@section('page-title', 'Add New Testimonial')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-select" required>
                    <option value="">Select Student</option>
                    @foreach(\App\Models\User::where('role', 'student')->get() as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quote</label>
                <textarea name="quote" class="form-control" rows="4" required>{{ old('quote') }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_approved" class="form-check-input" value="1" {{ old('is_approved') ? 'checked' : '' }}>
                <label class="form-check-label">Approved (visible on public site)</label>
            </div>
            <button type="submit" class="btn btn-success">Add Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
