@extends('layouts.dashboard_master')
@section('testimonial')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('testimonial/list') }}">Testimonial</a>
    <span class="breadcrumb-item active">Edit Testimonial</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Edit Testimonial
            </div>
            <div class="card-body">
                <form action="{{ url('testimonial/update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $testimonial->id }}">
                  <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" value="{{ $testimonial->client_name }}" class="form-control" id="client_name" placeholder="Enter Client Name..">
                    @error ('client_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_working_position">Client Working Position</label>
                    <input type="text" name="client_working_position" value="{{ $testimonial->client_working_position }}" class="form-control" id="client_working_position" placeholder="Enter Client Working Position">
                    @error ('client_working_position')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_picture">Client Old Picture</label>
                    <img src="{{ asset('uploads/testimonial_images/'.$testimonial->client_picture) }}" alt="picture" class="form-control" height="">
                  </div>

                  <div class="form-group">
                    <label for="client_picture">Client New Picture</label>
                    <input type="file" name="client_new_picture" class="form-control" id="client_picture">
                    @error ('client_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_description">Client Description</label>
                    <textarea name="client_description" rows="4" id="client_description" class="form-control" placeholder="Enter Client Description">{{ $testimonial->client_description }}</textarea>
                    @error ('client_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
