<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Golden Wave Resort')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1a5f7a;
            --secondary-color: #f39c12;
            --accent-color: #e8f4f8;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            margin: 0;
            color: var(--dark-color);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        /* Make the main content grow so footer sits at bottom */
        .site-main { flex: 1 0 auto; }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        /* Navigation Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%);
            padding: 1rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
        }
        
        .navbar-nav .nav-link {
            color: white !important;
            margin: 0 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link.active::before {
            width: 100%;
        }

        .navbar-nav .nav-link.active {
            font-weight: 700;
        }

        .navbar-nav .nav-link:hover::before {
            width: 100%;
        }

        .navbar .dropdown-toggle::after {
            display: inline-block;
            margin-left: 6px;
            vertical-align: middle;
            border-top: 5px solid #fff;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            border-bottom: 0;
        }

        
        
        /* Hero Section */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),
            url("images/backgrounds/hero-bg.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            padding: 120px 0;
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
        }
        
        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.8;
        }
        
        .btn-primary {
            background: var(--secondary-color);
            border: none;
            color: white;
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }
        
        .btn-primary:hover {
            background: #d68910;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.3);
            color: white;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-sm{
            background: #00bcd4;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-sm:hover{
            background: #0097a7;
            color: white;
            transform: translateX(5px);  
        }

        
        /* Featured Rooms Section */
        .featured-section {
            padding: 80px 0;
            background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }
        
        .section-title h2 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .section-title p {
            font-size: 1.1rem;
            color: #0f1010ff;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            margin: 1.5rem auto 0;
        }
        
        /* Room Cards */
        .Room-card {
            border: none;
            border-radius: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            height: 100%;
            background: white;
        }
        
        .Room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        
        .Room-image {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .Room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .Room-card:hover .Room-image img {
            transform: scale(1.1);
        }
            
        .Room-badges {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            z-index: 2;
        }
        
        .badge-item {
            background: white;
            padding: 8px 15px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .room-content {
            padding: 25px;
        }
        
        .room-content h3 {
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .room-content p {
            color: #7f8c8d;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .room-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #3a7483ff;
        }
        
        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Playfair Display', serif;
        }
        
        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%);
            color: white;
        }
        
        .feature-box {
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .feature-box:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 3.5rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        
        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .feature-box p {
            opacity: 0.9;
            line-height: 1.8;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #d1850aff 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        
        /* Footer */
        footer {
            background: #1a2332;
            color: #bdc3c7;
            padding: 50px 0 20px;
        }
        
        footer h5 {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        footer ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        footer ul li a:hover {
            color: var(--secondary-color);
        }
        
        footer .footer-contact {
            margin: 1rem 0;
        }
        
        footer .social-links a {
            color: var(--secondary-color);
            margin-right: 1rem;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }
        
        footer .social-links a:hover {
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 2rem;
            text-align: center;
            margin-top: 2rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .feature-box {
                margin-bottom: 2rem;
            }
        }
        
        /* Animation Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .hero-section {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .room-card {
            animation: none;
            opacity: 0;
            transform: translateY(30px) scale(.98);
            transition: transform 0.6s cubic-bezier(.2,.9,.2,1), opacity 0.6s ease;
            will-change: transform, opacity;
        }

        .room-card.in-view {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        
        .feature-box {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .btn-primary:hover {
            animation: pulse 0.3s ease-in-out;
        }

        /* Facilities Cards */
        .facilities-section {
            padding: 80px 0;
            background: linear-gradient(135deg,rgba(203, 208, 210, 0.85) 0%,rgba(15, 61, 82, 0.85) 100%);
            position: relative;
            z-index: 2;
        }

        .facility-row {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .facility-card {
            width: 210px;
            height: 270px;
            background: #ffffff;
            border-radius: 14px;
            padding: 26px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;

            box-shadow: 0 12px 30px rgba(0,0,0,0.08);

            transform-origin: center bottom;
            transition:transform 0.45s cubic-bezier(.2,.9,.2,1), box-shadow 0.3s ease;
        }

        .facility-card.stand-left {
            transform: rotate(-6deg);
        }

        .facility-card.stand-mid {
            transform: rotate(2deg);
        }

        .facility-card.stand-right {
            transform: rotate(6deg);
        }

        .facility-card:hover {
            transform: translateY(-14px) rotate(0deg) scale(1.05);
            box-shadow: 0 24px 50px rgba(0,0,0,0.18);
        }

        .facility-card .icon-large {
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 14px;
        }

        .facility-card h5 {
            font-size: 1.25rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .facility-card p {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.6;
        }


        /* === KONTEN PROMO === */
        .promo-section {
            position: relative;
            background: linear-gradient(135deg,rgba(203, 208, 210, 0.85) 0%,rgba(242, 222, 158, 0.85) 100%);
            padding: 120px 0 80px;
        }

        .promo-inner {
            position: relative;
            background: #ffffff;
            border-radius: 22px;
            padding: 48px 56px;
            display: flex;
            gap: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .promo-left {
            flex: 1;
        }

        .promo-badge {
            color: var(--secondary-color);
            font-weight: 600;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
        }

        .promo-left h3 {
            font-size: 1.9rem;
            margin: 12px 0;
            color: #2c3e50;
        }

        .promo-left p {
            color: #555;
            margin-bottom: 16px;
        }

        .promo-left ul {
            padding-left: 20px;
            margin: 0;
        }

        .promo-left li {
            margin-bottom: 8px;
            color: #444;
        }

        .promo-right {
            width: 320px;
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 18px;
        }

        .promo-offer {
            font-size: 1.1rem;
            color: #333;
        }

        .promo-offer span {
            font-weight: 700;
            color: var(--secondary-color);
        }

        .promo-right .btn {
            align-self: flex-end;
            padding: 12px 32px;
            border-radius: 50px;
        }

        .testimonials-section {
            padding: 80px 0;
            background: linear-gradient(135deg, rgba(203, 208, 210, 0.85) 0%, rgba(15, 61, 82, 0.85) 100%);
            color: white;
        }

        .testimonials-section .section-title h2 {
            color: var(--primary-color);
        }

        .testimonials-section .section-title p {
            color: rgba(0, 0, 0, 0.9);
        }

        .testimonial-card {
            background: #bbc9ccff;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.04);
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }


        .testimonial-quote {
            font-style: italic;
            color: #2c3e50;
            line-height: 1.6;
        }
        
        /* ===== Unified Section Gradients & Fade Utilities ===== */
        :root {
            /* Extended palette for smooth transitions (derived from existing vars) */
            --ocean-top: #0f3d52;    /* deep blue */
            --ocean-mid: #1a5f7a;    /* primary */
            --sand-top: #f2dec4;     /* light sand */
            --sand-bottom: #f7efe3;  /* softer sand */
            --accent-top: #f39c12;   /* warm accent */
            --accent-bottom: #f0b84a;
            --section-fade-height: 4.5rem;
        }

        /* Reusable consistent top->bottom gradients */
        .section { padding: 60px 0; position: relative; }
        .section--ocean { background: linear-gradient(to bottom, var(--ocean-top), var(--ocean-mid)); }
        .section--ocean-soft { background: linear-gradient(to bottom, var(--ocean-mid), rgba(26,95,122,0.6) 60%, var(--sand-top)); }
        .section--sand { background: linear-gradient(to bottom, var(--sand-top), var(--sand-bottom)); }
        .section--accent { background: linear-gradient(to bottom, var(--accent-top), var(--accent-bottom)); }

        /* Text contrast helpers */
        .section--ocean .text-contrast { color: #fff; }
        .section--sand .text-contrast, .section--accent .text-contrast { color: #2c3e50; }

        /* Subtle fade overlay at section bottom to avoid harsh jumps */
        .section-fade--bottom { position: relative; overflow: visible; }
        .section-fade--bottom::after{
            content: "";
            pointer-events: none;
            position: absolute;
            left: 0; right: 0; bottom: -1px;
            height: var(--section-fade-height);
            background: linear-gradient(to bottom,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.25) 45%,
                rgba(255,255,255,0.50) 65%,
                rgba(255,255,255,0.85) 100%);
            mix-blend-mode: normal;
        }

        /* Darker fade variant (for ocean -> darker sections) */
        .section-fade--bottom.darker::after{
            background: linear-gradient(to bottom,
                rgba(26,95,122,0) 0%,
                rgba(26,95,122,0.15) 40%,
                rgba(26,95,122,0.40) 70%,
                rgba(26,95,122,0.75) 100%);
        }

        /* Small utility to lengthen blend if needed */
        .section-fade--long::after{ height: calc(var(--section-fade-height) * 1.6); }
        
        /* Navbar transparent on scroll support */
        .navbar-transition {
            transition: background-color 300ms ease, box-shadow 300ms ease, backdrop-filter 300ms ease;
        }
        .navbar-transparent {
            background-color: rgba(255,255,255,0.06) !important;
            box-shadow: none !important;
            backdrop-filter: blur(6px);
        }
        .navbar-solid {
            /* fallback solid when not transparent to preserve contrast */
            background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Golden Wave" height="50" class="me-2">
                <span class="d-none d-md-inline">Golden Wave</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

    {{-- Beranda --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
           href="{{ route('home') }}">Beranda</a>
    </li>

    {{-- Kamar --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}"
           href="{{ route('rooms.index') }}">Kamar</a>
    </li>

    {{-- Reservasi --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('reservation.create') ? 'active' : '' }}"
           href="{{ route('reservation.create') }}">Reservasi</a>
    </li>

    {{-- Blog --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
           href="{{ route('blog.index') }}">Blog</a>
    </li>

    {{-- Tentang (Dropdown) --}}
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('about','contact') ? 'active' : '' }}"
           href="#" role="button" data-bs-toggle="dropdown">
            Tentang
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('about') }}">Tentang Kami</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('contact') }}">Kontak</a>
            </li>
        </ul>
    </li>

    {{-- Check-in --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('checkin.*') ? 'active' : '' }}"
           href="{{ route('checkin.create') }}">Check-in</a>
    </li>

    {{-- Akun --}}
    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('bookings.index') }}">My Bookings</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                </li>

                @if(Auth::user()->isAdmin())
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>
                    </li>
                @endif

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Keluar</button>
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('login','register') ? 'active' : '' }}"
               href="#" data-bs-toggle="dropdown">
                Akun
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('login') }}">Masuk</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('register') }}">Daftar</a>
                </li>
            </ul>
        </li>
    @endauth

</ul>

            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="site-main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Golden Wave Resort</h5>
                    <p>Pengalaman menginap terbaik dengan fasilitas premium dan pemandangan laut yang memukau.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/goldenwave_id?igsh=d3k5OWlvOXFxOHlp" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://api.whatsapp.com/send/?phone=6288806658440&text&type=phone_number&app_absent=0" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://youtube.com/@rizzalalfa?si=aiMD1aNZO7DQO1jh" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('rooms.index') }}">Kamar</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Hubungi Kami</h5>
                    <div class="footer-contact">
                        <p><i class="fas fa-phone"></i> +62 812 3456 7890</p>
                        <p><i class="fas fa-envelope"></i> info@goldenwave.com</p>
                        <p><i class="fas fa-map-marker-alt"></i> Pantai Golden, Jawa Barat</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Golden Wave Resort. Semua hak dilindungi. Dikelola dengan penuh dedikasi untuk kepuasan Anda.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Smooth Scroll -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = Array.from(document.querySelectorAll('.room-card'));
            if (!cards.length) return;

            if ('IntersectionObserver' in window) {
                const obs = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const el = entry.target;
                            const idx = cards.indexOf(el);
                            el.style.transitionDelay = (idx * 100) + 'ms';
                            el.classList.add('in-view');
                            observer.unobserve(el);
                        }
                    });
                }, { threshold: 0.15 });

                cards.forEach(c => obs.observe(c));
            } else {
                cards.forEach((c, i) => {
                    c.style.transitionDelay = (i * 100) + 'ms';
                    c.classList.add('in-view');
                });
            }
        });
    </script>
    <script>
        // Toggle navbar transparency on scroll
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            navbar.classList.add('navbar-transition');

            const setState = () => {
                const y = window.scrollY || window.pageYOffset;
                // when user scrolls down at least 30px, make navbar transparent
                if (y > 30) {
                    navbar.classList.add('navbar-transparent');
                    navbar.classList.remove('navbar-solid');
                } else {
                    navbar.classList.remove('navbar-transparent');
                    navbar.classList.add('navbar-solid');
                }
            };

            // initial state
            setState();

            let ticking = false;
            window.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        setState();
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });
        });
    </script>
    <!-- Booking success modal -->
    @if(session('booking_success'))
        <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pesanan Berhasil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('booking_success') }}</p>
                        <p>Silakan cek email Anda untuk detail reservasi dan instruksi selanjutnya. Jika perlu bantuan, hubungi kami di <strong>+62 812 3456 7890</strong>.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Lihat Kamar Lainnya</a>
                        @if(session('booking_id'))
                            <a href="{{ route('bookings.show', session('booking_id')) }}" class="btn btn-outline-primary">Lihat Detail Reservasi</a>
                        @endif
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalEl = document.getElementById('bookingSuccessModal');
                if (modalEl) {
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
