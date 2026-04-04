<!-- Top Bar -->
<div class="top-bar d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <span><i class="bi bi-geo-alt me-1"></i> পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড, রাঙামাটি</span>
                <span class="ms-3"><i class="bi bi-envelope me-1"></i> info@chtdb.gov.bd</span>
                <span class="ms-3"><i class="bi bi-telephone me-1"></i> +৮৮০-৩৫১-৬২০৮১</span>
            </div>
            <div class="col-md-5 text-end">
                <a href="https://chtdb.gov.bd" target="_blank" class="me-3"><i class="bi bi-globe me-1"></i> chtdb.gov.bd</a>
                <a href="https://peoplentech.com.bd" target="_blank"><i class="bi bi-globe me-1"></i> peoplentech.com.bd</a>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div style="width:48px;height:48px;border-radius:12px;background:var(--gradient-1);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-mortarboard-fill text-white" style="font-size:1.5rem;"></i>
            </div>
            <div class="brand-text d-none d-sm-block">আইসিটি দক্ষতা উন্নয়ন<br>তিন পার্বত্য জেলা স্কিম</div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}#home">হোম</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">প্রকল্প</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#organizations">সংস্থাসমূহ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#stories">সাফল্য</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#courses">কোর্সসমূহ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#gallery">গ্যালারি</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">যোগাযোগ</a></li>
            </ul>
            <div class="nav-auth-btns d-flex gap-2 ms-lg-3 mt-2 mt-lg-0">
                <a href="{{ route('home') }}#stories" class="btn btn-primary-custom">
                    <i class="bi bi-trophy me-1"></i> সাফল্যের গল্প
                </a>

                @auth
                    @if(auth()->user()->role === 'student')
                        <div class="dropdown" id="navUserDropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.1);border:none;padding:8px;">
                                <li><a class="dropdown-item" href="{{ route('student.dashboard') }}" style="border-radius:8px;padding:10px 16px;"><i class="bi bi-speedometer2 me-2"></i>ড্যাশবোর্ড</a></li>
                                <li><a class="dropdown-item" href="{{ route('student.dashboard') }}?tab=profile" style="border-radius:8px;padding:10px 16px;"><i class="bi bi-person me-2"></i>প্রোফাইল</a></li>
                                @if(auth()->user()->portfolioSetting && auth()->user()->portfolioSetting->slug)
                                    <li><a class="dropdown-item" href="{{ route('portfolio.public.show', auth()->user()->portfolioSetting->slug) }}" target="_blank" style="border-radius:8px;padding:10px 16px;"><i class="bi bi-link-45deg me-2"></i>পোর্টফোলিও URL</a></li>
                                    <li><a class="dropdown-item" href="{{ route('portfolio.public.show', auth()->user()->portfolioSetting->slug) }}" target="_blank" style="border-radius:8px;padding:10px 16px;"><i class="bi bi-box-arrow-up-right me-2"></i>পোর্টফোলিও দেখুন</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('student.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit" style="border-radius:8px;padding:10px 16px;width:100%;text-align:left;">
                                            <i class="bi bi-box-arrow-left me-2"></i>লগআউট
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                    {{-- Admin users can access admin panel separately --}}
                @else
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal" id="navLoginBtn">
                        <i class="bi bi-box-arrow-in-right me-1"></i> লগইন
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal" id="navRegisterBtn">
                        <i class="bi bi-person-plus me-1"></i> রেজিস্ট্রেশন
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>
<!-- Auth Modals -->
@include('partials.auth-modals')
