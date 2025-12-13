@extends('layouts/layoutMaster')

@section('title', 'Add New Testimonial')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Testimonials /</span> Add New</h4>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
              <label class="form-label" for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required />
            </div>

            <div class="mb-3">
              <label class="form-label" for="role">Role</label>
              <input type="text" class="form-control" id="role" name="role" required />
            </div>

            <div class="mb-3">
               <label class="form-label" for="avatar_type">Avatar Source</label>
               <div class="nav nav-tabs mb-3" role="tablist">
                    <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#navs-url" aria-controls="navs-url" aria-selected="true" onclick="document.getElementById('avatar_input').name='avatar'; document.getElementById('avatar_file_input').name='';">URL</button>
                    <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#navs-file" aria-controls="navs-file" aria-selected="false" onclick="document.getElementById('avatar_input').name=''; document.getElementById('avatar_file_input').name='avatar_file';">Upload</button>
               </div>
               <div class="tab-content p-0">
                   <div class="tab-pane fade show active" id="navs-url">
                        <input type="text" class="form-control" id="avatar_input" name="avatar" placeholder="https://..." />
                        <div class="form-text">Enter URL to image</div>
                   </div>
                   <div class="tab-pane fade" id="navs-file">
                        <input type="file" class="form-control crop-image" id="avatar_file_input" name="" accept="image/*" data-ratio="1" />
                   </div>
               </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="rating">Rating (1-5)</label>
              <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" value="5" required />
            </div>

            <div class="mb-3">
              <label class="form-label" for="content">Review Content</label>
              <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Testimonial</button>
            <a href="{{ route('landing-customization') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
