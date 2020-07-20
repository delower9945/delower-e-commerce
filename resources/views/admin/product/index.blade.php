@extends('layouts.dashboard_master')
@section('product')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Product</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Add Product
            </div>
            <div class="card-body">
                <form action="{{ url('add/product/store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name..">
                    @error ('product_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id">
                      <option value="">--select--</option>
                      @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                      @endforeach
                    </select>
                    @error ('category_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Enter Product Price..">
                    @error ('product_price')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_thumbnail_picture">Product Thumbnail Picture</label>
                    <input type="file" name="product_thumbnail_picture" class="form-control" id="product_thumbnail_picture">
                    @error ('product_thumbnail_picture')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_multiple_picture">Product Multipule Picture</label>
                    <input type="file" name="product_multiple_pictures[]" class="form-control" id="product_multiple_picture" multiple>
                    @error ('product_multiple_pictures')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Enter Product Quantity">
                    @error ('product_quantity')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_short_description">Product Short Description</label>
                    <textarea name="product_short_description" rows="4" class="form-control" placeholder="Enter Product Short Description"></textarea>
                    @error ('product_short_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_long_description">Product Short Description</label>
                    <textarea name="product_long_description" rows="4" class="form-control" placeholder="Enter Product Long Description"></textarea>
                    @error ('product_long_description')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
