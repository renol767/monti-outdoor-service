@extends('layouts/layoutMaster')

@section('title', 'Data Pelanggan - ' . $customer->name)

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Admin / <a href="{{ route('admin.customers.index') }}">Customers</a> /</span> Profil
</h4>

<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        @if($customer->avatar)
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset($customer->avatar) }}" height="100" width="100" alt="User avatar">
                        @else
                            <span class="badge bg-label-primary rounded p-4 mb-3 fs-2 mt-4">
                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                            </span>
                        @endif
                        <div class="user-info text-center">
                            <h4 class="mb-2">{{ $customer->name }}</h4>
                            <span class="badge bg-label-secondary">Customer</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-around flex-wrap mt-4 pb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="ti tabler-plane-tilt ti-md"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $metrics['total_orders'] }}</h5>
                            <span>Trip Lunas</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-success rounded">
                                <i class="ti tabler-currency-rupiah ti-md"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ number_format($metrics['total_spent'] / 1000000, 1, ',', '.') }} Juta</h5>
                            <span>Total Spend</span>
                        </div>
                    </div>
                </div>

                <h5 class="pb-2 border-bottom mb-4 mt-4">Detail Informasi</h5>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium me-2">Email:</span>
                            <span>{{ $customer->email }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Phone / WA:</span>
                            <span>{{ $customer->phone ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Alamat:</span>
                            <span>{{ $customer->address ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Tergabung:</span>
                            <span>{{ $customer->created_at->format('d M Y') }}</span>
                        </li>
                    </ul>
                </div>

                <h5 class="pb-2 border-bottom mb-4 mt-4 text-warning">Kontak Darurat</h5>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium me-2">Nama:</span>
                            <span>{{ $customer->emergency_name ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Hubungan:</span>
                            <span>{{ $customer->emergency_relation ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Telepon:</span>
                            <span>{{ $customer->emergency_phone ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- User Content (Order History) -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- Project table -->
        <div class="card mb-4">
            <h5 class="card-header border-bottom">Riwayat Transaksi Pelanggan</h5>
            <div class="table-responsive mb-3 mt-3">
                <table class="table datatable-project border-top">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Trip Yang Dipesan</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="fw-medium">#{{ $order->order_number }}</a></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-truncate fw-medium">{{ limit_string($order->departure->tripTemplate->title ?? 'Unknown', 30) }}</span>
                                    <small class="text-muted">{{ $order->pax_count }} Pax</small>
                                </div>
                            </td>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada riwayat transaksi dari pelanggan ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-4 pb-3">
                {{ $orders->links() }}
            </div>
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
