@extends('layouts/layoutMaster')

@section('title', 'Manage Trip - ' . $trip->title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
      <span class="text-muted fw-light">Admin / <a href="{{ route('admin.trip-management.index') }}">Trips</a> /</span> {{ $trip->title }}
    </h4>
    <div>
      @if($trip->status === 'published')
      <span class="badge bg-success me-2">Published</span>
      @else
      <span class="badge bg-warning me-2">Draft</span>
      @endif
      <form action="{{ route('admin.trip-management.toggle-publish', $trip) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-{{ $trip->status === 'published' ? 'outline-secondary' : 'primary' }}">
          @if($trip->status === 'published')
          <i class="ti tabler-eye-off me-1"></i> Unpublish
          @else
          <i class="ti tabler-check me-1"></i> Publish
          @endif
        </button>
      </form>
    </div>
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

  <!-- Tabs -->
  <div class="nav-align-top mb-4">
    <ul class="nav nav-tabs mb-3" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-basic">
          <i class="ti tabler-info-circle me-1"></i> Basic Info
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-departures">
          <i class="ti tabler-calendar me-1"></i> Departures
          <span class="badge bg-label-primary ms-1">{{ $trip->departures->count() }}</span>
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-content">
          <i class="ti tabler-file-text me-1"></i> Content
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-media">
          <i class="ti tabler-photo me-1"></i> Media
        </button>
      </li>
    </ul>

    <div class="tab-content">
      <!-- Basic Info Tab -->
      <div class="tab-pane fade show active" id="tab-basic">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.trip-management.update', $trip) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="row">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="form-label">Trip Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $trip->title) }}" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category" required>
                      <option value="mountain" {{ $trip->category == 'mountain' ? 'selected' : '' }}>Mountain Trip</option>
                      <option value="island" {{ $trip->category == 'island' ? 'selected' : '' }}>Island Trip</option>
                      <option value="city" {{ $trip->category == 'city' ? 'selected' : '' }}>City Tour</option>
                      <option value="international" {{ $trip->category == 'international' ? 'selected' : '' }}>International</option>
                      <option value="oneday" {{ $trip->category == 'oneday' ? 'selected' : '' }}>One Day Trip</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Destination</label>
                    <input type="text" class="form-control" name="destination" value="{{ old('destination', $trip->destination) }}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="mb-3">
                    <label class="form-label">Days</label>
                    <input type="number" class="form-control" name="duration_days" value="{{ $trip->duration_days }}" min="1" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="mb-3">
                    <label class="form-label">Nights</label>
                    <input type="number" class="form-control" name="duration_nights" value="{{ $trip->duration_nights }}" min="0" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="mb-3">
                    <label class="form-label">Difficulty</label>
                    <select class="form-select" name="difficulty">
                      <option value="">-</option>
                      <option value="easy" {{ $trip->difficulty == 'easy' ? 'selected' : '' }}>Easy</option>
                      <option value="moderate" {{ $trip->difficulty == 'moderate' ? 'selected' : '' }}>Moderate</option>
                      <option value="hard" {{ $trip->difficulty == 'hard' ? 'selected' : '' }}>Hard</option>
                      <option value="extreme" {{ $trip->difficulty == 'extreme' ? 'selected' : '' }}>Extreme</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Trip Includes (Amenities shown on cards) -->
              <div class="row">
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Trip Includes (shown as icons)</label>
                    <div class="row g-3">
                      @php $includes = $trip->includes ?? []; @endphp
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="crew" id="inc-crew" {{ in_array('crew', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-crew">
                            <i class="ti tabler-users-group me-1"></i> Professional Crew
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="porters" id="inc-porters" {{ in_array('porters', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-porters">
                            <i class="ti tabler-backpack me-1"></i> Porters
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="transport" id="inc-transport" {{ in_array('transport', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-transport">
                            <i class="ti tabler-bus me-1"></i> Transport Bus
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="meals" id="inc-meals" {{ in_array('meals', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-meals">
                            <i class="ti tabler-tools-kitchen-2 me-1"></i> Meals
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="campsite" id="inc-campsite" {{ in_array('campsite', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-campsite">
                            <i class="ti tabler-tent me-1"></i> Campsite Tenda
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="insurance" id="inc-insurance" {{ in_array('insurance', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-insurance">
                            <i class="ti tabler-shield-check me-1"></i> Perijinan / Asuransi
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="first_aid" id="inc-first_aid" {{ in_array('first_aid', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-first_aid">
                            <i class="ti tabler-first-aid-kit me-1"></i> P3K
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="snacks" id="inc-snacks" {{ in_array('snacks', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-snacks">
                            <i class="ti tabler-coffee me-1"></i> Snack & Beverages
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="souvenir" id="inc-souvenir" {{ in_array('souvenir', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-souvenir">
                            <i class="ti tabler-gift me-1"></i> Souvenir
                          </label>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-6">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="includes[]" value="documentation" id="inc-documentation" {{ in_array('documentation', $includes) ? 'checked' : '' }}>
                          <label class="form-check-label" for="inc-documentation">
                            <i class="ti tabler-camera me-1"></i> Dokumentasi
                          </label>
                        </div>
                      </div>
                      
                    </div>
                    <small class="text-muted mt-2 d-block">These icons will appear on the trip card and detail page</small>
                  </div>
                </div>
              </div>
              
              <!-- Highlights for Card -->
              <div class="row">
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Card Highlights <small class="text-muted">(max 3 lines, shown on trip card)</small></label>
                    <textarea class="form-control" name="highlights" rows="3" placeholder="Expert guide included&#10;All meals included&#10;Equipment provided">{{ implode("\n", $trip->highlights ?? []) }}</textarea>
                    <small class="text-muted">Enter one highlight per line. These appear as bullet points on the trip card.</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    @if($trip->thumbnail)
                    <div class="mb-2" id="currentThumbnail">
                      <img src="{{ asset($trip->thumbnail) }}" alt="" class="rounded" style="max-height: 100px;">
                    </div>
                    @endif
                    <div class="mb-2 d-none" id="croppedThumbnailPreview">
                      <img src="" alt="Cropped preview" class="rounded" style="max-height: 100px;">
                      <small class="d-block text-success mt-1"><i class="ti tabler-check"></i> New thumbnail ready</small>
                    </div>
                    <input type="file" class="form-control" id="thumbnailInput" accept="image/*">
                    <input type="hidden" name="thumbnail_cropped" id="thumbnailCroppedData">
                    <small class="text-muted">Click to select and crop thumbnail image</small>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">
                <i class="ti tabler-check me-1"></i> Save Changes
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Departures Tab -->
      <div class="tab-pane fade" id="tab-departures">
        <!-- Add Departure Form -->
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">Add New Departure</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.departures.store', $trip) }}" method="POST" class="row g-3">
              @csrf
              <div class="col-md-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" required min="{{ date('Y-m-d') }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" required>
              </div>
              <div class="col-md-2">
                <label class="form-label">Capacity</label>
                <input type="number" class="form-control" name="capacity" value="20" min="1" required>
              </div>
              <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary d-block w-100">
                  <i class="ti tabler-plus"></i> Add
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Departures List -->
        @foreach($trip->departures as $departure)
        <div class="card mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <strong>{{ $departure->start_date->format('d M Y') }} - {{ $departure->end_date->format('d M Y') }}</strong>
              @if($departure->status === 'available')
              <span class="badge bg-success ms-2">Available</span>
              @elseif($departure->status === 'limited')
              <span class="badge bg-warning ms-2">Limited</span>
              @elseif($departure->status === 'sold_out')
              <span class="badge bg-danger ms-2">Sold Out</span>
              @else
              <span class="badge bg-secondary ms-2">Closed</span>
              @endif
              <span class="text-muted ms-2">{{ $departure->remaining_capacity }}/{{ $departure->capacity }} slots</span>
            </div>
            <div class="dropdown">
              <button class="btn btn-sm btn-icon" data-bs-toggle="dropdown"><i class="ti tabler-dots-vertical"></i></button>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCapacityModal-{{ $departure->id }}">
                  <i class="ti tabler-users me-1"></i> Edit Capacity
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('admin.departures.sold-out', $departure) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="dropdown-item"><i class="ti tabler-alert-circle me-1"></i> Mark Sold Out</button>
                </form>
                <form action="{{ route('admin.departures.close', $departure) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="dropdown-item"><i class="ti tabler-lock me-1"></i> Close</button>
                </form>
                <div class="dropdown-divider"></div>
                <form action="{{ route('admin.departures.destroy', $departure) }}" method="POST" onsubmit="return confirm('Delete this departure?');">
                  @csrf @method('DELETE')
                  <button class="dropdown-item text-danger"><i class="ti tabler-trash me-1"></i> Delete</button>
                </form>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Variants -->
            <h6>Pricing Variants</h6>
            <form action="{{ route('admin.variants.store', $departure) }}" method="POST" class="row g-2 mb-3">
              @csrf
              <div class="col-md-3">
                <input type="text" class="form-control form-control-sm" name="name" placeholder="Variant name (e.g., Meeting Point Jakarta)" required>
              </div>
              <div class="col-md-2">
                <input type="number" class="form-control form-control-sm" name="base_price" placeholder="Price (IDR)" min="1000" required>
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-sm btn-outline-primary w-100">Add</button>
              </div>
            </form>
            
            @if($departure->variants->count())
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Variant</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($departure->variants as $variant)
                <tr>
                  <td>{{ $variant->name }}</td>
                  <td>IDR {{ number_format($variant->base_price, 0, ',', '.') }}</td>
                  <td>
                    @if($variant->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                  </td>
                  <td class="text-end">
                    <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-icon text-danger"><i class="ti tabler-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <p class="text-muted small">No variants yet. Add at least one pricing variant.</p>
            @endif
            
            <hr class="my-3">
            
            <!-- Addons -->
            <h6>Additional Items (Addons)</h6>
            <form action="{{ route('admin.departure-addons.store', $departure) }}" method="POST" class="row g-2 mb-3">
              @csrf
              <div class="col-md-4">
                <select name="addon_id" class="form-select form-select-sm addon-select" required onchange="this.closest('form').querySelector('.addon-price').value = this.selectedOptions[0].dataset.price || ''">
                  <option value="">Select addon...</option>
                  @foreach(\App\Models\Addon::orderBy('name')->get() as $addon)
                  <option value="{{ $addon->id }}" data-price="{{ $addon->default_price }}">{{ $addon->name }} (IDR {{ number_format($addon->default_price, 0, ',', '.') }})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <input type="number" class="form-control form-control-sm addon-price" name="price" placeholder="Price" min="0" required>
              </div>
              <div class="col-md-2">
                <input type="number" class="form-control form-control-sm" name="max_qty" placeholder="Max Qty (opt)" min="1">
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-sm btn-outline-primary w-100">Add</button>
              </div>
            </form>
            
            @if($departure->addons->count())
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Addon</th>
                  <th>Price</th>
                  <th>Max Qty</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($departure->addons as $depAddon)
                <tr>
                  <td>{{ $depAddon->addon->name }}</td>
                  <td>IDR {{ number_format($depAddon->price, 0, ',', '.') }}</td>
                  <td>{{ $depAddon->max_qty ?? 'Unlimited' }}</td>
                  <td>
                    @if($depAddon->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                  </td>
                  <td class="text-end">
                    <form action="{{ route('admin.departure-addons.destroy', $depAddon) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove addon?');">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-icon text-danger"><i class="ti tabler-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <p class="text-muted small">No addons attached. Add optional items like porter, equipment rental, etc.</p>
            @endif
          </div>
        </div>
        @endforeach

        @if($trip->departures->isEmpty())
        <div class="card">
          <div class="card-body text-center py-5">
            <i class="ti tabler-calendar-off fs-1 text-muted"></i>
            <p class="mt-2 text-muted">No departures added yet</p>
          </div>
        </div>
        @endif
      </div>

      <!-- Content Tab -->
      <div class="tab-pane fade" id="tab-content">
        <div class="card">
          <div class="card-body">
            <!-- Content Sub-tabs -->
            <ul class="nav nav-pills mb-4" id="contentSubTabs">
              <li class="nav-item">
                <button class="nav-link active" data-content-tab="overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-content-tab="include_exclude">Include/Exclude</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-content-tab="itinerary">Itinerary</button>
              </li>
            </ul>

            <div id="currentTabName" class="text-muted small mb-2">Editing: <strong>Overview</strong></div>
            
            <!-- Quill Editor Container -->
            <div id="quillEditor" style="height: 400px; background: #fff;"></div>
            
            <div class="mt-3 d-flex justify-content-between align-items-center">
              <button type="button" id="saveContentBtn" class="btn btn-primary">
                <i class="ti tabler-check me-1"></i> Save Content
              </button>
              <span id="saveStatus" class="text-muted small"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Media Tab -->
      <div class="tab-pane fade" id="tab-media">
        <div class="row">
          <!-- Gallery Section -->
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Gallery Images</h5>
                <label for="galleryUpload" class="btn btn-primary btn-sm mb-0">
                  <i class="ti tabler-upload me-1"></i> Upload Images
                </label>
                <input type="file" id="galleryUpload" accept="image/*" multiple class="d-none">
              </div>
              <div class="card-body">
                <div id="galleryDropzone" class="border-2 border-dashed rounded p-4 text-center mb-4" style="border-style: dashed; border-color: #ccc;">
                  <i class="ti tabler-photo-plus fs-1 text-muted"></i>
                  <p class="mb-0 text-muted">Drag & drop images here or click Upload</p>
                </div>
                
                <div id="galleryGrid" class="row g-3">
                  @foreach($trip->media->where('media_type', 'gallery') as $image)
                  <div class="col-md-4 col-6 gallery-item" data-id="{{ $image->id }}">
                    <div class="card h-100 position-relative">
                      <img src="{{ asset($image->file_path) }}" class="card-img-top" alt="{{ $image->alt_text }}" style="height: 150px; object-fit: cover;">
                      @if($image->is_cover)
                      <span class="badge bg-primary position-absolute top-0 start-0 m-2">Cover</span>
                      @endif
                      <div class="card-body p-2">
                        <div class="d-flex justify-content-between">
                          <button type="button" class="btn btn-sm btn-icon btn-cover" data-id="{{ $image->id }}" title="Set as cover">
                            <i class="ti tabler-star{{ $image->is_cover ? '-filled' : '' }}"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-icon text-danger btn-delete-media" data-id="{{ $image->id }}" title="Delete">
                            <i class="ti tabler-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                @if($trip->media->where('media_type', 'gallery')->isEmpty())
                <p class="text-muted text-center" id="noGalleryMessage">No gallery images uploaded yet</p>
                @endif
              </div>
            </div>
          </div>
          
          <!-- Tracking Map Section -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="mb-0">Tracking Map</h5>
              </div>
              <div class="card-body">
                @php $trackingMap = $trip->media->where('media_type', 'tracking_map')->first(); @endphp
                
                @if($trackingMap)
                <div class="mb-3">
                  <img src="{{ asset($trackingMap->file_path) }}" class="img-fluid rounded" alt="Tracking Map">
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-media" data-id="{{ $trackingMap->id }}">
                  <i class="ti tabler-trash me-1"></i> Remove Map
                </button>
                @else
                <div id="trackingMapDropzone" class="border-2 border-dashed rounded p-4 text-center" style="border-style: dashed; border-color: #ccc;">
                  <i class="ti tabler-map-2 fs-1 text-muted"></i>
                  <p class="mb-0 text-muted small">Drag & drop tracking map image</p>
                </div>
                @endif
                
                <label for="trackingMapUpload" class="btn btn-outline-primary btn-sm w-100 mt-3 mb-0">
                  <i class="ti tabler-upload me-1"></i> {{ $trackingMap ? 'Replace Map' : 'Upload Map' }}
                </label>
                <input type="file" id="trackingMapUpload" accept="image/*" class="d-none">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<!-- Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">
@endsection

@section('page-script')
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tripId = {{ $trip->id }};
    const csrfToken = '{{ csrf_token() }}';
    
    // ============ QUILL CONTENT EDITOR ============
    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        placeholder: 'Write trip content here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    let currentTab = 'overview';
    const contentCache = {};

    // Load content for a tab
    async function loadContent(tabType) {
        // Completely clear the editor first
        const length = quill.getLength();
        if (length > 0) {
            quill.deleteText(0, length);
        }
        
        // Check cache first
        if (contentCache[tabType]) {
            const cached = contentCache[tabType];
            if (cached.ops && cached.ops.length > 0) {
                quill.setContents(cached);
            }
            return;
        }

        try {
            const response = await fetch(`/admin/trip-management/${tripId}/content/${tabType}`, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await response.json();
            
            // Get delta from response
            let delta = data.delta || (data.content && data.content.content_delta) || null;
            let htmlContent = data.html || (data.content && data.content.content_html) || null;
            
            // Use HTML as PRIMARY method - it preserves all formatting including bullet points
            if (htmlContent && htmlContent.trim() !== '') {
                quill.setText('');
                quill.clipboard.dangerouslyPasteHTML(htmlContent);
                contentCache[tabType] = quill.getContents();
                return;
            }
            
            // Fallback to delta if no HTML available
            if (delta && delta.ops && Array.isArray(delta.ops) && delta.ops.length > 0) {
                // Filter out ops with null/undefined insert values - these crash Quill
                const validOps = delta.ops.filter(op => {
                    if (op === null || op === undefined || typeof op !== 'object') return false;
                    if (op.insert === null || op.insert === undefined) return false;
                    return true;
                });
                
                if (validOps.length > 0) {
                    const cleanDelta = { ops: validOps };
                    quill.setContents(cleanDelta);
                    contentCache[tabType] = cleanDelta;
                    return;
                }
            }
            
            // No content - leave empty
            contentCache[tabType] = { ops: [{ insert: '\n' }] };
            
        } catch (error) {
            // On error, leave editor empty
            contentCache[tabType] = { ops: [{ insert: '\n' }] };
        }
    }

    // Content sub-tab click handler
    document.querySelectorAll('[data-content-tab]').forEach(btn => {
        btn.addEventListener('click', function() {
            // Save current content before switching
            contentCache[currentTab] = quill.getContents();
            
            // Update active state
            document.querySelectorAll('[data-content-tab]').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Load new tab content
            currentTab = this.dataset.contentTab;
            document.getElementById('currentTabName').innerHTML = 'Editing: <strong>' + this.textContent + '</strong>';
            loadContent(currentTab);
        });
    });

    // Save content button
    document.getElementById('saveContentBtn').addEventListener('click', async function() {
        const btn = this;
        const statusEl = document.getElementById('saveStatus');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="ti tabler-loader me-1 spin"></i> Saving...';
        
        try {
            const response = await fetch(`/admin/trip-management/${tripId}/content/${currentTab}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    content_delta: quill.getContents(),
                    content_html: quill.root.innerHTML
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                statusEl.textContent = 'Saved at ' + new Date().toLocaleTimeString();
                statusEl.className = 'text-success small';
                contentCache[currentTab] = quill.getContents();
            } else {
                throw new Error(data.message || 'Save failed');
            }
        } catch (error) {
            console.error('Save error:', error);
            statusEl.textContent = 'Error saving content';
            statusEl.className = 'text-danger small';
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="ti tabler-check me-1"></i> Save Content';
        }
    });

    // Load initial content when tab is shown
    const contentTabTrigger = document.querySelector('[data-bs-target="#tab-content"]');
    if (contentTabTrigger) {
        contentTabTrigger.addEventListener('shown.bs.tab', function() {
            loadContent(currentTab);
        });
        // Also load on click (fallback if shown.bs.tab doesn't trigger)
        contentTabTrigger.addEventListener('click', function() {
            setTimeout(() => loadContent(currentTab), 100);
        });
    }
    
    // Preload overview content on page load
    loadContent('overview');

    // ============ MEDIA GALLERY ============
    const galleryGrid = document.getElementById('galleryGrid');
    const galleryUpload = document.getElementById('galleryUpload');
    const trackingMapUpload = document.getElementById('trackingMapUpload');

    // Image resize function - resizes large images before upload
    function resizeImage(file, maxWidth = 1920, maxHeight = 1920, quality = 0.8) {
        return new Promise((resolve) => {
            // If not an image, return original file
            if (!file.type.startsWith('image/')) {
                resolve(file);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    // Check if resize is needed
                    if (img.width <= maxWidth && img.height <= maxHeight) {
                        // No resize needed, but still compress
                        const canvas = document.createElement('canvas');
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        
                        canvas.toBlob((blob) => {
                            resolve(new File([blob], file.name, { type: 'image/jpeg' }));
                        }, 'image/jpeg', quality);
                        return;
                    }

                    // Calculate new dimensions maintaining aspect ratio
                    let newWidth = img.width;
                    let newHeight = img.height;

                    if (newWidth > maxWidth) {
                        newHeight = (maxWidth / newWidth) * newHeight;
                        newWidth = maxWidth;
                    }
                    if (newHeight > maxHeight) {
                        newWidth = (maxHeight / newHeight) * newWidth;
                        newHeight = maxHeight;
                    }

                    // Create canvas and resize
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    // Convert to blob
                    canvas.toBlob((blob) => {
                        resolve(new File([blob], file.name, { type: 'image/jpeg' }));
                    }, 'image/jpeg', quality);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // Upload handler
    async function uploadMedia(file, mediaType, skipResize = false) {
        // Resize gallery images, but NOT tracking map
        let fileToUpload = file;
        if (!skipResize && mediaType === 'gallery') {
            fileToUpload = await resizeImage(file, 1920, 1920, 0.8);
        }

        const formData = new FormData();
        formData.append('file', fileToUpload);
        formData.append('media_type', mediaType);
        
        try {
            const response = await fetch(`/admin/trip-management/${tripId}/media`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                location.reload(); // Simple reload for now
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Upload error:', error);
            alert('Upload failed');
        }
    }

    // ============ IMAGE CROPPER ============
    let cropper = null;
    let pendingFiles = [];
    let currentFileIndex = 0;
    let currentMediaType = 'gallery';
    const cropperModal = new bootstrap.Modal(document.getElementById('imageCropperModal'));
    const cropperImage = document.getElementById('cropperImage');
    
    function showCropper(file, mediaType) {
        currentMediaType = mediaType;
        const reader = new FileReader();
        reader.onload = function(e) {
            cropperImage.src = e.target.result;
            cropperModal.show();
            
            // Destroy old cropper if exists
            if (cropper) {
                cropper.destroy();
            }
            
            // Initialize new cropper after modal is shown
            setTimeout(() => {
                cropper = new Cropper(cropperImage, {
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.9,
                    responsive: true,
                    background: false,
                });
            }, 300);
        };
        reader.readAsDataURL(file);
    }
    
    // Aspect ratio buttons
    document.querySelectorAll('.aspect-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.aspect-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const aspect = this.dataset.aspect;
            if (cropper) {
                if (aspect === 'free') {
                    cropper.setAspectRatio(NaN);
                } else {
                    const [w, h] = aspect.split(':').map(Number);
                    cropper.setAspectRatio(w / h);
                }
            }
        });
    });
    
    // Crop and upload button
    document.getElementById('cropAndUploadBtn').addEventListener('click', async function() {
        if (!cropper) return;
        
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Uploading...';
        
        // Get cropped canvas
        const canvas = cropper.getCroppedCanvas({
            maxWidth: 1920,
            maxHeight: 1920,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });
        
        // Convert to blob and upload
        canvas.toBlob(async (blob) => {
            const file = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });
            await uploadMedia(file, currentMediaType, true); // skip resize since already cropped
            
            cropper.destroy();
            cropper = null;
            cropperModal.hide();
            btn.disabled = false;
            btn.innerHTML = '<i class="ti tabler-crop me-1"></i> Crop & Upload';
            
            // Process next file if batch upload
            currentFileIndex++;
            if (currentFileIndex < pendingFiles.length) {
                showCropper(pendingFiles[currentFileIndex], currentMediaType);
            } else {
                pendingFiles = [];
                currentFileIndex = 0;
            }
        }, 'image/jpeg', 0.85);
    });
    
    // Handle modal close - clear pending files
    document.getElementById('imageCropperModal').addEventListener('hidden.bs.modal', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        pendingFiles = [];
        currentFileIndex = 0;
    });

    // Gallery upload (with cropper)
    galleryUpload.addEventListener('change', function(e) {
        pendingFiles = Array.from(e.target.files);
        currentFileIndex = 0;
        if (pendingFiles.length > 0) {
            showCropper(pendingFiles[0], 'gallery');
        }
        e.target.value = ''; // clear input
    });
    
    // Thumbnail upload (with cropper)
    const thumbnailInput = document.getElementById('thumbnailInput');
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            if (e.target.files[0]) {
                pendingFiles = [e.target.files[0]];
                currentFileIndex = 0;
                currentMediaType = 'thumbnail';
                showCropper(e.target.files[0], 'thumbnail');
            }
            e.target.value = ''; // clear input
        });
    }
    
    // Special handling for thumbnail - store in hidden field instead of uploading
    const originalCropHandler = document.getElementById('cropAndUploadBtn').onclick;
    document.getElementById('cropAndUploadBtn').addEventListener('click', function(e) {
        if (currentMediaType === 'thumbnail' && cropper) {
            e.stopImmediatePropagation();
            
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Processing...';
            
            const canvas = cropper.getCroppedCanvas({
                maxWidth: 1920,
                maxHeight: 1920,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            });
            
            // Store base64 in hidden field
            const base64 = canvas.toDataURL('image/jpeg', 0.92);
            document.getElementById('thumbnailCroppedData').value = base64;
            
            // Show preview
            const preview = document.getElementById('croppedThumbnailPreview');
            preview.querySelector('img').src = base64;
            preview.classList.remove('d-none');
            
            // Hide current thumbnail
            const current = document.getElementById('currentThumbnail');
            if (current) current.classList.add('d-none');
            
            cropper.destroy();
            cropper = null;
            cropperModal.hide();
            btn.disabled = false;
            btn.innerHTML = '<i class="ti tabler-crop me-1"></i> Crop & Upload';
            
            pendingFiles = [];
            currentFileIndex = 0;
        }
    }, true); // use capture to run first

    // Tracking map upload (NO resize)
    trackingMapUpload.addEventListener('change', function(e) {
        if (e.target.files[0]) {
            uploadMedia(e.target.files[0], 'tracking_map', true); // true = skip resize
        }
    });

    // Delete media
    document.querySelectorAll('.btn-delete-media').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Delete this image?')) return;
            
            const mediaId = this.dataset.id;
            
            try {
                const response = await fetch(`/admin/trip-media/${mediaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error('Delete error:', error);
            }
        });
    });

    // Set as cover
    document.querySelectorAll('.btn-cover').forEach(btn => {
        btn.addEventListener('click', async function() {
            const mediaId = this.dataset.id;
            
            try {
                const response = await fetch(`/admin/trip-media/${mediaId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ is_cover: true })
                });
                
                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error('Cover error:', error);
            }
        });
    });

    // Drag and drop for gallery dropzone
    const galleryDropzone = document.getElementById('galleryDropzone');
    if (galleryDropzone) {
        galleryDropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('bg-light');
        });
        
        galleryDropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('bg-light');
        });
        
        galleryDropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-light');
            
            Array.from(e.dataTransfer.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    uploadMedia(file, 'gallery');
                }
            });
        });
    }
});
</script>
<style>
.spin { animation: spin 1s linear infinite; }
@keyframes spin { 100% { transform: rotate(360deg); } }
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
          <label class="form-label">Aspect Ratio:</label>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary btn-sm aspect-btn active" data-aspect="free">Free</button>
            <button type="button" class="btn btn-outline-primary btn-sm aspect-btn" data-aspect="16:9">16:9</button>
            <button type="button" class="btn btn-outline-primary btn-sm aspect-btn" data-aspect="4:3">4:3</button>
            <button type="button" class="btn btn-outline-primary btn-sm aspect-btn" data-aspect="1:1">1:1</button>
          </div>
        </div>
        <div style="max-height: 400px; overflow: hidden;">
          <img id="cropperImage" src="" style="max-width: 100%;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="cropAndUploadBtn">
          <i class="ti tabler-crop me-1"></i> Crop & Upload
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Capacity Modals (must be at end of page for proper z-index) -->
@foreach($trip->departures as $departure)
<div class="modal fade" id="editCapacityModal-{{ $departure->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Capacity & Addons</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.departures.update-capacity', $departure) }}" method="POST">
        @csrf
        <div class="modal-body">
          <p class="text-muted small mb-3">
            <strong>Departure:</strong> {{ $departure->start_date->format('d M Y') }} - {{ $departure->end_date->format('d M Y') }}
          </p>
          
          <h6 class="mb-2">Departure Capacity</h6>
          <div class="row mb-4">
            <div class="col-6">
              <label class="form-label">Total Slots</label>
              <input type="number" name="capacity" class="form-control" value="{{ $departure->capacity }}" min="1" required>
            </div>
            <div class="col-6">
              <label class="form-label">Currently Booked</label>
              <input type="text" class="form-control" value="{{ $departure->booked_count }}" disabled>
            </div>
          </div>
          
          @if($departure->addons->count() > 0)
          <h6 class="mb-2">Addon Limits</h6>
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Addon</th>
                <th>Max Qty</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($departure->addons as $depAddon)
              <tr>
                <td>{{ $depAddon->addon->name }}</td>
                <td>
                  <input type="number" name="addon_max_qty[{{ $depAddon->id }}]" class="form-control form-control-sm" value="{{ $depAddon->max_qty }}" min="1" placeholder="Unlimited" style="width: 100px;">
                </td>
                <td>
                  <span class="badge bg-{{ $depAddon->is_active ? 'success' : 'secondary' }}">
                    {{ $depAddon->is_active ? 'Active' : 'Inactive' }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection

