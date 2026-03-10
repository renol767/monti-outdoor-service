@extends('layouts/layoutMaster')

@section('title', 'Order Detail - ' . $order->order_number)

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Admin / <a href="{{ route('admin.orders.index') }}">Orders</a> /</span> Detail
</h4>

<div class="row">
    <!-- Invoice Sidebar / Order Status -->
    <div class="col-xl-3 col-md-4 col-12 mb-md-0 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="pb-2 border-bottom mb-3">Status Pemesanan</h6>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium me-2">ID:</span>
                            <span>#{{ $order->order_number }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Status:</span>
                            @if($order->status == 'paid')
                                <span class="badge bg-label-success">Paid</span>
                            @elseif($order->status == 'pending')
                                <span class="badge bg-label-warning">Pending</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-label-danger">Cancelled</span>
                            @elseif($order->status == 'refunded')
                                <span class="badge bg-label-info">Refunded</span>
                            @else
                                <span class="badge bg-label-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Tanggal Pesan:</span>
                            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Metode Bayar:</span>
                            <span class="text-uppercase">{{ $order->payment_method ?? 'N/A' }}</span>
                        </li>
                        @if($order->paid_at)
                        <li class="mb-3">
                            <span class="fw-medium me-2">Tanggal Lunas:</span>
                            <span>{{ \Carbon\Carbon::parse($order->paid_at)->format('d M Y, H:i') }}</span>
                        </li>
                        @endif
                    </ul>
                    
                    @if($order->status == 'pending')
                    <div class="alert alert-warning py-2 mb-0">Menunggu pembayaran pelanggan via payment gateway.</div>
                    @endif
                </div>
            </div>
        </div>

        @if($order->status == 'pending')
        <div class="card">
            <div class="card-body text-center">
                <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan (pending) ini secara manual?');">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-outline-danger w-100">Batalkan Pesanan (Manual)</button>
                </form>
            </div>
        </div>
        @endif
    </div>

    <!-- Detail Information -->
    <div class="col-xl-9 col-md-8 col-12">
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Rincian Perjalanan</h5>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h6 class="text-muted"><i class="ti tabler-map-pin me-1"></i> Informasi Trip</h6>
                        <p class="mb-1 fw-bold">{{ $order->departure->tripTemplate->title ?? 'Trip Dihapus' }}</p>
                        <p class="mb-1 text-muted">{{ $order->departure->start_date ? $order->departure->start_date->format('d M Y') : '' }} s/d {{ $order->departure->end_date ? $order->departure->end_date->format('d M Y') : '' }}</p>
                        <p class="mb-1"><span class="fw-medium">Variant:</span> {{ $order->variant->name ?? 'Default' }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <h6 class="text-muted"><i class="ti tabler-user me-1"></i> Data Pemesan Pertama</h6>
                        <p class="mb-1 fw-bold">{{ $order->user->name ?? 'User (Dihapus)' }}</p>
                        <p class="mb-1">{{ $order->user->email ?? '-' }}</p>
                        <p class="mb-0">{{ $order->user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Data Partisipan ({{ $order->pax_count }} Orang)</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped border-bottom-0 m-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>No. Telepon / WA</th>
                            <th>Email Lengkap</th>
                            <th>Identitas / KTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->participant_name }}</td>
                            <td>{{ $item->participant_phone ?? '-' }}</td>
                            <td>{{ $item->participant_email ?? '-' }}</td>
                            <td>{{ $item->participant_id_number ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Rincian Biaya (Billing)</h5>
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Deskripsi Item</th>
                            <th>Jumlah (Qty)</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Varian Dasar -->
                        <tr>
                            <td>
                                <span class="fw-medium text-heading">Paket Trip ({{ $order->variant->name ?? 'Utama' }})</span>
                            </td>
                            <td>{{ $order->pax_count }} Pax</td>
                            <td class="text-end">Rp {{ number_format(($order->subtotal + $order->discount_amount) / $order->pax_count, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($order->subtotal + $order->discount_amount, 0, ',', '.') }}</td>
                        </tr>

                        <!-- Addons / Opsional -->
                        @if($order->addons && $order->addons->count() > 0)
                            <tr>
                                <td colspan="4" class="bg-light py-2"><span class="fw-bold px-2 text-muted">Tambahan (Add-ons)</span></td>
                            </tr>
                            @foreach($order->addons as $addon)
                            <tr>
                                <td>{{ $addon->addon_name }}</td>
                                <td>{{ $addon->quantity }}x</td>
                                <td class="text-end">Rp {{ number_format($addon->unit_price, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($addon->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @endif

                        <!-- Summary -->
                        <tr>
                            <td colspan="2" class="align-top px-4 py-4">
                                <p class="mb-2 mt-3">
                                <span class="ms-3 fw-medium">Catatan / Snap Token:</span>
                                <span>{{ $order->notes ?? '-' }}</span>
                                </p>
                            </td>
                            <td class="text-end pe-3 py-4">
                                <p class="mb-2">Subtotal:</p>
                                <p class="mb-2 text-danger">Diskon Paket:</p>
                                <p class="mb-2">Total Addons:</p>
                                <p class="mb-0 fw-bold fs-5 text-primary">Grand Total:</p>
                            </td>
                            <td class="text-end px-4 py-4">
                                <p class="fw-medium mb-2">Rp {{ number_format($order->subtotal + $order->discount_amount, 0, ',', '.') }}</p>
                                <p class="fw-medium mb-2 text-danger">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</p>
                                <p class="fw-medium mb-2">Rp {{ number_format($order->addons_total, 0, ',', '.') }}</p>
                                <p class="fw-bold mb-0 fs-5 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
