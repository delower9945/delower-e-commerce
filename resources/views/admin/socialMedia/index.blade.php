@extends('layouts.dashboard_master')
@section('social_media')
  active
@endsection
@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Social Media</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-12">
        <div class="float-right">
          <a href="{{ url('social/media/add') }}" class="btn btn-success">Add Social Media</a>
        </div>
      </div>
      <div class="col-12">
        @if (session('message'))
          <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card mt-3">
          <div class="card-header">
            Social Media List
          </div>
          <div class="card-body">
            <table class="table table-border table-responsive">
              <thead>
                <tr>
                  <td>SL NO.</td>
                  <td>Social Icon</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @forelse($social_medias as $row)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td><a href="{{ $row->social_media_link }}"><i class="{{ $row->icon_name }} fa-lg"></i></a></td>
                    <td>
                      <div class="btn-group text-white" role="group" aria-label="Basic example">
                        <a href="{{ url('social/media/edit/'.$row->id) }}" class="btn btn-info btn-sm "><i class="fa fa-edit fa-lg"></i></a>
                        <a href="{{ url('social/media/delete/'.$row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="70">No Data To Show</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
