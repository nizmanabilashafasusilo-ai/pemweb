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
            color: var(--dark-color);
            overflow-x: hidden;
        }
        
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
        
        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link.active:after {
            width: 100%;
        }

        .navbar-nav .nav-link.active {
            font-weight: 700;
        }
        
        .navbar-nav .nav-link:hover:after {
            width: 100%;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(26, 95, 122, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="wave" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse"><path d="M0,60 Q30,30 60,60 T120,60" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></pattern></defs><rect width="1200" height="600" fill="url(%23wave)"/></svg>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
        
        /* Featured Rooms Section */
        .featured-section {
            padding: 80px 0;
            background: #f8f9fa;
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
            color: #7f8c8d;
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
        .room-card {
            background: white;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .room-image {
            height: 250px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .room-image i {
            font-size: 4rem;
            color: white;
            opacity: 0.8;
        }
        
        .room-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
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
            border-top: 1px solid #ecf0f1;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
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
            background: linear-gradient(135deg, var(--secondary-color) 0%, #d68910 100%);
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
            /* disable previous keyframe animation to use scroll-reveal */
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

        /* Facilities / Cards (tilted look) */
        .facilities-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #f6f6f2 0%, #fff 100%);
            overflow: hidden;
        }

        .facility-row {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            align-items: end;
        }

        .facility-card {
            width: 200px;
            height: 260px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            padding: 24px;
            transform-origin: center bottom;
            transition: transform 0.45s cubic-bezier(.2,.9,.2,1), box-shadow 0.25s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
        }

        .facility-card:hover {
            transform: translateY(-10px) rotate(-2deg) scale(1.03);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .facility-card.icon-large {
            font-size: 2.6rem;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        /* Promo section (arched background) */
        .promo-section {
            padding: 100px 0 60px;
            background: #fbf7f0;
            position: relative;
        }

        .promo-arch {
            position: absolute;
            left: 0; right: 0; top: -160px;
            height: 360px;
            background: radial-gradient(circle at 50% -10%, #fff 0%, #fff 60%, rgba(243,156,18,0.06) 61%);
            border-bottom: 8px solid var(--secondary-color);
            border-bottom-left-radius: 50% 40%;
            border-bottom-right-radius: 50% 40%;
            z-index: 0;
        }

        .promo-inner {
            position: relative;
            z-index: 2;
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .promo-left h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .promo-right .promo-offer {
            background: var(--secondary-color);
            padding: 18px 22px;
            color: white;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Testimonials */
        .testimonials-section {
            padding: 80px 0;
            background: #fff;
        }

        .testimonial-card {
            background: #f8f9fb;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.04);
        }

        .testimonial-card img {
            width: 96px;
            height: 96px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .testimonial-quote {
            font-style: italic;
            color: #2c3e50;
            line-height: 1.6;
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" aria-current="{{ request()->routeIs('home') ? 'page' : '' }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}" aria-current="{{ request()->routeIs('rooms.*') ? 'page' : '' }}">Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" aria-current="{{ request()->routeIs('about') ? 'page' : '' }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}" aria-current="{{ request()->routeIs('contact') ? 'page' : '' }}">Kontak</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white">Keluar ({{ Auth::user()->name }})</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}" aria-current="{{ request()->routeIs('login') ? 'page' : '' }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}" aria-current="{{ request()->routeIs('register') ? 'page' : '' }}">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Golden Wave Resort</h5>
                    <p>Pengalaman menginap terbaik dengan fasilitas premium dan pemandangan laut yang memukau.</p>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
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
        // Reveal .room-card when scrolled into view with staggered delay
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
                // fallback: reveal all
                cards.forEach((c, i) => {
                    c.style.transitionDelay = (i * 100) + 'ms';
                    c.classList.add('in-view');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
