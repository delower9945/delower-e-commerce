@extends('layouts.dashboard_master')
@section('category')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('add/category') }}">Add Category</a>
    <span class="breadcrumb-item active">{{ $category->category_name }}</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

    <div class="col-6 m-auto">
        <div class="card">
          <div class="card-header">
            Update Category
          </div>
          <div class="card-body">
              <form action="{{ url('update/category/post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group">
                  <label for="name">Category Name</label>
                  <input type="text" value="{{ $category->category_name }}" name="category_name" class="form-control" id="name" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label>Category old picture</label>
                  <img src="{{ asset('uploads/category_images/'.$category->category_picture) }}" alt="" class="form-control" height="250">
                </div>
                <div class="form-group">
                  <label for="">Category New Picture</label>
                  <input type="file" name="category_new_picture" class="form-control" id="" aria-describedby="emailHelp">
                  @error ('category_new_picture')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
              </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
