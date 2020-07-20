@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>Blog Page</h2>
                          <ul>
                              <li><a href="{{ url('/') }}">Home</a></li>
                              <li><span>Blog</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- .breadcumb-area end -->
      <!-- blog-area start -->
      <div class="blog-area">
          <div class="container">
              <div class="col-lg-12">
                  <div class="section-title  text-center">
                      <h2>Latest News</h2>
                      <img src="assets/images/section-title.png" alt="">
                  </div>
              </div>
              <div class="row">
                @foreach($posts as $post)
                  <div class="col-lg-4  col-md-6 col-12">
                      <div class="blog-wrap">
                          <div class="blog-image">
                              <img src="{{ asset('uploads/blog_images/'.$post->post_picture) }}" alt="Picture">
                              <ul>
                                  <li>{{ $post->created_at->format('d') }}</li>
                                  <li>{{ $post->created_at->format('M') }}</li>
                              </ul>
                          </div>
                          <div class="blog-content">
                              <div class="blog-meta">
                                  <ul>
                                      <li><a href="#"><i class="fa fa-user"></i> {{ $post->relationToUser->name }}</a></li>
                                      <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{ $post->created_at->format('d/m/Y') }}</a></li>
                                  </ul>
                              </div>
                              <h3><a href="{{ url('blog/post/'.$post->id) }}">{{ $post->post_title }}</a></h3>
                              {{ Str::limit($post->post_description,200) }}
                          </div>
                      </div>
                  </div>
                @endforeach
                  <div class="col-12 mb-30">
                      <div style="margin:auto">
                          {{ $posts->links() }}
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- blog-area end -->


@endsection
