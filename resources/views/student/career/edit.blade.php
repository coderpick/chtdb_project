@extends('layouts.student')

@section('title', 'Career')
@section('page-title', 'ক্যারিয়ার')

@section('content')
<div class="dash-content-card border-0">
    <h5><i class="bi bi-briefcase-fill text-warning"></i> ক্যারিয়ার তথ্য</h5>
    <p class="card-subtitle">আপনি বর্তমানে কী করছেন — চাকরি, ফ্রিল্যান্সিং নাকি উদ্যোক্তা?</p>
    
    <form action="{{ route('student.career.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="dash-form-label">বর্তমান পেশাগত অবস্থা *</label>
                <select name="status" class="dash-form-control @error('status') is-invalid @enderror" required>
                    <option value="" disabled selected>নির্বাচন করুন</option>
                    <option value="job" {{ old('status', $user->career->status ?? '') == 'job' ? 'selected' : '' }}>চাকরি করছি</option>
                    <option value="freelance" {{ old('status', $user->career->status ?? '') == 'freelance' ? 'selected' : '' }}>ফ্রিল্যান্সিং করছি</option>
                    <option value="entrepreneur" {{ old('status', $user->career->status ?? '') == 'entrepreneur' ? 'selected' : '' }}>উদ্যোক্তা/ব্যবসা</option>
                </select>
                @error('status')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">মাসিক আয় (BDT)</label>
                <input type="number" name="income" class="dash-form-control @error('income') is-invalid @enderror" value="{{ old('income', $user->career->income ?? '') }}" min="0" placeholder="উদা: ৩৫০০০">
                @error('income')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">কোম্পানি/প্রতিষ্ঠান/প্ল্যাটফর্ম</label>
                <input type="text" name="company" class="dash-form-control @error('company') is-invalid @enderror" value="{{ old('company', $user->career->company ?? '') }}" placeholder="কোম্পানির নাম বা ফ্রিল্যান্স প্ল্যাটফর্ম">
                @error('company')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">পদবি / ডেজিগনেশন</label>
                <input type="text" name="designation" class="dash-form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $user->career->designation ?? '') }}" placeholder="যেমন: Junior Developer">
                @error('designation')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">শুরুর তারিখ</label>
                <input type="date" name="join_date" class="dash-form-control @error('join_date') is-invalid @enderror" value="{{ old('join_date', isset($user->career->join_date) ? $user->career->join_date?->format('Y-m-d') : '') }}">
                @error('join_date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label">কর্মস্থলের ঠিকানা</label>
                <input type="text" name="location" class="dash-form-control @error('location') is-invalid @enderror" value="{{ old('location', $user->career->location ?? '') }}" placeholder="ঢাকা / রিমোট">
                @error('location')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-2">
                <label class="dash-form-label">আপনার সাফল্যের গল্প</label>
                <textarea name="story" class="dash-form-control @error('story') is-invalid @enderror" rows="4" placeholder="প্রশিক্ষণের পর কীভাবে আপনার ক্যারিয়ার গড়ে উঠেছে তার গল্প শেয়ার করুন...">{{ old('story', $user->career->story ?? '') }}</textarea>
                @error('story')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>ক্যারিয়ার তথ্য সেভ করুন</button>
        </div>
    </form>
</div>
@endsection
