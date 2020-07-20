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
    <span class="breadcrumb-item active">Show Post</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-8 m-auto">

          <div class="card pd-20 pd-sm-40 mg-t-25">
            <div class="card-body-title mb-4">
              <img src="{{ asset('uploads/blog_images/'.$post->post_picture) }}" alt="picture" class="img-fluid">
            </div>

          <dl class="row">
              <dt class="col-sm-4 tx-inverse">Post Title</dt>
              <dd class="col-sm-8">{{ $post->post_title }}</dd>

              <dt class="col-sm-4 tx-inverse">Post Time</dt>
              <dd class="col-sm-8">
                <p>{{ $post->created_at->format('d M Y') }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">User Name</dt>
              <dd class="col-sm-8">
                <p>{{ $post->relationToUser->name }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Post Description</dt>
              <dd class="col-sm-8">{{ $post->post_description }}</dd>

          </dl>
        </div><!-- card -->

        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
