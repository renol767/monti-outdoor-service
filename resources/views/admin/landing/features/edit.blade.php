@extends('layouts/layoutMaster')

@section('title', 'Edit Feature')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Features /</span> Edit Feature</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.features.update', $feature->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label class="form-label">Title</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <input type="text" class="form-control" name="title[id]" value="{{ $feature->getTranslation('title', 'id', false) }}" placeholder="Indonesia" required />
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <input type="text" class="form-control" name="title[en]" value="{{ $feature->getTranslation('title', 'en', false) }}" placeholder="English" />
              </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Description</label>
              <div class="input-group mb-2">
                <span class="input-group-text">ID</span>
                <textarea class="form-control" name="description[id]" rows="3" placeholder="Indonesia" required>{{ $feature->getTranslation('description', 'id', false) }}</textarea>
              </div>
              <div class="input-group">
                <span class="input-group-text">EN</span>
                <textarea class="form-control" name="description[en]" rows="3" placeholder="English">{{ $feature->getTranslation('description', 'en', false) }}</textarea>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="icon">Icon (SVG Code)</label>
              <textarea class="form-control font-monospace" id="icon" name="icon" rows="5" required>{{ $feature->icon }}</textarea>
              <div class="form-text">Paste the SVG &lt;svg&gt;...&lt;/svg&gt; code here.</div>
            </div>
            
             <div class="mb-3">
              <label class="form-label" for="order">Orden (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="{{ $feature->order }}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update Feature</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
