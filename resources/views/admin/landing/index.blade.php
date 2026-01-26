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
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-features" aria-controls="navs-features" aria-selected="true">
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
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-quote" aria-controls="navs-quote" aria-selected="false">
              <i class="ti tabler-quote me-1"></i> Quote
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-gallery" aria-controls="navs-gallery" aria-selected="false">
              <i class="ti tabler-photo me-1"></i> Gallery
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
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-terms" aria-controls="navs-terms" aria-selected="false">
              <i class="ti tabler-file-text me-1"></i> Terms & Conditions
            </button>
          </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-global" aria-controls="navs-global" aria-selected="false">
              <i class="ti tabler-settings me-1"></i> Global
            </button>
          </li>
        </ul>
        <div class="tab-content">
          
          <!-- Features (Why Us) Tab -->
          <div class="tab-pane fade show active" id="navs-features" role="tabpanel">
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
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Select Popular Trips (Max 6)</h5>
                    <small class="text-muted">Select open trips to display on the landing page.</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.landing.popular-trips.update') }}" method="POST">
                        @csrf
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">Select</th>
                                        <th>Trip Title</th>
                                        <th>Category</th>
                                        <th>Price (From)</th>
                                        <th style="width: 100px;">Order</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($openTrips as $trip)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="popular_trips[]" value="{{ $trip->id }}" id="trip_{{ $trip->id }}" {{ $trip->is_popular ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-check-label" for="trip_{{ $trip->id }}">
                                                <strong>{{ $trip->title }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $trip->duration }}</small>
                                            </label>
                                        </td>
                                        <td><span class="badge bg-label-primary">{{ $trip->category }}</span></td>
                                        <td>
                                            @if($trip->from_price)
                                                IDR {{ number_format($trip->from_price, 0, ',', '.') }}
                                            @else
                                                <span class="text-muted">Contact us</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="popular_orders[{{ $trip->id }}]" value="{{ $trip->popular_order }}" min="0">
                                        </td>
                                        <td>
                                            @if($trip->status === 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($trip->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Popular Trips</button>
                        </div>
                    </form>
                </div>
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

           <!-- Quote Tab -->
          <div class="tab-pane fade" id="navs-quote" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <div class="col-12 mb-3">
                      <h5 class="fw-semibold">Quote Section</h5>
                      <p class="text-muted">Manage the inspirational quote section on the homepage</p>
                      <hr>
                  </div>
                  
                  <!-- Quote Text -->
                  <div class="col-md-12 mb-3">
                      <label class="form-label" for="quote_text">Quote Text</label>
                      <textarea class="form-control" name="quote_text" id="quote_text" rows="4" placeholder="Enter the inspirational quote...">{{ $settings->where('key', 'quote_text')->first()->value ?? '' }}</textarea>
                      <div class="form-text">The inspirational quote that will be displayed on the homepage</div>
                  </div>
                  
                  <!-- Background Image -->
                  <div class="col-md-12 mb-3">
                      <label class="form-label" for="quote_background_image">Background Image (16:9 Ratio)</label>
                      @php $quoteBg = $settings->where('key', 'quote_background_image')->first()->value ?? ''; @endphp
                      @if($quoteBg)
                         <div class="mb-2">
                             <img src="{{ asset($quoteBg) }}" alt="Quote Background Preview" class="d-block rounded" style="max-height: 200px; width: auto;">
                         </div>
                      @endif
                      <input type="file" class="form-control crop-image" name="quote_background_image" id="quote_background_image" accept="image/*" data-ratio="16/9" data-no-resize="true">
                      <div class="form-text">Upload a landscape image (16:9 ratio recommended). The image will be used as background for the quote section.</div>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="ti tabler-check me-1"></i> Save Changes
              </button>
              <a href="{{ route('landing') }}#quote" target="_blank" class="btn btn-outline-secondary ms-2">
                <i class="ti tabler-external-link me-1"></i> Preview on Homepage
              </a>
             </form>
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
          
           <!-- Terms & Conditions Tab -->
          <div class="tab-pane fade" id="navs-terms" role="tabpanel">
             <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data" id="termsForm">
              @csrf
              <div class="row">
                  <div class="col-12 mb-3">
                      <h5 class="fw-semibold">Syarat & Ketentuan</h5>
                      <p class="text-muted">Upload gambar-gambar Terms & Conditions. Gambar akan ditampilkan berurutan di halaman /terms-conditions.</p>
                      <hr>
                  </div>
                  
                  <!-- Existing Images Preview -->
                  <div class="col-12 mb-4">
                      <label class="form-label fw-semibold">Gambar T&C yang Sudah Diupload</label>
                      @php 
                          $tcImages = $settings->where('key', 'terms_conditions_images')->first();
                          $tcImagesArray = $tcImages && $tcImages->value ? json_decode($tcImages->value, true) : [];
                      @endphp
                      
                      @if(count($tcImagesArray) > 0)
                      <div class="row" id="tcImagesPreview">
                          @foreach($tcImagesArray as $index => $img)
                          <div class="col-md-4 col-lg-3 mb-3" id="tc-img-{{ $index }}">
                              <div class="card h-100 border">
                                  @if(is_string($img))
                                    <img src="{{ asset($img) }}" class="card-img-top" alt="T&C Image" style="height: 150px; object-fit: cover;">
                                  @elseif(is_array($img) && count($img) > 0 && is_string($img[0]))
                                    <img src="{{ asset($img[0]) }}" class="card-img-top" alt="T&C Image" style="height: 150px; object-fit: cover;">
                                    {{-- Debug: Rendered from array --}}
                                  @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                        <small class="text-danger">Invalid Image Format</small>
                                    </div>
                                  @endif
                                  <div class="card-body p-2">
                                      <div class="d-flex justify-content-between align-items-center">
                                          <small class="text-muted">Image {{ $index + 1 }}</small>
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="delete_tc_images_indices[]" value="{{ $index }}" id="del-{{ $index }}">
                                              <label class="form-check-label text-danger" for="del-{{ $index }}">
                                                  <i class="ti tabler-trash"></i> Hapus
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                      @else
                      <div class="alert alert-info">
                          <i class="ti tabler-info-circle me-1"></i> Belum ada gambar T&C yang diupload.
                      </div>
                      @endif
                  </div>

                  <!-- Upload New Images -->
                  <div class="col-12 mb-3">
                      <label class="form-label fw-semibold">Tambah Gambar Baru</label>
                      <input type="file" class="form-control" name="terms_conditions_images[]" id="terms_conditions_images" accept="image/*" multiple>
                      <div class="form-text">Pilih satu atau beberapa gambar sekaligus. Format: JPG, PNG, JPEG. Maksimal 10MB per file.</div>
                  </div>

                  <!-- Preview New Images -->
                  <div class="col-12 mb-3">
                      <div class="row" id="newImagesPreview"></div>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary" id="saveTermsBtn">
                <i class="ti tabler-check me-1"></i> Save Changes
              </button>
              <a href="{{ route('terms-conditions') }}" target="_blank" class="btn btn-outline-secondary ms-2">
                <i class="ti tabler-external-link me-1"></i> Preview Page
              </a>
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
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

@vite(['resources/js/admin-preview-handler.js'])
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewFrame = document.getElementById('previewFrame');
    const previewModal = document.getElementById('previewModal');

    // ============ TERMS & CONDITIONS - PREVIEW NEW IMAGES ============
    const tcImageInput = document.getElementById('terms_conditions_images');
    const newImagesPreview = document.getElementById('newImagesPreview');
    
    if (tcImageInput && newImagesPreview) {
        tcImageInput.addEventListener('change', function(e) {
            newImagesPreview.innerHTML = '';
            const files = e.target.files;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';
                    col.innerHTML = `
                        <div class="card border">
                            <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                            <div class="card-body p-2">
                                <small class="text-muted">${file.name}</small>
                            </div>
                        </div>
                    `;
                    newImagesPreview.appendChild(col);
                };
                
                reader.readAsDataURL(file);
            }
        });
    }

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
