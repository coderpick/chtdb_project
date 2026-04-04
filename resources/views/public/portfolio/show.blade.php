<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: {{ $portfolio->theme && $portfolio->theme != 'primary' ? '#3b82f6' : '#1a6b3c' }};
        }
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, #2d8f5e 100%);
            color: white;
            padding: 4rem 0;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.3);
        }
        .section {
            padding: 3rem 0;
        }
        .project-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .project-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
        .badge-custom {
            background: var(--primary);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Hero -->
    <section class="hero text-center">
        <div class="container">
            <img src="{{ $user->profile && $user->profile->photo ? asset('storage/' . $user->profile->photo) : 'https://via.placeholder.com/150' }}" alt="{{ $user->name }}" class="profile-img mb-3">
            <h2>{{ $user->name }}</h2>
            @if($portfolio->tagline)
                <p class="lead">{{ $portfolio->tagline }}</p>
            @endif
            <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ $user->profile->district ?? 'N/A' }}</p>
            @if($user->training && $user->training->course)
                <p class="mb-0">{{ $user->training->course->name }} @ {{ $user->training->center->name ?? '' }}</p>
            @endif
        </div>
    </section>

    <!-- About -->
    <section class="section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h4 class="mb-3">About Me</h4>
                    <p>{{ $user->profile->bio ?? 'No bio available.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section class="section">
        <div class="container">
            <h4 class="mb-3">Skills</h4>
            @if($user->skills->isEmpty())
                <p class="text-muted">No skills added.</p>
            @else
                <div class="d-flex flex-wrap gap-2">
                    @foreach($user->skills as $skill)
                        <span class="badge badge-custom px-3 py-2">{{ $skill->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Training -->
    @if($user->training && $user->training->course)
        <section class="section bg-white">
            <div class="container">
                <h4 class="mb-3">Training</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Course:</strong> {{ $user->training->course->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Center:</strong> {{ $user->training->center->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> {{ ucfirst($user->training->status) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Grade:</strong> {{ $user->training->grade ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Projects -->
    <section class="section">
        <div class="container">
            <h4 class="mb-3">Projects</h4>
            @if($user->projects->isEmpty())
                <p class="text-muted">No projects to show.</p>
            @else
                <div class="row g-4">
                    @foreach($user->projects->sortByDesc('is_featured')->take(6) as $project)
                        <div class="col-md-4">
                            <div class="project-card">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="project-img">
                                @endif
                                <div class="p-3">
                                    <h5>{{ $project->name }}</h5>
                                    <p class="small text-muted">{{ $project->technologies }}</p>
                                    <p>{{ Str::limit($project->description, 100) }}</p>
                                    @if($project->link)
                                        <a href="{{ $project->link }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                    @endif
                                    @if($project->github)
                                        <a href="{{ $project->github }}" target="_blank" class="btn btn-sm btn-outline-secondary">GitHub</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Career -->
    @if($user->career && $user->career->designation)
        <section class="section bg-white">
            <div class="container">
                <h4 class="mb-3">Career</h4>
                <p>{{ $user->career->designation }} @ {{ $user->career->company }}</p>
                <p class="text-muted">{{ ucfirst($user->career->status) }} | Started: {{ $user->career->join_date?->format('M Y') }}</p>
            </div>
        </section>
    @endif

    <!-- Contact -->
    <section class="section">
        <div class="container text-center">
            <h4 class="mb-3">Get in Touch</h4>
            <div class="d-flex justify-content-center gap-3">
                @if($user->socialLinks && $user->socialLinks->email)
                    <a href="mailto:{{ $user->email }}" class="btn btn-primary"><i class="bi bi-envelope"></i> Email</a>
                @endif
                @if($user->socialLinks && $user->socialLinks->linkedin)
                    <a href="{{ $user->socialLinks->linkedin }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-linkedin"></i> LinkedIn</a>
                @endif
                @if($user->socialLinks && $user->socialLinks->github)
                    <a href="{{ $user->socialLinks->github }}" target="_blank" class="btn btn-outline-dark"><i class="bi bi-github"></i> GitHub</a>
                @endif
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <small>&copy; {{ date('Y') }} ICT Skill Development Scheme, CHTDB</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
