@extends('layouts/layoutMaster')

@section('title', 'User Dashboard - Monti Outdoor Service')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 bg-primary text-white">
            <div class="card-body py-4">
                <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle">
                        @else
                            <span class="avatar-initial rounded-circle bg-white text-primary">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-white mb-1">Halo, {{ auth()->user()->name }}!</h4>
                        <p class="mb-0">Selamat datang di Dasbor Monti Outdoor Service Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-3">
    <!-- Quick Links -->
    <div class="col-md-3">
        <div class="card bg-label-secondary h-100 position-relative">
            <div class="card-body">
                <a href="{{ route('user.profile') }}" class="stretched-link" style="text-decoration: none;"></a>
                <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-secondary">
                        <i class="ti tabler-user icon-lg"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0">Profil Saya</h5>
                        <small>Kelola informasi pengaturan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Invoice -->
    <div class="col-md-3">
        <div class="card bg-label-primary h-100 pointer-events-none opacity-75">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-primary">
                        <i class="ti tabler-file-invoice icon-lg"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0">My Invoice</h5>
                        <small>Tagihan belanja Anda</small>
                    </div>
                </div>
                <div class="badge bg-label-dark mt-2 w-100">Segera Hadir</div>
            </div>
        </div>
    </div>

    <!-- My Transaction -->
    <div class="col-md-3">
        <div class="card bg-label-success h-100 pointer-events-none opacity-75">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-success">
                        <i class="ti tabler-receipt icon-lg"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0">My Transaction</h5>
                        <small>Riwayat pembayaran</small>
                    </div>
                </div>
                <div class="badge bg-label-dark mt-2 w-100">Segera Hadir</div>
            </div>
        </div>
    </div>

    <!-- My Wishlist -->
    <div class="col-md-3">
        <div class="card bg-label-danger h-100 position-relative">
            <div class="card-body">
                <a href="{{ route('user.wishlist') }}" class="stretched-link" style="text-decoration: none;"></a>
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-danger">
                        <i class="ti tabler-heart icon-lg"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0">My Wishlist</h5>
                        <small>Daftar trip impian</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
