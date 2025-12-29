<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin Dashboard') - Golden Wave</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #cbd0d2 0%, #0f3d52 100%);
            background-attachment: fixed;
            background-size: cover;
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: var(--surface, #ffffff);
            border-right: 1px solid rgba(0, 0, 0, 0.04);
            padding: 24px;
            position: relative;
            transition: width .2s ease;
        }

        .admin-sidebar .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 1.2rem;
            color: #1a5f7a;
        }

        .admin-sidebar .nav-link {
            padding: 10px 12px;
            border-radius: 8px;
            color: #334155;
        }

        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background: #f1f5f9;
            color: #0f3d52;
        }

        .admin-main {
            flex: 1;
            padding: 28px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .card-analytic {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(18, 38, 63, 0.06);
        }

        .small-card {
            padding: 18px;
        }

        .kanban {
            background: #ffffff;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 6px 20px rgba(18, 38, 63, 0.06);
        }

        .sidebar-footer {
            position: absolute;
            bottom: 24px;
            left: 24px;
            right: 24px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Ensure navbar toggler icon is visible in admin topbar */
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }
        .navbar-toggler-icon {
            display: inline-block;
            width: 1.25em;
            height: 1.25em;
            vertical-align: middle;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(0,0,0,0.7)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }

        /* Mobile off-canvas sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1040;
            transition: opacity .2s ease;
        }

        @media (max-width: 992px) {
            .admin-shell { flex-direction: column; }
            /* hide fixed sidebar on small screens; use offcanvas instead */
            .admin-sidebar { display: none; }
            .admin-main { padding: 16px; }
            .admin-shell.sidebar-open .admin-sidebar { left: 0; }
            .admin-shell.sidebar-open .sidebar-overlay { display: block; }
            .topbar { justify-content: space-between; gap: 12px; }
        }

        /* Collapsed sidebar for compact view */
        .admin-shell.collapsed .admin-sidebar {
            width: 72px !important;
        }
        .admin-shell.collapsed .admin-sidebar .logo-text { display: none; }
        .admin-shell.collapsed .admin-sidebar .nav-link { justify-content: center; }
        .admin-shell.collapsed .admin-sidebar .nav-link .nav-label { display: none; }
        .admin-shell.collapsed .admin-sidebar .sidebar-footer { display: none; }
    </style>

    <style>
        /* Admin responsive tweaks */
        @media (max-width: 992px) {
            /* hide the in-page sidebar on small screens so only the offcanvas is used */
            .admin-sidebar { display: none !important; }
            .admin-main { padding: 16px; }
            .admin-shell { flex-direction: column; }
        }

        @media (max-width: 576px) {
            .topbar h2 { font-size: 1.1rem; }
            .admin-main { padding: 12px; }
            .admin-shell { flex-direction: column; }
            .kanban { padding: 12px; }
        }
    </style>

    @stack('head')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar d-flex flex-column position-relative">
            <div>
                <div class="d-flex align-items-center mb-4">
                        <div class="logo d-flex align-items-center">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="logo" height="34">
                            <span class="logo-text ms-2">Golden Wave</span>
                        </div>
                        <!-- desktop collapse removed: burger only appears on small screens -->
                    </div>

                <nav class="nav flex-column">
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-simple me-2"></i><span class="nav-label">Analytics</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}"><i class="fa-solid fa-receipt me-2"></i><span class="nav-label">Bookings</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}" href="{{ route('admin.rooms.index') }}"><i class="fa-solid fa-bed me-2"></i><span class="nav-label">Rooms</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.cancellations.*') ? 'active' : '' }}" href="{{ route('admin.cancellations.index') }}"><i class="fa-solid fa-ban me-2"></i><span class="nav-label">Cancellations</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}"><i class="fa-solid fa-newspaper me-2"></i><span class="nav-label">Articles</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}"><i class="fa-solid fa-boxes-stacked me-2"></i><span class="nav-label">Services</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users-cog me-2"></i><span class="nav-label">Users</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}"><i class="fa-solid fa-users me-2"></i><span class="nav-label">Customers</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope me-2"></i><span class="nav-label">Messages</span></a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}" href="{{ route('admin.activity.index') }}"><i class="fa-solid fa-clock-rotate-left me-2"></i><span class="nav-label">Activity Log</span></a>
                </nav>
            </div>

            <div class="sidebar-footer mt-auto">
                <div class="small text-muted">Signed in as</div>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <img src="{{ asset('images/logo/logo.png') }}" class="avatar" alt="avatar">
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-muted small">Super Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="admin-main">
            <div class="topbar">
                    <div class="d-flex align-items-center">
                            <button id="sidebarToggle" class="navbar-toggler d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminNavOffcanvas" aria-controls="adminNavOffcanvas" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                                <h2 class="m-0">@yield('page-title','Dashboard')</h2>
                            </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="me-2 d-none d-md-block">{{ now()->format('d M Y') }}</div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm text-dark border-0">Sign out</button>
                    </form>
                </div>
            </div>

            @yield('content')
        </main>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Admin navigation offcanvas for small screens -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminNavOffcanvas" aria-labelledby="adminNavOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="adminNavOffcanvasLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-simple me-2"></i><span class="nav-label">Analytics</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}"><i class="fa-solid fa-receipt me-2"></i><span class="nav-label">Bookings</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}" href="{{ route('admin.rooms.index') }}"><i class="fa-solid fa-bed me-2"></i><span class="nav-label">Rooms</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.cancellations.*') ? 'active' : '' }}" href="{{ route('admin.cancellations.index') }}"><i class="fa-solid fa-ban me-2"></i><span class="nav-label">Cancellations</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}"><i class="fa-solid fa-newspaper me-2"></i><span class="nav-label">Articles</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}"><i class="fa-solid fa-boxes-stacked me-2"></i><span class="nav-label">Services</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users-cog me-2"></i><span class="nav-label">Users</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}"><i class="fa-solid fa-users me-2"></i><span class="nav-label">Customers</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope me-2"></i><span class="nav-label">Messages</span></a>
                <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}" href="{{ route('admin.activity.index') }}"><i class="fa-solid fa-clock-rotate-left me-2"></i><span class="nav-label">Activity Log</span></a>
            </nav>
            <hr>
            <div class="small text-muted">Signed in as</div>
            <div class="d-flex align-items-center gap-2 mt-2">
                <img src="{{ asset('images/logo/logo.png') }}" class="avatar" alt="avatar">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="text-muted small">Super Admin</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('scripts')

    <script>
        (function(){
            const toggle = document.getElementById('sidebarToggle');
            // desktop collapse button removed; no collapseBtn element
            const shell = document.querySelector('.admin-shell');
            const overlay = document.getElementById('sidebarOverlay');

            // top hamburger uses Bootstrap offcanvas (data-bs-toggle="offcanvas");
            // we intentionally do not toggle `.sidebar-open` here to avoid
            // duplicating Bootstrap's backdrop/visibility behavior.

            // no collapse handler (desktop collapse removed)

            if (overlay) {
                overlay.addEventListener('click', function(){
                    shell.classList.remove('sidebar-open');
                });
            }

            document.addEventListener('keydown', function(e){
                if (e.key === 'Escape' && shell.classList.contains('sidebar-open')) {
                    shell.classList.remove('sidebar-open');
                }
            });
        })();
    </script>
</body>
</html>
