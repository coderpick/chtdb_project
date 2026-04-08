<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - CHTDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a6b3c;
            --secondary: #2d8f5e;
            --sidebar-width: 240px;
            --sidebar-collapsed-width: 68px;
            --sidebar-transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: #f5f6fa;
            margin: 0;
        }

        /* ── Wrapper layout ── */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: #17264f;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: width var(--sidebar-transition);
            overflow-y: auto;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-inner {
            width: var(--sidebar-width);
            /* fixed – prevents text wrapping */
            padding: 1.25rem 1rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            margin-bottom: 2rem;
            padding: 0 0.25rem;
        }

        .sidebar-brand i {
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            opacity: 1;
            transition: opacity var(--sidebar-transition);
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
        }

        /* Nav links */
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            white-space: nowrap;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .sidebar .nav-link .link-text {
            opacity: 1;
            transition: opacity var(--sidebar-transition);
        }

        .sidebar.collapsed .nav-link .link-text {
            opacity: 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* Tooltip when collapsed */
        .sidebar.collapsed .nav-link::after {
            content: attr(data-label);
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 8px);
            background: #1a6b3c;
            color: #fff;
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            z-index: 9999;
        }

        .sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
        }

        /* Logout button */
        .sidebar .btn-logout {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            width: 100%;
            text-align: left;
            cursor: pointer;
            color: #ff6b6b;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s;
        }

        .sidebar .btn-logout:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        .sidebar .btn-logout i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .sidebar .btn-logout .link-text {
            opacity: 1;
            transition: opacity var(--sidebar-transition);
        }

        .sidebar.collapsed .btn-logout .link-text {
            opacity: 0;
        }

        /* ── Main area ── */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            transition: margin-left var(--sidebar-transition);
        }

        /* ── Header ── */
        .header {
            background: white;
            padding: 0.9rem 1.75rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        /* Toggle button */
        #sidebarToggle {
            background: none;
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 0.35rem 0.55rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
            flex-shrink: 0;
        }

        #sidebarToggle:hover {
            background: rgba(26, 107, 60, 0.08);
            border-color: var(--primary);
            color: var(--primary);
        }

        #sidebarToggle i {
            font-size: 1.15rem;
        }

        .header-title {
            font-weight: 600;
            font-size: 1.05rem;
            flex: 1;
        }

        .header-user {
            color: #666;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        /* ── Content ── */
        .content {
            padding: 1.75rem;
            flex: 1;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--secondary);
            border-color: var(--secondary);
        }

        /* ── Responsive ── */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                transform: translateX(0);
                transition: transform var(--sidebar-transition), width var(--sidebar-transition);
                z-index: 200;
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
                /* keep full width on mobile */
                transform: translateX(calc(-1 * var(--sidebar-width)));
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.35);
                z-index: 199;
            }

            .sidebar-overlay.visible {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="admin-wrapper">

        <!-- Sidebar -->
        <nav class="sidebar" id="adminSidebar">
            <div class="sidebar-inner">
                <!-- Brand -->
                <div class="sidebar-brand">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="brand-text">CHTDB Admin</span>
                </div>

                <!-- Nav -->
                <ul class="nav flex-column flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}" data-label="Dashboard">
                            <i class="bi bi-speedometer2"></i>
                            <span class="link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}"
                            href="{{ route('admin.courses.index') }}" data-label="Courses">
                            <i class="bi bi-book"></i>
                            <span class="link-text">Courses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.centers*') ? 'active' : '' }}"
                            href="{{ route('admin.centers.index') }}" data-label="Centers">
                            <i class="bi bi-geo-alt"></i>
                            <span class="link-text">Centers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.success-stories.index') }}"
                            class="nav-link {{ request()->routeIs('admin.success-stories.*') ? 'active' : '' }}"
                            data-label="Success Stories">
                            <i class="bi bi-chat-quote-fill nav-icon"></i>
                            <span class="link-text">Success Stories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}"
                            href="{{ route('admin.gallery.index') }}" data-label="Gallery">
                            <i class="bi bi-images"></i>
                            <span class="link-text">Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}"
                            href="{{ route('admin.students.index') }}" data-label="Students">
                            <i class="bi bi-people"></i>
                            <span class="link-text">Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                            href="{{ route('admin.settings.index') }}" data-label="Settings">
                            <i class="bi bi-gear-fill"></i>
                            <span class="link-text">Site Settings</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"
                            href="{{ route('admin.messages.index') }}" data-label="Messages">
                            <i class="bi bi-envelope-fill"></i>
                            <span class="link-text">Messages</span>
                            @php
                                $unreadMessages = \App\Models\ContactMessage::where('status', 'new')->count();
                            @endphp
                            @if ($unreadMessages > 0)
                                <span
                                    class="badge bg-danger rounded-pill ms-auto unread-badge">{{ $unreadMessages }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Logout at bottom -->
                    <li class="nav-item mt-auto pt-3">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout" data-label="Logout">
                                <i class="bi bi-box-arrow-left"></i>
                                <span class="link-text">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Mobile overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Area -->
        <div class="main-area">
            <!-- Header -->
            <div class="header">
                <button id="sidebarToggle" aria-label="Toggle sidebar" title="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <span class="header-title">@yield('page-title', 'Dashboard')</span>
                <span class="header-user">
                    <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                </span>
            </div>

            <!-- Alerts -->
            <div class="content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');
            const isMobile = () => window.innerWidth < 768;
            const STORAGE_KEY = 'chtdb_sidebar_collapsed';

            // Auto-close on mobile load or restore saved state on desktop
            if (isMobile() || localStorage.getItem(STORAGE_KEY) === '1') {
                sidebar.classList.add('collapsed');
            }

            toggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');

                if (isMobile()) {
                    overlay.classList.toggle('visible', !sidebar.classList.contains('collapsed'));
                } else {
                    // Persist desktop state
                    localStorage.setItem(STORAGE_KEY, sidebar.classList.contains('collapsed') ? '1' : '0');
                }
            });

            // Close on overlay click (mobile)
            overlay.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                overlay.classList.remove('visible');
            });

            // On resize – handle mobile/desktop transitions
            window.addEventListener('resize', function() {
                if (isMobile()) {
                    sidebar.classList.add('collapsed');
                    overlay.classList.remove('visible');
                } else {
                    overlay.classList.remove('visible');
                    // Restore desktop state from storage
                    if (localStorage.getItem(STORAGE_KEY) === '1') {
                        sidebar.classList.add('collapsed');
                    } else {
                        sidebar.classList.remove('collapsed');
                    }
                }
            });
        })();
    </script>
    @stack('scripts')
</body>

</html>
