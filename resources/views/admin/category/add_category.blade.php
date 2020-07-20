@extends('layouts.dashboard_master')
@section('category')
  active
@endsection
@section('content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
      <span class="breadcrumb-item active">Add Category</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header">
              Add Category
            </div>
            <div class="card-body">
              @if(session('success_message'))
                <div class="alert alert-success">
                  {{ session('success_message') }}
                </div>
              @endif
                <form action="{{ url('add/category/post') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" id="name" aria-describedby="emailHelp" placeholder="Enter Category Name..">
                    @error ('category_name')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="Picture">Category Picture</label>
                    <input type="file" name="category_picture" class="form-control" id="Picture" aria-describedby="emailHelp" placeholder="Enter Category Name..">
                    @error ('category_picture')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection
