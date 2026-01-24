@extends('layouts/layoutMaster')

@section('title', 'Edit Service')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Services /</span> Edit Service</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label class="form-label">Title</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <input type="text" class="form-control" name="title[id]" value="{{ $service->getTranslation('title', 'id', false) }}" placeholder="Indonesia" required />
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <input type="text" class="form-control" name="title[en]" value="{{ $service->getTranslation('title', 'en', false) }}" placeholder="English" />
              </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Description</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <textarea class="form-control" name="description[id]" rows="3" placeholder="Indonesia" required>{{ $service->getTranslation('description', 'id', false) }}</textarea>
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <textarea class="form-control" name="description[en]" rows="3" placeholder="English">{{ $service->getTranslation('description', 'en', false) }}</textarea>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="icon">Icon (SVG Code)</label>
              <textarea class="form-control font-monospace" id="icon" name="icon" rows="5" required>{{ $service->icon }}</textarea>
              <div class="form-text">Paste the SVG &lt;svg&gt;...&lt;/svg&gt; code here.</div>
            </div>

             <div class="mb-3">
              <label class="form-label" for="icon_bg_class">Icon Background Class</label>
              <select class="form-select" id="icon_bg_class" name="icon_bg_class">
                  <option value="bg-orange" {{ $service->icon_bg_class == 'bg-orange' ? 'selected' : '' }}>Orange</option>
                  <option value="bg-green" {{ $service->icon_bg_class == 'bg-green' ? 'selected' : '' }}>Green</option>
                  <option value="bg-blue" {{ $service->icon_bg_class == 'bg-blue' ? 'selected' : '' }}>Blue</option>
                  <option value="bg-primary" {{ $service->icon_bg_class == 'bg-primary' ? 'selected' : '' }}>Primary</option>
                  <option value="bg-danger" {{ $service->icon_bg_class == 'bg-danger' ? 'selected' : '' }}>Red</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Features (One per line)</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <textarea class="form-control" name="features[id]" rows="5" placeholder="Indonesia">{{ implode("\n", $service->getTranslation('features', 'id', false) ?? []) }}</textarea>
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <textarea class="form-control" name="features[en]" rows="5" placeholder="English">{{ implode("\n", $service->getTranslation('features', 'en', false) ?? []) }}</textarea>
              </div>
            </div>
            
             <div class="mb-3">
              <label class="form-label" for="order">Orden (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="{{ $service->order }}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
