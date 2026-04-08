<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @php
        $theme = $portfolio->theme ?? 'green';
        $themeConfig = [
            'green' => [
                'primary' => '#1a6b3c',
                'gradient' => 'linear-gradient(135deg, #0d4a28 0%, #1a6b3c 50%, #2d8f5e 100%)',
                'bg_light' => '#f0fdf4',
                'card_shadow' => 'rgba(26, 107, 60, 0.12)',
            ],
            'blue' => [
                'primary' => '#1e40af',
                'gradient' => 'linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%)',
                'bg_light' => '#eff6ff',
                'card_shadow' => 'rgba(30, 64, 175, 0.12)',
            ],
            'purple' => [
                'primary' => '#6d28d9',
                'gradient' => 'linear-gradient(135deg, #4c1d95 0%, #7c3aed 50%, #8b5cf6 100%)',
                'bg_light' => '#f5f3ff',
                'card_shadow' => 'rgba(109, 40, 217, 0.12)',
            ],
            'orange' => [
                'primary' => '#c2410c',
                'gradient' => 'linear-gradient(135deg, #9a3412 0%, #ea580c 50%, #f97316 100%)',
                'bg_light' => '#fff7ed',
                'card_shadow' => 'rgba(194, 65, 12, 0.12)',
            ],
            'dark' => [
                'primary' => '#0f172a',
                'gradient' => 'linear-gradient(135deg, #020617 0%, #0f172a 50%, #1e293b 100%)',
                'bg_light' => '#f8fafc',
                'card_shadow' => 'rgba(15, 23, 42, 0.15)',
            ],
            'teal' => [
                'primary' => '#0f766e',
                'gradient' => 'linear-gradient(135deg, #134e4a 0%, #0d9488 50%, #14b8a6 100%)',
                'bg_light' => '#f0fdfa',
                'card_shadow' => 'rgba(15, 118, 110, 0.12)',
            ],
        ];
        $activeTheme = $themeConfig[$theme] ?? $themeConfig['green'];
    @endphp

    <style>
        :root {
            --primary: {{ $activeTheme['primary'] }};
            --primary-gradient: {{ $activeTheme['gradient'] }};
            --bg-light: {{ $activeTheme['bg_light'] }};
            --card-shadow: {{ $activeTheme['card_shadow'] }};
        }

        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }

        .hero-section {
            background: var(--primary-gradient);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50px;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
            background: white;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .hero-tagline {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto 20px;
        }

        .hero-meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 0.95rem;
            opacity: 0.85;
        }

        .portfolio-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px var(--card-shadow);
            border: 1px solid rgba(0, 0, 0, 0.04);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title::after {
            content: "";
            height: 3px;
            flex-grow: 1;
            background: linear-gradient(to right, var(--primary), transparent);
            border-radius: 2px;
            opacity: 0.2;
        }

        .skill-tag {
            background: var(--bg-light);
            color: var(--primary);
            padding: 8px 18px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .skill-tag:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }

        .project-item {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
            transition: all 0.4s;
            height: 100%;
        }

        .project-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 45px var(--card-shadow);
        }

        .project-img-wrapper {
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .project-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-content {
            padding: 25px;
        }

        .project-title {
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .project-tags {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 15px;
        }

        .project-link {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }

        .info-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #edf2f7;
        }

        .info-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            margin-top: 4px;
        }

        .footer {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.7);
            padding: 40px 0;
            margin-top: 80px;
            text-align: center;
        }

        .social-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1.2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .social-btn:hover {
            background: var(--primary);
            transform: translateY(-5px);
            color: white;
            box-shadow: 0 5px 15px var(--card-shadow);
        }
    </style>
</head>

<body>

    <section class="hero-section">
        <div class="container hero-content">
            <img src="{{ $user->studentProfile && $user->studentProfile->photo ? asset($user->studentProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=200' }}"
                alt="{{ $user->name }}" class="hero-avatar">
            <h1 class="hero-title">{{ $user->name }}</h1>
            @if ($portfolio->tagline)
                <p class="hero-tagline">{{ $portfolio->tagline }}</p>
            @endif
            <div class="hero-meta">
                <span><i class="bi bi-geo-alt me-1"></i>
                    {{ ucfirst($user->studentProfile->district->name) ?? 'CHT, Bangladesh' }}</span>
                @if ($user->training)
                    <span><i class="bi bi-mortarboard me-1"></i> {{ $user->training->course->name }} কোর্স</span>
                @endif
            </div>
        </div>
    </section>

    <div class="container">
        <div class="portfolio-card">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="mb-5">
                        <h2 class="section-title"><i class="bi bi-person-badge"></i> আমার সম্পর্কে</h2>
                        <p style="font-size:1.1rem; color:#475569;">
                            {{ $user->profile->bio ?? 'স্বাগতম! আমি একজন প্রযুক্তিপ্রেমী এবং সিএইচটিডিবি-র তত্ত্বাবধানে আইসিটি প্রশিক্ষণ সম্পন্ন করেছি।' }}
                        </p>
                    </div>

                    <!-- Skills Section -->
                    <div class="mb-5">
                        <h2 class="section-title"><i class="bi bi-cpu"></i> প্রযুক্তিগত দক্ষতা</h2>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($user->skills as $skill)
                                <span class="skill-tag">{{ $skill->name }}</span>
                            @empty
                                <span class="text-muted">এখনো কোনো দক্ষতা যুক্ত করা হয়নি।</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Projects Section -->
                    <div>
                        <h2 class="section-title"><i class="bi bi-layers"></i> প্রজেক্টসমূহ</h2>
                        <div class="row g-4">
                            @forelse($user->projects->sortByDesc('is_featured')->take(6) as $project)
                                <div class="col-md-6">
                                    <div class="project-item">
                                        <div class="project-img-wrapper">
                                            <img src="{{ $project->image ? asset($project->image) : 'https://via.placeholder.com/400x250?text=' . urlencode($project->name) }}"
                                                alt="{{ $project->name }}" class="project-img">
                                        </div>
                                        <div class="project-content">
                                            <h5 class="project-title">{{ $project->name }}</h5>
                                            <div class="project-tags">{{ $project->technologies }}</div>
                                            <p class="small text-muted mb-3">
                                                {{ Str::limit($project->description, 100) }}</p>
                                            <div class="d-flex gap-3">
                                                @if ($project->link)
                                                    <a href="{{ $project->link }}" target="_blank"
                                                        class="project-link"><i class="bi bi-box-arrow-up-right"></i>
                                                        প্রজেক্ট ভিজিট করুন</a>
                                                @endif
                                                @if ($project->github)
                                                    <a href="{{ $project->github }}" target="_blank"
                                                        class="project-link text-dark"><i class="bi bi-github"></i>
                                                        কোডবেস</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted">কোনো প্রজেক্ট পাওয়া যায়নি।</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Training Info -->
                    @if ($user->training)
                        <div class="mb-5">
                            <h2 class="section-title"><i class="bi bi-award"></i> প্রশিক্ষণ তথ্য</h2>
                            <div class="info-card">
                                <div class="mb-3">
                                    <div class="info-label">কোর্স</div>
                                    <div class="info-value text-primary">{{ $user->training->course->name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="info-label">ট্রেনিং সেন্টার</div>
                                    <div class="info-value">
                                        {{ $user->training->center->name ?? 'CHTDB Training Center' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="info-label">স্ট্যাটাস</div>
                                        <div class="info-value"><span class="badge bg-success"
                                                style="font-size:0.7rem; border-radius:50px;">{{ strtoupper($user->training->status) }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-label">গ্রেড</div>
                                        <div class="info-value">{{ $user->training->grade ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Professional Experience -->
                    @if ($user->career && $user->career->designation)
                        <div class="mb-5">
                            <h2 class="section-title"><i class="bi bi-briefcase"></i> পেশাদার অভিজ্ঞতা</h2>
                            <div class="info-card" style="border-left: 4px solid var(--primary);">
                                <div class="info-value" style="font-size:1.1rem;">{{ $user->career->designation }}
                                </div>
                                <div class="text-muted small mb-2">{{ $user->career->company }}</div>
                                <div class="badge bg-light text-dark border">{{ ucfirst($user->career->status) }}</div>
                                @if ($user->career->join_date)
                                    <div class="mt-2 small text-muted"><i class="bi bi-calendar3 me-1"></i> যোগদান:
                                        {{ $user->career->join_date->format('M Y') }}</div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Social Links -->
                    <div>
                        <h2 class="section-title"><i class="bi bi-chat-dots"></i> যোগাযোগ করুন</h2>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="mailto:{{ $user->email }}" class="social-btn" title="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                            @if ($user->socialLinks && $user->socialLinks->phone)
                                <a href="tel:{{ $user->socialLinks->phone }}" class="social-btn" title="Phone">
                                    <i class="bi bi-telephone"></i>
                                </a>
                            @endif
                            @if ($user->socialLinks && $user->socialLinks->linkedin)
                                <a href="{{ $user->socialLinks->linkedin }}" target="_blank" class="social-btn"
                                    title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            @endif
                            @if ($user->socialLinks && $user->socialLinks->github)
                                <a href="{{ $user->socialLinks->github }}" target="_blank" class="social-btn"
                                    title="GitHub"><i class="bi bi-github"></i></a>
                            @endif
                            @if ($user->socialLinks && $user->socialLinks->facebook)
                                <a href="{{ $user->socialLinks->facebook }}" target="_blank" class="social-btn"
                                    title="Facebook"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if ($user->socialLinks && $user->socialLinks->twitter)
                                <a href="{{ $user->socialLinks->twitter }}" target="_blank" class="social-btn"
                                    title="Twitter"><i class="bi bi-twitter-x"></i></a>
                            @endif
                            @if ($user->socialLinks && $user->socialLinks->website)
                                <a href="{{ $user->socialLinks->website }}" target="_blank" class="social-btn"
                                    title="Website"><i class="bi bi-globe"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="mb-2">© {{ date('Y') }} <strong>ICT Skill Development Scheme</strong></p>
            <a href="https://www.chtdb.gov.bd/" target="_blank" class="small opacity-50">CHT Development Board,
                Bangladesh</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
