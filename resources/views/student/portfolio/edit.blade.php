@extends('layouts.student')

@section('title', 'Portfolio Settings')
@section('page-title', 'পাবলিক পোর্টফোলিও URL')

@push('styles')
<style>
    .theme-swatch {
        cursor: pointer;
        transition: all 0.3s;
        border: 3px solid transparent;
    }
    .theme-swatch:hover {
        transform: scale(1.1);
    }
    .theme-swatch.active {
        border-color: #000 !important;
        box-shadow: 0 0 0 2px white inset !important;
    }
    .portfolio-preview-mini {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid #eee;
        max-width: 400px;
        margin: 0 auto;
    }
    .preview-header {
        padding: 25px 20px;
        text-align: center;
        color: white;
        transition: background 0.4s;
    }
    .preview-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        border: 2px solid rgba(255,255,255,0.4);
    }
    .preview-body {
        padding: 20px;
    }
    .mini-stat {
        display: flex;
        justify-content: space-around;
        text-align: center;
        background: #f8fafc;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 15px;
    }
    .mini-stat h6 { margin: 0; font-weight: 700; font-size: 1rem; }
    .mini-stat small { font-size: 0.75rem; color: #64748b; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-lg-12">
        <div class="dash-content-card border-0">
            <h5><i class="bi bi-link-45deg text-primary"></i> পাবলিশিং সেটিংস</h5>
            <p class="card-subtitle">আপনার পোর্টফোলিও URL ও ভিজিবিলিটি নিয়ন্ত্রণ করুন</p>
            
            <form action="{{ route('student.portfolio.update') }}" method="POST" id="portfolioUpdateForm">
                @csrf
                @method('PUT')

                <div class="portfolio-url-box p-4" style="background:#f8fafc; border: 1px solid #e2e8f0; border-radius: 16px;">
                    <label class="dash-form-label mb-2"><i class="bi bi-globe2 me-1"></i> আপনার পোর্টফোলিও URL</label>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f1f5f9;border-radius:12px 0 0 12px;border:2px solid #e2e8f0;border-right:none;font-size:0.88rem;color:#64748b;">{{ url('/') }}/portfolio/</span>
                                <input type="text" name="slug" id="slugInput" class="dash-form-control border-start-0 ps-0 @error('slug') is-invalid @enderror" value="{{ old('slug', $portfolio->slug ?? '') }}" placeholder="your-username" style="border-radius:0 12px 12px 0; border-left:none;" required>
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
                <div class="portfolio-url-display mt-4 mb-4" style="background:#f0fdf4; border: 2px dashed #bbf7d0; border-radius:14px; padding:20px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <i class="bi bi-link-45deg text-success" style="font-size:1.3rem;"></i>
                            <span style="color:#666; font-size:1rem;">{{ url('/') }}/portfolio/</span>
                            <strong style="color:var(--primary); font-size:1.1rem;" id="slugDisplay">{{ $portfolio->slug }}</strong>
                        </div>
                        <button type="button" class="btn btn-sm btn-success px-3" onclick="copyPortfolioUrl('{{ url('/portfolio/' . $portfolio->slug) }}')" style="border-radius:8px;font-weight:600;">
                            <i class="bi bi-clipboard me-1"></i> কপি করুন
                        </button>
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
                        <p class="text-muted small"><i class="bi bi-info-circle me-1"></i>বন্ধ করলে অন্যরা আপনার পোর্টফোলিও দেখতে পারবে না</p>

                        <label class="dash-form-label mt-4 mb-2"><i class="bi bi-chat-quote me-1"></i> পোর্টফোলিও ট্যাগলাইন / বায়ো</label>
                        <input type="text" name="tagline" id="taglineInput" class="dash-form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $portfolio->tagline ?? '') }}" placeholder="যেমন: Full Stack Web Developer">
                        @error('tagline')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Portfolio Theme -->
                    <div class="col-md-6 ps-md-4">
                        <label class="dash-form-label mb-3"><i class="bi bi-palette me-1"></i> পোর্টফোলিও থিম নির্বাচন করুন</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach([
                                'green' => 'linear-gradient(135deg,#0d4a28,#2d8f5e)',
                                'blue' => 'linear-gradient(135deg,#1a365d,#2b6cb0)',
                                'purple' => 'linear-gradient(135deg,#44337a,#805ad5)',
                                'orange' => 'linear-gradient(135deg,#c05621,#ed8936)',
                                'dark' => 'linear-gradient(135deg,#1a1a2e,#16213e)',
                                'teal' => 'linear-gradient(135deg,#234e52,#38b2ac)'
                            ] as $theme => $gradient)
                            <label style="cursor:pointer; text-align:center;">
                                <input type="radio" name="theme" value="{{ $theme }}" {{ old('theme', $portfolio->theme ?? 'green') == $theme ? 'checked' : '' }} style="display:none;" onchange="updateThemePreview('{{ $theme }}', '{{ $gradient }}')">
                                <div style="width:48px;height:48px;border-radius:12px;background:{{ $gradient }};" class="theme-swatch {{ old('theme', $portfolio->theme ?? 'green') == $theme ? 'active' : '' }}" data-theme="{{ $theme }}"></div>
                                <small class="d-block mt-1" style="font-size:0.75rem;">{{ ucfirst($theme) }}</small>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Live Preview -->
    <div class="col-lg-5">
        <div class="dash-content-card h-100">
            <h5><i class="bi bi-phone text-info"></i> লাইভ প্রিভিউ</h5>
            <p class="card-subtitle">আপনার পোর্টফোলিও এইরকম দেখাবে</p>
            
            <div class="portfolio-preview-mini mt-4">
                <div class="preview-header" id="previewHeader" style="background: {{ [
                    'green'  => 'linear-gradient(135deg,#0d4a28,#2d8f5e)',
                    'blue'   => 'linear-gradient(135deg,#1a365d,#2b6cb0)',
                    'purple' => 'linear-gradient(135deg,#44337a,#805ad5)',
                    'orange' => 'linear-gradient(135deg,#c05621,#ed8936)',
                    'dark'   => 'linear-gradient(135deg,#1a1a2e,#16213e)',
                    'teal'   => 'linear-gradient(135deg,#234e52,#38b2ac)'
                ][old('theme', $portfolio->theme ?? 'green')] }}">
                    <div class="preview-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</div>
                    <h6 class="mb-0" style="font-weight:700;">{{ auth()->user()->name }}</h6>
                    <small id="previewTagline">{{ old('tagline', $portfolio->tagline ?? 'ICT Student') }}</small>
                    <div class="mt-2">
                        <small style="font-size:0.7rem; opacity:0.8;"><i class="bi bi-geo-alt"></i> {{ $stats['district'] }}</small>
                    </div>
                </div>
                <div class="preview-body">
                    <div class="mini-stat">
                        <div>
                            <h6>{{ $stats['projects'] }}</h6>
                            <small>প্রজেক্ট</small>
                        </div>
                        <div>
                            <h6>{{ $stats['skills'] }}</h6>
                            <small>দক্ষতা</small>
                        </div>
                        <div>
                            <h6 style="font-size:0.85rem;"> ICT </h6>
                            <small>কোর্স</small>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-sm btn-outline-secondary disabled" style="border-radius:10px; font-size:0.75rem;">
                            <i class="bi bi-box-arrow-up-right me-1"></i> পোর্টফোলিও দেখুন
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions / Guide -->
    <div class="col-lg-7">
        <div class="row g-4">
            <div class="col-12">
                <div class="dash-content-card h-100">
                    <h5><i class="bi bi-lightbulb text-warning"></i> পোর্টফোলিও উন্নত করার টিপস</h5>
                    <ul class="list-unstyled mt-3" style="font-size:0.88rem;">
                        <li class="mb-3 d-flex align-items-start"><i class="bi bi-check-circle-fill text-success me-2 mt-1"></i> একটি সুন্দর প্রোফাইল ছবি আপলোড করুন — এটি আপনার গ্রহণযোগ্যতা বাড়াবে।</li>
                        <li class="mb-3 d-flex align-items-start"><i class="bi bi-check-circle-fill text-success me-2 mt-1"></i> কমপক্ষে ৩টি প্রজেক্ট যুক্ত করুন যাতে আপনার কাজের নমুনা ঠিকভাবে প্রকাশ পায়।</li>
                        <li class="mb-3 d-flex align-items-start"><i class="bi bi-check-circle-fill text-success me-2 mt-1"></i> আপনার সব টেকনিক্যাল দক্ষতা (Skills) যুক্ত করুন।</li>
                        <li class="mb-3 d-flex align-items-start"><i class="bi bi-check-circle-fill text-success me-2 mt-1"></i> সাফল্যের গল্প সেকশনে আপনার শেখার অভিজ্ঞতা শেয়ার করুন।</li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="dash-content-card h-100">
                    <h5><i class="bi bi-share text-primary"></i> শেয়ার করার গাইড</h5>
                    <p style="font-size:0.88rem;color:#666;" class="mt-2">আপনার তৈরি করা পোর্টফোলিওটি যেখানে ব্যবহার করতে পারেন:</p>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <span class="badge bg-light text-dark p-2 border" style="font-size:0.8rem; font-weight:500;"><i class="bi bi-linkedin text-primary me-1"></i> LinkedIn প্রোফাইল</span>
                        <span class="badge bg-light text-dark p-2 border" style="font-size:0.8rem; font-weight:500;"><i class="bi bi-briefcase text-success me-1"></i> জব অ্যাপ্লিকেশন (CV)</span>
                        <span class="badge bg-light text-dark p-2 border" style="font-size:0.8rem; font-weight:500;"><i class="bi bi-globe me-1"></i> ব্যক্তিগত ওয়েবসাইট</span>
                        <span class="badge bg-light text-dark p-2 border" style="font-size:0.8rem; font-weight:500;"><i class="bi bi-facebook-x text-info me-1"></i> সোশ্যাল মিডিয়া</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyPortfolioUrl(url) {
        navigator.clipboard.writeText(url).then(() => {
            alert('লিংকটি ক্লিপবোর্ডে কপি করা হয়েছে!');
        });
    }

    function updateThemePreview(theme, gradient) {
        // Update swatch UI
        document.querySelectorAll('.theme-swatch').forEach(sw => {
            sw.classList.remove('active');
        });
        document.querySelector(`.theme-swatch[data-theme="${theme}"]`).classList.add('active');
        
        // Update Live Preview header
        document.getElementById('previewHeader').style.background = gradient;
    }

    // Sync Slug/URL
    document.getElementById('slugInput').addEventListener('input', function(e) {
        const value = e.target.value.toLowerCase().replace(/[^a-z0-9-]/g, '');
        e.target.value = value;
        const display = document.getElementById('slugDisplay');
        if(display) display.innerText = value || '...';
    });

    // Sync Tagline
    document.getElementById('taglineInput').addEventListener('input', function(e) {
        document.getElementById('previewTagline').innerText = e.target.value || 'Tagline here';
    });

    // Manual swatch click handler to aid theme change if radio click doesn't trigger visually
    document.querySelectorAll('.theme-swatch').forEach(swatch => {
        swatch.addEventListener('click', function() {
            const radio = this.parentElement.querySelector('input[type="radio"]');
            radio.checked = true;
            radio.dispatchEvent(new Event('change'));
        });
    });
</script>
@endpush
