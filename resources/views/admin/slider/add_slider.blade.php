@extends('layouts.dashboard_master')
@section('slider')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Slider</span>
  </nav>

  <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Add Slider
            </div>
            <div class="card-body">
                <form action="{{ url('add/slider/store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="name">Slider Title</label>
                    <input type="text" name="slider_title" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Slider Title..">
                    @error ('slider_title')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="picturef">Slider Picture</label>
                    <input type="file" name="slider_picture" class="form-control" id="picturef">
                    @error ('slider_picture')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Slider Description</label>
                    <textarea id="description" class="form-control" name="slider_description" rows="4" placeholder="Enter Slider Description.."></textarea>
                    @error ('slider_description')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
