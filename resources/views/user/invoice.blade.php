@extends('layouts/layoutMaster')

@section('title', 'My Invoice - Monti Outdoor Service')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User /</span> My Invoice
</h4>

<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-0">Daftar Tagihan & Pesanan</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Trip</th>
          <th>Tanggal Transaksi</th>
          <th>Total</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
          <tr>
            <td><span class="fw-medium text-heading">#{{ $order->order_number }}</span></td>
            <td>
              <div class="d-flex flex-column">
                <span class="fw-medium text-heading">{{ $order->departure->tripTemplate->title ?? 'Trip' }}</span>
                <small class="text-muted">{{ $order->departure->start_date ? $order->departure->start_date->format('d M Y') : '' }}</small>
              </div>
            </td>
            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            <td>
              @if($order->status == 'pending')
                <span class="badge bg-label-warning">Menunggu Pembayaran</span>
              @elseif($order->status == 'paid')
                <span class="badge bg-label-success">Lunas</span>
              @elseif($order->status == 'cancelled')
                <span class="badge bg-label-danger">Dibatalkan</span>
              @else
                <span class="badge bg-label-secondary">{{ ucfirst($order->status) }}</span>
              @endif
            </td>
            <td>
              <a href="{{ route('checkout.invoice', $order->order_number) }}" class="btn btn-sm btn-primary">
                <i class="ti tabler-file-invoice me-1"></i> <span class="d-none d-sm-inline-block">Lihat Invoice</span>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4">Belum ada tagihan pesanan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
