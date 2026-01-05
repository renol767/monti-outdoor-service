@extends('layouts/layoutMaster')

@section('title', 'Edit Section - ' . $section->title)

@section('vendor-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.trip-types.index', ['category' => $section->category]) }}">Mountain Trip</a></li>
      <li class="breadcrumb-item active">{{ $section->title }}</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-lg-7">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Edit Section: {{ $section->title }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.trip-types.update', $section) }}" method="POST" enctype="multipart/form-data" id="mainForm">
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $section->title) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" min="0">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Subtitle</label>
              <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}" placeholder="Short description">
            </div>

            <div class="mb-3">
              <label class="form-label">Content Highlight <small class="text-muted">(ditampilkan di halaman Mountain Trip)</small></label>
              <div id="quillEditorHighlight" style="height: 180px;"></div>
              <input type="hidden" name="content_html" id="contentHtml">
            </div>

            <div class="mb-3">
              <label class="form-label">Content Full <small class="text-muted">(ditampilkan di halaman detail)</small></label>
              <div id="quillEditorFull" style="height: 300px;"></div>
              <input type="hidden" name="content_full" id="contentFull">
            </div>

            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $section->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Active</label>
              </div>
            </div>

            <!-- Hidden inputs for cropped images -->
            <input type="hidden" name="cropped_image_0" id="croppedImage0">
            <input type="hidden" name="cropped_image_1" id="croppedImage1">
            <input type="hidden" name="cropped_image_2" id="croppedImage2">
            <input type="hidden" name="cropped_image_3" id="croppedImage3">

            <button type="submit" class="btn btn-primary">
              <i class="ti tabler-check me-1"></i> Save Changes
            </button>
            <a href="{{ route('admin.trip-types.index', ['category' => $section->category]) }}" class="btn btn-outline-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <!-- Images with Cropper -->
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="mb-0">Section Images</h5>
          <small class="text-muted">Click to upload & crop</small>
        </div>
        <div class="card-body">
          @php $images = $section->images ?? []; @endphp
          
          <!-- Image Grid Preview -->
          <div class="image-grid-preview mb-3">
            <!-- Large Image -->
            <div class="img-preview-large" data-index="0" data-aspect="0.75">
              @if(isset($images[0]))
              <img src="{{ asset($images[0]) }}" id="preview0">
              @else
              <div class="img-upload-placeholder">
                <i class="ti tabler-photo-plus"></i>
                <span>Large</span>
              </div>
              @endif
              <input type="file" class="d-none" id="fileInput0" accept="image/*">
            </div>
            
            <!-- Right Column -->
            <div class="img-preview-right">
              <!-- Medium Image -->
              <div class="img-preview-medium" data-index="1" data-aspect="1.5">
                @if(isset($images[1]))
                <img src="{{ asset($images[1]) }}" id="preview1">
                @else
                <div class="img-upload-placeholder">
                  <i class="ti tabler-photo-plus"></i>
                  <span>Medium</span>
                </div>
                @endif
                <input type="file" class="d-none" id="fileInput1" accept="image/*">
              </div>
              
              <!-- Small Images -->
              <div class="img-preview-small-row">
                <div class="img-preview-small" data-index="2" data-aspect="1">
                  @if(isset($images[2]))
                  <img src="{{ asset($images[2]) }}" id="preview2">
                  @else
                  <div class="img-upload-placeholder">
                    <i class="ti tabler-photo-plus"></i>
                    <span>Small 1</span>
                  </div>
                  @endif
                  <input type="file" class="d-none" id="fileInput2" accept="image/*">
                </div>
                <div class="img-preview-small" data-index="3" data-aspect="1">
                  @if(isset($images[3]))
                  <img src="{{ asset($images[3]) }}" id="preview3">
                  @else
                  <div class="img-upload-placeholder">
                    <i class="ti tabler-photo-plus"></i>
                    <span>Small 2</span>
                  </div>
                  @endif
                  <input type="file" class="d-none" id="fileInput3" accept="image/*">
                </div>
              </div>
            </div>
          </div>
          
          <p class="text-muted small mb-0"><i class="ti tabler-info-circle me-1"></i>Click each box to upload and crop image</p>
        </div>
      </div>

      <!-- Preview -->
      <div class="card mt-3">
        <div class="card-body text-center">
          <p class="text-muted mb-2">Section ID</p>
          <code>#{{ $section->slug }}</code>
          <hr>
          <a href="{{ route('mountain-trip') }}#{{ $section->slug }}" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="ti tabler-external-link me-1"></i> Preview Section
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Crop Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="img-container" style="max-height: 400px;">
          <img id="cropperImage" style="max-width: 100%;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="cropBtn">
          <i class="ti tabler-crop me-1"></i> Crop & Apply
        </button>
      </div>
    </div>
  </div>
</div>

<style>
.image-grid-preview {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.5rem;
  aspect-ratio: 1;
}
.img-preview-large {
  grid-row: 1 / 3;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  border: 2px dashed #ddd;
  transition: all 0.2s;
}
.img-preview-large:hover {
  border-color: var(--bs-primary);
}
.img-preview-right {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.img-preview-medium {
  flex: 1;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  border: 2px dashed #ddd;
  transition: all 0.2s;
}
.img-preview-medium:hover {
  border-color: var(--bs-primary);
}
.img-preview-small-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.5rem;
  flex: 1;
}
.img-preview-small {
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  border: 2px dashed #ddd;
  transition: all 0.2s;
}
.img-preview-small:hover {
  border-color: var(--bs-primary);
}
.img-preview-large img,
.img-preview-medium img,
.img-preview-small img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.img-upload-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #f8f9fa;
  color: #6c757d;
}
.img-upload-placeholder i {
  font-size: 1.5rem;
  margin-bottom: 0.25rem;
}
.img-upload-placeholder span {
  font-size: 0.75rem;
}
</style>
@endsection

@section('page-script')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Quill Editor - Content Highlight
  const quillHighlight = new Quill('#quillEditorHighlight', {
    theme: 'snow',
    placeholder: 'Tulis ringkasan singkat untuk ditampilkan di halaman Mountain Trip...',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['clean']
      ]
    }
  });

  // Load existing highlight content
  const existingHighlight = @json($section->content_html ?? '');
  if (existingHighlight) {
    quillHighlight.clipboard.dangerouslyPasteHTML(existingHighlight);
  }

  // Quill Editor - Content Full
  const quillFull = new Quill('#quillEditorFull', {
    theme: 'snow',
    placeholder: 'Tulis artikel lengkap untuk ditampilkan di halaman detail...',
    modules: {
      toolbar: [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link'],
        ['clean']
      ]
    }
  });

  // Load existing full content
  const existingFull = @json($section->content_full ?? '');
  if (existingFull) {
    quillFull.clipboard.dangerouslyPasteHTML(existingFull);
  }

  // Cropper
  let cropper = null;
  let currentIndex = null;
  const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
  const cropperImage = document.getElementById('cropperImage');

  // Click handlers for image boxes
  document.querySelectorAll('[data-index]').forEach(box => {
    box.addEventListener('click', function() {
      const index = this.getAttribute('data-index');
      document.getElementById('fileInput' + index).click();
    });
  });

  // File input handlers - use forEach to avoid closure issues
  [0, 1, 2, 3].forEach(function(idx) {
    const fileInput = document.getElementById('fileInput' + idx);
    if (!fileInput) return;
    
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;

      currentIndex = idx;
      const aspectRatios = [0.75, 1.5, 1, 1]; // Large, Medium, Small, Small
      
      const reader = new FileReader();
      reader.onload = function(event) {
        cropperImage.src = event.target.result;
        cropModal.show();
        
        // Wait for modal to show
        setTimeout(() => {
          if (cropper) cropper.destroy();
          cropper = new Cropper(cropperImage, {
            aspectRatio: aspectRatios[currentIndex],
            viewMode: 2,
            autoCropArea: 1,
            responsive: true
          });
        }, 300);
      };
      reader.readAsDataURL(file);
    });
  });

  // Crop button
  document.getElementById('cropBtn').addEventListener('click', function() {
    if (!cropper || currentIndex === null) return;
    
    const canvas = cropper.getCroppedCanvas({
      maxWidth: 1200,
      maxHeight: 1200
    });
    
    const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
    
    // Update preview - preserve file input
    const previewBox = document.querySelector('[data-index="' + currentIndex + '"]');
    const fileInput = previewBox.querySelector('input[type="file"]');
    
    let previewImg = previewBox.querySelector('img');
    if (!previewImg) {
      // Clear placeholder but keep file input
      const placeholder = previewBox.querySelector('.img-upload-placeholder');
      if (placeholder) placeholder.remove();
      
      previewImg = document.createElement('img');
      previewImg.id = 'preview' + currentIndex;
      previewBox.insertBefore(previewImg, fileInput);
    }
    previewImg.src = dataUrl;
    
    // Store in hidden input
    document.getElementById('croppedImage' + currentIndex).value = dataUrl;
    
    cropModal.hide();
    cropper.destroy();
    cropper = null;
  });

  // Form submit
  document.getElementById('mainForm').addEventListener('submit', function(e) {
    document.getElementById('contentHtml').value = quillHighlight.root.innerHTML;
    document.getElementById('contentFull').value = quillFull.root.innerHTML;
  });
});
</script>
@endsection
