@extends('layouts/layoutMaster')

@section('title', 'Master Addons')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Admin /</span> Master Addons</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddonModal">
      <i class="ti tabler-plus me-1"></i> Create Addon
    </button>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Default Price</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($addons as $addon)
          <tr>
            <td><strong>{{ $addon->name }}</strong></td>
            <td>{{ \Illuminate\Support\Str::limit($addon->description, 50) }}</td>
            <td>IDR {{ number_format($addon->default_price, 0, ',', '.') }}</td>
            <td>{{ $addon->unit ?: '-' }}</td>
            <td>
              @if($addon->is_active)
              <span class="badge bg-success">Active</span>
              @else
              <span class="badge bg-secondary">Inactive</span>
              @endif
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-icon" data-bs-toggle="modal" data-bs-target="#editAddonModal{{ $addon->id }}">
                <i class="ti tabler-edit"></i>
              </button>
              <form action="{{ route('admin.addons.destroy', $addon) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this addon?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-icon text-danger"><i class="ti tabler-trash"></i></button>
              </form>
            </td>
          </tr>

          <!-- Edit Modal -->
          <div class="modal fade" id="editAddonModal{{ $addon->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('admin.addons.update', $addon) }}" method="POST">
                  @csrf @method('PUT')
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Addon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $addon->name }}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea class="form-control" name="description" rows="2">{{ $addon->description }}</textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Default Price (IDR)</label>
                          <input type="number" class="form-control" name="default_price" value="{{ $addon->default_price }}" min="0" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Unit</label>
                          <input type="text" class="form-control" name="unit" value="{{ $addon->unit }}" placeholder="e.g., per day">
                        </div>
                      </div>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="is_active{{ $addon->id }}" name="is_active" value="1" {{ $addon->is_active ? 'checked' : '' }}>
                      <label class="form-check-label" for="is_active{{ $addon->id }}">Active</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @empty
          <tr>
            <td colspan="6" class="text-center py-5">
              <i class="ti tabler-puzzle fs-1 text-muted"></i>
              <p class="mt-2 text-muted">No addons created yet</p>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($addons->hasPages())
    <div class="card-footer">
      {{ $addons->links() }}
    </div>
    @endif
  </div>
</div>

<!-- Add Addon Modal -->
<div class="modal fade" id="addAddonModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.addons.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Create New Addon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" required placeholder="e.g., Porter Pribadi">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="2" placeholder="Optional description"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Default Price (IDR) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="default_price" min="0" required placeholder="150000">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Unit</label>
                <input type="text" class="form-control" name="unit" placeholder="e.g., per day, per trip">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Addon</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
