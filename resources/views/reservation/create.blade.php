@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg,rgba(203, 208, 210, 0.8) 0%,rgba(15, 61, 82, 0.8) 100%);
    }

    h1 {
        color: var(--primary-color);
    }

    .card {
        background-color: #ffffff;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 0.65rem 0.9rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.15rem rgba(15, 61, 82, 0.25);
    }

    #bookingButton {
        background-color: var(--secondary-color);
        border: none;
        color: #fff;
    }

    #bookingButton:hover {
        filter: brightness(1.1);
    }

    .modal-content {
        border-radius: 1rem;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Header --}}
            <div class="text-center mb-4">
                <h1 class="fw-bold">Reservasi Cepat</h1>
                <p class="text-muted">
                    Isi formulir singkat untuk memulai proses reservasi. Setelah mengirim,
                    Anda akan diarahkan untuk menyelesaikan pembayaran atau melihat detail reservasi.
                </p>
            </div>

            {{-- Card Form --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Kamar --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Kamar</label>
                            <select name="room_id" class="form-select form-select-lg" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}"
                                            data-price="{{ $room->price_per_night }}"
                                            {{ optional($selectedRoom)->id === $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} — Rp {{ number_format($room->price,0,',','.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-in</label>
                                <input type="date" name="check_in_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-out</label>
                                <input type="date" name="check_out_date" class="form-control" required>
                            </div>
                        </div>

                        {{-- Jumlah Tamu --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Tamu</label>
                            <input type="number" name="number_of_guests"
                                   class="form-control" min="1" value="1">
                        </div>

                        @if(!empty($services) && $services->count())
                        <hr class="my-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tambahan Layanan</label>
                            <div class="row">
                                @foreach($services as $service)
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-start">
                                            <div class="form-check me-2">
                                                <input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}" data-price="{{ $service->price }}">
                                            </div>
                                            <div class="flex-fill">
                                                <label class="form-label mb-0" for="service-{{ $service->id }}">{{ $service->name }}</label>
                                                <div class="small text-muted">{{ $service->type ?? '-' }} • Rp {{ number_format($service->price ?? 0,0,',','.') }}</div>
                                            </div>
                                            @if(!empty($service->description))
                                                <div class="ms-2">
                                                    <button type="button" class="btn btn-outline-secondary service-detail-btn" 
                                                        style="padding: .25rem .4rem; font-size: .75rem;" 
                                                        data-name="{{ e($service->name) }}" 
                                                        data-type="{{ e($service->type) }}" 
                                                        data-price="{{ $service->price }}" 
                                                        data-description="{{ e($service->description) }}">
                                                        Details
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr class="my-4">
                        @else
                        <hr class="my-4">
                        @endif

                        {{-- Data Pemesan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="guest_name" class="form-control"
                                   value="{{ auth()->user()->name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="guest_email" class="form-control"
                                   value="{{ auth()->user()->email ?? '' }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="guest_phone" class="form-control">
                        </div>

                        {{-- Button --}}
                        @auth
                        <button type="button"
                                id="bookingButton"
                                class="btn btn-warning btn-lg w-100 rounded-pill fw-semibold">
                            Booking Sekarang
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg w-100 rounded-pill fw-semibold">
                            Masuk untuk Booking
                        </a>
                        @endauth
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Payment Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Periksa ringkasan reservasi Anda sebelum melanjutkan.</p>
                <ul class="list-unstyled">
                    <li><strong>Kamar:</strong> <span id="modalRoom"></span></li>
                    <li><strong>Check-in:</strong> <span id="modalCheckIn"></span></li>
                    <li><strong>Check-out:</strong> <span id="modalCheckOut"></span></li>
                    <li><strong>Malam:</strong> <span id="modalNights"></span></li>
                    <li><strong>Services:</strong> <span id="modalServices">-</span></li>
                    <li class="mt-2">
                        <strong>Total:</strong>
                        <span class="fw-bold text-warning">
                            Rp <span id="modalTotal"></span>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmPayment">Lanjutkan & Bayar</button>
            </div>
        </div>
    </div>

            {{-- Service Detail Modal placeholder (removed from here and re-inserted below) --}}
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bookingBtn = document.getElementById('bookingButton');
    const form = document.getElementById('bookingForm');
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

    bookingBtn.addEventListener('click', function () {
        const roomSelect = document.querySelector('[name="room_id"]');
        const opt = roomSelect.options[roomSelect.selectedIndex];
        const price = parseFloat(opt.dataset.price) || 0;

        const checkIn = document.querySelector('[name="check_in_date"]').value;
        const checkOut = document.querySelector('[name="check_out_date"]').value;

        if (!checkIn || !checkOut) {
            alert('Isi tanggal check-in dan check-out.');
            return;
        }

        const nights = Math.max(1, (new Date(checkOut) - new Date(checkIn)) / 86400000);
        // sum selected services prices
        let servicesTotal = 0;
        const selectedServices = [];
        document.querySelectorAll('.service-checkbox:checked').forEach(function(cb){
            const p = parseFloat(cb.dataset.price) || 0;
            servicesTotal += p;
            // get label text
            const lbl = document.querySelector('label[for="'+cb.id+'"]');
            selectedServices.push(lbl ? lbl.textContent.trim() : cb.value);
        });

        const total = nights * price + servicesTotal;

        document.getElementById('modalRoom').textContent = opt.text;
        document.getElementById('modalCheckIn').textContent = checkIn;
        document.getElementById('modalCheckOut').textContent = checkOut;
        document.getElementById('modalNights').textContent = nights;
        document.getElementById('modalTotal').textContent = total.toLocaleString('id-ID');
        document.getElementById('modalServices').textContent = selectedServices.length ? selectedServices.join(', ') : '-';

        paymentModal.show();
    });

    document.getElementById('confirmPayment').onclick = () => form.submit();

    // Service detail modal handlers (delegated listener to ensure it works)
    const serviceDetailModalEl = document.getElementById('serviceDetailModal');
    if (serviceDetailModalEl) {
        const serviceModal = new bootstrap.Modal(serviceDetailModalEl);
        document.body.addEventListener('click', function(e){
            const btn = e.target.closest && e.target.closest('.service-detail-btn');
            if (!btn) return;

            // try dataset first, fallback to getAttribute
            let name = btn.dataset.name || btn.getAttribute('data-name') || '';
            let type = btn.dataset.type || btn.getAttribute('data-type') || '-';
            let price = btn.dataset.price || btn.getAttribute('data-price') || 0;
            let desc = btn.dataset.description || btn.getAttribute('data-description') || '';

            // decode HTML entities if present
            function decodeHtml(html) {
                const txt = document.createElement('textarea');
                txt.innerHTML = html || '';
                return txt.value;
            }
            desc = decodeHtml(desc);

            // debug for troubleshooting
            console.log('Service detail clicked', {name, type, price, desc});

            const titleEl = document.getElementById('serviceDetailTitle');
            const typeEl = document.getElementById('serviceDetailType');
            const priceEl = document.getElementById('serviceDetailPrice');
            const descEl = document.getElementById('serviceDetailDescription');

            if (titleEl) titleEl.textContent = name;
            if (typeEl) typeEl.textContent = type;
            if (priceEl) priceEl.textContent = 'Rp ' + Number(price || 0).toLocaleString('id-ID');
            if (descEl) descEl.innerHTML = (desc || '').replace(/\n/g, '<br>');

            serviceModal.show();
        });
    }
});
</script>
@endsection

{{-- Single Service Detail Modal (placed after page content to avoid nesting) --}}
<div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceDetailTitle">Detail Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-1"><strong>Type:</strong> <span id="serviceDetailType"></span></p>
                <p class="mb-1"><strong>Price:</strong> <span id="serviceDetailPrice"></span></p>
                <hr>
                <div id="serviceDetailDescription" class="text-muted small"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
