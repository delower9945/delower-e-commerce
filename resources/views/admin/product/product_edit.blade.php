@extends('layouts.dashboard_master')
@section('product')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('product/list') }}">Product</a>
    <span class="breadcrumb-item active">Edit Product</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Edit Product
            </div>
            <div class="card-body">
                <form action="{{ url('product/update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $product->id }}">
                  <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" value="{{ $product->product_name }}" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name..">
                    @error ('product_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id">
                      <option value="">--select--</option>
                      @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" @if ($product->category_id == $categorie->id)selected @endif >{{ $categorie->category_name }}</option>
                      @endforeach
                    </select>
                    @error ('category_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" value="{{ $product->product_price }}" name="product_price" class="form-control" id="product_price" placeholder="Enter Product Price..">
                    @error ('product_price')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_thumbnail_picture">Product Thumbnail Picture</label>
                    <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="picture" class="form-control" height="200">
                  </div>

                  <div class="form-group">
                    <label for="product_thumbnail_picture">Product New Thumbnail Picture</label>
                    <input type="file" name="product_new_thumbnail_picture" class="form-control" id="product_thumbnail_picture">
                    @error ('product_new_thumbnail_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="text" value="{{ $product->product_quantity }}" name="product_quantity" class="form-control" id="product_quantity" placeholder="Enter Product Quantity">
                    @error ('product_quantity')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_short_description">Product Short Description</label>
                    <textarea name="product_short_description" rows="4" class="form-control" placeholder="Enter Product Short Description">{{ $product->product_short_description }}</textarea>
                    @error ('product_short_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_long_description">Product Short Description</label>
                    <textarea name="product_long_description" rows="4" class="form-control" placeholder="Enter Product Long Description">{{ $product->product_long_description }}</textarea>
                    @error ('product_long_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-info">Update</button>
                </form>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
