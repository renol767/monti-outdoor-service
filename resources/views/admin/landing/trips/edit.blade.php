@extends('layouts/layoutMaster')

@section('title', 'Edit Trip')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Trips /</span> Edit Trip</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label class="form-label" for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ $trip->title }}" required />
            </div>
            
            <div class="mb-3">
              <label class="form-label" for="category">Category</label>
              <select class="form-select" id="category" name="category" required>
                  <option value="Mountain Trip" {{ $trip->category == 'Mountain Trip' ? 'selected' : '' }}>Mountain Trip</option>
                  <option value="Outdoor Activity" {{ $trip->category == 'Outdoor Activity' ? 'selected' : '' }}>Outdoor Activity</option>
                  <option value="Indoor Activity" {{ $trip->category == 'Indoor Activity' ? 'selected' : '' }}>Indoor Activity</option>
                  <option value="Other" {{ $trip->category == 'Other' ? 'selected' : '' }}>Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required>{{ $trip->description }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="price">Price (e.g. From IDR 2,500,000)</label>
                  <input type="text" class="form-control" id="price" name="price" value="{{ $trip->price }}" required />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="duration">Duration (e.g. 3-7 Days)</label>
                  <input type="text" class="form-control" id="duration" name="duration" value="{{ $trip->duration }}" required />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="difficulty">Difficulty</label>
                  <input type="text" class="form-control" id="difficulty" name="difficulty" value="{{ $trip->difficulty }}" required />
                </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="image">Image</label>
               @if($trip->image)
                <div class="mb-2">
                    <img src="{{ asset($trip->image) }}" alt="Preview" class="d-block rounded" style="max-height: 100px; width: auto;">
                </div>
                @endif
              <input type="file" class="form-control crop-image" id="image" name="image" accept="image/*" data-ratio="4/3" required />
            </div>


            
             <div class="mb-3">
              <label class="form-label" for="order">Order (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="{{ $trip->order }}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update Trip</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
