@extends('layouts.dashboard_master')
@section('blog')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Blog Post</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-8 m-auto">
          <div class="card">
            <div class="card-header">
              Add Blog Post
            </div>
            <div class="card-body">
                <form action="{{ url('blog/add/store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" name="post_title" class="form-control" id="post_title" placeholder="Enter Post Title..">
                    @error ('post_title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="post_picture">Post Picture</label>
                    <input type="file" name="post_picture" class="form-control" id="client_pipost_picturecture">
                    @error ('post_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="post_description">Post Description</label>
                    <textarea name="post_description" rows="8" id="post_description" class="form-control" placeholder="Enter Post Description"></textarea>
                    @error ('post_description')
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
