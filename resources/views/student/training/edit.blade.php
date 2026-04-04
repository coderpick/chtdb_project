@extends('layouts.student')

@section('title', 'Training')
@section('page-title', 'প্রশিক্ষণ তথ্য')

@section('content')
<div class="dash-content-card border-0">
    <h5><i class="bi bi-mortarboard-fill text-primary"></i> প্রশিক্ষণ তথ্য</h5>
    <p class="card-subtitle">আপনি কোন বিষয়ে প্রশিক্ষণ নিয়েছেন তার বিস্তারিত তথ্য দিন</p>
    
    <form action="{{ route('student.training.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="dash-form-label">প্রশিক্ষণ কোর্স *</label>
                <select name="course_id" class="dash-form-control @error('course_id') is-invalid @enderror" required id="courseSelect">
                    <option value="">কোর্স নির্বাচন করুন</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $user->training->course_id ?? '') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">ব্যাচ</label>
                <select name="batch_id" class="dash-form-control @error('batch_id') is-invalid @enderror" id="batchSelect">
                    <option value="">ব্যাচ নির্বাচন করুন</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ old('batch_id', $user->training->batch_id ?? '') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }} ({{ $batch->course->name }} - {{ $batch->start_date?->format('M Y') }})
                        </option>
                    @endforeach
                </select>
                @error('batch_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">প্রশিক্ষণ কেন্দ্র</label>
                <select name="center_id" class="dash-form-control @error('center_id') is-invalid @enderror" required>
                    <option value="">কেন্দ্র নির্বাচন করুন</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ old('center_id', $user->training->center_id ?? '') == $center->id ? 'selected' : '' }}>
                            {{ $center->name }} ({{ $center->district }})
                        </option>
                    @endforeach
                </select>
                @error('center_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">প্রশিক্ষণের অবস্থা</label>
                <select name="status" class="dash-form-control @error('status') is-invalid @enderror" required>
                    <option value="ongoing" {{ old('status', $user->training->status ?? '') == 'ongoing' ? 'selected' : '' }}>চলমান</option>
                    <option value="completed" {{ old('status', $user->training->status ?? '') == 'completed' ? 'selected' : '' }}>সম্পন্ন</option>
                    <option value="certified" {{ old('status', $user->training->status ?? '') == 'certified' ? 'selected' : '' }}>সার্টিফাইড</option>
                </select>
                @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">ফলাফল / গ্রেড</label>
                <input type="text" name="grade" class="dash-form-control @error('grade') is-invalid @enderror" value="{{ old('grade', $user->training->grade ?? '') }}" placeholder="যেমন: A+, ৮০%">
                @error('grade')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">শুরুর তারিখ</label>
                <input type="date" name="start_date" class="dash-form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($user->training->start_date) ? $user->training->start_date?->format('Y-m-d') : '') }}">
                @error('start_date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">সমাপ্তির তারিখ</label>
                <input type="date" name="end_date" class="dash-form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', isset($user->training->end_date) ? $user->training->end_date?->format('Y-m-d') : '') }}">
                @error('end_date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>প্রশিক্ষণ তথ্য সেভ করুন</button>
        </div>
    </form>
</div>
@endsection
