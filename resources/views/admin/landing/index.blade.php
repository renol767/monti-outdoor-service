@extends('layouts/layoutMaster')

@section('title', 'Landing Page Customization')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Admin /</span> Landing Page Customization</h4>
    <button type="button" class="btn btn-primary" id="btnPreview" data-bs-toggle="modal" data-bs-target="#previewModal">
        <i class="ti tabler-eye me-1"></i> Live Preview
    </button>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="row">
    <div class="col-xl-12">
      <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs mb-3" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-hero" aria-controls="navs-hero" aria-selected="true">
              <i class="ti tabler-home me-1"></i> Hero
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-features" aria-controls="navs-features" aria-selected="false">
              <i class="ti tabler-bulb me-1"></i> Why Us
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-trips" aria-controls="navs-trips" aria-selected="false">
              <i class="ti tabler-map-pin me-1"></i> Trips
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-services" aria-controls="navs-services" aria-selected="false">
               <i class="ti tabler-list me-1"></i> Services
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-gallery" aria-controls="navs-gallery" aria-selected="false">
              <i class="ti tabler-photo me-1"></i> Gallery
            </button>
          </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-testimonials" aria-controls="navs-testimonials" aria-selected="false">
              <i class="ti tabler-star me-1"></i> Testimonials
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-about" aria-controls="navs-about" aria-selected="false">
              <i class="ti tabler-info-circle me-1"></i> About
            </button>
          </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cta" aria-controls="navs-cta" aria-selected="false">
              <i class="ti tabler-pointer me-1"></i> CTA
            </button>
          </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-contact" aria-controls="navs-contact" aria-selected="false">
              <i class="ti tabler-phone me-1"></i> Contact
            </button>
          </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-global" aria-controls="navs-global" aria-selected="false">
              <i class="ti tabler-settings me-1"></i> Global
            </button>
          </li>
        </ul>
        <div class="tab-content">
          
          <!-- Hero Tab -->
          <div class="tab-pane fade show active" id="navs-hero" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  @foreach($settings as $setting)
                     @if(\Illuminate\Support\Str::startsWith($setting->key, 'hero_') && !\Illuminate\Support\Str::contains($setting->key, 'cta'))
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="{{ $setting->key }}">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                      @if($setting->type == 'image')
                         @if($setting->value)
                            <div class="mb-2">
                                <img src="{{ asset($setting->value) }}" alt="Preview" class="d-block rounded" style="max-height: 100px; width: auto;">
                            </div>
                         @endif
                         <input type="file" class="form-control crop-image" name="{{ $setting->key }}" id="{{ $setting->key }}" accept="image/*" data-ratio="16/9">
                      @else
                        <input type="text" class="form-control" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}">
                      @endif
                    </div>
                     @endif
                  @endforeach
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
             </form>
          </div>

          <!-- Features (Why Us) Tab -->
          <div class="tab-pane fade" id="navs-features" role="tabpanel">
            <div class="card mb-3">
                <div class="card-body">
                     <form action="{{ route('admin.landing.settings.update') }}" method="POST">
                        @csrf
                         <div class="row">
                            @foreach($settings as $setting)
                                @if(\Illuminate\Support\Str::startsWith($setting->key, 'why_choose_'))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                     <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                </div>
                                @endif
                            @endforeach
                         </div>
                         <button type="submit" class="btn btn-primary">Save Section Title/Desc</button>
                     </form>
                </div>
            </div>
             <hr>
            <div class="mb-3">
                 <a href="{{ route('admin.features.create') }}" class="btn btn-primary">
                    <i class="ti tabler-plus me-1"></i> Add New Feature Card
                 </a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($features as $feature)
                  <tr>
                    <td>{{ $feature->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($feature->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.features.edit', $feature->id) }}" class="btn btn-sm btn-icon item-edit"><i class="ti tabler-edit"></i></a>
                        <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feature?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-icon item-trash"><i class="ti tabler-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
          <!-- Trips Tab -->
          <div class="tab-pane fade" id="navs-trips" role="tabpanel">
              <div class="card mb-3">
                <div class="card-body">
                     <form action="{{ route('admin.landing.settings.update') }}" method="POST">
                        @csrf
                         <div class="row">
                            @foreach($settings as $setting)
                                @if(\Illuminate\Support\Str::startsWith($setting->key, 'trips_'))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                     <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                </div>
                                @endif
                            @endforeach
                         </div>
                         <button type="submit" class="btn btn-primary">Save Section Title/Desc</button>
                     </form>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                 <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
                    <i class="ti tabler-plus me-1"></i> Add New Trip
                 </a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Duration</th>

                    <th>Category</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @foreach($trips as $trip)
                  <tr>
                    <td><strong>{{ $trip->title }}</strong></td>
                    <td>{{ $trip->price }}</td>
                    <td>{{ $trip->duration }}</td>
                    <td>

                    </td>
                    <td><span class="badge bg-label-primary">{{ $trip->category }}</span></td>
                    <td>
                        <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-sm btn-icon item-edit"><i class="ti tabler-edit"></i></a>
                        <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this trip?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-icon item-trash"><i class="ti tabler-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
           <!-- Services Tab -->
          <div class="tab-pane fade" id="navs-services" role="tabpanel">
             <div class="card mb-3">
                <div class="card-body">
                     <form action="{{ route('admin.landing.settings.update') }}" method="POST">
                        @csrf
                         <div class="row">
                            @foreach($settings as $setting)
                                @if(\Illuminate\Support\Str::startsWith($setting->key, 'services_'))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                     <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                </div>
                                @endif
                            @endforeach
                         </div>
                         <button type="submit" class="btn btn-primary">Save Section Title/Desc</button>
                     </form>
                </div>
            </div>
            <hr>
             <div class="mb-3">
                 <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="ti tabler-plus me-1"></i> Add New Service
                 </a>
            </div>
             <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($services as $service)
                  <tr>
                    <td>{{ $service->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($service->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-icon item-edit"><i class="ti tabler-edit"></i></a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-icon item-trash"><i class="ti tabler-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             </div>
          </div>

           <!-- Gallery Tab -->
          <div class="tab-pane fade" id="navs-gallery" role="tabpanel">
             <div class="card mb-3">
                <div class="card-body">
                     <form action="{{ route('admin.landing.settings.update') }}" method="POST">
                        @csrf
                         <div class="row">
                            @foreach($settings as $setting)
                                @if(\Illuminate\Support\Str::startsWith($setting->key, 'gallery_'))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                     <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                </div>
                                @endif
                            @endforeach
                         </div>
                         <button type="submit" class="btn btn-primary">Save Section Title/Desc</button>
                     </form>
                </div>
            </div>
            <hr>
             <div class="mb-3">
                 <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                    <i class="ti tabler-plus me-1"></i> Add New Image
                 </a>
            </div>
             <div class="row">
                  @foreach($gallery as $img)
                  <div class="col-md-3 mb-3">
                      <div class="card h-100">
                          <img src="{{ asset($img->image) }}" class="card-img-top" alt="...">
                          <div class="card-body">
                              <p class="card-text">{{ $img->caption }}</p>
                              <div class="d-flex justify-content-between mt-2">
                                  <a href="{{ route('admin.gallery.edit', $img->id) }}" class="btn btn-sm btn-outline-primary"><i class="ti tabler-edit"></i> Edit</a>
                                  
                                  <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="ti tabler-trash"></i></button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
                  @if($gallery->isEmpty())
                    <div class="col-12 text-center py-5">
                       <p class="text-muted">No images found. Add some!</p>
                    </div>
                  @endif
             </div>
          </div>
          
           <!-- Testimonials Tab -->
          <div class="tab-pane fade" id="navs-testimonials" role="tabpanel">
             <div class="card mb-3">
                <div class="card-body">
                     <form action="{{ route('admin.landing.settings.update') }}" method="POST">
                        @csrf
                         <div class="row">
                            @foreach($settings as $setting)
                                @if(\Illuminate\Support\Str::startsWith($setting->key, 'testimonials_'))
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                     <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                </div>
                                @endif
                            @endforeach
                         </div>
                         <button type="submit" class="btn btn-primary">Save Section Title/Desc</button>
                     </form>
                </div>
            </div>
            <hr>
             <div class="mb-3">
                 <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                    <i class="ti tabler-plus me-1"></i> Add New Testimonial
                 </a>
            </div>
             <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Content</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($testimonials as $testimonial)
                  <tr>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ $testimonial->role }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($testimonial->content, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-icon item-edit"><i class="ti tabler-edit"></i></a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-icon item-trash"><i class="ti tabler-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             </div>
          </div>
          
           <!-- About Tab -->
          <div class="tab-pane fade" id="navs-about" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  @foreach($settings as $setting)
                     @if(\Illuminate\Support\Str::startsWith($setting->key, 'about_'))
                    <div class="col-md-12 mb-3">
                      <label class="form-label" for="{{ $setting->key }}">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                      @if($setting->type == 'image')
                         @if($setting->value)
                            <div class="mb-2">
                                <img src="{{ asset($setting->value) }}" alt="Preview" class="d-block rounded" style="max-height: 200px; width: auto;">
                            </div>
                         @endif
                         <input type="file" class="form-control crop-image" name="{{ $setting->key }}" id="{{ $setting->key }}" accept="image/*" data-ratio="4/3">
                      @elseif($setting->type == 'textarea' || $setting->key == 'about_text') <!-- Force textarea for about text even if type is not strictly set -->
                        <textarea class="form-control" name="{{ $setting->key }}" id="{{ $setting->key }}" rows="8">{{ $setting->value }}</textarea>
                      @else
                        <input type="text" class="form-control" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}">
                      @endif
                    </div>
                     @endif
                  @endforeach
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
             </form>
          </div>
          
           <!-- CTA Tab -->
          <div class="tab-pane fade" id="navs-cta" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST">
              @csrf
              <div class="row">
                  @foreach($settings as $setting)
                     @if(\Illuminate\Support\Str::startsWith($setting->key, 'cta_'))
                    <div class="col-md-12 mb-3">
                      <label class="form-label" for="{{ $setting->key }}">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                        <input type="text" class="form-control" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}">
                    </div>
                     @endif
                  @endforeach
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
             </form>
          </div>

           <!-- Contact Tab -->
          <div class="tab-pane fade" id="navs-contact" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST">
              @csrf
              <div class="row">
                  @foreach($settings as $setting)
                     @if(\Illuminate\Support\Str::startsWith($setting->key, 'contact_'))
                    <div class="col-md-12 mb-3">
                      <label class="form-label" for="{{ $setting->key }}">{{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                        <input type="text" class="form-control" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}">
                    </div>
                     @endif
                  @endforeach
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
             </form>
          </div>
          
           <!-- Global Tab -->
          <div class="tab-pane fade" id="navs-global" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <!-- Logos Section -->
                  <div class="col-12 mb-3">
                      <h5 class="fw-semibold">Branding</h5>
                      <hr>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label" for="global_logo">Header Logo</label>
                       @php $logo = $settings->where('key', 'global_logo')->first()->value ?? ''; @endphp
                       @if($logo)
                          <div class="mb-2">
                              <img src="{{ asset($logo) }}" alt="Logo Preview" class="d-block rounded" style="max-height: 80px; width: auto; background: #eee; padding: 5px;">
                          </div>
                       @endif
                       <input type="file" class="form-control crop-image" name="global_logo" id="global_logo" accept="image/*" data-ratio="1">
                  </div>
                   <div class="col-md-6 mb-3">
                      <label class="form-label" for="global_footer_logo">Footer Logo</label>
                      @php $footerLogo = $settings->where('key', 'global_footer_logo')->first()->value ?? ''; @endphp
                       @if($footerLogo)
                          <div class="mb-2">
                              <img src="{{ asset($footerLogo) }}" alt="Footer Logo Preview" class="d-block rounded" style="max-height: 80px; width: auto; background: #eee; padding: 5px;">
                          </div>
                       @endif
                       <input type="file" class="form-control crop-image" name="global_footer_logo" id="global_footer_logo" accept="image/*" data-ratio="1">
                  </div>

                   <div class="col-md-12 mb-3">
                      <label class="form-label" for="global_footer_text">Footer Description Text</label>
                      <textarea class="form-control" name="global_footer_text" id="global_footer_text" rows="3">{{ $settings->where('key', 'global_footer_text')->first()->value ?? '' }}</textarea>
                  </div>

                  <!-- Social Media Section -->
                  <div class="col-12 mt-3 mb-3">
                      <h5 class="fw-semibold">Social Media Links</h5>
                      <hr>
                  </div>
                   <div class="col-md-6 mb-3">
                      <label class="form-label" for="social_facebook">Facebook URL</label>
                       <input type="text" class="form-control" name="social_facebook" id="social_facebook" value="{{ $settings->where('key', 'social_facebook')->first()->value ?? '' }}" placeholder="https://facebook.com/...">
                  </div>
                   <div class="col-md-6 mb-3">
                      <label class="form-label" for="social_instagram">Instagram URL</label>
                       <input type="text" class="form-control" name="social_instagram" id="social_instagram" value="{{ $settings->where('key', 'social_instagram')->first()->value ?? '' }}" placeholder="https://instagram.com/...">
                  </div>
                   <div class="col-md-6 mb-3">
                      <label class="form-label" for="social_twitter">Twitter/X URL</label>
                       <input type="text" class="form-control" name="social_twitter" id="social_twitter" value="{{ $settings->where('key', 'social_twitter')->first()->value ?? '' }}" placeholder="https://twitter.com/...">
                  </div>
                   <div class="col-md-6 mb-3">
                      <label class="form-label" for="social_tiktok">TikTok URL</label>
                       <input type="text" class="form-control" name="social_tiktok" id="social_tiktok" value="{{ $settings->where('key', 'social_tiktok')->first()->value ?? '' }}" placeholder="https://tiktok.com/@...">
                  </div>
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
             </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFullTitle">Live Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0" style="background: #f5f5f5;">
         <iframe id="previewFrame" src="{{ url('/') }}" style="width: 100%; height: 100%; border: none;"></iframe>
      </div>
    </div>
  </div>
</div>

@section('page-script')
@vite(['resources/js/admin-preview-handler.js'])
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewFrame = document.getElementById('previewFrame');
    const previewModal = document.getElementById('previewModal');

    // Function to gather all form data and send to iframe
    function updatePreview() {
        const settings = {};
        
        // Gather all inputs from all tabs
        const inputs = document.querySelectorAll('input[name], textarea[name], select[name]');
        
        inputs.forEach(input => {
            const name = input.name;
            let value = input.value;

            // Handle Files (Images)
            if (input.type === 'file' && input.files.length > 0) {
                const file = input.files[0];
                value = URL.createObjectURL(file);
            }
            // If Text Area (Rich Text) - for now just raw value
            // If checkbox
            if(input.type === 'checkbox') {
                 value = input.checked ? 1 : 0;
            }

            settings[name] = value;
        });

        // Post message to iframe
        if (previewFrame.contentWindow) {
            previewFrame.contentWindow.postMessage({
                type: 'preview_update',
                settings: settings
            }, '*');
        }
    }

    // Listen for changes on any input
    document.addEventListener('input', function(e) {
        // Debounce could be good here, but for now instant
         updatePreview();
    });
    
    document.addEventListener('change', function(e) {
         updatePreview();
    });

    // Also update when modal opens to ensure current state is reflected
    previewModal.addEventListener('shown.bs.modal', function () {
        updatePreview();
    });
    
     // Also update when iframe loads (initial load)
    previewFrame.onload = function() {
        updatePreview();
    };
});
</script>
@endsection

@endsection
