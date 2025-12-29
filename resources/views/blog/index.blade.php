@extends('layouts.app')

@section('content')
<style>
    .blog-hero {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url("images/backgrounds/header-blog.jpeg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 60px 0;
        display: flex;
        align-items: center;
        position: relative;
        justify-content: center;
        color: white;
        text-align: center;
    }
    
    .blog-hero h1 {
        color: var(--light-color);
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    
    .blog-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .blog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px 80px;
    }
    
    .blog-article-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        display: flex;
        flex-direction: row;
        height: 280px;
    }
    
    .blog-article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    /* Entrance animation (matches homepage) */
    .anim-on-scroll { opacity: 0; transform: translateY(30px); transition: transform 0.6s cubic-bezier(.2,.9,.2,1), opacity 0.6s ease; will-change: transform, opacity; }
    .anim-on-scroll.in-view { opacity: 1; transform: translateY(0); }
    
    .blog-image {
        width: 320px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }
    
    .blog-image i {
        font-size: 4rem;
        color: white;
        opacity: 0.6;
    }
    
    .blog-image::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse-slow 4s ease-in-out infinite;
    }
    
    @keyframes pulse-slow {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    
    .blog-content {
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1;
    }
    
    .blog-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 12px;
        font-weight: 500;
    }
    
    .blog-date i {
        color: var(--secondary-color);
    }
    
    .blog-content h3 {
        font-size: 1.6rem;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .blog-content h3 a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .blog-content h3 a:hover {
        color: var(--secondary-color);
    }
    
    .blog-excerpt {
        color: #555;
        line-height: 1.7;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    
    .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #ecf0f1;
    }
    
    .blog-read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 10px 20px;
        border: 2px solid var(--primary-color);
        border-radius: 25px;
    }
    
    .blog-read-more:hover {
        background: var(--primary-color);
        color: white;
        transform: translateX(5px);
    }
    
    .blog-sidebar {
        position: sticky;
        top: 100px;
    }
    
    .sidebar-widget {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .sidebar-widget h5 {
        font-size: 1.4rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--secondary-color);
    }
    
    .recent-post-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #ecf0f1;
        transition: all 0.3s ease;
    }
    
    .recent-post-item:last-child {
        border-bottom: none;
    }
    
    .recent-post-item:hover {
        transform: translateX(5px);
        background: #f8f9fa;
        padding-left: 10px;
        border-radius: 8px;
    }
    
    .recent-post-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .recent-post-icon i {
        color: white;
        font-size: 1.3rem;
    }
    
    .recent-post-content h6 {
        font-size: 0.95rem;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    
    .recent-post-content h6 a {
        color: var(--dark-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .recent-post-content h6 a:hover {
        color: var(--secondary-color);
    }
    
    .recent-post-date {
        font-size: 0.8rem;
        color: #7f8c8d;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state i {
        font-size: 5rem;
        color: var(--accent-color);
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #7f8c8d;
    }

    .pagination {
        justify-content: center;
        margin-top: 40px;
    }
    
    .pagination .page-link {
        color: var(--primary-color);
        border: 2px solid #ecf0f1;
        margin: 0 5px;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    .pagination .page-item.active .page-link {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
        color: white;
    }
    
    @media (max-width: 991px) {
        .blog-article-card {
            flex-direction: column;
            height: auto;
        }
        
        .blog-image {
            width: 100%;
            height: 200px;
        }
        
        .blog-sidebar {
            position: static;
            margin-top: 40px;
        }
    }
    
    @media (max-width: 768px) {
        .blog-hero h1 {
            font-size: 2rem;
        }
        
        .blog-content h3 {
            font-size: 1.3rem;
        }
    }
</style>

<!-- Blog Hero Section -->
<div class="blog-hero anim-on-scroll">
    <div class="container">
        <h1>Blog Golden Wave</h1>
        <p>Temukan tips liburan, berita terbaru, dan panduan lengkap untuk pengalaman menginap terbaik Anda</p>
    </div>
</div>

<!-- Blog Content -->
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%); padding: 30px 0;">
<div class="blog-container">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            @forelse($articles as $article)
                <article class="blog-article-card anim-on-scroll">
                    <div class="blog-image">
                        @if($article->main_image)
                        <img src="{{ asset('images/gallery/'.$article->main_image) }}"alt="{{ $article->title }}"style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <i class="fas fa-newspaper"></i>
                    @endif
                    </div>
                    <div class="blog-content">
                        <div>
                            @php
                                $pub = null;
                                if (!empty($article->published_at)) {
                                    try {
                                        $pub = \Illuminate\Support\Carbon::parse($article->published_at);
                                    } catch (\Exception $e) {
                                        $pub = null;
                                    }
                                }
                            @endphp
                            <div class="blog-date">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $pub ? $pub->format('d M Y') : '' }}
                            </div>
                            <h3><a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a></h3>
                            <p class="blog-excerpt">{!! Str::limit(strip_tags($article->body), 200) !!}</p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Belum Ada Artikel</h3>
                    <p>Saat ini belum ada artikel yang tersedia. Silakan kembali lagi nanti!</p>
                </div>
            @endforelse

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const observer = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('in-view');
                                obs.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.15 });

                    document.querySelectorAll('.anim-on-scroll').forEach((el, i) => {
                        el.style.transitionDelay = (i * 80) + 'ms';
                        observer.observe(el);
                    });
                });
            </script>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="blog-sidebar">
                <div class="sidebar-widget">
                    <h5><i class="fas fa-fire me-2"></i>Artikel Terbaru</h5>
                    @foreach($articles->take(5) as $a)
                        <div class="recent-post-item">
                            <div class="recent-post-icon">
                                @if($a->main_image)
                                <img src="{{ asset('images/gallery/'.$a->main_image) }}"alt="{{ $a->title }}"style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <i class="fas fa-newspaper"></i>
                            @endif
                            </div>
                            <div class="recent-post-content">
                                <h6><a href="{{ route('blog.show', $a->slug) }}">{{ $a->title }}</a></h6>
                                @php
                                    $pub = null;
                                    if (!empty($a->published_at)) {
                                        try {
                                            $pub = \Illuminate\Support\Carbon::parse($a->published_at);
                                        } catch (\Exception $e) {
                                            $pub = null;
                                        }
                                    }
                                @endphp
                                <div class="recent-post-date">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $pub ? $pub->format('d M Y') : '' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Additional Widget - Call to Action -->
                <div class="sidebar-widget" style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); color: white;">
                    <h5 style="color: white; border-bottom-color: var(--secondary-color);">
                        <i class="fas fa-hotel me-2"></i>Pesan Sekarang
                    </h5>
                    <p style="margin-bottom: 20px;">Dapatkan penawaran terbaik untuk liburan impian Anda di Golden Wave Resort!</p>
                    <a href="{{ route('reservation.create') }}" class="btn btn-light w-100" style="font-weight: 600;">
                        <i class="fas fa-calendar-check me-2"></i>Reservasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection