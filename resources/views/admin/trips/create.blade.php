@extends('layouts/layoutMaster')

@section('title', 'Create Trip')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
      <span class="text-muted fw-light">Admin / <a href="{{ route('admin.trip-management.index') }}">Trips</a> /</span> Create New Trip
    </h4>
  </div>

  @if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.trip-management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
          <div class="col-md-8">
            <div class="mb-3">
              <label class="form-label" for="title">Trip Title <span class="text-danger">*</span></label>
              <div class="input-group mb-2">
                  <span class="input-group-text">ID</span>
                  <input type="text" class="form-control" name="title[id]" value="{{ old('title.id') }}" required placeholder="Judul Trip">
              </div>
              <div class="input-group">
                  <span class="input-group-text">EN</span>
                  <input type="text" class="form-control" name="title[en]" value="{{ old('title.en') }}" placeholder="Trip Title">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label class="form-label" for="category">Category <span class="text-danger">*</span></label>
              <select class="form-select" id="category" name="category" required>
                <option value="">Select category</option>
                <option value="mountain" {{ old('category') == 'mountain' ? 'selected' : '' }}>Mountain Trip</option>
                <option value="island" {{ old('category') == 'island' ? 'selected' : '' }}>Island Trip</option>
                <option value="city" {{ old('category') == 'city' ? 'selected' : '' }}>City Tour</option>
                <option value="international" {{ old('category') == 'international' ? 'selected' : '' }}>International</option>
                <option value="oneday" {{ old('category') == 'oneday' ? 'selected' : '' }}>One Day Trip</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="destination">Destination</label>
              <div class="input-group mb-2">
                  <span class="input-group-text">ID</span>
                  <input type="text" class="form-control" name="destination[id]" value="{{ old('destination.id') }}" placeholder="Lokasi">
              </div>
              <div class="input-group">
                  <span class="input-group-text">EN</span>
                  <input type="text" class="form-control" name="destination[en]" value="{{ old('destination.en') }}" placeholder="Location">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-3">
              <label class="form-label" for="duration_days">Days <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="duration_days" name="duration_days" value="{{ old('duration_days', 1) }}" min="1" required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-3">
              <label class="form-label" for="duration_nights">Nights <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="duration_nights" name="duration_nights" value="{{ old('duration_nights', 0) }}" min="0" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="difficulty">Difficulty</label>
              <select class="form-select" id="difficulty" name="difficulty">
                <option value="">Select difficulty</option>
                <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="moderate" {{ old('difficulty') == 'moderate' ? 'selected' : '' }}>Moderate</option>
                <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
                <option value="extreme" {{ old('difficulty') == 'extreme' ? 'selected' : '' }}>Extreme</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="thumbnail">Thumbnail Image</label>
              <input type="file" class="form-control" id="thumbnailInput" accept="image/*">
              <input type="hidden" name="thumbnail_cropped" id="thumbnailCroppedData">
              <div class="mt-2 d-none" id="croppedThumbnailPreview">
                <img src="" alt="Cropped preview" class="rounded border" style="max-height: 150px;">
                <small class="d-block text-success mt-1"><i class="ti tabler-check"></i> Valid 4:5 Thumbnail</small>
              </div>
              <small class="text-muted">Recommended: 4:5 ratio (portrait). Image will be cropped automatically.</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="thumbnail_landscape">Landscape Thumbnail (Hero)</label>
              <input type="file" class="form-control cropper-input" id="landscapeInput" data-type="landscape" accept="image/*">
              <input type="hidden" name="thumbnail_landscape_cropped" id="landscapeCroppedData">
              <div class="mt-2 d-none" id="croppedLandscapePreview">
                <img src="" alt="Cropped preview" class="rounded border" style="max-height: 150px;">
                <small class="d-block text-success mt-1"><i class="ti tabler-check"></i> Valid Landscape Thumbnail</small>
              </div>
              <small class="text-muted">Recommended: Landscape (16:9). Required for Hero section.</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
               <label class="form-label" for="trip_itinerary_pdf">Trip Itinerary PDF</label>
               <input type="file" class="form-control" id="trip_itinerary_pdf" name="trip_itinerary_pdf" accept=".pdf">
               <small class="text-muted">Upload PDF file for "Download Trip Detail" button.</small>
            </div>
          </div>
        </div>

        <hr class="my-4">

        <!-- Trip Includes (Amenities shown on cards - KEY based) -->
        <div class="row">
          <div class="col-12">
            <div class="mb-3">
              <label class="form-label">Trip Includes (shown as icons)</label>
              <div class="row g-3">
                @foreach([
                    'guide' => ['icon' => 'user-check', 'label' => 'Guide'],
                    'tour_leader' => ['icon' => 'flag', 'label' => 'Tour Leader'],
                    'local_guide' => ['icon' => 'map-pin', 'label' => 'Local Guide'],
                    'porters' => ['icon' => 'backpack', 'label' => 'Porters'],
                    'hotel' => ['icon' => 'building', 'label' => 'Hotel'],
                    'homestay' => ['icon' => 'home', 'label' => 'Homestay'],
                    'lodge' => ['icon' => 'home-2', 'label' => 'Lodge'],
                    'meals' => ['icon' => 'tools-kitchen-2', 'label' => 'Meals'],
                    'campsite' => ['icon' => 'tent', 'label' => 'Campsite Tenda'],
                    'transport' => ['icon' => 'bus', 'label' => 'Transport Bus'],
                    'transport_plane' => ['icon' => 'plane', 'label' => 'Transport Pesawat'],
                    'transport_ojek' => ['icon' => 'motorbike', 'label' => 'Transport Ojek'],
                    'transport_pickup' => ['icon' => 'truck', 'label' => 'Transport Pickup'],
                    'transport_jeep' => ['icon' => 'car', 'label' => 'Transport Jeep'],
                    'transport_ship' => ['icon' => 'speedboat', 'label' => 'Transport Kapal Laut'],
                    'airport_transfer' => ['icon' => 'plane-arrival', 'label' => 'Airport Transfer'],
                    'permit' => ['icon' => 'ticket', 'label' => 'Permit'],
                    'insurance' => ['icon' => 'shield-check', 'label' => 'Insurance'],
                    'first_aid' => ['icon' => 'first-aid-kit', 'label' => 'First Aid'],
                    'technical_gears' => ['icon' => 'tools', 'label' => 'Technical Gears'],
                    'snacks' => ['icon' => 'coffee', 'label' => 'Snack & Beverages'],
                    'souvenir' => ['icon' => 'gift', 'label' => 'Souvenir'],
                    'documentation' => ['icon' => 'camera', 'label' => 'Dokumentasi']
                ] as $key => $meta)
                <div class="col-md-3 col-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="includes[]" value="{{ $key }}" id="inc-{{ $key }}">
                    <label class="form-check-label" for="inc-{{ $key }}">
                      <i class="ti tabler-{{ $meta['icon'] }} me-1"></i> {{ $meta['label'] }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <hr class="my-4">
        
        <!-- Trip Facts -->
        <h6 class="text-muted mb-3">Trip Facts (Metrics)</h6>
        <div class="alert alert-info py-2 mb-3">
          <i class="ti tabler-info-circle me-1"></i> Enable the checkbox to display the metric. Provide values for both languages.
        </div>
        
        @php
            $metrics = [
                'grade' => ['label' => 'Grade', 'placeholder' => 'III - Menengah / Medium'],
                'distance' => ['label' => 'Distance', 'placeholder' => '5.2 KM'],
                'max_altitude' => ['label' => 'Max Altitude', 'placeholder' => '3.142 mdpl'],
                'duration' => ['label' => 'Duration (Text)', 'placeholder' => '2H 1M'],
                'trekking_time' => ['label' => 'Trekking Time', 'placeholder' => '5-7 Jam / Hours'],
                'elevation_gain' => ['label' => 'Elevation Gain', 'placeholder' => '1.200 m'],
                'terrain' => ['label' => 'Terrain', 'placeholder' => 'Aspal / Paved'],
                'trekking_day' => ['label' => 'Trekking Day', 'placeholder' => '3 Hari / Days'],
                'accommodation' => ['label' => 'Accomodation Type', 'placeholder' => 'Tenda / Tent'],
                'destinations' => ['label' => 'Destinations', 'placeholder' => 'Puncak / Summit'],
                'climate' => ['label' => 'Climate', 'placeholder' => 'Tropis / Tropical']
            ];
        @endphp

        <div class="row g-3">
            @foreach($metrics as $key => $meta)
            <div class="col-12 border rounded p-2 bg-light bg-opacity-10">
                <div class="d-flex align-items-center mb-2">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="trip_facts_enabled[{{ $key }}]" value="1" {{ old("trip_facts_enabled.$key") ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold">{{ $meta['label'] }}</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">ID</span>
                            <input type="text" class="form-control" name="trip_facts[id][{{ $key }}][value]" 
                                    value="{{ old("trip_facts.id.$key.value") }}" placeholder="{{ $meta['placeholder'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">EN</span>
                            <input type="text" class="form-control" name="trip_facts[en][{{ $key }}][value]" 
                                    value="{{ old("trip_facts.en.$key.value") }}" placeholder="{{ $meta['placeholder'] }}">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr class="my-4">
        <h6 class="text-muted mb-3">SEO Settings (Optional)</h6>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="meta_title">Meta Title</label>
              <div class="input-group mb-2">
                  <span class="input-group-text">ID</span>
                  <input type="text" class="form-control" name="meta_title[id]" value="{{ old('meta_title.id') }}">
              </div>
              <div class="input-group">
                  <span class="input-group-text">EN</span>
                  <input type="text" class="form-control" name="meta_title[en]" value="{{ old('meta_title.en') }}">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="meta_description">Meta Description</label>
               <div class="input-group mb-2">
                  <span class="input-group-text">ID</span>
                  <textarea class="form-control" name="meta_description[id]" rows="2">{{ old('meta_description.id') }}</textarea>
              </div>
              <div class="input-group">
                  <span class="input-group-text">EN</span>
                  <textarea class="form-control" name="meta_description[en]" rows="2">{{ old('meta_description.en') }}</textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">
            <i class="ti tabler-check me-1"></i> Create Trip
          </button>
          <a href="{{ route('admin.trip-management.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">
<style>
.cropper-container { max-height: 400px; }
</style>

<!-- Image Cropper Modal -->
<div class="modal fade" id="imageCropperModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Aspect Ratio: Fixed 4:5</label>
        </div>
        <div style="max-height: 400px; overflow: hidden; background: #333;">
          <img id="cropperImage" src="" style="max-width: 100%; display: block;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="cropBtn">
          <i class="ti tabler-crop me-1"></i> Crop & Save
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('page-script')
<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 0. Trip Facts Form Handler (Matches edit.blade.php logic)
    const createForm = document.querySelector('form[action="{{ route('admin.trip-management.store') }}"]');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            const keys = ['grade', 'distance', 'max_altitude', 'duration', 'trekking_time', 'elevation_gain', 'terrain', 'trekking_day', 'accommodation', 'destinations', 'climate'];
            
            keys.forEach(key => {
                const enabledCheckbox = form.querySelector(`input[name="trip_facts_enabled[${key}]"]`);
                const enabled = enabledCheckbox ? (enabledCheckbox.checked ? '1' : '0') : '0';
                
                // Create hidden inputs for enabled logic to match backend expectations
                // Backend likely expects array structure as defined or custom processing. 
                // We'll mimic edit.blade.php approach to safe-guard structure.
                
                const hiddenId = document.createElement('input');
                hiddenId.type = 'hidden';
                hiddenId.name = `trip_facts[id][${key}][enabled]`;
                hiddenId.value = enabled;
                form.appendChild(hiddenId);
                
                const hiddenEn = document.createElement('input');
                hiddenEn.type = 'hidden';
                hiddenEn.name = `trip_facts[en][${key}][enabled]`;
                hiddenEn.value = enabled;
                form.appendChild(hiddenEn);
            });
            
            form.submit();
        });
    }

    // Cropper Variables
    let cropper = null;
    const cropperModal = new bootstrap.Modal(document.getElementById('imageCropperModal'));
    const cropperImage = document.getElementById('cropperImage');
    const cropBtn = document.getElementById('cropBtn');
    
    // State
    let currentInputType = null; // 'portrait' or 'landscape'

    // 1. File Selection Handler
    function handleFileSelect(e, type) {
        if (e.target.files && e.target.files[0]) {
            const file = e.target.files[0];
            
            // Validate Type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            currentInputType = type;

            // Update Modal Title/Label
            const label = type === 'portrait' ? 'Fixed 4:5 (Portrait)' : 'Fixed 16:9 (Landscape)';
            document.querySelector('#imageCropperModal .form-label').textContent = `Aspect Ratio: ${label}`;

            // Load Image
            const reader = new FileReader();
            reader.onload = function(evt) {
                cropperImage.src = evt.target.result;
                cropperModal.show();
            };
            reader.readAsDataURL(file);
        }
        e.target.value = ''; // Reset
    }

    // Attach listeners
    document.getElementById('thumbnailInput').addEventListener('change', (e) => handleFileSelect(e, 'portrait'));
    document.getElementById('landscapeInput').addEventListener('change', (e) => handleFileSelect(e, 'landscape'));

    // 2. Init Cropper when Modal opens
    document.getElementById('imageCropperModal').addEventListener('shown.bs.modal', function() {
        if (cropper) cropper.destroy();
        
        const aspectRatio = currentInputType === 'portrait' ? 0.8 : (16/9);

        cropper = new Cropper(cropperImage, {
            viewMode: 1,
            dragMode: 'move',
            autoCropArea: 0.9,
            responsive: true,
            background: false,
            aspectRatio: aspectRatio,
        });
    });

    document.getElementById('imageCropperModal').addEventListener('hidden.bs.modal', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        currentInputType = null;
    });


    // 4. Crop Action
    cropBtn.addEventListener('click', function() {
        if (!cropper || !currentInputType) return;

        // Get cropped canvas
        const canvas = cropper.getCroppedCanvas({
            maxWidth: 1600,
            maxHeight: 1600, // Sufficient for both
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        if (canvas) {
            // Convert to Base64
            const base64 = canvas.toDataURL('image/jpeg', 0.9);
            
            // Determine targets based on type
            let hiddenInputId, previewId;
            if (currentInputType === 'portrait') {
                hiddenInputId = 'thumbnailCroppedData';
                previewId = 'croppedThumbnailPreview';
            } else {
                hiddenInputId = 'landscapeCroppedData';
                previewId = 'croppedLandscapePreview';
            }
            
            // Set Hidden Input
            document.getElementById(hiddenInputId).value = base64;
            
            // Show Preview
            const previewEl = document.getElementById(previewId);
            previewEl.querySelector('img').src = base64;
            previewEl.classList.remove('d-none');
            
            // Close Modal
            cropperModal.hide();
        }
    });
});
</script>
@endsection
