@extends('layouts.student')

@section('title', 'Career')
@section('page-title', 'ক্যারিয়ার')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    <div class="dash-content-card border-0">
        <h5><i class="bi bi-briefcase-fill text-warning"></i> ক্যারিয়ার তথ্য</h5>
        <p class="card-subtitle">আপনি বর্তমানে কী করছেন — চাকরি, ফ্রিল্যান্সিং নাকি উদ্যোক্তা?</p>

        <form action="{{ route('student.career.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="dash-form-label">বর্তমান পেশাগত অবস্থা *</label>
                    <select name="status" class="dash-form-control @error('status') is-invalid @enderror" id="careerStatus"
                        onchange="toggleCareerFields()" required>
                        <option value="" disabled selected>নির্বাচন করুন</option>
                        <option value="job" {{ old('status', $user->career->status ?? '') == 'job' ? 'selected' : '' }}>
                            চাকরি করছি</option>
                        <option value="freelance"
                            {{ old('status', $user->career->status ?? '') == 'freelance' ? 'selected' : '' }}>ফ্রিল্যান্সিং
                            করছি</option>
                        <option value="entrepreneur"
                            {{ old('status', $user->career->status ?? '') == 'entrepreneur' ? 'selected' : '' }}>
                            উদ্যোক্তা/ব্যবসা</option>
                        <option value="job_and_freelance"
                            {{ old('status', $user->career->status ?? '') == 'job_and_freelance' ? 'selected' : '' }}>চাকরি
                            ও ফ্রিল্যান্সিং দুটোই</option>
                        <option value="seeking"
                            {{ old('status', $user->career->status ?? '') == 'seeking' ? 'selected' : '' }}>চাকরি খুঁজছি
                        </option>
                        <option value="higher_education"
                            {{ old('status', $user->career->status ?? '') == 'higher_education' ? 'selected' : '' }}>
                            উচ্চশিক্ষায় আছি</option>
                    </select>
                    @error('status')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="dash-form-label">মাসিক আয় (BDT)</label>
                    <input type="number" name="income" class="dash-form-control @error('income') is-invalid @enderror"
                        value="{{ old('income', $user->career->income ?? '') }}" min="0" placeholder="উদা: ৩৫০০০">
                    @error('income')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Job Fields -->
                <div class="col-12" id="jobFields" style="display:none;">
                    <div class="row g-3" style="background:#f8faf9;border-radius:14px;padding:20px;margin-top:4px;">
                        <div class="col-12">
                            <h6 style="font-weight:700;color:var(--primary);"><i class="bi bi-building me-1"></i> চাকরির
                                তথ্য</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">প্রাতিষ্ঠানের নাম</label>
                            <input type="text" name="company"
                                class="dash-form-control @error('company') is-invalid @enderror"
                                value="{{ old('company', $user->career->company ?? '') }}"
                                placeholder="কোম্পানি/প্রতিষ্ঠানের নাম">
                            @error('company')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">পদবি / ডেজিগনেশন</label>
                            <input type="text" name="designation"
                                class="dash-form-control @error('designation') is-invalid @enderror"
                                value="{{ old('designation', $user->career->designation ?? '') }}"
                                placeholder="যেমন: Junior Developer">
                            @error('designation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">চাকরি শুরুর তারিখ</label>
                            <input type="text" name="join_date" id="join-date-picker"
                                class="dash-form-control @error('join_date') is-invalid @enderror"
                                value="{{ old('join_date', isset($user->career->join_date) ? \Carbon\Carbon::parse($user->career->join_date)->format('Y-m-d') : '') }}"
                                placeholder="YYYY-MM-DD">
                            @error('join_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">কর্মস্থলের ঠিকানা</label>
                            <input type="text" name="location"
                                class="dash-form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $user->career->location ?? '') }}" placeholder="ঢাকা / রিমোট">
                            @error('location')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Freelance Fields -->
                <div class="col-12" id="freelanceFields" style="display:none;">
                    <div class="row g-3" style="background:#f0f4ff;border-radius:14px;padding:20px;margin-top:4px;">
                        <div class="col-12">
                            <h6 style="font-weight:700;color:#0d6efd;"><i class="bi bi-globe me-1"></i> ফ্রিল্যান্সিং তথ্য
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ফ্রিল্যান্সিং প্ল্যাটফর্ম</label>
                            <input type="text" name="platform"
                                class="dash-form-control @error('platform') is-invalid @enderror"
                                value="{{ old('platform', $user->career->platform ?? '') }}"
                                placeholder="Upwork, Fiverr, Freelancer ইত্যাদি">
                            @error('platform')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">প্রোফাইল লিংক</label>
                            <input type="url" name="profile_link"
                                class="dash-form-control @error('profile_link') is-invalid @enderror"
                                value="{{ old('profile_link', $user->career->profile_link ?? '') }}"
                                placeholder="https://www.upwork.com/freelancers/...">
                            @error('profile_link')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">মোট সম্পন্ন প্রজেক্ট</label>
                            <input type="number" name="completed_projects"
                                class="dash-form-control @error('completed_projects') is-invalid @enderror"
                                value="{{ old('completed_projects', $user->career->completed_projects ?? '') }}"
                                placeholder="যেমন: 25">
                            @error('completed_projects')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ক্লায়েন্ট রেটিং</label>
                            <input type="text" name="rating"
                                class="dash-form-control @error('rating') is-invalid @enderror"
                                value="{{ old('rating', $user->career->rating ?? '') }}" placeholder="যেমন: 4.9/5.0">
                            @error('rating')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Entrepreneur Fields -->
                <div class="col-12" id="entrepreneurFields" style="display:none;">
                    <div class="row g-3" style="background:#fef9e7;border-radius:14px;padding:20px;margin-top:4px;">
                        <div class="col-12">
                            <h6 style="font-weight:700;color:var(--secondary);"><i class="bi bi-shop me-1"></i> উদ্যোক্তা
                                তথ্য</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ব্যবসা/প্রতিষ্ঠানের নাম</label>
                            <input type="text" name="business_name"
                                class="dash-form-control @error('business_name') is-invalid @enderror"
                                value="{{ old('business_name', $user->career->business_name ?? '') }}"
                                placeholder="আপনার ব্যবসার নাম">
                            @error('business_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ব্যবসার ধরন</label>
                            <input type="text" name="business_type"
                                class="dash-form-control @error('business_type') is-invalid @enderror"
                                value="{{ old('business_type', $user->career->business_type ?? '') }}"
                                placeholder="ডিজিটাল এজেন্সি / ই-কমার্স ইত্যাদি">
                            @error('business_type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">কতজন কর্মী আছেন</label>
                            <input type="number" name="employees"
                                class="dash-form-control @error('employees') is-invalid @enderror"
                                value="{{ old('employees', $user->career->employees ?? '') }}" placeholder="যেমন: 5">
                            @error('employees')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ওয়েবসাইট (যদি থাকে)</label>
                            <input type="url" name="business_website"
                                class="dash-form-control @error('business_website') is-invalid @enderror"
                                value="{{ old('business_website', $user->career->business_website ?? '') }}"
                                placeholder="https://example.com">
                            @error('business_website')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>ক্যারিয়ার তথ্য সেভ
                    করুন</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#join-date-picker", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d M Y",
                });
            });

            function toggleCareerFields() {
                const status = document.getElementById('careerStatus').value;
                const jobFields = document.getElementById('jobFields');
                const freelanceFields = document.getElementById('freelanceFields');
                const entrepreneurFields = document.getElementById('entrepreneurFields');

                // Hide all fields initially
                if (jobFields) jobFields.style.display = 'none';
                if (freelanceFields) freelanceFields.style.display = 'none';
                if (entrepreneurFields) entrepreneurFields.style.display = 'none';

                // Show appropriate fields
                if (status === 'job') {
                    if (jobFields) jobFields.style.display = 'block';
                } else if (status === 'freelance') {
                    if (freelanceFields) freelanceFields.style.display = 'block';
                } else if (status === 'entrepreneur') {
                    if (entrepreneurFields) entrepreneurFields.style.display = 'block';
                } else if (status === 'job_and_freelance') {
                    if (jobFields) jobFields.style.display = 'block';
                    if (freelanceFields) freelanceFields.style.display = 'block';
                }
            }

            // Run on init
            document.addEventListener('DOMContentLoaded', toggleCareerFields);
        </script>
    @endpush
@endsection
