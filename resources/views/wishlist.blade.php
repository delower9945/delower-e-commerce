@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Wishlist</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Wishlist</span></li>
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
                <form action="">
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="stock">Stock Stutus </th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach(App\Wishlist::where('ip_address',request()->ip())->get() as $wishlist)
                            <tr>
                                <td class="images"><img src="{{ asset('uploads/product_images/'.$wishlist->product->product_thumbnail_picture) }}" alt=""></td>
                                <td class="product"><a href="{{ url('single/product/description/'.$wishlist->product_id) }}">{{ $wishlist->product->product_name }}</a></td>
                                <td class="ptice">${{ $wishlist->product->product_price }}</td>
                                <td class="stock">In Stock</td>
                                <td class="addcart"><a href="{{ url('add/cart/'.$wishlist->product_id) }}">Add to Cart</a></td>

                                <td class="remove"><i class="fa fa-times"></i></td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection
