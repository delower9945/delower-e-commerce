@extends('layouts.dashboard_master')
@section('product')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('product/list') }}">Product List</a>
    <span class="breadcrumb-item active">Product Details</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-8 m-auto">

          <div class="card pd-20 pd-sm-40 mg-t-25">
            <div class="card-body-title mb-4">
              <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="picture" class="img-fluid" width="200">
            </div>

          <dl class="row">
              <dt class="col-sm-4 tx-inverse">Product Name</dt>
              <dd class="col-sm-8">{{ $product->product_name }}</dd>

              <dt class="col-sm-4 tx-inverse">Category Name</dt>
              <dd class="col-sm-8">
                <p>{{ $product->category_id }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Product Price</dt>
              <dd class="col-sm-8">
                <p>{{ $product->product_price }}$</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Product Quantity</dt>
              <dd class="col-sm-8">
                <p>{{ $product->product_quantity }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Product Short Description</dt>
              <dd class="col-sm-8">
                <p>{{ $product->product_short_description }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Product Long Description</dt>
              <dd class="col-sm-8">{{ $product->product_long_description }}</dd>

          </dl>
        </div><!-- card -->

        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
