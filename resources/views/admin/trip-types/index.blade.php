@extends('layouts/layoutMaster')

@section('title', 'Trip Type Sections')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Trip Type Sections</h4>
      <p class="text-muted mb-0">Manage content for {{ $categories[$category] ?? $category }} page</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
      <i class="ti tabler-plus me-1"></i> Add Section
    </button>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <!-- Sections List -->
  <div class="card">
    <div class="card-body">
      @if($sections->isEmpty())
      <div class="text-center py-5">
        <i class="ti tabler-mountain-off fs-1 text-muted"></i>
        <p class="mt-2 text-muted">No sections found. Add your first section.</p>
      </div>
      @else
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="60">Order</th>
              <th>Title</th>
              <th>Subtitle</th>
              <th>Images</th>
              <th>Status</th>
              <th width="120">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sections as $section)
            <tr>
              <td>{{ $section->sort_order }}</td>
              <td>
                <strong>{{ $section->title }}</strong>
                <br><code class="small">#{{ $section->slug }}</code>
              </td>
              <td>{{ \Illuminate\Support\Str::limit($section->subtitle, 50) }}</td>
              <td>
                @php $imgCount = count($section->images ?? []); @endphp
                <span class="badge bg-{{ $imgCount > 0 ? 'success' : 'secondary' }}">{{ $imgCount }} images</span>
              </td>
              <td>
                @if($section->is_active)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-secondary">Inactive</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.trip-types.edit', $section) }}" class="btn btn-sm btn-icon btn-primary" title="Edit">
                  <i class="ti tabler-edit"></i>
                </a>
                <form action="{{ route('admin.trip-types.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this section?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Delete">
                    <i class="ti tabler-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>

  <!-- Preview Link -->
  @if($category === 'mountain')
  <div class="mt-3">
    <a href="{{ route('mountain-trip') }}" target="_blank" class="btn btn-outline-primary">
      <i class="ti tabler-external-link me-1"></i> Preview Mountain Trip Page
    </a>
  </div>
  @endif
</div>

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.trip-types.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add New Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="category" value="{{ $category }}">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required placeholder="e.g., Private Trip">
          </div>
          <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text" class="form-control" name="subtitle" placeholder="Short description">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Section</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
