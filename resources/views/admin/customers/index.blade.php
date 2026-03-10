@extends('layouts/layoutMaster')

@section('title', 'Data Pelanggan (CRM) - Monti Outdoor Service')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Admin /</span> Customers
</h4>

<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-0">Daftar Pelanggan Terdaftar</h5>
  </div>
  
  <div class="card-body mt-3">
    <form action="{{ route('admin.customers.index') }}" method="GET" class="row g-3 mb-3">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama, Email, atau No. Telepon..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="ti tabler-search me-1"></i> Cari</button>
        </div>
        @if(request('search'))
        <div class="col-md-2">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
        @endif
    </form>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Profil</th>
            <th>Kontak</th>
            <th class="text-center">Total Order</th>
            <th class="text-end">Total Pembelanjaan</th>
            <th>Terdaftar Sejak</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($customers as $customer)
          <tr>
            <td>
                <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-3">
                            @if($customer->avatar)
                                <img src="{{ asset($customer->avatar) }}" alt="Avatar" class="rounded-circle">
                            @else
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    {{ strtoupper(substr($customer->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="{{ route('admin.customers.show', $customer) }}" class="text-body text-truncate">
                            <span class="fw-medium">{{ $customer->name }}</span>
                        </a>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex flex-column">
                    <span>{{ $customer->email }}</span>
                    @if($customer->phone)
                      <small class="text-muted"><i class="ti tabler-phone fs-6 me-1"></i>{{ $customer->phone }}</small>
                    @else
                      <small class="text-muted">No Phone</small>
                    @endif
                </div>
            </td>
            <td class="text-center">
                <span class="badge bg-label-secondary">{{ $customer->orders_count ?? 0 }} Trip</span>
            </td>
            <td class="text-end fw-medium">
                Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}
            </td>
            <td>
                {{ $customer->created_at->format('d M Y') }}
            </td>
            <td>
                <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" title="View Customer Data">
                    <i class="ti tabler-user-search"></i>
                </a>
            </td>
          </tr>
          @empty
          <tr>
              <td colspan="6" class="text-center py-4">Belum ada pelanggan terdaftar.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $customers->links() }}
    </div>

  </div>
</div>
@endsection
