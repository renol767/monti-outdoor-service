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
    <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3">
        <div class="row g-3 mb-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Order ID / Nama..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="trip_id" id="trip_id" class="form-select">
                    <option value="">Semua Trip</option>
                    @foreach($trips as $trip)
                        <option value="{{ $trip->id }}" data-departures="{{ json_encode($trip->departures->map(function($d) { return ['id' => $d->id, 'date' => $d->start_date->format('d M Y')]; })) }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>{{ $trip->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="departure_id" id="departure_id" class="form-select" {{ request('trip_id') ? '' : 'disabled' }}>
                    <option value="">Semua Sesi / Keberangkatan</option>
                </select>
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
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-md-auto ps-3 pe-0">
                <span class="fw-medium text-muted" style="font-size: 0.9rem;">Booking Date:</span>
            </div>
            <div class="col-md-3">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Dari</span>
                    <input type="date" name="booking_date_from" class="form-control" value="{{ request('booking_date_from') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Sampai</span>
                    <input type="date" name="booking_date_to" class="form-control" value="{{ request('booking_date_to') }}">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-sm btn-primary"><i class="ti tabler-search me-1 text-sm"></i> Filter</button>
                @if(request('search') || request('status') || request('trip_id') || request('departure_id') || request('booking_date_from') || request('booking_date_to'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                @endif
            </div>
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
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill me-1" title="View Details">
                        <i class="ti tabler-eye"></i>
                    </a>
                    @if($order->status === 'paid')
                    <a href="{{ route('admin.orders.pdf', $order) }}" target="_blank" class="btn btn-sm btn-icon btn-text-primary rounded-pill" title="Download PDF Invoice">
                        <i class="ti tabler-file-type-pdf"></i>
                    </a>
                    @endif
                </div>
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

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tripSelect = document.getElementById('trip_id');
    const departureSelect = document.getElementById('departure_id');
    const currentDepartureId = "{{ request('departure_id') }}";

    function updateDepartures() {
        const selectedOption = tripSelect.options[tripSelect.selectedIndex];
        
        // Clear departures
        departureSelect.innerHTML = '<option value="">Semua Sesi / Keberangkatan</option>';
        departureSelect.disabled = true;

        if (selectedOption && selectedOption.value) {
            const departuresStr = selectedOption.getAttribute('data-departures');
            if (departuresStr) {
                try {
                    const departures = JSON.parse(departuresStr);
                    if (departures.length > 0) {
                        departureSelect.disabled = false;
                        departures.forEach(dep => {
                            const option = document.createElement('option');
                            option.value = dep.id;
                            option.textContent = dep.date;
                            if (dep.id == currentDepartureId) {
                                option.selected = true;
                            }
                            departureSelect.appendChild(option);
                        });
                    }
                } catch (e) {
                    console.error("Error parsing departures:", e);
                }
            }
        }
    }

    // Run on load to set initial state if trip is ALREADY selected
    if (tripSelect.value) {
        updateDepartures();
    }

    // Run on change
    tripSelect.addEventListener('change', function() {
        // Reset the departure selection when trip changes
        updateDepartures();
    });
});
</script>
@endsection
