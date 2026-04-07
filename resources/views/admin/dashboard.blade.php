@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')
<style>
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .avatar-circle {
        width: 35px;
        height: 35px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .quick-action-card {
        border: 1px solid #edf2f7;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .quick-action-card:hover {
        background: #f8fafc;
        border-color: var(--primary);
        color: var(--primary);
    }
    .quick-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>

<div class="row g-4 mb-4">
    <!-- Total Students -->
    <div class="col-12 col-sm-6 col-xl">
        <div class="card stat-card p-3 border-0 shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Students</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['students'] ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Courses -->
    <div class="col-12 col-sm-6 col-xl">
        <div class="card stat-card p-3 border-0 shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Courses</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['courses'] ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-info-subtle text-info">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Centers -->
    <div class="col-12 col-sm-6 col-xl">
        <div class="card stat-card p-3 border-0 shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Centers</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['centers'] ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Stories -->
    <div class="col-12 col-sm-6 col-xl">
        <div class="card stat-card p-3 border-0 shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Success</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['success_stories'] ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-award"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Messages -->
    <div class="col-12 col-sm-6 col-xl">
        <div class="card stat-card p-3 border-0 shadow-sm">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small text-uppercase fw-bold">Messages</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_messages'] ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-danger-subtle text-danger position-relative">
                    <i class="bi bi-envelope"></i>
                    @if(($stats['new_messages'] ?? 0) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $stats['new_messages'] }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Students Table -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Recent Students</h5>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-light border fw-bold text-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>District</th>
                                <th>Course</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentStudents as $student)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $student->name }}</div>
                                            <div class="text-muted small">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted small">{{ $student->studentProfile->district->bn_name ?? '-' }}</span></td>
                                <td><span class="badge bg-light text-dark border fw-normal">{{ $student->training->course->name ?? '-' }}</span></td>
                                <td>
                                    @if($student->training)
                                        <span class="badge bg-success-subtle text-success px-3">{{ ucfirst($student->training->status) }}</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning px-3">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-lightning-charge text-warning me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('admin.courses.create') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-primary-subtle text-primary"><i class="bi bi-plus-lg"></i></div>
                            <span class="small fw-bold">Course</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.students.index') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-info-subtle text-info"><i class="bi bi-search"></i></div>
                            <span class="small fw-bold">Find</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.centers.create') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-warning-subtle text-warning"><i class="bi bi-geo-alt"></i></div>
                            <span class="small fw-bold">Center</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.success-stories.create') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-success-subtle text-success"><i class="bi bi-quote"></i></div>
                            <span class="small fw-bold">Story</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.gallery.create') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-secondary-subtle text-secondary"><i class="bi bi-image"></i></div>
                            <span class="small fw-bold">Photo</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.messages.index') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-danger-subtle text-danger"><i class="bi bi-chat-dots"></i></div>
                            <span class="small fw-bold">Inbox</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Updates / Stats Card -->
        <div class="card border-0 shadow-sm mt-4 bg-primary text-white overflow-hidden position-relative" style="border-radius: 16px; background: linear-gradient(135deg, #17264f 0%, #1a6b3c 100%) !important;">
            <div class="card-body p-4 position-relative" style="z-index: 1;">
                <h5 class="fw-bold mb-1">CHTDB Admin</h5>
                <p class="small text-white-50 mb-3">Welcome back! Everything looks good today.</p>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-25 rounded-3 p-2 text-center flex-fill">
                        <div class="small text-white-50">New Msg</div>
                        <div class="fw-bold">{{ $stats['new_messages'] ?? 0 }}</div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-3 p-2 text-center flex-fill">
                        <div class="small text-white-50">Pending</div>
                        <div class="fw-bold">{{ $stats['success_stories'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
            <i class="bi bi-shield-check position-absolute bottom-0 end-0 m-n4 opacity-10" style="font-size: 10rem;"></i>
        </div>
    </div>
</div>
@endsection
