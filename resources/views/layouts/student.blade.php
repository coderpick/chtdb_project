<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Student Dashboard') - CHTDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
    <style>
        body { background: #f5f6fa; font-family: "Noto Sans Bengali", sans-serif; }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <span><i class="bi bi-geo-alt me-1"></i> পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড, রাঙামাটি</span>
                    <span class="ms-3"><i class="bi bi-envelope me-1"></i> info@chtdb.gov.bd</span>
                    <span class="ms-3"><i class="bi bi-telephone me-1"></i> +৮৮০-৩৫১-৬২০৮১</span>
                </div>
                <div class="col-md-5 text-end">
                    <a href="https://chtdb.gov.bd" target="_blank" class="me-3 text-white text-decoration-none"><i class="bi bi-globe me-1"></i> chtdb.gov.bd</a>
                    <a href="https://peoplentech.com.bd" target="_blank" class="text-white text-decoration-none"><i class="bi bi-globe me-1"></i> peoplentech.com.bd</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Topbar -->
    <div class="dash-topbar border-bottom">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
                    <div>
                        <div style="font-weight:700;font-size:0.95rem;color:var(--primary-dark);">স্টুডেন্ট ড্যাশবোর্ড</div>
                        <div style="font-size:0.72rem;color:#888;">আইসিটি দক্ষতা উন্নয়ন স্কিম</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-sm btn-outline-success d-none d-sm-inline-flex">
                        <i class="bi bi-house me-1"></i> হোম পেজ
                    </a>
                    <div class="dash-user-info d-flex align-items-center gap-2">
                        <div class="dash-user-avatar" id="dashAvatarSmall">
                            @if(auth()->user()->profile && auth()->user()->profile->photo)
                                <img src="{{ asset(auth()->user()->profile->photo) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                            @else
                                <span id="dashAvatarInitial">{{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="d-none d-md-block text-end">
                            <div style="font-weight:600;font-size:0.88rem;color:#333;" id="dashTopName">{{ auth()->user()->name ?? 'Student' }}</div>
                            <div style="font-size:0.72rem;color:#888;">শিক্ষার্থী</div>
                        </div>
                    </div>
                    <form action="{{ route('student.logout') }}" method="POST" class="d-inline m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="লগআউট">
                            <i class="bi bi-box-arrow-left"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="container-fluid px-4 py-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="dash-sidebar">
                    <div class="profile-preview">
                        <div class="avatar-lg mx-auto mb-3" style="width:80px;height:80px;border-radius:50%;background:#f0f0f0;display:flex;align-items:center;justify-content:center;overflow:hidden;border:3px solid white;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                            @if(auth()->user()->profile && auth()->user()->profile->photo)
                                <img src="{{ asset(auth()->user()->profile->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="avatar-placeholder" id="dashAvatarLarge"><i class="bi bi-person-fill text-secondary" style="font-size: 2.5rem;"></i></div>
                            @endif
                        </div>
                        <h6 id="dashSidebarName" class="text-center font-weight-bold">{{ auth()->user()->name ?? 'Student' }}</h6>
                        <p class="text-center text-muted small mb-0" id="dashSidebarRole">শিক্ষার্থী | {{ auth()->user()->profile->district ?? 'ঠিকানা নেই' }}</p>
                    </div>
                    <ul class="dash-menu mt-4">
                        <li><a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> ওভারভিউ</a></li>
                        <li><a href="{{ route('student.profile.edit') }}" class="{{ request()->routeIs('student.profile.*') ? 'active' : '' }}"><i class="bi bi-person"></i> প্রোফাইল সেটিংস</a></li>
                        <li><a href="{{ route('student.training.edit') }}" class="{{ request()->routeIs('student.training.*') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> প্রশিক্ষণ তথ্য</a></li>
                        <li><a href="{{ route('student.career.edit') }}" class="{{ request()->routeIs('student.career.*') ? 'active' : '' }}"><i class="bi bi-briefcase"></i> ক্যারিয়ার তথ্য</a></li>
                        <li><a href="{{ route('student.projects.index') }}" class="{{ request()->routeIs('student.projects.*') ? 'active' : '' }}"><i class="bi bi-collection"></i> পোর্টফোলিও</a></li>
                        <li><a href="{{ route('student.skills.edit') }}" class="{{ request()->routeIs('student.skills.*') ? 'active' : '' }}"><i class="bi bi-stars"></i> দক্ষতা সমূহ</a></li>
                        {{-- social media links --}}
                        <li><a href="{{ route('student.socials.edit') }}" class="{{ request()->routeIs('student.socials.*') ? 'active' : '' }}"><i class="bi bi-link-45deg"></i> সোশ্যাল মিডিয়া লিঙ্কস</a></li>
                        <li><a href="{{ route('student.portfolio.edit') }}" class="{{ request()->routeIs('student.portfolio.*') ? 'active' : '' }}"><i class="bi bi-link-45deg"></i> পাবলিক পোর্টফোলিও URL</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4"><i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}</div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
