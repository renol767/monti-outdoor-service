@extends('layouts/blankLayout')

@section('title', 'Checkout - ' . $departure->tripTemplate->title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Booking /</span> Checkout
</h4>

<div class="row">
    <!-- Left form column -->
    <div class="col-12 col-lg-8 mb-4">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form id="checkoutForm" action="{{ route('checkout.process', ['departure' => $departure->id, 'variant' => $variant->id]) }}" method="POST">
            @csrf
            
            <!-- Contact Details -->
            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">Detail Pemesan (Contact Person)</h5>
                </div>
                <div class="card-body mt-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->email }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Telepon / WhatsApp</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->phone ?? '-' }}" readonly>
                            <small class="text-muted">Untuk mengubah profil, <a href="{{ route('user.profile') }}">klik di sini</a>.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participant Selection -->
            <div class="card mb-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jumlah Peserta (Pax)</h5>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="btn-minus-pax">-</button>
                        <input type="number" class="form-control text-center text-sm" name="pax" id="pax-input" value="1" min="1" max="{{ $variant->remaining_capacity ?? 99 }}" readonly style="background: white;">
                        <button class="btn btn-outline-secondary" type="button" id="btn-plus-pax">+</button>
                    </div>
                </div>
                <div class="card-body mt-4" id="participants-container">
                    <!-- Participant Form Item Template -->
                    <div class="participant-item border rounded p-3 mb-3 bg-light position-relative" id="participant-1">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-2">Peserta 1 (Utama)</span>
                        <div class="mt-4 row g-3">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="participants[0][name]" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Email <small class="text-muted">(opsional)</small></label>
                                <input type="email" class="form-control" name="participants[0][email]" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">No. Telepon / WA <small class="text-muted">(opsional)</small></label>
                                <input type="text" class="form-control" name="participants[0][phone]" value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">No Identitas (KTP/Passport) <small class="text-muted">(opsional)</small></label>
                                <input type="text" class="form-control" name="participants[0][id_number]">
                            </div>
                        </div>
                    </div>
                    <!-- End template -->
                </div>
            </div>

            <!-- Add-ons Selection -->
            @if($addons->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">Add-ons (Pilihan Tambahan)</h5>
                </div>
                <div class="card-body mt-4">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            @foreach($addons as $index => $addon)
                            <tr class="border-bottom">
                                <td width="5%">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input addon-checkbox" type="checkbox" name="addons[{{ $index }}][id]" value="{{ $addon->id }}" id="addon_{{ $addon->id }}" data-price="{{ $addon->price }}" data-name="{{ $addon->addon->name }}">
                                    </div>
                                </td>
                                <td>
                                    <label class="form-check-label w-100" for="addon_{{ $addon->id }}">
                                        <div class="fw-bold">{{ $addon->addon->name }}</div>
                                        <div class="text-muted small">{{ $addon->description ?? $addon->addon->description }}</div>
                                        <div class="text-primary mt-1 fw-bold">Rp {{ number_format($addon->price, 0, ',', '.') }}</div>
                                    </label>
                                </td>
                                <td width="150" class="align-middle text-end text-sm-start">
                                    <div class="input-group input-group-sm opacity-50" id="addon-group-{{ $addon->id }}">
                                        <button class="btn btn-outline-secondary addon-minus" type="button" disabled>-</button>
                                        <input type="number" class="form-control text-center addon-qty" name="addons[{{ $index }}][quantity]" value="1" min="1" max="{{ $addon->max_qty ?? 99 }}" readonly disabled>
                                        <button class="btn btn-outline-secondary addon-plus" type="button" disabled>+</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <button class="btn btn-primary btn-lg w-100 d-lg-none mb-4" type="submit">Lanjut ke Pembayaran</button>
        </form>
    </div>

    <!-- Right Side: Order Summary -->
    <div class="col-12 col-lg-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header border-bottom">
                <h5 class="card-title m-0">Order Summary</h5>
            </div>
            <div class="card-body p-0">
                <div class="p-4 border-bottom">
                    <div class="d-flex align-items-start gap-3">
                        <img src="{{ asset($departure->tripTemplate->thumbnail) }}" alt="Trip Image" class="rounded" width="80" height="80" style="object-fit: cover;">
                        <div>
                            <h6 class="mb-1">{{ $departure->tripTemplate->title }}</h6>
                            <small class="text-muted d-block"><i class="ti tabler-calendar me-1"></i> {{ $departure->start_date->format('d M Y') }} - {{ $departure->end_date->format('d M Y') }}</small>
                            <small class="text-muted d-block"><i class="ti tabler-map-pin me-1"></i> {{ $variant->name }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="p-4">
                    <h6 class="mb-3 text-uppercase text-muted">Ringkasan Harga</h6>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Harga Dasar (<span id="summary-pax-count">1</span> Pax)</span>
                        <span class="text-heading" id="summary-base-price" data-price="{{ $variant->base_price }}">Rp {{ number_format($variant->base_price, 0, ',', '.') }}</span>
                    </div>

                    @php
                        $discountPerPax = $variant->calculated_discount ?: $departure->calculated_discount;
                    @endphp
                    @if($discountPerPax > 0)
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-success">Diskon</span>
                        <span class="text-success" id="summary-discount" data-discount="{{ $discountPerPax }}">- Rp {{ number_format($discountPerPax, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <!-- Dynamic Addon List -->
                    <div id="summary-addons-container" class="border-top mt-3 pt-3" style="display: none;">
                        <!-- Addons appended here via JS -->
                    </div>

                </div>

                <div class="card-footer border-top bg-lighter">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-heading">Total Pembayaran</span>
                        <h4 class="fw-bold text-primary mb-0" id="summary-total" data-total="0">Rp 0</h4>
                    </div>
                    <button class="btn btn-primary d-none d-lg-block w-100" onclick="document.getElementById('checkoutForm').submit();">
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="ti tabler-lock me-2"></i> Lanjut Pembayaran (Midtrans)
                        </span>
                    </button>
                    <small class="d-block text-center text-muted mt-2">Pemesanan aman dengan koneksi terenkripsi.</small>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Pax & Participants Logic ---
    const paxInput = document.getElementById('pax-input');
    const btnMinusPax = document.getElementById('btn-minus-pax');
    const btnPlusPax = document.getElementById('btn-plus-pax');
    const container = document.getElementById('participants-container');
    const maxPax = parseInt(paxInput.getAttribute('max')) || 99;
    
    // --- Price & Summary Logic ---
    const summaryPaxCount = document.getElementById('summary-pax-count');
    const summaryBasePrice = document.getElementById('summary-base-price');
    const summaryDiscount = document.getElementById('summary-discount');
    const summaryTotal = document.getElementById('summary-total');
    const summaryAddonsContainer = document.getElementById('summary-addons-container');
    
    const basePricePerPax = parseInt(summaryBasePrice.getAttribute('data-price')) || 0;
    const discountPerPax = summaryDiscount ? (parseInt(summaryDiscount.getAttribute('data-discount')) || 0) : 0;
    
    // --- Addons Logic ---
    const addonCheckboxes = document.querySelectorAll('.addon-checkbox');
    
    // Formatting currency
    function formatCurrency(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Update Order Summary
    function updateSummary() {
        const pax = parseInt(paxInput.value);
        
        // 1. Update text info
        summaryPaxCount.innerText = pax;
        
        // 2. Base Price
        const totalBase = basePricePerPax * pax;
        summaryBasePrice.innerText = formatCurrency(totalBase);
        
        // 3. Discount
        const totalDiscount = discountPerPax * pax;
        if (summaryDiscount) {
            summaryDiscount.innerText = '- ' + formatCurrency(totalDiscount);
        }
        
        // 4. Addons
        let totalAddons = 0;
        let addonsHtml = '';
        
        addonCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                const qtyInput = row.querySelector('.addon-qty');
                const qty = parseInt(qtyInput.value);
                const price = parseInt(checkbox.getAttribute('data-price'));
                const name = checkbox.getAttribute('data-name');
                const subtotal = price * qty;
                
                totalAddons += subtotal;
                
                addonsHtml += `
                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>${name} (x${qty})</span>
                        <span>${formatCurrency(subtotal)}</span>
                    </div>
                `;
            }
        });
        
        if (addonsHtml !== '') {
            summaryAddonsContainer.innerHTML = addonsHtml;
            summaryAddonsContainer.style.display = 'block';
        } else {
            summaryAddonsContainer.style.display = 'none';
        }
        
        // 5. Total
        const finalTotal = (totalBase - totalDiscount) + totalAddons;
        summaryTotal.innerText = formatCurrency(finalTotal);
        summaryTotal.setAttribute('data-total', finalTotal);
    }

    // Addon Checkbox change logic
    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const row = this.closest('tr');
            const group = row.querySelector('.input-group');
            const qtyInput = row.querySelector('.addon-qty');
            const btns = row.querySelectorAll('button');
            
            if (this.checked) {
                group.classList.remove('opacity-50');
                qtyInput.removeAttribute('disabled');
                btns.forEach(b => b.removeAttribute('disabled'));
            } else {
                group.classList.add('opacity-50');
                qtyInput.setAttribute('disabled', 'disabled');
                btns.forEach(b => b.setAttribute('disabled', 'disabled'));
                qtyInput.value = 1; // reset
            }
            updateSummary();
        });
        
        // Setup +/- Addon Quantity
        const row = checkbox.closest('tr');
        const btnMinus = row.querySelector('.addon-minus');
        const btnPlus = row.querySelector('.addon-plus');
        const qtyInput = row.querySelector('.addon-qty');
        const maxAddon = parseInt(qtyInput.getAttribute('max')) || 99;
        
        btnMinus.addEventListener('click', () => {
             let val = parseInt(qtyInput.value);
             if (val > 1) {
                 qtyInput.value = val - 1;
                 updateSummary();
             }
        });
        
        btnPlus.addEventListener('click', () => {
             let val = parseInt(qtyInput.value);
             if (val < maxAddon) {
                 qtyInput.value = val + 1;
                 updateSummary();
             }
        });
    });

    // Pax plus minus
    btnMinusPax.addEventListener('click', () => {
        let val = parseInt(paxInput.value);
        if (val > 1) {
            paxInput.value = val - 1;
            renderParticipants(val - 1);
            updateSummary();
        }
    });

    btnPlusPax.addEventListener('click', () => {
        let val = parseInt(paxInput.value);
        if (val < maxPax) {
            paxInput.value = val + 1;
            renderParticipants(val + 1);
            updateSummary();
        }
    });

    function renderParticipants(count) {
        const currentItems = container.querySelectorAll('.participant-item').length;
        
        if (count > currentItems) {
            // Add items
            for (let i = currentItems + 1; i <= count; i++) {
                const itemHtml = `
                <div class="participant-item border rounded p-3 mb-3 bg-white position-relative" id="participant-${i}">
                    <span class="badge bg-secondary position-absolute top-0 start-0 m-2">Peserta ${i}</span>
                    <div class="mt-4 row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="participants[${i-1}][name]" required placeholder="Sesuai kartu identitas">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Email <small class="text-muted">(opsional)</small></label>
                            <input type="email" class="form-control" name="participants[${i-1}][email]">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">No. Telepon / WA <small class="text-muted">(opsional)</small></label>
                            <input type="text" class="form-control" name="participants[${i-1}][phone]">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">No Identitas (KTP/Passport) <small class="text-muted">(opsional)</small></label>
                            <input type="text" class="form-control" name="participants[${i-1}][id_number]">
                        </div>
                    </div>
                </div>
                `;
                container.insertAdjacentHTML('beforeend', itemHtml);
            }
        } else if (count < currentItems) {
            // Remove items
            for (let i = currentItems; i > count; i--) {
                const el = document.getElementById('participant-' + i);
                if (el) el.remove();
            }
        }
    }

    // Init summary
    updateSummary();
});
</script>
@endsection
