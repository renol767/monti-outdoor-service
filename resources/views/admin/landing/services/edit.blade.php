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
              <label class="form-label" for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ $service->title }}" required />
            </div>
            
            <div class="mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required>{{ $service->description }}</textarea>
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
              <label class="form-label" for="features">Features (One per line)</label>
              <textarea class="form-control" id="features" name="features" rows="5">{{ implode("\n", $service->features ?? []) }}</textarea>
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
