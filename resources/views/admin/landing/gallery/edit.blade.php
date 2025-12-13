@extends('layouts/layoutMaster')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Gallery /</span> Edit Image</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label class="form-label" for="image">Image</label>
               @if($gallery->image)
                <div class="mb-2">
                    <img src="{{ asset($gallery->image) }}" alt="Preview" class="d-block rounded" style="max-height: 100px; width: auto;">
                </div>
                @endif
              <input type="file" class="form-control crop-image" id="image" name="image" accept="image/*" data-ratio="4/3" />
            </div>

            <div class="mb-3">
              <label class="form-label" for="caption">Caption</label>
              <input type="text" class="form-control" id="caption" name="caption" value="{{ $gallery->caption }}" />
            </div>
            
             <div class="mb-3">
              <label class="form-label" for="order">Orden (Optional)</label>
              <input type="number" class="form-control" id="order" name="order" value="{{ $gallery->order }}"/>
            </div>

            <button type="submit" class="btn btn-primary">Update Image</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
