@extends('layouts.app')

@section('content')

<!-- Header Section -->
<section style="background: linear-gradient(135deg, #1a5f7a 0%, #0f3d52 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; margin-bottom: 1rem;">Tentang Golden Wave Resort</h1>
        <p style="font-size: 1.1rem; opacity: 0.9;">Mengenal lebih jauh tentang kami dan perjalanan menuju excellence</p>
    </div>
</section>

<!-- About Content -->
<section style="padding: 80px 0; background: white;">
    <div class="container">
        <div class="row align-items-center mb-80">
            <div class="col-lg-6 mb-4">
                <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border-radius: 15px; height: 400px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-building" style="font-size: 6rem; color: white; opacity: 0.3;"></i>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 style="font-size: 2.2rem; color: var(--primary-color); margin-bottom: 1.5rem; font-family: 'Playfair Display', serif;">
                    Siapa Kami?
                </h2>
                <p style="color: #555; line-height: 1.9; margin-bottom: 1.5rem; font-size: 1.05rem;">
                    Golden Wave Resort adalah penginapan mewah yang terletak di tepi pantai yang indah dengan pemandangan laut yang menakjubkan. Kami berkomitmen untuk memberikan pengalaman menginap yang tak terlupakan bagi setiap tamu kami.
                </p>
                <p style="color: #555; line-height: 1.9; margin-bottom: 1.5rem; font-size: 1.05rem;">
                    Dengan fasilitas kelas dunia, layanan pelanggan yang responsif, dan lokasi strategis yang sempurna untuk liburan keluarga, kami menjadi pilihan utama untuk akomodasi berkualitas tinggi di kawasan pantai.
                </p>
                <p style="color: #555; line-height: 1.9; font-size: 1.05rem;">
                    Setiap detail dirancang dengan cermat untuk memastikan kenyamanan dan kepuasan maksimal Anda selama menginap bersama kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; color: var(--primary-color); margin-bottom: 60px; font-family: 'Playfair Display', serif;">
                Misi & Visi Kami
        </h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); border-top: 5px solid var(--secondary-color);">
                    <h3 style="color: var(--primary-color); font-size: 1.5rem; margin-bottom: 1.5rem;">
                        <i class="fas fa-rocket" style="color: var(--secondary-color); margin-right: 10px;"></i> Misi
                    </h3>
                    <p style="color: #555; line-height: 1.9;">
                        Memberikan pelayanan penginapan berkualitas tinggi dengan standar internasional, menciptakan pengalaman menginap yang berkesan dan memuaskan bagi setiap tamu, serta menjadi destinasi wisata pilihan utama di kawasan pantai.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); border-top: 5px solid var(--secondary-color);">
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
<section style="padding: 80px 0; background: white;">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; color: var(--primary-color); margin-bottom: 60px; font-family: 'Playfair Display', serif;">
            Nilai-Nilai Kami
        </h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div style="text-align: center; padding: 30px;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-handshake" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">Integritas</h3>
                    <p style="color: #555; line-height: 1.8;">
                        Kami berkomitmen untuk transparansi dan kejujuran dalam setiap interaksi dengan tamu dan mitra bisnis kami.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div style="text-align: center; padding: 30px;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">Keunggulan</h3>
                    <p style="color: #555; line-height: 1.8;">
                        Kami terus berinovasi dan meningkatkan standar layanan untuk memberikan pengalaman terbaik bagi setiap tamu.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div style="text-align: center; padding: 30px;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, #0f3d52 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-heart" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">Kepedulian</h3>
                    <p style="color: #555; line-height: 1.8;">
                        Kepuasan dan kenyamanan tamu adalah prioritas utama kami dalam setiap aspek layanan hospitality.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <h2 style="text-align: center; font-size: 2.2rem; color: var(--primary-color); margin-bottom: 60px; font-family: 'Playfair Display', serif;">
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
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Lokasi Strategis</h4>
                            <p style="color: #555; margin: 0;">Terletak di pantai dengan akses mudah ke berbagai tempat wisata menarik</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Fasilitas Premium</h4>
                            <p style="color: #555; margin: 0;">Dilengkapi dengan berbagai fasilitas modern dan lengkap untuk kenyamanan maksimal</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Layanan 24 Jam</h4>
                            <p style="color: #555; margin: 0;">Tim profesional kami siap melayani Anda kapan saja dengan respons cepat</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Harga Kompetitif</h4>
                            <p style="color: #555; margin: 0;">Menawarkan harga terbaik dengan paket spesial dan penawaran menarik</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Pengalaman Berkesan</h4>
                            <p style="color: #555; margin: 0;">Setiap detail dirancang untuk menciptakan pengalaman menginap yang tak terlupakan</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        </div>
                        <div>
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Keberlanjutan</h4>
                            <p style="color: #555; margin: 0;">Berkomitmen untuk praktik bisnis yang ramah lingkungan dan berkelanjutan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2>Siap Merasakan Pengalaman Luar Biasa?</h2>
        <p>Pesan kamar Anda sekarang dan rasakan sendiri keunggulan Golden Wave Resort</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-light btn-lg">
            <i class="fas fa-door-open"></i> Lihat Kamar Kami
        </a>
    </div>
</section>

@endsection
