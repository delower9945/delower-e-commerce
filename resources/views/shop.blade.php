@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>Shop Page</h2>
                          <ul>
                              <li><a href="{{ url('/') }}">Home</a></li>
                              <li><span>Shop</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- .breadcumb-area end -->
      <!-- product-area start -->
      <div class="product-area pt-100">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12 col-lg-12">
                      <div class="product-menu">
                          <ul class="nav justify-content-center">
                              <li>
                                  <a class="active" data-toggle="tab" href="#all">All product</a>
                              </li>
                              @foreach($categories as $category)
                                <li>
                                    <a data-toggle="tab" href="#category_{{ $category->id }}">{{ $category->category_name }}</a>
                                </li>
                              @endforeach

                          </ul>
                      </div>
                  </div>
              </div>
              <div class="tab-content">
                  <div class="tab-pane active" id="all">
                      <ul class="row">
                        @php
                          $flag = 1;
                        @endphp
                        @foreach ($products as $product)
                          <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ 4 < $flag ? "moreload":'' }}">
                              <div class="product-wrap">
                                  <div class="product-img">
                                      <span>Sale</span>
                                      <img src="{{ asset('uploads/product_images') }}/{{ $product->product_thumbnail_picture }}" alt="">
                                      <div class="product-icon flex-style">
                                          <ul>
                                              <li><a id="showProduct" data-id="{{ $product->id }}"><i class="fa fa-eye"></i></a></li>
                                              @if(App\Wishlist::where('product_id',$product->id)->where('ip_address',request()->ip())->exists())
                                                <li><a href="{{ url('add/wish/'.$product->id) }}" class="bg-danger">
                                                  <i class="fa fa-heart"></i>
                                                </a></li>
                                              @else
                                                <li><a href="{{ url('add/wish/'.$product->id) }}">
                                                  <i class="fa fa-heart"></i>
                                                </a></li>
                                              @endif
                                              <li><a href="{{ url('add/cart/'.$product->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="product-content">
                                      <h3><a href="{{ url('single/product/description/'.$product->id) }}">{{ $product->product_name }}</a></h3>
                                      <p class="pull-left">${{ $product->product_price }}

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
                          @php
                            $flag++;
                          @endphp
                        @endforeach

                          <li class="col-12 text-center">
                              <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                          </li>
                      </ul>
                  </div>

                  @foreach ($categories as $category)
                    <div class="tab-pane" id="category_{{ $category->id }}">
                      <ul class="row">
                        @php
                        // moreload class active when item 8
                          $item = 1;
                        @endphp
                        @forelse (App\Product::where('category_id',$category->id)->get() as $category_wise_product)

                          <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ $item > 4 ? "moreload":"" }}">
                              <div class="product-wrap">
                                  <div class="product-img">
                                      <span>Sale</span>
                                      <img src="{{ asset('uploads/product_images') }}/{{ $category_wise_product->product_thumbnail_picture }}" alt="">
                                      <div class="product-icon flex-style">
                                          <ul>
                                              <li><a id="showProduct" data-id="{{ $category_wise_product->id }}"><i class="fa fa-eye"></i></a></li>
                                              @if(App\Wishlist::where('product_id',$category_wise_product->id)->where('ip_address',request()->ip())->exists())
                                                <li><a href="{{ url('add/wish/'.$category_wise_product->id) }}" class="bg-danger">
                                                  <i class="fa fa-heart"></i>
                                                </a></li>
                                              @else
                                                <li><a href="{{ url('add/wish/'.$category_wise_product->id) }}">
                                                  <i class="fa fa-heart"></i>
                                                </a></li>
                                              @endif
                                              <li><a href="{{ url('add/cart/'.$category_wise_product->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="product-content">
                                      <h3><a href="{{ url('single/product/description/'.$category_wise_product->id) }}">{{ $category_wise_product->product_name }}</a></h3>
                                      <p class="pull-left">${{ $category_wise_product->product_price }}

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

                          @php
                            $item++;
                          @endphp
                        @empty
                          <li class="col-12 text-danger text-center alert alert-danger">No Product Available In This Category</li>
                        @endforelse

                      </ul>
                  </div>
                  @endforeach

              </div>
          </div>
      </div>
      <!-- product-area end -->

@endsection
