@extends('layouts.dashboard_master')
@section('product')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Product List</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

        <div class="col-12">
          @if (session('product_message'))
            <div class="alert alert-success">{{ session('product_message') }}</div>
          @endif
          @if (session('product_delete_message'))
            <div class="alert alert-warning">{{ session('product_delete_message') }}</div>
          @endif
          <div class="card">
            <div class="card-header">
              Product List
            </div>
            <div class="card-body">
              <table class="table table-bordered table-responsive" id="datatable1">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Product Price</th>
                    <th>Product Thumbnail Picture</th>
                    <th>Product Quantity</th>
                    <th>Product Short Text</th>
                    <th>Product Long Text</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->relationToCategory->category_name }}</td>
                      <td>{{ $product->product_price }}$</td>
                      <td>
                        <img src="{{ asset('uploads/product_images/'.$product->product_thumbnail_picture) }}" alt="Picture" width="100">
                      </td>
                      <td>{{ $product->product_quantity }}</td>
                      <td>{{ Str::limit($product->product_short_description,10) }}</td>
                      <td>{{ Str::limit($product->product_long_description,10) }}</td>
                      <td>{{ $product->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('product/show/'.$product->id) }}" class="btn btn-info btn-sm "><i class="fa fa-eye fa-lg"></i></a>
                          <a href="{{ url('product/edit/'.$product->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit fa-lg"></i></a>
                          <a href="{{ url('product/delete/'.$product->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-lg"></i></a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-center text-danger">No Data To Show</td>
                    </tr>
                  @endforelse


                </tbody>
              </table>
            </div>
          </div>

          <div class="card mt-5">
            <div class="card-header text-danger">
              Trashed Product List
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="datatable2">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Product Price</th>
                    <th>Product Thumbnail Picture</th>
                    <th>Product Quantity</th>
                    <th>Product Short Text</th>
                    <th>Product Long Text</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($delete_products as $delete_product)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $delete_product->product_name }}</td>
                      <td>{{ $delete_product->category_id }}</td>
                      <td>{{ $delete_product->product_price }}$</td>
                      <td>
                        <img src="{{ asset('uploads/product_images/'.$delete_product->product_thumbnail_picture) }}" alt="Picture" width="100">
                      </td>
                      <td>{{ $delete_product->product_quantity }}</td>
                      <td>{{ Str::limit($delete_product->product_short_description,10) }}</td>
                      <td>{{ Str::limit($delete_product->product_long_description,10) }}</td>
                      <td>{{ $delete_product->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('product/restore/'.$delete_product->id) }}" class="btn btn-success btn-sm "><i class="fa fa-plane fa-lg"></i></a>
                          <a href="{{ url('product/heard/delete/'.$delete_product->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-center text-danger">No Data To Show</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
