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
    </style>

    @stack('head')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar d-flex flex-column position-relative">
            <div>
                <div class="logo mb-4">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo" height="34">
                    <span>Golden Wave</span>
                </div>

                <nav class="nav flex-column">
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-simple me-2"></i> Analytics</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}"><i class="fa-solid fa-receipt me-2"></i> Bookings</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}" href="{{ route('admin.rooms.index') }}"><i class="fa-solid fa-bed me-2"></i> Rooms</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.cancellations.*') ? 'active' : '' }}" href="{{ route('admin.cancellations.index') }}"><i class="fa-solid fa-ban me-2"></i> Cancellations</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}"><i class="fa-solid fa-newspaper me-2"></i> Articles</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}"><i class="fa-solid fa-boxes-stacked me-2"></i> Services</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users-cog me-2"></i> Users</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}"><i class="fa-solid fa-users me-2"></i> Customers</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope me-2"></i> Messages</a>
                    <a class="nav-link d-flex align-items-center mb-1 {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}" href="{{ route('admin.activity.index') }}"><i class="fa-solid fa-clock-rotate-left me-2"></i> Activity Log</a>
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
                <h2 class="m-0">@yield('page-title','Dashboard')</h2>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('scripts')
</body>
</html>
