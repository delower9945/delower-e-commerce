@extends('layouts.dashboard_master')
@section('logo')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Logo</span>
  </nav>

  <div class="sl-pagebody">
      <div class="row row-sm">
        @if (session('logo_message'))
          <div class="col-12">
            <div class="alert alert-success">
              {{ session('logo_message') }}
            </div>
          </div>
        @endif
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              Logo
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>SL NO</td>
                    <td>Logo</td>
                    {{-- <td>Last Update Time</td> --}}
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="card">
            <div class="card-header">
              <h6>Update Picture</h6>
            </div>
            <div class="card-body">
                  <form action="{{ url('logo/update') }}" method="post" class="mt-3" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="picture">Update Picture</label>
                      <input type="file" name="picture" class="form-control" id="picture">
                      @error ('picture')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <input type="submit" class="btn btn-success" value="Update">
                  </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

@endsection
