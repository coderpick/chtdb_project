@extends('layouts.student')

@section('title', 'Social Links')
@section('page-title', 'সোশ্যাল লিংক')

@section('content')
<div class="dash-content-card border-0">
    <h5><i class="bi bi-link-45deg text-primary"></i> সোশ্যাল ও প্রফেশনাল লিংক</h5>
    <p class="card-subtitle">আপনার সোশ্যাল মিডিয়া ও প্রফেশনাল প্রোফাইল লিংক দিন</p>
    
    <form action="{{ route('student.socials.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-linkedin text-primary me-1"></i> LinkedIn</label>
                <input type="url" name="linkedin" class="dash-form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $socials->linkedin ?? '') }}" placeholder="https://linkedin.com/in/...">
                @error('linkedin')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-github me-1"></i> GitHub</label>
                <input type="url" name="github" class="dash-form-control @error('github') is-invalid @enderror" value="{{ old('github', $socials->github ?? '') }}" placeholder="https://github.com/...">
                @error('github')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-globe me-1 text-success"></i> ব্যক্তিগত ওয়েবসাইট</label>
                <input type="url" name="website" class="dash-form-control @error('website') is-invalid @enderror" value="{{ old('website', $socials->website ?? '') }}" placeholder="https://yourwebsite.com">
                @error('website')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-facebook text-primary me-1"></i> Facebook</label>
                <input type="url" name="facebook" class="dash-form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $socials->facebook ?? '') }}" placeholder="https://facebook.com/...">
                @error('facebook')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-twitter-x text-dark me-1"></i> Twitter / X</label>
                <input type="url" name="twitter" class="dash-form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $socials->twitter ?? '') }}" placeholder="https://x.com/...">
                @error('twitter')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="dash-form-label"><i class="bi bi-whatsapp text-success me-1"></i> Phone (WhatsApp)</label>
                <input type="text" name="phone" class="dash-form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $socials->phone ?? '') }}" placeholder="+8801...">
                @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>লিংক সেভ করুন</button>
            </div>
        </div>
    </form>
</div>
@endsection
