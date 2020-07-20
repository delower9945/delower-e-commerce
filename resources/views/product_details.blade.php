@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>{{ $product->product_name }}</h2>
                          <ul>
                              <li><a href="{{ url('/') }}">Home</a></li>
                              <li><span>{{ $product->product_name }}</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- .breadcumb-area end -->
      <!-- single-product-area start-->
      <div class="single-product-area ptb-100">
          <div class="container">
            @if (session('card_err'))
              <div class="alert alert-danger">
                {{ session('card_err') }}
              </div>
            @endif
              <div class="row">
                  <div class="col-lg-6">
                      <div class="product-single-img">
                          <div class="product-active owl-carousel">
                              <div class="item">
                                  <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="">
                              </div>
                              @foreach ($multiple_pictures as $multiple_picture)
                                <div class="item">
                                  <img src="{{ asset('uploads/product_multiple_images') }}/{{ $multiple_picture->picture_name }}" alt="">
                                </div>
                              @endforeach

                          </div>
                          <div class="product-thumbnil-active  owl-carousel">
                              <div class="item">
                                  <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="">
                              </div>
                              @foreach ($multiple_pictures as $multiple_picture)
                                <div class="item">
                                  <img src="{{ asset('uploads/product_multiple_images') }}/{{ $multiple_picture->picture_name }}" alt="">
                                </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="product-single-content">
                          <h3>{{ $product->product_name }}</h3>
                          <h6>Available Quantity: {{ $product->product_quantity }}</h6>
                          <div class="rating-wrap fix">
                              <span class="pull-left">${{ $product->product_price }}</span>
                              <ul class="rating pull-right">
                                  <li><i class="fa fa-star"></i></li>
                                  <li><i class="fa fa-star"></i></li>
                                  <li><i class="fa fa-star"></i></li>
                                  <li><i class="fa fa-star"></i></li>
                                  <li><i class="fa fa-star"></i></li>
                                  <li>({{ $total_review }} Customar Review)</li>
                              </ul>
                          </div>
                          <p>{{ $product->product_short_description }}</p>
                          <ul class="input-style">
                            @if ($product->product_quantity == 0)
                              <span class="text-danger"><strong>This Product Is Out Of Stock</strong></span>
                            @else
                              <form action="{{ url('add/to/cart') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id" />
                                <li class="quantity cart-plus-minus">
                                    <input type="text" value="1" name="quantity" />
                                </li>
                                <li><button class="btn btn-danger" type="submit">Add to Cart</button></li>
                              </form>
                            @endif

                          </ul>
                          <ul class="cetagory">
                              <li>Categories:</li>
                              <li><a href="#">{{ $product->relationToCategory->category_name }}</a></li>
                          </ul>
                          <ul class="socil-icon">
                              <li>Share :</li>
                              @foreach ($social_icons as $social_icon)
                                <li><a href="{{ $social_icon->social_media_link }}"><i class="{{ $social_icon->icon_name }}"></i></a></li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="row mt-60">
                  <div class="col-12">
                      <div class="single-product-menu">
                          <ul class="nav">
                              <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                              <li><a data-toggle="tab" href="#review">Review</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="tab-content">
                          <div class="tab-pane active" id="description">
                              <div class="description-wrap">
                                  {{ $product->product_long_description }}
                              </div>
                          </div>


                          <div class="tab-pane" id="review">
                              <div class="review-wrap">
                                  <ul>
                                    @forelse ($reviews as $review)
                                      <li class="review-items">
                                          <div class="review-img">
                                              @if ($review->user->picture)
                                                <img src="{{ asset('uploads/user_images') }}/{{ $review->user->picture }}" alt="" width="50" style="border-radius:60px">
                                              @else
                                                <img src="{{ asset('uploads/user_images') }}/default.png" alt="default" width="50" style="border-radius:60px">
                                              @endif

                                          </div>
                                          <div class="review-content">
                                              <h3><a>{{ $review->user->name }}</a></h3>
                                              <span>{{ $review->created_at->format('d M Y') }} at {{ $review->created_at->format('h:i A') }}</span>
                                              <p>{{ $review->message }}</p>
                                              <ul class="rating">
                                                @for ($i=0; $i < $review->star; $i++)
                                                  <li><i class="fa fa-star"></i></li>
                                                @endfor

                                              </ul>
                                          </div>
                                      </li>
                                    @empty
                                      <li class="text-danger review-items">No Review Available</li>
                                    @endforelse

                                  </ul>
                              </div>

                              <div class="add-review">
                                  <h4>Add A Review</h4>
                                  <form action="{{ url('review') }}" method="post">
                                    @csrf
                                      <div class="ratting-wrap">
                                          <table>
                                              <thead>
                                                  <tr>
                                                      <th>task</th>
                                                      <th>1 Star</th>
                                                      <th>2 Star</th>
                                                      <th>3 Star</th>
                                                      <th>4 Star</th>
                                                      <th>5 Star</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>How Many Stars?</td>
                                                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                      <td>
                                                          <input type="radio" name="star" value="1" />
                                                      </td>
                                                      <td>
                                                          <input type="radio" name="star" value="2" />
                                                      </td>
                                                      <td>
                                                          <input type="radio" name="star" value="3" />
                                                      </td>
                                                      <td>
                                                          <input type="radio" name="star" value="4" />
                                                      </td>
                                                      <td>
                                                          <input type="radio" name="star" value="5" />
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      <div class="row">
                                          @if (session('review_message'))
                                            <div class="col-12">
                                              <div class="alert alert-danger">{{ session('review_message') }}</div>
                                            </div>
                                          @endif
                                          <div class="col-12">
                                              <h4>Your Review:</h4>
                                              <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                          </div>
                                          <div class="col-12">
                                              <button class="btn-style">Submit</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- single-product-area end-->
      <!-- featured-product-area start -->
      <div class="featured-product-area">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="section-title text-left">
                          <h2>Related Product</h2>
                      </div>
                  </div>
              </div>
              <div class="row">
                @forelse ($related_products as $related_product)
                  <div class="col-lg-3 col-sm-6 col-12">
                      <div class="featured-product-wrap">
                          <div class="featured-product-img">
                              <img src="{{ asset('uploads/product_images/'.$related_product->product_thumbnail_picture) }}" alt="picture">
                          </div>
                          <div class="featured-product-content">
                              <div class="row">
                                  <div class="col-7">
                                      <h3><a href="{{ url('single/product/description/'.$related_product->id) }}">{{ $related_product->product_name }}</a></h3>
                                      <p>${{ $related_product->product_price }}</p>
                                  </div>
                                  <div class="col-5 text-right">
                                      <ul>
                                          <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                          <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                @empty
                  <div class="col-12">
                    <div class="alert alert-danger text-center">
                      No Related Product Available
                    </div>
                  </div>
                @endforelse
              </div>
          </div>
      </div>
      <!-- featured-product-area end -->

@endsection
