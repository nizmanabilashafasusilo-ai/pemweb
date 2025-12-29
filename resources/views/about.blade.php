@extends('layouts.app')

@section('content')
<!-- Page-specific animations & hover styles -->
<style>
    .animate {
        opacity: 0;
        transform: translateY(10px);
        animation-fill-mode: both;
    }

    @keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    @keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
    }

    .fade-up {
        animation: fadeUp 0.6s cubic-bezier(0.2, 0.9, 0.3, 1) var(--delay, 0s) both;
    }

    .fade-in {
        animation: fadeIn 0.6s ease var(--delay, 0s) both;
    }

    .hover-scale {
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .hover-scale:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 18px 30px rgba(2, 18, 29, 0.12);
    }

    .card-hover {
        transition: transform 0.28s ease, box-shadow 0.28s ease;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(2, 18, 29, 0.08);
    }

    .icon-circle {
        transition: transform 0.35s ease;
    }

    .icon-circle:hover {
    transform: rotate(-8deg) scale(1.06);
    }

    .btn-cta {
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(2, 18, 29, 0.12);
    }

    .feature-item {
        transition: transform 0.25s ease;
    }

    .feature-item:hover {
        transform: translateY(-6px);
    }

    .stagger > * {
        opacity: 0;
        animation: fadeUp 0.6s cubic-bezier(0.2, 0.9, 0.3, 1) var(--delay, 0s) both;
    }

    .stagger > *:nth-child(1) {
        --delay: 0.06s;
    }

    .stagger > *:nth-child(2) {
        --delay: 0.12s;
    }

    .stagger > *:nth-child(3) {
        --delay: 0.18s;
    }

    .stagger > *:nth-child(4) {
        --delay: 0.24s;
    }

    /* Soft accent for headings (not too bright) */
    .soft-accent {
        color: #1a5f7a;
    }
    .soft-accent-muted {
        color: rgba(0,0,0,0.85);
    }

</style>

<!-- Header Section -->
<section style="background: linear-gradient(135deg, #1a5f7a 0%, #0f3d52 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="fade-up" style="font-size: 2.5rem; font-family: 'Playfair Display', serif; margin-bottom: 1rem;">Tentang Golden Wave Resort</h1>
        <p class="fade-in" style="font-size: 1.1rem; opacity: 0.95;">Mengenal lebih jauh tentang kami dan perjalanan menuju excellence</p>
    </div>
</section>

<!-- About Content -->
<section style="padding: 80px 0; background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);">
    <div class="container">
        <div class="row align-items-center mb-80 stagger">
            <div class="col-lg-6 mb-4">
                <div class="hover-scale" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border-radius: 15px; height: 500px; display: flex; align-items: center; justify-content: center; overflow:hidden;">
                    <img src="{{ asset('images/gallery/Goldenwave.png') }}" alt="Golden Wave" style="width:100%; height:100%; object-fit:cover; transition: transform .6s ease;" onmouseover="this.style.transform='scale(1.03)';" onmouseout="this.style.transform='scale(1)';">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="fade-up soft-accent" style="font-size: 2.2rem; margin-bottom: 1.5rem; font-family: 'Playfair Display', serif;">
                    Siapa Kami?
                </h2>
                <p class="fade-in" style="color: #000000ff; line-height: 1.9; margin-bottom: 1.5rem; font-size: 1.05rem;">
                    Golden Wave Resort adalah penginapan mewah yang terletak di tepi pantai yang indah dengan pemandangan laut yang menakjubkan. Kami berkomitmen untuk memberikan pengalaman menginap yang tak terlupakan bagi setiap tamu kami.
                </p>
                <p class="fade-in" style="color: #131313ff; line-height: 1.9; margin-bottom: 1.5rem; font-size: 1.05rem;">
                    Dengan fasilitas kelas dunia, layanan pelanggan yang responsif, dan lokasi strategis yang sempurna untuk liburan keluarga, kami menjadi pilihan utama untuk akomodasi berkualitas tinggi di kawasan pantai.
                </p>
                <p class="fade-in" style="color: #0f0f0fff; line-height: 1.9; font-size: 1.05rem;">
                    Setiap detail dirancang dengan cermat untuk memastikan kenyamanan dan kepuasan maksimal Anda selama menginap bersama kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section style="padding: 80px 0; background: var(--primary-color);">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; color: white; margin-bottom: 60px; font-family: 'Playfair Display', serif;">
                Misi & Visi Kami
        </h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card-hover" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06); border-top: 5px solid var(--secondary-color);">
                    <h3 style="color: var(--primary-color); font-size: 1.5rem; margin-bottom: 1.5rem;">
                        <i class="fas fa-rocket" style="color: var(--secondary-color); margin-right: 10px;"></i> Misi
                    </h3>
                    <p style="color: #555; line-height: 1.9;">
                        Memberikan pelayanan penginapan berkualitas tinggi dengan standar internasional, menciptakan pengalaman menginap yang berkesan dan memuaskan bagi setiap tamu, serta menjadi destinasi wisata pilihan utama di kawasan pantai.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card-hover" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06); border-top: 5px solid var(--secondary-color);">
                    <h3 style="color: var(--primary-color); font-size: 1.5rem; margin-bottom: 1.5rem;">
                        <i class="fas fa-star" style="color: var(--secondary-color); margin-right: 10px;"></i> Visi
                    </h3>
                    <p style="color: #555; line-height: 1.9;">
                        Menjadi resort pantai terkemuka yang dikenal karena keunggulan fasilitas, layanan prima, dan komitmen terhadap kepuasan pelanggan, sekaligus berkontribusi positif terhadap pembangunan pariwisata berkelanjutan di wilayah pantai.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section style="padding: 80px 0; background: linear-gradient(135deg, rgba(203, 208, 210, 0.8) 0%, rgba(15, 61, 82, 0.8) 100%);">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; margin-bottom: 60px; font-family: 'Playfair Display', serif;" class="soft-accent">
            Nilai-Nilai Kami
        </h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center feature-item p-3">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-handshake" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 class="soft-accent" style="font-size: 1.3rem; margin-bottom: 1rem;">Integritas</h3>
                    <p style="color: #0e0e0eff; line-height: 1.8;">
                        Kami berkomitmen untuk transparansi dan kejujuran dalam setiap interaksi dengan tamu dan mitra bisnis kami.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center feature-item p-3">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 class="soft-accent" style="font-size: 1.3rem; margin-bottom: 1rem;">Keunggulan</h3>
                    <p style="color: #0c0c0cff; line-height: 1.8;">
                        Kami terus berinovasi dan meningkatkan standar layanan untuk memberikan pengalaman terbaik bagi setiap tamu.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center feature-item p-3">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-heart" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 class="soft-accent" style="font-size: 1.3rem; margin-bottom: 1rem;">Kepedulian</h3>
                    <p style="color: #070707ff; line-height: 1.8;">
                        Kepuasan dan kenyamanan tamu adalah prioritas utama kami dalam setiap aspek layanan hospitality.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="padding: 80px 0; background: linear-gradient(135deg, rgba(37, 93, 119, 0.8) 100%, rgba(196, 215, 222, 0.8) 0%)">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; color: #f0b429; margin-bottom: 60px; font-family: 'Playfair Display', serif;">
            Mengapa Memilih Kami?
        </h2>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Lokasi Strategis</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Terletak di pantai dengan akses mudah ke berbagai tempat wisata menarik</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Fasilitas Premium</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Dilengkapi dengan berbagai fasilitas modern dan lengkap untuk kenyamanan maksimal</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Layanan 24 Jam</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Tim profesional kami siap melayani Anda kapan saja dengan respons cepat</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Harga Kompetitif</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Menawarkan harga terbaik dengan paket spesial dan penawaran menarik</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Pengalaman Berkesan</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Setiap detail dirancang untuk menciptakan pengalaman menginap yang tak terlupakan</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: #f0b429; margin-bottom: 0.5rem;">Keberlanjutan</h4>
                            <p style="color: rgba(255,255,255,0.95); margin: 0;">Berkomitmen untuk praktik bisnis yang ramah lingkungan dan berkelanjutan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center stagger">
        <h2 class="fade-up">Siap Merasakan Pengalaman Luar Biasa?</h2>
        <p class="fade-in">Pesan kamar Anda sekarang dan rasakan sendiri keunggulan Golden Wave Resort</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-light btn-lg btn-cta" style="margin-top:14px;">
            <i class="fas fa-door-open"></i> Lihat Kamar Kami
        </a>
    </div>
</section>

@endsection
