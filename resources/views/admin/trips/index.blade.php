@extends('layouts/layoutMaster')

@section('title', 'Trip Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Admin /</span> Trip Management</h4>
    <a href="{{ route('admin.trip-management.create') }}" class="btn btn-primary">
      <i class="ti tabler-plus me-1"></i> Create New Trip
    </a>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <!-- Filters -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" class="row g-3">
        <div class="col-md-3">
          <input type="text" name="search" class="form-control" placeholder="Search trips..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
          <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
          </select>
        </div>
        <div class="col-md-2">
          <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-outline-primary w-100">
            <i class="ti tabler-filter me-1"></i> Filter
          </button>
        </div>
        @if(request()->hasAny(['search', 'status', 'category']))
        <div class="col-md-2">
          <a href="{{ route('admin.trip-management.index') }}" class="btn btn-outline-secondary w-100">
            <i class="ti tabler-x me-1"></i> Clear
          </a>
        </div>
        @endif
      </form>
    </div>
  </div>

  <!-- Trips Table -->
  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Trip</th>
            <th>Category</th>
            <th>Duration</th>
            <th>From Price</th>
            <th>Next Departure</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($trips as $trip)
          <tr>
            <td>
              <div class="d-flex align-items-center">
                @if($trip->thumbnail)
                <img src="{{ asset($trip->thumbnail) }}" alt="" class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                @else
                <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                  <i class="ti tabler-photo text-muted"></i>
                </div>
                @endif
                <div>
                  <strong>{{ $trip->title }}</strong>
                  <div class="small text-muted">{{ $trip->destination }}</div>
                </div>
              </div>
            </td>
            <td><span class="badge bg-label-primary">{{ ucfirst($trip->category) }}</span></td>
            <td>{{ $trip->duration_days }}D{{ $trip->duration_nights }}N</td>
            <td>
              @if($trip->from_price)
              IDR {{ number_format($trip->from_price, 0, ',', '.') }}
              @else
              <span class="text-muted">-</span>
              @endif
            </td>
            <td>
              @if($trip->departures->first())
                @php $nextDep = $trip->departures->first(); @endphp
                <span class="badge bg-label-info">{{ $nextDep->start_date->format('d M Y') }}</span>
                <div class="small text-muted">{{ $nextDep->capacity - $nextDep->booked_count }} slots left</div>
              @else
              <span class="text-muted">No departures</span>
              @endif
            </td>
            <td>
              @if($trip->status === 'published')
              <span class="badge bg-success">Published</span>
              @elseif($trip->status === 'draft')
              <span class="badge bg-warning">Draft</span>
              @else
              <span class="badge bg-secondary">Archived</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="ti tabler-dots-vertical"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('admin.trip-management.edit', $trip) }}">
                    <i class="ti tabler-edit me-1"></i> Manage
                  </a>
                  <form action="{{ route('admin.trip-management.toggle-publish', $trip) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      @if($trip->status === 'published')
                      <i class="ti tabler-eye-off me-1"></i> Unpublish
                      @else
                      <i class="ti tabler-check me-1"></i> Publish
                      @endif
                    </button>
                  </form>
                  <form action="{{ route('admin.trip-management.duplicate', $trip) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="ti tabler-copy me-1"></i> Duplicate
                    </button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <form action="{{ route('admin.trip-management.destroy', $trip) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this trip? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                      <i class="ti tabler-trash me-1"></i> Delete
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-5">
              <i class="ti tabler-mood-empty fs-1 text-muted"></i>
              <p class="text-muted mt-2">No trips found</p>
              <a href="{{ route('admin.trip-management.create') }}" class="btn btn-primary mt-2">Create your first trip</a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($trips->hasPages())
    <div class="card-footer">
      {{ $trips->links() }}
    </div>
    @endif
  </div>
</div>
@endsection
