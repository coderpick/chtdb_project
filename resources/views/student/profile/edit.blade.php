@extends('layouts.student')

@section('title', 'Edit Profile')
@section('page-title', 'প্রোফাইল সম্পাদন')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')

    <div class="dash-content-card">
        <h5><i class="bi bi-person-fill text-success"></i> প্রোফাইল সেটিংস</h5>
        <p class="card-subtitle">আপনার ব্যক্তিগত তথ্য আপডেট করুন। পরে Laravel ব্যাকএন্ডে ডেটা সেভ হবে।</p>

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-3 mb-4 text-center">
                    <label class="dash-form-label mb-2">প্রোফাইল ছবি</label>
                    <div class="photo-upload-area mx-auto" onclick="document.getElementById('profilePhoto').click()">
                        @if ($user->profile && $user->profile->photo)
                            <img id="profilePhotoPreview" src="{{ asset($user->profile->photo) }}" style="display:block;">
                            <div class="upload-placeholder" id="photoPlaceholder" style="display:none;">
                                <i class="bi bi-camera"></i>
                                <span>ছবি পরিবর্তন করুন</span>
                            </div>
                        @else
                            <img id="profilePhotoPreview" style="display:none;">
                            <div class="upload-placeholder" id="photoPlaceholder">
                                <i class="bi bi-camera"></i>
                                <span>ছবি আপলোড</span>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="photo" id="profilePhoto" accept="image/*" style="display:none;"
                        onchange="previewProfilePhoto(event)">
                    @error('photo')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="dash-form-label">পুরো নাম <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="dash-form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" placeholder="আপনার পুরো নাম" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ইমেইল <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="dash-form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" placeholder="example@email.com" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">মোবাইল নম্বর</label>
                            <input type="tel" name="phone"
                                class="dash-form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->profile->phone ?? '') }}" placeholder="০১XXXXXXXXX">
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label" for="district">জেলা <span class="text-danger">*</span></label>
                            <select name="district" class="dash-form-control" id="district"
                                @error('district') is-invalid @enderror" required>
                                <option value="">জেলা নির্বাচন করুন</option>
                                <option value="rangamati"
                                    {{ old('district', $user->profile->district ?? '') == 'rangamati' || old('district', $user->profile->district ?? '') == 'rangamati' ? 'selected' : '' }}>
                                    রাঙামাটি</option>
                                <option value="khagrachhari"
                                    {{ old('district', $user->profile->district ?? '') == 'khagrachhari' || old('district', $user->profile->district ?? '') == 'khagrachhari' ? 'selected' : '' }}>
                                    খাগড়াছড়ি</option>
                                <option value="bandarban"
                                    {{ old('district', $user->profile->district ?? '') == 'bandarban' || old('district', $user->profile->district ?? '') == 'bandarban' ? 'selected' : '' }}>
                                    বান্দরবান</option>
                            </select>
                            @error('district')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">উপজেলা/থানা</label>
                            <input type="text" name="upazila"
                                class="dash-form-control @error('upazila') is-invalid @enderror"
                                value="{{ old('upazila', $user->profile->upazila ?? '') }}" placeholder="আপনার উপজেলা">
                            @error('upazila')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">জন্ম তারিখ</label>
                            <input type="text" name="dob" id="dob-picker"
                                class="dash-form-control @error('dob') is-invalid @enderror"
                                value="{{ old('dob', $user->profile->dob ?? '') }}" placeholder="YYYY-MM-DD">
                            @error('dob')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            {{-- male', 'female', 'other --}}
                            <label class="dash-form-label">লিঙ্গ</label>
                            <select name="gender" class="dash-form-control @error('gender') is-invalid @enderror">
                                <option value="">নির্বাচন করুন</option>
                                <option value="male"
                                    {{ old('gender', $user->profile->gender ?? '') == 'male' ? 'selected' : '' }}>পুরুষ
                                </option>
                                <option value="female"
                                    {{ old('gender', $user->profile->gender ?? '') == 'female' ? 'selected' : '' }}>মহিলা
                                </option>
                                <option value="other"
                                    {{ old('gender', $user->profile->gender ?? '') == 'other' ? 'selected' : '' }}>
                                    অন্যান্য</option>
                            </select>
                            @error('gender')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">NID নম্বর</label>
                            <input type="number" name="nid" min="0"
                                class="dash-form-control @error('nid') is-invalid @enderror"
                                value="{{ old('nid', $user->profile->nid ?? '') }}"
                                placeholder="জাতীয় পরিচয়পত্র নম্বর">
                            @error('nid')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <label class="dash-form-label">সম্পূর্ণ ঠিকানা</label>
                    <input type="text" name="address" class="dash-form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $user->profile->address ?? '') }}"
                        placeholder="আপনার পূর্ণ ঠিকানা লিখুন">
                    @error('address')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-3">
                    <label class="dash-form-label">নিজের সম্পর্কে (Bio)</label>
                    <textarea name="bio" class="dash-form-control @error('bio') is-invalid @enderror"
                        placeholder="নিজের সম্পর্কে সংক্ষেপে লিখুন... (ক্যারিয়ার লক্ষ্য, আগ্রহ ইত্যাদি)">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                    @error('bio')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn-dash-save">
                        <i class="bi bi-check-lg me-2"></i>প্রোফাইল সেভ করুন
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            function previewProfilePhoto(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profilePhotoPreview').src = e.target.result;
                        document.getElementById('profilePhotoPreview').style.display = 'block';
                        document.getElementById('photoPlaceholder').style.display = 'none';
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#dob-picker", {
                    dateFormat: "Y-m-d",
                    maxDate: "today",
                    altInput: true,
                    altFormat: "d M Y",
                });
            });
        </script>
    @endpush

@endsection
