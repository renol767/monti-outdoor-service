@extends('layouts/layoutMaster')

@section('title', 'Edit Hero Slide')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
      <span class="text-muted fw-light">Admin / Hero Slides /</span> Edit Slide #{{ $slide->order }}
    </h4>
    <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">
      <i class="ti tabler-arrow-left me-1"></i> Back to List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0">Slide Content</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.hero-slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Badge Text -->
            <div class="mb-3">
              <label class="form-label">Badge Text</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <input type="text" class="form-control @error('badge_text.id') is-invalid @enderror" 
                       id="badge_text_id" name="badge_text[id]" 
                       value="{{ old('badge_text.id', $slide->getTranslation('badge_text', 'id', false)) }}" 
                       maxlength="100" placeholder="Indonesia">
                @error('badge_text.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <input type="text" class="form-control @error('badge_text.en') is-invalid @enderror" 
                       id="badge_text_en" name="badge_text[en]" 
                       value="{{ old('badge_text.en', $slide->getTranslation('badge_text', 'en', false)) }}" 
                       maxlength="100" placeholder="English">
                @error('badge_text.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-text">Small text above the title (max 100 characters)</div>
            </div>

            <!-- Title -->
            <div class="mb-3">
              <label class="form-label">Title</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <input type="text" class="form-control @error('title.id') is-invalid @enderror" 
                       id="title_id" name="title[id]" 
                       value="{{ old('title.id', $slide->getTranslation('title', 'id', false)) }}" 
                       maxlength="200" placeholder="Indonesia" required>
                @error('title.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <input type="text" class="form-control @error('title.en') is-invalid @enderror" 
                       id="title_en" name="title[en]" 
                       value="{{ old('title.en', $slide->getTranslation('title', 'en', false)) }}" 
                       maxlength="200" placeholder="English">
                @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-text">Main heading text (max 200 characters)</div>
            </div>

            <!-- Subtitle -->
            <div class="mb-3">
              <label class="form-label">Subtitle</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <textarea class="form-control @error('subtitle.id') is-invalid @enderror" 
                          id="subtitle_id" name="subtitle[id]" 
                          rows="3" maxlength="500" placeholder="Indonesia" required>{{ old('subtitle.id', $slide->getTranslation('subtitle', 'id', false)) }}</textarea>
                @error('subtitle.id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <textarea class="form-control @error('subtitle.en') is-invalid @enderror" 
                          id="subtitle_en" name="subtitle[en]" 
                          rows="3" maxlength="500" placeholder="English">{{ old('subtitle.en', $slide->getTranslation('subtitle', 'en', false)) }}</textarea>
                @error('subtitle.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-text">Description text below the title (max 500 characters)</div>
            </div>

            <!-- Background Image -->
            <div class="mb-3">
              <label for="background_image" class="form-label">Background Image</label>
              
              @if($slide->background_image)
              <div class="mb-2">
                <img src="{{ asset($slide->background_image) }}" alt="Current background" 
                     class="d-block rounded" style="max-height: 200px; width: auto;">
                <small class="text-muted d-block mt-1">Current image</small>
              </div>
              @endif

              <input type="file" class="form-control crop-image @error('background_image') is-invalid @enderror" 
                     id="background_image" name="background_image" 
                     accept="image/*" data-ratio="16/9">
              <div class="form-text">
                <i class="ti tabler-info-circle me-1"></i>
                Recommended size: 1920x1080px (16:9 ratio). Max file size: 5MB. Leave empty to keep current image.
              </div>
              @error('background_image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                       {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  <strong>Active</strong>
                  <span class="text-muted d-block">Show this slide in the hero slider</span>
                </label>
              </div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="ti tabler-check me-1"></i> Save Changes
              </button>
              <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">
                Cancel
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Preview Card -->
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Preview</h5>
        </div>
        <div class="card-body">
          <div class="position-relative" style="height: 300px; overflow: hidden; border-radius: 8px;">
            <img src="{{ asset($slide->background_image) }}" alt="Preview" 
                 style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6)); display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px;">
              <span class="badge bg-primary mb-2" id="preview-badge">{{ $slide->badge_text }}</span>
              <h3 class="text-white mb-2" id="preview-title">{{ $slide->title }}</h3>
              <p class="text-white-50 mb-0" style="font-size: 14px;" id="preview-subtitle">{{ $slide->subtitle }}</p>
            </div>
          </div>
          
          <div class="mt-3">
            <div class="d-flex justify-content-between align-items-center">
              <span class="text-muted">Slide Order:</span>
              <strong>#{{ $slide->order }}</strong>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <span class="text-muted">Status:</span>
              <span class="badge bg-label-{{ $slide->is_active ? 'success' : 'secondary' }}">
                {{ $slide->is_active ? 'Active' : 'Inactive' }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview updates (defaults to showing ID version)
    const badgeInput = document.getElementById('badge_text_id');
    const titleInput = document.getElementById('title_id');
    const subtitleInput = document.getElementById('subtitle_id');
    
    // Also optional EN listeners if we want to toggle preview (skipping for now, showing ID)
    
    const previewBadge = document.getElementById('preview-badge');
    const previewTitle = document.getElementById('preview-title');
    const previewSubtitle = document.getElementById('preview-subtitle');
    
    if (badgeInput && previewBadge) {
        badgeInput.addEventListener('input', function() {
            previewBadge.textContent = this.value || 'Badge Text';
        });
    }
    
    if (titleInput && previewTitle) {
        titleInput.addEventListener('input', function() {
            previewTitle.textContent = this.value || 'Title';
        });
    }
    
    if (subtitleInput && previewSubtitle) {
        subtitleInput.addEventListener('input', function() {
            previewSubtitle.textContent = this.value || 'Subtitle';
        });
    }
});
</script>
@endsection

@endsection
