@extends('layouts.app')

@section('content')
<style>
    .article-hero {
        background: linear-gradient(135deg, rgba(26, 95, 122, 0.95) 0%, rgba(15, 61, 82, 0.95) 100%);
        padding: 60px 0 40px;
        color: white;
        margin-bottom: 0; /* flush with gradient section below */
    }
    
    .article-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px 80px;
    }
    
    .article-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .article-header h1 {
        font-size: 2.8rem;
        margin-bottom: 20px;
        font-weight: 700;
        line-height: 1.3;
    }
    
    .article-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
        opacity: 0.9;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }
    
    .meta-item i {
        color: var(--secondary-color);
        font-size: 1.1rem;
    }
    
    .article-content-card {
        background: white;
        border-radius: 15px;
        padding: 50px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    /* Entrance animation for article and sidebar */
    .anim-on-scroll { opacity: 0; transform: translateY(30px); transition: transform 0.6s cubic-bezier(.2,.9,.2,1), opacity 0.6s ease; will-change: transform, opacity; }
    .anim-on-scroll.in-view { opacity: 1; transform: translateY(0); }
    
    .article-featured-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .article-featured-image i {
        font-size: 6rem;
        color: white;
        opacity: 0.4;
        position: relative;
        z-index: 1;
    }
    
    .article-featured-image::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        animation: pulse-slow 6s ease-in-out infinite;
    }
    
    .article-body {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #333;
    }
    
    .article-body p {
        margin-bottom: 1.5rem;
    }
    
    .article-body h2 {
        font-size: 1.8rem;
        color: var(--primary-color);
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    
    .article-body h3 {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .article-body ul, .article-body ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .article-body li {
        margin-bottom: 0.8rem;
    }
    
    .article-footer {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-top: 40px;
        border-left: 5px solid var(--secondary-color);
    }
    
    .share-section {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .share-section h6 {
        margin: 0;
        color: var(--primary-color);
        font-weight: 600;
    }
    
    .share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }
    
    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .share-facebook { background: #3b5998; }
    .share-twitter { background: #1da1f2; }
    .share-whatsapp { background: #25d366; }
    .share-linkedin { background: #0077b5; }
    
    .back-to-blog {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        padding: 12px 25px;
        border: 2px solid var(--primary-color);
        border-radius: 25px;
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    
    .back-to-blog:hover {
        background: var(--primary-color);
        color: white;
        transform: translateX(-5px);
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
    
    .cta-widget {
        background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%);
        color: white;
        text-align: center;
    }
    
    .cta-widget h5 {
        color: white;
        border-bottom-color: var(--secondary-color);
    }
    
    .cta-widget p {
        margin-bottom: 20px;
        opacity: 0.95;
    }
    
    .cta-widget .btn {
        background: white;
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        width: 100%;
        padding: 12px;
        transition: all 0.3s ease;
    }
    
    .cta-widget .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    
    @media (max-width: 768px) {
        .article-hero {
            padding: 40px 0 30px;
        }
        
        .article-header h1 {
            font-size: 2rem;
        }
        
        .article-content-card {
            padding: 30px 20px;
        }
        
        .article-featured-image {
            height: 250px;
        }
        
        .article-body {
            font-size: 1rem;
        }
        
        .sidebar-widget {
            position: static;
        }
    }
</style>

<!-- Article Hero -->
<div class="article-hero">
    <div class="container">
        <div class="article-header">
            <h1>{{ $article->title }}</h1>
            <div class="article-meta">
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
                <div class="meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $pub ? $pub->format('d M Y') : '' }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $pub ? $pub->diffForHumans() : '' }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-eye"></i>
                    <span>{{ rand(150, 500) }} views</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<section style="background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%); padding: 30px 0;">
    <div class="article-container">
        <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <a href="{{ route('blog.index') }}" class="back-to-blog">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Blog
            </a>
            
            <article class="article-content-card anim-on-scroll">
                
                <!-- Featured Image -->
                <div class="article-featured-image">
                    @if($article->main_image)
                        <img src="{{ asset('images/gallery/'.$article->main_image) }}"
                            alt="{{ $article->title }}"
                            style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <i class="fas fa-newspaper"></i>
                    @endif
                </div>

                <!-- Article Body -->
                <div class="article-body">
                    {!! $article->body !!}
                </div>
                
                <!-- Article Footer -->
                <div class="article-footer">
                    <div class="share-section">
                        <h6><i class="fas fa-share-alt me-2"></i>Bagikan Artikel:</h6>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $article->slug)) }}" target="_blank" class="share-btn share-facebook" title="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $article->slug)) }}&text={{ urlencode($article->title) }}" target="_blank" class="share-btn share-twitter" title="Share on Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('blog.show', $article->slug)) }}" target="_blank" class="share-btn share-whatsapp" title="Share on WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $article->slug)) }}" target="_blank" class="share-btn share-linkedin" title="Share on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- CTA Widget -->
            <div class="blog-sidebar"> 
                <div class="sidebar-widget cta-widget anim-on-scroll">
                    <h5><i class="fas fa-hotel me-2"></i>Pesan Kamar</h5>
                    <p>Siap untuk liburan impian Anda? Pesan kamar di Golden Wave Resort sekarang!</p>
                    <a href="{{ route('reservation.create') }}" class="btn">
                        <i class="fas fa-calendar-check me-2"></i>Reservasi Sekarang
                    </a>
                </div>
                
                <!-- Contact Widget -->
                <div class="sidebar-widget anim-on-scroll">
                    <h5><i class="fas fa-phone-alt me-2"></i>Butuh Bantuan?</h5>
                    <div style="line-height: 2;">
                        <p style="margin-bottom: 15px; color: #555;">
                            <i class="fas fa-phone text-success me-2"></i>
                            <strong>+62 812 3456 7890</strong>
                        </p>
                        <p style="margin-bottom: 15px; color: #555;">
                            <i class="fas fa-envelope text-danger me-2"></i>
                            <strong>info@goldenwave.com</strong>
                        </p>
                        <a href="https://api.whatsapp.com/send/?phone=6288806658440" target="_blank" class="btn btn-success w-100" style="background: #25d366; border: none;">
                            <i class="fab fa-whatsapp me-2"></i>Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const obs = new IntersectionObserver((entries, o) => {
        entries.forEach(en => {
            if (en.isIntersecting) { en.target.classList.add('in-view'); o.unobserve(en.target); }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.anim-on-scroll').forEach((el, i) => {
        el.style.transitionDelay = (i * 80) + 'ms';
        obs.observe(el);
    });
});
</script>
@endsection