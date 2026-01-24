@extends('layouts/layoutMaster')

@section('title', 'Hero Slides Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Admin /</span> Hero Slides</h4>
    <a href="{{ route('landing') }}" target="_blank" class="btn btn-outline-primary">
      <i class="ti tabler-external-link me-1"></i> Preview Landing Page
    </a>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">
        <i class="ti tabler-slideshow me-2"></i>Manage Hero Slides (5 Slides)
      </h5>
      <p class="text-muted mb-0 mt-2">
        <i class="ti tabler-info-circle me-1"></i>
        Edit content and toggle active/inactive status for each slide. Active slides will appear in the hero slider.
      </p>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th width="5%">#</th>
            <th width="15%">Preview</th>
            <th width="15%">Badge</th>
            <th width="30%">Title</th>
            <th width="10%" class="text-center">Status</th>
            <th width="15%" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($slides as $slide)
          <tr>
            <td><strong>{{ $slide->order }}</strong></td>
            <td>
              <img src="{{ asset($slide->background_image) }}" alt="Slide {{ $slide->order }}" 
                   class="rounded" style="width: 100px; height: 60px; object-fit: cover;">
            </td>
            <td>
              <span class="badge bg-label-info">{{ \Illuminate\Support\Str::limit($slide->badge_text, 20) }}</span>
            </td>
            <td>
              <strong>{{ \Illuminate\Support\Str::limit($slide->title, 40) }}</strong>
              <br>
              <small class="text-muted">{{ \Illuminate\Support\Str::limit($slide->subtitle, 50) }}</small>
            </td>
            <td class="text-center">
              <div class="form-check form-switch d-inline-block">
                <input class="form-check-input toggle-active" type="checkbox" 
                       data-slide-id="{{ $slide->id }}"
                       {{ $slide->is_active ? 'checked' : '' }}>
                <label class="form-check-label">
                  <span class="badge bg-label-{{ $slide->is_active ? 'success' : 'secondary' }} slide-status-{{ $slide->id }}">
                    {{ $slide->is_active ? 'Active' : 'Inactive' }}
                  </span>
                </label>
              </div>
            </td>
            <td class="text-center">
              <a href="{{ route('admin.hero-slides.edit', $slide->id) }}" class="btn btn-sm btn-primary">
                <i class="ti tabler-edit"></i> Edit
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle active status via AJAX
    const toggles = document.querySelectorAll('.toggle-active');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const slideId = this.dataset.slideId;
            const isActive = this.checked;
            
            fetch(`/admin/hero-slides/${slideId}/toggle-active`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ is_active: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update badge
                    const badge = document.querySelector(`.slide-status-${slideId}`);
                    if (data.is_active) {
                        badge.textContent = 'Active';
                        badge.classList.remove('bg-label-secondary');
                        badge.classList.add('bg-label-success');
                    } else {
                        badge.textContent = 'Inactive';
                        badge.classList.remove('bg-label-success');
                        badge.classList.add('bg-label-secondary');
                    }
                    
                    // Show success toast (optional)
                    console.log(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert toggle on error
                toggle.checked = !isActive;
            });
        });
    });
});
</script>
@endsection

@endsection
