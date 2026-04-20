@extends('layouts/blankLayout')

@section('title', 'Invoice ' . $order->order_number)

@section('page-style')
<style>
    body {
        background-color: #151515 !important;
    }
    .invoice-header-text {
        color: #ffffff !important;
    }
    .invoice-header-text .text-muted {
        color: #a1a1aa !important;
    }
    .invoice-preview-card, .sidebar-participant-card {
        background-color: #ffffff !important;
        position: relative;
        overflow: hidden;
    }
    .invoice-watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        max-width: 450px;
        opacity: 0.05;
        z-index: 0;
        pointer-events: none;
    }
    /* Memastikan teks tetap berada di atas watermark */
    .invoice-preview-card > div, .invoice-preview-card > hr {
        position: relative;
        z-index: 1;
    }

    @media print {
        body, html {
            background-color: #ffffff !important;
        }
        .invoice-header-text, .col-lg-4 {
            display: none !important;
        }
        .col-lg-8 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
        .invoice-preview-card {
            box-shadow: none !important;
            border: 1px solid #eee !important;
        }
        .invoice-watermark {
            opacity: 0.05 !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4 invoice-header-text">
    <span class="text-muted fw-light">Booking /</span> Invoice
</h4>

<div class="row justify-content-center">
    <!-- Invoice Column -->
    <div class="col-12 col-lg-8">
        <div class="card invoice-preview-card shadow-lg border-0">
            <!-- Center Watermark Logo -->
            <img src="{{ asset(config('app.logo', 'images/logo/Untitled-2.png')) }}" alt="Monti Outdoor Watermark" class="invoice-watermark">
            
            <div class="card-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            <img src="{{ asset(config('app.logo', 'images/logo/Untitled-2.png')) }}" alt="Logo" width="32">
                            <span class="app-brand-text fw-bold fs-4">Monti Outdoor</span>
                        </div>
                        <p class="mb-2">{{ \App\Models\LandingSetting::where('key', 'contact_address')->value('value') ?? 'Jakarta, Indonesia' }}</p>
                        <p class="mb-2">{{ \App\Models\LandingSetting::where('key', 'contact_email')->value('value') ?? '-' }}</p>
                        <p class="mb-0">{{ \App\Models\LandingSetting::where('key', 'contact_phone')->value('value') ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="fw-medium mb-2">INVOICE #{{ $order->order_number }}</h4>
                        <div class="mb-2 pt-1">
                            <span>Tanggal Transaksi:</span>
                            <span class="fw-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="mb-2 pt-1">
                            <span>Jadwal Trip:</span>
                            <span class="fw-medium">{{ $order->departure->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="pt-1">
                            <span>Status:</span>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning">Menunggu Pembayaran</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-0">
            
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="mb-3">Klien (Pemesan):</h6>
                        <p class="mb-1">{{ $order->user->name }}</p>
                        <p class="mb-1">{{ $order->user->email }}</p>
                        <p class="mb-0">{{ $order->user->phone ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <h6 class="mb-3">Informasi Trip:</h6>
                        <p class="mb-1 fw-medium">{{ $order->departure->tripTemplate->title }}</p>
                        <p class="mb-1">{{ $order->variant->name }} ({{ $order->pax_count }} Pax)</p>
                    </div>
                </div>
            </div>

            <div class="table-responsive border-top">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Keterangan</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Trip Base Item -->
                        <tr>
                            <td class="text-nowrap">Paket Perjalanan</td>
                            <td class="text-nowrap">{{ $order->variant->name }}</td>
                            <td>{{ $order->pax_count }}</td>
                            <td>Rp {{ number_format($order->variant->base_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($order->variant->base_price * $order->pax_count, 0, ',', '.') }}</td>
                        </tr>
                        
                        <!-- Addons Items Jika Ada -->
                        @foreach($order->addons as $addon)
                        <tr>
                            <td class="text-nowrap">Add-on</td>
                            <td class="text-nowrap">{{ $addon->addon_name }}</td>
                            <td>{{ $addon->quantity }}</td>
                            <td>Rp {{ number_format($addon->unit_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($addon->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        
                        <!-- Diskon Jika Ada -->
                        @if($order->discount_amount > 0)
                        <tr>
                            <td class="text-nowrap" colspan="2">
                                <span class="badge bg-label-success">Diskon</span>
                            </td>
                            <td></td>
                            <td>-</td>
                            <td class="text-success">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        
                        <tr>
                            <td colspan="3" class="align-top px-4 py-4">
                                @if($order->status == 'pending')
                                <p class="mb-2 mt-3">
                                    <span class="ms-3 fw-medium">Mohon selesaikan pembayaran agar kami dapat mengkonfirmasi pesanan Anda.</span>
                                </p>
                                <!-- MIDTRANS SNAP BUTTON -->
                                <button id="pay-button" class="btn btn-primary w-100 mt-2">Bayar Sekarang</button>
                                @endif
                            </td>
                            <td class="text-end pe-3 py-4">
                                <p class="mb-2 pt-3">Subtotal:</p>
                                <p class="mb-2">Addons:</p>
                                <p class="mb-2">Diskon:</p>
                                <p class="mb-0 pb-3">Total Tagihan:</p>
                            </td>
                            <td class="ps-2 py-4">
                                <p class="fw-medium mb-2 pt-3">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                                <p class="fw-medium mb-2">Rp {{ number_format($order->addons_total, 0, ',', '.') }}</p>
                                <p class="fw-medium mb-2 text-success">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</p>
                                <p class="fw-bold fs-5 mb-0 pb-3 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-body mx-3">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-medium">Catatan:</span>
                        <span>Jika Anda memerlukan bantuan terkait Invoice ini, silahkan hubungi Admin via WhatsApp atau Email suport.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Sidebar (Daftar Partisipan) -->
    <div class="col-12 col-lg-4 mt-4 mt-lg-0">
        <div class="card sidebar-participant-card shadow-lg border-0">
            <h5 class="card-header border-bottom bg-transparent">Daftar Partisipan</h5>
            <div class="card-body mt-4">
                <ul class="list-unstyled mb-0">
                    @foreach($order->items as $index => $item)
                    <li class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">{{ $index + 1 }}</span>
                            </div>
                            <div class="w-100">
                                <h6 class="mb-1">{{ $item->participant_name }}</h6>
                                @if($item->participant_phone)
                                <small class="text-muted d-block">{{ $item->participant_phone }}</small>
                                @endif
                                @if($item->participant_id_number)
                                <small class="text-muted d-block">ID: {{ $item->participant_id_number }}</small>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="mt-4">
            @if($order->status == 'paid')
            <a href="{{ route('checkout.invoice.pdf', $order->order_number) }}" target="_blank" class="btn w-100 d-flex align-items-center justify-content-center mb-3 fw-bold" style="background-color: #fbcaa5; color: #151515; border: none;">
                <i class="ti tabler-file-type-pdf me-2"></i> Unduh PDF Invoice
            </a>
            @endif
            <a href="{{ route('user.dashboard') }}" class="btn btn-label-secondary w-100 mb-3">Kembali ke Dashboard</a>
            <a href="https://wa.me/6281196969119?text=Halo admin, saya ingin konfirmasi pesanan {{ $order->order_number }}" target="_blank" class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                <i class="ti tabler-brand-whatsapp me-2"></i> Konfirmasi Manual (WA)
            </a>
        </div>
    </div>
</div>
</div>
@endsection

@section('page-script')
@if($order->status == 'pending' && $snapToken)
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */
            toastr.success("Payment success!");
            setTimeout(() => { window.location.reload(); }, 2000);
          },
          // Optional
          onPending: function(result){
             /* You may add your own js here, this is just example */
             toastr.info("Waiting for your payment!");
          },
          // Optional
          onError: function(result){
             toastr.error("Payment failed or expired!");
             setTimeout(() => { window.location.reload(); }, 2000);
          },
          // Optional
          onClose: function(){
            toastr.info("Anda menutup popup pembayaran.");
            setTimeout(() => { window.location.reload(); }, 1000);
          }
        });
      };
    </script>
@endif
@endsection
