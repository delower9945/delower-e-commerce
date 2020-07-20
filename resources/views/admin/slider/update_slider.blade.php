@extends('layouts.dashboard_master')
@section('slider')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('add/slider') }}">Slider Manage</a>
    <span class="breadcrumb-item active">Edit Slider Manage</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Add Slider
            </div>
            <div class="card-body">
                <form action="{{ url('slider/update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                  <div class="form-group">
                    <label for="name">Slider Title</label>
                    <input type="text" name="slider_title" value="{{ $slider->slider_title }}" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Slider Title..">
                    @error ('slider_title')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="picturef">Slider Old Picture</label>
                    <img src="{{ asset('uploads/slider_images/'.$slider->slider_picture) }}" alt="picture" class="form-control" height="200">
                  </div>

                  <div class="form-group">
                    <label for="picturef">Slider Picture</label>
                    <input type="file" name="slider_new_picture" class="form-control" id="picturef">
                    @error ('slider_new_picture')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Slider Description</label>
                    <textarea id="description" class="form-control" name="slider_description" rows="4" placeholder="Enter Slider Description..">{{ $slider->slider_description }}</textarea>
                    @error ('slider_description')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
