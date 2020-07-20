@extends('layouts.dashboard_master')
@section('blog')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('blog/list') }}">Blog Post</a>
    <span class="breadcrumb-item active">Edit Post</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-8 m-auto">
          <div class="card">
            <div class="card-header">
              Add Blog Post
            </div>
            <div class="card-body">
                <form action="{{ url('blog/post/update') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <input type="hidden" name="id" value="{{ $post->id }}">
                  <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" name="post_title" value="{{ $post->post_title }}" class="form-control" id="post_title" placeholder="Enter Post Title..">
                    @error ('post_title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label >Post Picture</label>
                    <img src="{{ asset('uploads/blog_images/'.$post->post_picture) }}" class="form-control" height="200" alt="Picture">
                  </div>

                  <div class="form-group">
                    <label for="post_picture">Post Picture</label>
                    <input type="file" name="post_new_picture" class="form-control" id="client_pipost_picturecture">
                    @error ('post_new_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="post_description">Post Description</label>
                    <textarea name="post_description" rows="8" id="post_description" class="form-control" placeholder="Enter Post Description">{{ $post->post_description }}</textarea>
                    @error ('post_description')
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
