@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
   <div class="container">
       <div class="row">
           <div class="col-12">
               <div class="breadcumb-wrap text-center">
                   <h2>Checkout</h2>
                   <ul>
                       <li><a href="{{ url('/') }}">Home</a></li>
                       <li><span>Checkout</span></li>
                   </ul>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
   <div class="container">
       <div class="row">
           <div class="col-lg-8">
               <div class="checkout-form form-style">
                   <h3>Billing Details</h3>
                   <form action="{{ url('order/post') }}" method="post" name="myForm">
                     @csrf
                       <div class="row">
                           <div class="col-sm-6 col-12">
                               <p>Name *</p>
                               <input type="text" name="full_name" value="{{ Auth::user()->name }}" >
                               @error ('full_name')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-sm-6 col-12">
                               <p>Email Address *</p>
                               <input type="email" name="email" value="{{ Auth::user()->email }}">
                               @error ('email')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-12">
                               <p>Phone No. *</p>
                               <input type="text" name="phone">
                               @error ('phone')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-12">
                               <p>Country *</p>
                               <input type="text" name="country">

                               @error ('country')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-12">
                               <p>Your Address *</p>
                               <input type="text" name="address">
                               @error ('address')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-sm-6 col-12">
                               <p>Postcode/ZIP</p>
                               <input type="text" name="post_code">
                               @error ('post_code')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-sm-6 col-12">
                               <p>Town/City *</p>
                               <input type="text" name="city">
                               @error ('city')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <div class="col-12">
                               <p>Order Notes </p>
                               <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                               @error ('notes')
                                 <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                       </div>

               </div>
           </div>
           <div class="col-lg-4">
               <div class="order-area">
                   <h3>Your Order</h3>
                   <ul class="total-cost">
                     @php
                       $subTotal = 0;
                     @endphp
                    @foreach($carts as $cart)
                       <li>{{ App\Product::find($cart->product_id)->product_name }} X {{ $cart->quantity }} <span class="pull-right">${{ $cart->quantity * (App\Product::find($cart->product_id)->product_price) }}</span></li>
                       @php
                         $subTotal = $subTotal + ($cart->quantity * (App\Product::find($cart->product_id)->product_price))
                       @endphp
                     @endforeach
                       <li>Subtotal <span class="pull-right"><strong>${{ $subTotal }}</strong></span></li>
                       <input type="hidden" name="sub_total" value="{{ $subTotal }}">
                       <li>Total<span class="pull-right">${{ $total }}</span></li>
                       <input type="hidden" name="total" value="{{ $total }}">
                   </ul>
                   <ul class="payment-method">
                       <li>
                         <input id="delivery" type="radio" value="1" name="payment_option" checked>
                         <label for="delivery">Cash on Delivery</label>
                       </li>
                       <li>
                           <input id="card" type="radio" value="2" name="payment_option">
                           <label for="card">Credit Card</label>
                       </li>
                   </ul>
                     <button type="submit">Place Order</button>

        </form>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- checkout-area end -->

@endsection
