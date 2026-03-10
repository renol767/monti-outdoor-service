@extends('layouts/layoutMaster')

@section('title', 'Admin Dashboard - Monti Outdoor Service')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                Anda memiliki <span class="fw-bold">{{ $pendingOrders }}</span> pesanan baru dengan status pending. Cek segera di menu Orders.
                            </p>
                            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-primary">Lihat Pesanan Pending</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Total Revenue</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">Rp {{ number_format($totalRevenue / 1000000, 1, ',', '.') }}jt</h4>
                            </div>
                            <small class="text-success">(Paid/Completed)</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded p-2">
                                <i class="ti tabler-currency-rupiah ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Total Orders</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalOrders }}</h4>
                            </div>
                            <small class="{{ $pendingOrders > 0 ? 'text-warning' : 'text-muted' }}">
                                {{ $pendingOrders }} Pending
                            </small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="ti tabler-shopping-cart ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Customers</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalCustomers }}</h4>
                            </div>
                            <small class="text-success">+{{ $newCustomersThisMonth }} bulan ini</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-info rounded p-2">
                                <i class="ti tabler-users ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text">Active Trips</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $activeDepartures }}</h4>
                            </div>
                            <small class="text-muted">Upcoming departures</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="ti tabler-map-pin ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover border-top">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                    <span class="fw-medium">#{{ $order->order_number }}</span>
                                    <br>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ $order->user->name ?? 'Deleted' }}</span>
                                        <small class="text-muted text-truncate" style="max-width: 150px;">{{ $order->departure->tripTemplate->title ?? '-' }}</small>
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
                                    @else
                                      <span class="badge bg-label-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-icon text-secondary"><i class="ti tabler-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada pesanan terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Links Grid -->
        <div class="col-12 col-xl-4 mb-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                             <h5 class="card-title mb-0">Aksi Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <a href="{{ route('admin.trip-management.create') }}" class="card bg-label-primary text-center p-3 text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center">
                                        <div class="avatar mb-2">
                                            <span class="avatar-initial rounded bg-label-primary"><i class="ti tabler-plus"></i></span>
                                        </div>
                                        <span class="fw-medium">Buat Trip Baru</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.customers.index') }}" class="card bg-label-info text-center p-3 text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center">
                                        <div class="avatar mb-2">
                                            <span class="avatar-initial rounded bg-label-info"><i class="ti tabler-users"></i></span>
                                        </div>
                                        <span class="fw-medium">Lihat Customers</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.orders.index') }}" class="card bg-label-success text-center p-3 text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center">
                                        <div class="avatar mb-2">
                                            <span class="avatar-initial rounded bg-label-success"><i class="ti tabler-file-invoice"></i></span>
                                        </div>
                                        <span class="fw-medium">Kelola Orders</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.landing.settings.update') }}" class="card bg-label-warning text-center p-3 text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center">
                                        <div class="avatar mb-2">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="ti tabler-settings"></i></span>
                                        </div>
                                        <span class="fw-medium">Pengaturan Web</span>
                                    </a>
                                </div>
                            </div>

                            <button onclick="logout()" class="btn btn-outline-danger w-100 mt-4">
                                <i class="ti tabler-logout me-2"></i> Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function logout() {
    const token = localStorage.getItem('token');
    
    try {
        if (token) {
            await fetch('/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });
        }
    } catch (error) {
        console.error('JWT Logout error:', error);
    }
    
    // Clear localStorage
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('role');
    
    // Logout web session
    window.location.href = '/logout-session';
}
</script>
@endsection
