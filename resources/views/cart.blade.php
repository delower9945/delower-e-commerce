@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
              @if (session('cupon_message'))
                <div class="alert alert-danger">{{ session('cupon_message') }}</div>
              @endif
              @if (session('cart_message'))
                <div class="alert alert-danger">{{ session('cart_message') }}</div>
              @endif
                <form action="{{ url('cart/update') }}" method="post">
                  @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                            $subTotal = 0;
                            $flag = 0;
                          @endphp
                          @foreach($cart_products as $cart_product)

                            <tr>
                                <td class="images"><img src="{{ asset('uploads/product_images/') }}/{{ $cart_product->product->product_thumbnail_picture }}" alt=""></td>
                                <td class="product">
                                  <a href="{{ url('single/product/description/'.$cart_product->product_id) }}">{{ $cart_product->product->product_name }} ( Available Quantity: {{ $cart_product->product->product_quantity }})</a>
                                  <br>
                                  @if ($cart_product->product->product_quantity < $cart_product->quantity)
                                    <span class="text-danger">You have remove or decrase product quantity</span>
                                    @php
                                      $flag++;
                                    @endphp
                                  @endif

                                </td>
                                <td class="ptice">${{ $cart_product->product->product_price }}</td>
                                <td class="quantity cart-plus-minus">
                                    <input type="text" value="{{ $cart_product->quantity }}" name="quantity[{{ $cart_product->id }}]" />
                                </td>
                                <td class="total">${{ ($cart_product->product->product_price)*($cart_product->quantity) }}</td>
                                <td class="remove">
                                  <a href="{{ url('remove/cart/'.$cart_product->id) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                            @php
                              $subTotal = $subTotal + ($cart_product->product->product_price)*($cart_product->quantity);
                            @endphp
                          @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button type="submit">Update Cart</button>
                                    </li>
                </form>
                                    <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                </ul>
                                <h3>Cupon</h3>
                                <p>Enter Your Cupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" value="{{ $cupon_name??'' }}" placeholder="Cupon Code" id="cupon-name">
                                    <a class="btn" id="cupon-name-link">Apply Cupon</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>${{ $subTotal }}</li>
                                    @isset($discount_amount)
                                      <li><span class="pull-left">Discount Amount </span>{{ $discount_amount }}%</li>
                                    @endisset
                                    @isset($discount_amount)
                                      <li><span class="pull-left"> Total </span> ${{ $final_total = $subTotal - ($subTotal*($discount_amount / 100)) }}</li>
                                    @else
                                      <li><span class="pull-left"> Total </span> ${{ $final_total = $subTotal }}</li>
                                    @endisset

                                </ul>
                                @if ($flag == 0)
                                  <form method="post" action="{{ url('checkout') }}">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $final_total }}">
                                    <button type="submit" class="btn btn-danger mt-2">Proceed to Checkout</button>
                                  </form>
                                @endif


                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection
