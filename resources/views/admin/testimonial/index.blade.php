@extends('layouts.dashboard_master')
@section('testimonial')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Testimonial</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Add Testimonial
            </div>
            <div class="card-body">
                <form action="{{ url('add/testimonial/store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" class="form-control" id="client_name" placeholder="Enter Client Name..">
                    @error ('client_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_working_position">Client Working Position</label>
                    <input type="text" name="client_working_position" class="form-control" id="client_working_position" placeholder="Enter Client Working Position">
                    @error ('client_working_position')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_picture">Client Picture</label>
                    <input type="file" name="client_picture" class="form-control" id="client_picture">
                    @error ('client_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="client_description">Client Description</label>
                    <textarea name="client_description" rows="4" id="client_description" class="form-control" placeholder="Enter Client Description"></textarea>
                    @error ('client_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
