@extends('layouts.student')

@section('title', 'Portfolio Settings')
@section('page-title', 'পাবলিক পোর্টফোলিও URL')

@section('content')
<div class="dash-content-card border-0">
    <h5><i class="bi bi-link-45deg text-primary"></i> পাবলিক পোর্টফোলিও URL</h5>
    <p class="card-subtitle">আপনার পোর্টফোলিওর জন্য একটি ইউনিক URL তৈরি করুন এবং সবার সাথে শেয়ার করুন</p>
    
    <form action="{{ route('student.portfolio.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="portfolio-url-box">
            <label class="dash-form-label mb-2"><i class="bi bi-globe2 me-1"></i> আপনার পোর্টফোলিও URL</label>
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text" style="background:#f0f0f0;border-radius:12px 0 0 12px;border:2px solid #e8e8e8;border-right:none;font-size:0.88rem;color:#888;">{{ url('/') }}/portfolio/</span>
                        <input type="text" name="slug" class="dash-form-control border-start-0 ps-0 @error('slug') is-invalid @enderror" value="{{ old('slug', $portfolio->slug ?? '') }}" placeholder="your-username" style="border-radius:0 12px 12px 0; border-left:none;" required>
                    </div>
                    <small class="text-muted d-block mt-1"><i class="bi bi-info-circle me-1"></i>শুধুমাত্র ইংরেজি ছোট হাতের অক্ষর, সংখ্যা ও হাইফেন ব্যবহার করুন</small>
                    @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn-dash-save w-100"><i class="bi bi-check-lg me-1"></i> সেভ করুন</button>
                    @if($portfolio->slug ?? false)
                        <a href="{{ route('portfolio.public.show', $portfolio->slug) }}" target="_blank" class="btn btn-outline-success d-inline-flex align-items-center justify-content-center" style="border-radius:12px; white-space:nowrap; padding:0 20px;" title="প্রিভিউ">
                            <i class="bi bi-eye"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($portfolio->slug ?? false)
        <div class="portfolio-url-display mt-4 mb-4" style="background:var(--bg-light); border: 2px dashed #ddd; border-radius:14px; padding:20px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-link-45deg text-success" style="font-size:1.3rem;"></i>
                    <span style="color:#666; font-size:1rem;">{{ url('/') }}/portfolio/</span>
                    <strong style="color:var(--primary); font-size:1.1rem;">{{ $portfolio->slug }}</strong>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success px-3" onclick="copyPortfolioUrl('{{ url('/portfolio/' . $portfolio->slug) }}')" style="border-radius:8px;font-weight:600;">
                    <i class="bi bi-clipboard me-1"></i> কপি করুন
                </button>
            </div>
            
            <!-- Share Buttons -->
            <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/portfolio/' . $portfolio->slug)) }}" target="_blank" class="btn btn-outline-primary btn-sm" style="border-radius:10px;">
                    <i class="bi bi-facebook me-1"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/portfolio/' . $portfolio->slug)) }}&text=Check%20out%20my%20portfolio!" target="_blank" class="btn btn-outline-info btn-sm" style="border-radius:10px;">
                    <i class="bi bi-twitter-x me-1"></i> Twitter
                </a>
                <a href="https://wa.me/?text={{ urlencode('Check out my portfolio: ' . url('/portfolio/' . $portfolio->slug)) }}" target="_blank" class="btn btn-outline-success btn-sm" style="border-radius:10px;">
                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url('/portfolio/' . $portfolio->slug)) }}" target="_blank" class="btn btn-outline-primary btn-sm" style="border-radius:10px;">
                    <i class="bi bi-linkedin me-1"></i> LinkedIn
                </a>
            </div>
        </div>
        @endif

        <div class="row g-4 mt-2">
            <!-- Portfolio Visibility -->
            <div class="col-md-6 border-end pe-md-4">
                <label class="dash-form-label mb-2"><i class="bi bi-eye me-1"></i> পোর্টফোলিও ভিজিবিলিটি</label>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_visible" id="portfolioVisible" value="1" {{ old('is_visible', $portfolio->is_visible ?? false) ? 'checked' : '' }} style="cursor:pointer;width:3em;height:1.5em;">
                    <label class="form-check-label ms-2 mt-1" for="portfolioVisible" style="font-size:0.92rem;">পাবলিক পোর্টফোলিও সক্রিয় করুন</label>
                </div>
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i>বন্ধ করলে অন্যরা আপনার পোর্টফোলিও দেখতে পারবে না</small>

                <label class="dash-form-label mt-4 mb-2"><i class="bi bi-chat-quote me-1"></i> পোর্টফোলিও ট্যাগলাইন / বায়ো</label>
                <input type="text" name="tagline" class="dash-form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $portfolio->tagline ?? '') }}" placeholder="যেমন: Full Stack Web Developer">
                @error('tagline')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            
            <!-- Portfolio Theme -->
            <div class="col-md-6 ps-md-4">
                <label class="dash-form-label mb-3"><i class="bi bi-palette me-1"></i> পোর্টফোলিও থিম নির্বাচন করুন</label>
                <div class="d-flex flex-wrap gap-3">
                    <label style="cursor:pointer; text-align:center;">
                        <input type="radio" name="theme" value="primary" {{ old('theme', $portfolio->theme ?? '') == 'primary' || empty(old('theme', $portfolio->theme ?? '')) ? 'checked' : '' }} style="display:none;">
                        <div style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#0d4a28,#2d8f5e);border:{{ (old('theme', $portfolio->theme ?? '') == 'primary' || empty(old('theme', $portfolio->theme ?? ''))) ? '3px solid #000' : '3px solid transparent' }};transition:all 0.3s;box-shadow:{{ (old('theme', $portfolio->theme ?? '') == 'primary' || empty(old('theme', $portfolio->theme ?? ''))) ? '0 0 0 2px white inset' : 'none' }};" class="theme-swatch" onclick="updateThemeSelect(this)"></div>
                        <small class="d-block mt-2">সবুজ</small>
                    </label>
                    <label style="cursor:pointer; text-align:center;">
                        <input type="radio" name="theme" value="blue" {{ old('theme', $portfolio->theme ?? '') == 'blue' ? 'checked' : '' }} style="display:none;">
                        <div style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#1a365d,#2b6cb0);border:{{ old('theme', $portfolio->theme ?? '') == 'blue' ? '3px solid #000' : '3px solid transparent' }};transition:all 0.3s;box-shadow:{{ old('theme', $portfolio->theme ?? '') == 'blue' ? '0 0 0 2px white inset' : 'none' }};" class="theme-swatch" onclick="updateThemeSelect(this)"></div>
                        <small class="d-block mt-2">নীল</small>
                    </label>
                    <label style="cursor:pointer; text-align:center;">
                        <input type="radio" name="theme" value="purple" {{ old('theme', $portfolio->theme ?? '') == 'purple' ? 'checked' : '' }} style="display:none;">
                        <div style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#44337a,#805ad5);border:{{ old('theme', $portfolio->theme ?? '') == 'purple' ? '3px solid #000' : '3px solid transparent' }};transition:all 0.3s;box-shadow:{{ old('theme', $portfolio->theme ?? '') == 'purple' ? '0 0 0 2px white inset' : 'none' }};" class="theme-swatch" onclick="updateThemeSelect(this)"></div>
                        <small class="d-block mt-2">বেগুনি</small>
                    </label>
                    <label style="cursor:pointer; text-align:center;">
                        <input type="radio" name="theme" value="orange" {{ old('theme', $portfolio->theme ?? '') == 'orange' ? 'checked' : '' }} style="display:none;">
                        <div style="width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,#c05621,#ed8936);border:{{ old('theme', $portfolio->theme ?? '') == 'orange' ? '3px solid #000' : '3px solid transparent' }};transition:all 0.3s;box-shadow:{{ old('theme', $portfolio->theme ?? '') == 'orange' ? '0 0 0 2px white inset' : 'none' }};" class="theme-swatch" onclick="updateThemeSelect(this)"></div>
                        <small class="d-block mt-2">কমলা</small>
                    </label>
                </div>
            </div>
        </div>
        
    </form>
</div>

@push('scripts')
<script>
function copyPortfolioUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('URL Copied to clipboard!');
    });
}
function updateThemeSelect(el) {
    document.querySelectorAll('.theme-swatch').forEach(swatch => {
        swatch.style.border = '3px solid transparent';
        swatch.style.boxShadow = 'none';
    });
    el.style.border = '3px solid #000';
    el.style.boxShadow = '0 0 0 2px white inset';
}
</script>
@endpush
@endsection
