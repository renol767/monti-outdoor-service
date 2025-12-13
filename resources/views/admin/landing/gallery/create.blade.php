@extends('layouts/layoutMaster')

@section('title', 'Add New Gallery Image')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Gallery /</span> Add New</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
              <label class="form-label" for="image">Image</label>
              <input type="file" class="form-control crop-image" id="image" name="image" accept="image/*" data-ratio="4/3" required />
            </div>

            <div class="mb-3">
              <label class="form-label" for="caption">Caption</label>
              <input type="text" class="form-control" id="caption" name="caption" />
            </div>
            
             <div class="mb-3">
              <label class="form-label" for="order">Order (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="0"/>
            </div>

            <button type="submit" class="btn btn-primary">Add Image</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
