@extends('layouts.dashboard_master')
@section('blog')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Blog Post List</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

        <div class="col-12">
          @if (session('blog_success'))
            <div class="alert alert-success">{{ session('blog_success') }}</div>
          @endif
          @if (session('blog_message_success'))
            <div class="alert alert-warning">{{ session('blog_message_success') }}</div>
          @endif
          <div class="card">
            <div class="card-header">
              Blog Post List
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Post Title</th>
                    <th>User Name</th>
                    <th>Post Picture</th>
                    <th>Post Description</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $post->post_title }}</td>
                      <td>{{ $post->relationToUser->name }}</td>
                      <td>
                        <img src="{{ asset('uploads/blog_images/'.$post->post_picture) }}" width="100" height="100" alt="">
                      </td>
                      <td>{{ Str::limit($post->post_description, 60) }}</td>
                      <td>{{ $post->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('blog/post/show/'.$post->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye fa-lg"></i></a>
                          <a href="{{ url('blog/post/edit/'.$post->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit fa-lg"></i></a>
                          <a href="{{ url('blog/post/delete/'.$post->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-lg"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mt-5">
            <div class="card-header text-danger">
              Trashed Post List
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Post Title</th>
                    <th>User Name</th>
                    <th>Post Picture</th>
                    <th>Post Description</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($delete_posts as $delete_post)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $delete_post->post_title }}</td>
                      <td>{{ $delete_post->relationToUser->name }}</td>
                      <td>
                        <img src="{{ asset('uploads/blog_images/'.$delete_post->post_picture) }}" width="100" height="100" alt="">
                      </td>
                      <td>{{ Str::limit($delete_post->post_description, 60) }}</td>
                      <td>{{ $delete_post->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('blog/post/restore/'.$delete_post->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plane fa-lg"></i></a>
                          <a href="{{ url('blog/post/heard/delete/'.$delete_post->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
