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
              <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g., Mount Rinjani 4D3N Summit">
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
              <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination') }}" placeholder="e.g., Lombok, Indonesia">
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
              <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
              <small class="text-muted">Recommended: 16:9 ratio, max 5MB</small>
            </div>
          </div>
        </div>

        <hr class="my-4">
        <h6 class="text-muted mb-3">SEO Settings (Optional)</h6>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="meta_title">Meta Title</label>
              <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="meta_description">Meta Description</label>
              <textarea class="form-control" id="meta_description" name="meta_description" rows="1">{{ old('meta_description') }}</textarea>
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
@endsection
