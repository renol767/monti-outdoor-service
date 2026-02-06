@extends('layouts/layoutMaster')

@section('title', 'Trip Type Sections')

@section('vendor-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Trip Type Sections</h4>
      <p class="text-muted mb-0">Manage content for {{ $categories[$category] ?? $category }} page</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#manageHeroModal">
        <i class="ti tabler-photo-edit me-1"></i> Hero Configuration
      </button>
    </div>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
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
          <button type="button" class="btn btn-primary">Create Section</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Manage Hero Modal -->
<div class="modal fade" id="manageHeroModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.trip-types.update-hero') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Hero Configuration ({{ ucfirst($category) }})</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="category" value="{{ $category }}">
          
          <div class="alert alert-info">
            <i class="ti tabler-info-circle me-1"></i> This updates the main banner image and text at the top of the page.
          </div>

          <div class="mb-3">
            <label class="form-label">Hero Title</label>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted">Indonesian (ID)</label>
                    <input type="text" class="form-control @error('title_id') is-invalid @enderror" name="title_id" required 
                           placeholder="Judul dalam Bahasa Indonesia"
                           value="{{ old('title_id', $heroSection ? $heroSection->getTranslation('title', 'id', false) : '') }}">
                    @error('title_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted">English (EN)</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en" required 
                           placeholder="Title in English"
                           value="{{ old('title_en', $heroSection ? $heroSection->getTranslation('title', 'en', false) : '') }}">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Hero Subtitle</label>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted">Indonesian (ID)</label>
                    <input type="text" class="form-control @error('subtitle_id') is-invalid @enderror" name="subtitle_id" 
                           placeholder="Deskripsi singkat..."
                           value="{{ old('subtitle_id', $heroSection ? $heroSection->getTranslation('subtitle', 'id', false) : '') }}">
                    @error('subtitle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label small text-muted">English (EN)</label>
                    <input type="text" class="form-control @error('subtitle_en') is-invalid @enderror" name="subtitle_en" 
                           placeholder="Short tagline..."
                           value="{{ old('subtitle_en', $heroSection ? $heroSection->getTranslation('subtitle', 'en', false) : '') }}">
                    @error('subtitle_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Current Hero Image</label>
            @if(isset($heroSection) && !empty($heroSection->images) && isset($heroSection->images[0]))
              <div class="mb-2">
                <img src="{{ asset($heroSection->images[0]) }}" class="img-fluid rounded" style="max-height: 150px; width: 100%; object-fit: cover;">
              </div>
            @else
              <div class="mb-2 p-3 bg-light text-center rounded text-muted">
                No custom image uploaded (Using Default)
              </div>
            @endif
          </div>

          <div class="mb-3">
            <label class="form-label">Upload New Image</label>
            <input type="file" class="form-control crop-image" id="hero_image" name="hero_image" accept="image/*" data-ratio="2.4" data-no-resize="true">
            <div class="form-text">Recommended size: 1920x800px. Max 10MB.</div>
            
            <!-- Restore Preview -->
            <div id="newImagePreview" class="mt-2 d-none">
                <p class="small text-muted mb-1">New Image Preview:</p>
                <img src="" class="img-fluid rounded border" style="max-height: 150px; width: 100%; object-fit: cover;">
            </div>
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

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroInput = document.getElementById('hero_image');
    const previewContainer = document.getElementById('newImagePreview');
    const previewImg = previewContainer.querySelector('img');

    if(heroInput) {
        heroInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection
@endsection
