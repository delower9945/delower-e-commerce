@extends('layouts.frontend_master')
@section('frontend_content')


  <!-- slider-area start -->
  <div class="slider-area">
      <div class="swiper-container">
          <div class="swiper-wrapper">
            @foreach($sliders as $slide)
              <div class="swiper-slide overlay">
                  <div class="single-slider slide-inner" style="background:url({{ asset('uploads/slider_images/'.$slide->slider_picture) }})">
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-12 col-lg-9 col-12">
                                  <div class="slider-content">
                                      <div class="slider-shape">
                                          <h2 data-swiper-parallax="-500">{{ $slide->slider_title }}</h2>
                                          <p data-swiper-parallax="-400">{{ $slide->slider_description }}</p>
                                          <a href="{{ url('shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
      </div>
  </div>
  <!-- slider-area end -->
  <!-- featured-area start -->
  <div class="featured-area featured-area2">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="section-title">
                      <h2>Categories</h2>
                      <img src="{{ asset('frontend_assets') }}/images/section-title.png" alt="">
                  </div>
                  <div class="featured-active2 owl-carousel next-prev-style">
                    @foreach($categories as $category)
                      <div class="featured-wrap">
                          <div class="featured-img">
                              <img src="{{ asset('uploads/category_images/'.$category->category_picture) }}" alt="">
                              <div class="featured-content">
                                  <a href="{{ url('category/product/'.$category->id) }}">{{ $category->category_name }}</a>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- featured-area end -->
  <!-- start count-down-section -->
  <div class="count-down-area count-down-area-sub">
      <section class="count-down-section section-padding parallax" data-speed="7">
          <div class="container">
              <div class="row">
                  <div class="col-12 col-lg-12 text-center">
                      <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                  </div>
                  <div class="col-12 col-lg-12 text-center">
                      <div class="count-down-clock text-center">
                          <div id="clock">

                          </div>
                      </div>
                  </div>
              </div>
              <!-- end row -->
          </div>
          <!-- end container -->
      </section>
  </div>
  <!-- end count-down-section -->

  <!-- Best Seller product-area start -->
  <div class="product-area product-area-2">
      <div class="fluid-container">
          <div class="row">
              <div class="col-12">
                  <div class="section-title">
                      <h2>Best Seller</h2>
                      <img src="{{ asset('frontend_assets') }}/images/section-title.png" alt="">
                  </div>
              </div>
          </div>
          <ul class="row">
              <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                  <div class="product-wrap">
                      <div class="product-img">
                          <img src="assets/images/product/1.jpg" alt="">
                          <div class="product-icon flex-style">
                              <ul>
                                  <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                  <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                  <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="product-content">
                          <h3><a href="single-product.html">Nature Honey</a></h3>
                          <p class="pull-left">$125

                          </p>
                          <ul class="pull-right d-flex">
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star-half-o"></i></li>
                          </ul>
                      </div>
                  </div>
              </li>
          </ul>
      </div>
  </div>
  <!-- Best Seller product-area end -->


  <!-- product-area start -->
  <div class="product-area">
      <div class="fluid-container">
          <div class="row">
              <div class="col-12">
                  <div class="section-title">
                      <h2>Our Latest Product</h2>
                      <img src="{{ asset('frontend_assets') }}/images/section-title.png" alt="">
                  </div>
              </div>
          </div>
          <ul class="row">
            @foreach($products as $product)
              <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                  <div class="product-wrap">
                      <div class="product-img">
                          <span>Sale</span>
                          <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="Product Picture">
                          <div class="product-icon flex-style">
                              <ul>
                                  <li><a id="showProduct" data-id="{{ $product->id }}"><i class="fa fa-eye"></i></a></li>
                                  {{-- <li><a href="{{ url('single/product/description/'.$product->id) }}"><i class="fa fa-eye"></i></a></li> --}}
                                  @if(App\Wishlist::where('product_id',$product->id)->where('ip_address',request()->ip())->exists())
                                    <li><a href="{{ url('add/wish/'.$product->id) }}" class="bg-danger">
                                      <i class="fa fa-heart"></i>
                                    </a></li>
                                  @else
                                    <li><a href="{{ url('add/wish/'.$product->id) }}">
                                      <i class="fa fa-heart"></i>
                                    </a></li>
                                  @endif
                                  <li><a  href="{{ url('add/cart/'.$product->id) }}"><i class="fa fa-shopping-bag"></i></li>
                              </ul>
                          </div>
                      </div>
                      <div class="product-content">
                          <h3><a  target="_blank" href="{{ url('single/product/description/'.$product->id) }}">{{ $product->product_name }}</a></h3>
                          <p class="">${{ $product->product_price }}

                          </p>
                          <ul class="pull-right d-flex">
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star-half-o"></i></li>
                          </ul>
                      </div>
                  </div>
              </li>
            @endforeach
              <li class="col-12 text-center">
                  <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
              </li>
          </ul>
      </div>
  </div>
  <!-- product-area end -->
  <!-- testmonial-area start -->
  <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="test-title text-center">
                      <h2>What Our client Says</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-10 offset-md-1 col-12">
                  <div class="testmonial-active owl-carousel">
                    @foreach($testimonials as $testimonial)
                      <div class="test-items test-items2">
                          <div class="test-content">
                              <p>{{ $testimonial->client_description }}</p>
                              <h2>{{ $testimonial->client_name }}</h2>
                              <p>{{ $testimonial->client_working_position }}</p>
                          </div>
                          <div class="test-img2">
                              <img src="{{ asset('uploads/testimonial_images/'.$testimonial->client_picture) }}" alt="Picture">
                          </div>
                      </div>
                    @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- testmonial-area end -->

@endsection
