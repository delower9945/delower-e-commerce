@extends('layouts.dashboard_master')
@section('category')
  active
@endsection
@section('content')


  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
      <span class="breadcrumb-item active">Category</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">

        @if(session('update_success'))
          <div class="col-12">
            <div class="alert alert-success">
              {{ session('update_success') }}
            </div>
          </div>
        @endif
        @if(session('delete_message'))
          <div class="col-12">
            <div class="alert alert-warning">
              {{ session('delete_message') }}
            </div>
          </div>
        @endif
        @if(session('restore_message'))
          <div class="col-12">
            <div class="alert alert-success">
              {{ session('restore_message') }}
            </div>
          </div>
        @endif
        @if(session('hdelete_message'))
          <div class="col-12">
            <div class="alert alert-danger">
              {{ session('hdelete_message') }}
            </div>
          </div>
        @endif

        <div class="col-12">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title mb-5">Category List</h6>
            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Name</th>
                    <th>Added By</th>
                    <th>Picture</th>
                    <th>Create At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($categories as $category)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ App\User::find($category->user_id)->name }}</td>
                      <td>
                        <img src="{{ asset('uploads/category_images/'.$category->category_picture) }}" width="100" alt="No Picture">
                      </td>
                      <td>{{ $category->created_at->diffForHumans() }}</td>
                      <td>
                        @if($category->updated_at)
                          {{ $category->updated_at->diffForHumans() }}
                        @endif
                      </td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('update/category') }}/{{ $category->id }}" class="btn btn-info">Edit</a>
                          <a href="{{ url('delete/category') }}/{{ $category->id }}" class="btn btn-danger">Delete</a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-danger text-center">No Data Show</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card -->
        </div>

        <div class="col-12 mt-5">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title mb-5 text-danger">Trashed Category List</h6>
            <div class="table-wrapper">
              <table id="datatable2" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Name</th>
                    <th>Added By</th>
                    <th>Picture</th>
                    <th>Create At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($delete_categories as $delete_category)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $delete_category->category_name }}</td>
                      <td>{{ App\User::find($delete_category->user_id)->name }}</td>
                      <td>
                        <img src="{{ asset('uploads/category_images/'.$delete_category->category_picture) }}" width="100" alt="No Picture">
                      </td>
                      <td>{{ $delete_category->created_at->diffForHumans() }}</td>
                      <td>
                        @if($delete_category->updated_at)
                          {{ $delete_category->updated_at->diffForHumans() }}
                        @endif
                      </td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('restore/category') }}/{{ $delete_category->id }}" class="btn btn-success">Restore</a>
                          <a href="{{ url('herddelete/category') }}/{{ $delete_category->id }}" class="btn btn-danger">HDelete</a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-center text-danger"> No Data To Show</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card -->
        </div>


      </div>
    </div>
  </div>

@endsection
