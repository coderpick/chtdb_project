@extends('admin.layouts.admin')

@section('title', 'Student Profile')
@section('page-title', 'Student Profile')

@section('content')
    @php
        $portfolio = $user->portfolioSetting;
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

    @push('styles')
        <style>
            :root {
                --primary: {{ $activeTheme['primary'] }};
                --primary-gradient: {{ $activeTheme['gradient'] }};
                --bg-light: {{ $activeTheme['bg_light'] }};
                --card-shadow: {{ $activeTheme['card_shadow'] }};
            }

            .portfolio-hero {
                background: var(--primary-gradient);
                color: white;
                padding: 40px;
                border-radius: 20px;
                margin-bottom: 30px;
                position: relative;
                overflow: hidden;
            }

            .portfolio-hero::after {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 1;
            }

            .hero-avatar {
                width: 120px;
                height: 120px;
                border-radius: 30px;
                object-fit: cover;
                border: 4px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                background: white;
            }

            .section-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .section-title::after {
                content: "";
                height: 2px;
                flex-grow: 1;
                background: linear-gradient(to right, var(--primary), transparent);
                opacity: 0.1;
            }

            .skill-tag {
                background: var(--bg-light);
                color: var(--primary);
                padding: 6px 14px;
                border-radius: 10px;
                font-weight: 600;
                font-size: 0.85rem;
                border: 1px solid rgba(0, 0, 0, 0.05);
            }

            .project-card {
                background: white;
                border-radius: 15px;
                overflow: hidden;
                border: 1px solid #f1f5f9;
                transition: transform 0.3s;
                height: 100%;
            }

            .project-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px var(--card-shadow);
            }

            .info-card {
                background: #f8fafc;
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 20px;
                border: 1px solid #edf2f7;
            }

            .info-label {
                font-weight: 700;
                font-size: 0.75rem;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .info-value {
                font-weight: 600;
                color: #1e293b;
                margin-top: 2px;
            }

            .social-btn {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--bg-light);
                color: var(--primary);
                text-decoration: none;
                font-size: 1.1rem;
                border: 1px solid rgba(0, 0, 0, 0.05);
                transition: all 0.2s;
            }

            .social-btn:hover {
                background: var(--primary);
                color: white;
                transform: scale(1.1);
            }
        </style>
    @endpush

    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </nav>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <a href="{{ route('admin.students.edit', $user) }}" class="btn btn-primary btn-sm px-3">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="portfolio-hero">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-auto">
                <img src="{{ $user->studentProfile && $user->studentProfile->photo ? asset($user->studentProfile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=200' }}"
                    alt="{{ $user->name }}" class="hero-avatar">
            </div>
            <div class="col">
                <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
                @if ($user->portfolioSetting && $user->portfolioSetting->tagline)
                    <p class="mb-2 opacity-75">{{ $user->portfolioSetting->tagline }}</p>
                @endif
                <div class="d-flex gap-3 flex-wrap small opacity-75">
                    <span><i class="bi bi-envelope me-1"></i> {{ $user->email }}</span>
                    @if ($user->studentProfile && $user->studentProfile->phone)
                        <span><i class="bi bi-telephone me-1"></i> {{ $user->studentProfile->phone }}</span>
                    @endif
                    <span><i class="bi bi-geo-alt me-1"></i>
                        {{ $user->studentProfile->district->bn_name ?? 'CHT, Bangladesh' }}</span>
                </div>
            </div>
            <div class="col-md-auto mt-3 mt-md-0 text-md-end">
                <div class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-mortarboard-fill me-1 text-primary"></i>
                    {{ $user->training->course->name ?? 'Student' }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Biography -->
            <div class="card border-0 shadow-sm mb-4 rounded-4 px-2">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-person-badge"></i> Biography</h5>
                    <p class="text-muted">
                        {{ $user->studentProfile->bio ?? 'No biography provided yet. This student is currently undergoing ICT skill development training.' }}
                    </p>
                </div>
            </div>

            <!-- Skills -->
            <div class="card border-0 shadow-sm mb-4 rounded-4 px-2">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-cpu"></i> Technical Skills</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($user->skills as $skill)
                            <span class="skill-tag">{{ $skill->name }}</span>
                        @empty
                            <span class="text-muted small">No skills added by student yet.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Projects -->
            <div class="card border-0 shadow-sm mb-4 rounded-4 px-2">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-layers"></i> Projects</h5>
                    <div class="row g-3">
                        @forelse($user->projects as $project)
                            <div class="col-md-6">
                                <div class="project-card">
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">{{ $project->name }}</h6>
                                            @if ($project->is_featured)
                                                <span class="badge bg-warning text-dark" style="font-size: 0.6rem;">
                                                    <i class="bi bi-star-fill"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <p class="small text-muted mb-3">{{ Str::limit($project->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-primary small fw-bold">{{ $project->technologies }}</span>
                                            <div class="d-flex gap-2">
                                                @if ($project->link)
                                                    <a href="{{ $project->link }}" target="_blank"
                                                        class="text-secondary" title="View Project"><i
                                                            class="bi bi-box-arrow-up-right"></i></a>
                                                @endif
                                                @if ($project->github)
                                                    <a href="{{ $project->github }}" target="_blank"
                                                        class="text-secondary" title="GitHub Source"><i
                                                            class="bi bi-github"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted small">No projects showcased yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Training Info -->
            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-award"></i> Training</h5>
                    @if ($user->training)
                        <div class="info-card mb-0">
                            <div class="mb-3">
                                <div class="info-label">Current Course</div>
                                <div class="info-value text-primary">{{ $user->training->course->name }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="info-label">Training Center</div>
                                <div class="info-value">{{ $user->training->center->name ?? 'Main Center' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="info-label">Status</div>
                                    <div class="info-value">
                                        <span
                                            class="badge bg-success-subtle text-success px-2">{{ strtoupper($user->training->status) }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Grade</div>
                                    <div class="info-value">{{ $user->training->grade ?? 'Pending' }}</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-muted small mb-0">Not enrolled in any current training.</p>
                    @endif
                </div>
            </div>

            <!-- Career -->
            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-briefcase"></i> Experience</h5>
                    @if ($user->career)
                        <div class="info-card mb-0" style="border-left: 4px solid var(--primary);">
                            <div class="info-value">{{ $user->career->designation ?? 'Employed' }}</div>
                            <div class="small text-muted mb-2">{{ $user->career->company ?? 'Company Info' }}</div>
                            <div class="badge bg-light text-dark border-0 small">
                                {{ ucfirst($user->career->status) }}</div>
                        </div>
                    @else
                        <p class="text-muted small mb-0">No career information recorded.</p>
                    @endif
                </div>
            </div>

            <!-- Social Contacts -->
            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-chat-dots"></i> Contact Info</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="mailto:{{ $user->email }}" class="social-btn" title="Send Email">
                            <i class="bi bi-envelope"></i>
                        </a>
                        @if ($user->socialLinks && $user->socialLinks->phone)
                            <a href="tel:{{ $user->socialLinks->phone }}" class="social-btn" title="Call">
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
                        @if ($user->socialLinks && $user->socialLinks->website)
                            <a href="{{ $user->socialLinks->website }}" target="_blank" class="social-btn"
                                title="Website"><i class="bi bi-globe"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Portfolio Info -->
            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body">
                    <h5 class="section-title"><i class="bi bi-pc-display"></i> Portfolio Status</h5>
                    @if ($user->portfolioSetting)
                        <div class="info-card mb-0">
                            <div class="mb-3">
                                <div class="info-label">Slug / URL</div>
                                <div class="info-value small">/portfolio/{{ $user->portfolioSetting->slug }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="info-label">Theme</div>
                                    <div class="info-value text-capitalize">{{ $user->portfolioSetting->theme }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Visibility</div>
                                    <div class="info-value">
                                        {!! $user->portfolioSetting->is_visible
                                            ? '<span class="text-success"><i class="bi bi-eye"></i> Public</span>'
                                            : '<span class="text-danger"><i class="bi bi-eye-slash"></i> Private</span>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-muted small mb-0">Portfolio not initialized.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
