@extends('layouts.app')

@section('content')

<!-- Header Section -->
<section style="background: linear-gradient(135deg, #1a5f7a 0%, #0f3d52 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; margin-bottom: 1rem;">Hubungi Kami</h1>
        <p style="font-size: 1.1rem; opacity: 0.9;">Kami siap membantu menjawab semua pertanyaan Anda</p>
    </div>
</section>

<!-- Contact Content -->
<section style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-7 mb-4">
                <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                    <h2 style="color: var(--primary-color); font-size: 1.8rem; margin-bottom: 2rem; font-family: 'Playfair Display', serif;">
                        <i class="fas fa-envelope"></i> Kirim Pesan
                    </h2>
                    
                    <form id="contactForm" method="POST" action="#">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div>
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">
                                        <i class="fas fa-user"></i> Nama Lengkap
                                    </label>
                                    <input id="cf_name" name="name" type="text" class="form-control" placeholder="Nama Anda" required style="border: 2px solid #ecf0f1; border-radius: 8px; padding: 12px; font-size: 0.95rem;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">
                                        <i class="fas fa-envelope"></i> Email
                                    </label>
                                    <input id="cf_email" name="email" type="email" class="form-control" placeholder="Email Anda" required style="border: 2px solid #ecf0f1; border-radius: 8px; padding: 12px; font-size: 0.95rem;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">
                                <i class="fas fa-phone"></i> Nomor Telepon
                            </label>
                            <input id="cf_phone" name="phone" type="tel" class="form-control" placeholder="Nomor Telepon Anda" required style="border: 2px solid #ecf0f1; border-radius: 8px; padding: 12px; font-size: 0.95rem;">
                        </div>

                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">
                                <i class="fas fa-pencil"></i> Subject
                            </label>
                            <input id="cf_subject" name="subject" type="text" class="form-control" placeholder="Subjek Pesan" required style="border: 2px solid #ecf0f1; border-radius: 8px; padding: 12px; font-size: 0.95rem;">
                        </div>

                        <div class="mb-4">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-color);">
                                <i class="fas fa-comment"></i> Pesan
                            </label>
                            <textarea id="cf_message" name="message" class="form-control" rows="6" placeholder="Tulis pesan Anda di sini..." required style="border: 2px solid #ecf0f1; border-radius: 8px; padding: 12px; font-size: 0.95rem; resize: vertical;"></textarea>
                        </div>

                        <button type="submit" id="cf_submit" class="btn btn-primary btn-lg" style="width: 100%; background: var(--secondary-color);">
                            <i class="fas fa-envelope"></i> Kirim Pesan via Email
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <!-- Info Box 1 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); margin-bottom: 25px; border-left: 5px solid var(--secondary-color);">
                    <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--secondary-color);"></i> Alamat
                    </h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        Pantai Golden, Jl. Pantai Indah No. 123<br>
                        Kabupaten Bekasi, Jawa Barat 17910<br>
                        Indonesia
                    </p>
                </div>

                <!-- Info Box 2 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); margin-bottom: 25px; border-left: 5px solid var(--secondary-color);">
                    <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">
                        <i class="fas fa-phone" style="color: var(--secondary-color);"></i> Telepon & WhatsApp
                    </h4>
                    <p style="color: #555; margin: 0;">
                        <strong>Telepon:</strong> +62 888 0665 8440<br>
                        <strong>WhatsApp:</strong> +62 888 0665 8440<br>
                    </p>
                </div>

                <!-- Info Box 3 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); margin-bottom: 25px; border-left: 5px solid var(--secondary-color);">
                    <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">
                        <i class="fas fa-envelope" style="color: var(--secondary-color);"></i> Email
                    </h4>
                    <p style="color: #555; margin: 0;">
                        <strong>Email:</strong> info@goldenwave.com<br>
                        <strong>Support:</strong> support@goldenwave.com
                    </p>
                </div>

                <!-- Info Box 4 -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); border-left: 5px solid var(--secondary-color);">
                    <h4 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 1rem;">
                        <i class="fas fa-clock" style="color: var(--secondary-color);"></i> Jam Operasional
                    </h4>
                    <p style="color: #555; margin: 0;">
                        <strong>Senin - Jumat:</strong> 08:00 - 20:00<br>
                        <strong>Sabtu - Minggu:</strong> 09:00 - 21:00<br>
                        <strong>Hari Libur:</strong> 10:00 - 19:00
                    </p>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div style="margin-top: 50px;">
            <h2 style="color: var(--primary-color); text-align: center; font-size: 2rem; margin-bottom: 30px; font-family: 'Playfair Display', serif;">
                <i class="fas fa-map"></i> Lokasi Kami
            </h2>
            <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                <iframe width="100%" height="450" style="border:none;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14314.97049278869!2d110.93777779999999!3d-7.614166600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a229011d11ad3%3A0xd8f516b20e822606!2sLalung%20Reservoir!5e1!3m2!1sen!2sid!4v1766116874483!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2>Siap Berkunjung?</h2>
        <p>Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan informasi lengkap tentang akomodasi kami</p>
        <a href="https://wa.me/6288806658440" class="btn btn-light btn-lg" target="_blank">
            <i class="fab fa-whatsapp"></i> Chat WhatsApp
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('contactForm');
    if (!form) return;

    // Send via mailto to the configured email address
    const targetEmail = 'nizmanabilashafasusilo@gmail.com';

    form.addEventListener('submit', function(e){
        e.preventDefault();

        const name = document.getElementById('cf_name').value.trim();
        const email = document.getElementById('cf_email').value.trim();
        const phone = document.getElementById('cf_phone').value.trim();
        const subject = document.getElementById('cf_subject').value.trim() || 'Pertanyaan dari website';
        const message = document.getElementById('cf_message').value.trim();

        let body = '';
        if (name) body += 'Nama: ' + name + '\n';
        if (email) body += 'Email: ' + email + '\n';
        if (phone) body += 'Nomor: ' + phone + '\n';
        body += '\nPesan:\n' + message + '\n';

        const mailto = `mailto:${targetEmail}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

        // Open default mail client
        window.location.href = mailto;
    });
});
</script>
@endpush
