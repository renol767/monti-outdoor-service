@extends('layouts/layoutMaster')

@section('title', 'Create New Trip')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Trips /</span> Create New</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" required />
            </div>
            
            <div class="mb-3">
              <label class="form-label" for="category">Category</label>
              <select class="form-select" id="category" name="category" required>
                  <option value="Mountain Trip">Mountain Trip</option>
                  <option value="Outdoor Activity">Outdoor Activity</option>
                  <option value="Indoor Activity">Indoor Activity</option>
                  <option value="Other">Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="price">Price (e.g. From IDR 2,500,000)</label>
                  <input type="text" class="form-control" id="price" name="price" required />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="duration">Duration (e.g. 3-7 Days)</label>
                  <input type="text" class="form-control" id="duration" name="duration" required />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label" for="difficulty">Difficulty</label>
                  <input type="text" class="form-control" id="difficulty" name="difficulty" required />
                </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="image">Image</label>
              <input type="file" class="form-control crop-image" id="image" name="image" accept="image/*" data-ratio="4/3" required />
            </div>


            
             <div class="mb-3">
              <label class="form-label" for="order">Orden (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="0"/>
            </div>

            <button type="submit" class="btn btn-primary">Create Trip</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
