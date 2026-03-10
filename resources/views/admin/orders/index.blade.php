@extends('layouts/layoutMaster')

@section('title', 'Order Management - Monti Outdoor Service')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Admin /</span> Orders
</h4>

<div class="card">
  <div class="card-header border-bottom d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Daftar Pesanan & Order</h5>
  </div>
  
  <div class="card-body mt-3">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari Order ID / Nama Pelanggan..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><i class="ti tabler-search me-1"></i> Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary ms-1">Reset</a>
            @endif
        </div>
    </form>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Pelanggan</th>
            <th>Trip Details</th>
            <th>Booking Date</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($orders as $order)
          <tr>
            <td><strong>#{{ $order->order_number }}</strong></td>
            <td>
                <div class="d-flex flex-column">
                    <span class="fw-medium">{{ $order->user->name ?? 'Deleted User' }}</span>
                    <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                </div>
            </td>
            <td>
                <div class="d-flex flex-column">
                    <span class="fw-medium">{{ limit_string($order->departure->tripTemplate->title ?? 'Unknown Trip', 30) }}</span>
                    <small class="text-muted">{{ $order->departure->start_date ? $order->departure->start_date->format('d M Y') : '' }} | {{ $order->pax_count }} Pax</small>
                </div>
            </td>
            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            <td>
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
            </td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="View Details">
                    <i class="ti tabler-eye"></i>
                </a>
            </td>
          </tr>
          @empty
          <tr>
              <td colspan="7" class="text-center py-4">Belum ada data pesanan yang sesuai.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

  </div>
</div>
@endsection

<?php
function limit_string($string, $limit) {
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit) . '...';
    }
    return $string;
}
?>
