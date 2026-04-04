@extends('admin.layouts.admin')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-select" required>
                    @foreach(\App\Models\User::where('role', 'student')->get() as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $testimonial->student_id) == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quote</label>
                <textarea name="quote" class="form-control" rows="4" required>{{ old('quote', $testimonial->quote) }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_approved" class="form-check-input" value="1" {{ old('is_approved', $testimonial->is_approved) ? 'checked' : '' }}>
                <label class="form-check-label">Approved</label>
            </div>
            <button type="submit" class="btn btn-success">Update Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
