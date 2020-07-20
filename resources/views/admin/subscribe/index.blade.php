@extends('layouts.dashboard_master')
@section('subscribe')
  active
@endsection
@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Subscriber</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-12">
        @if (session('message'))
          <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card mt-3">
          <div class="card-header">
            Subscribe List
          </div>
          <div class="card-body">
            <table class="table table-border table-responsive" id="datatable1">
              <thead>
                <tr>
                  <td>SL NO.</td>
                  <td>Email Address</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @forelse($subscribes as $row)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                      <div class="btn-group text-white" role="group" aria-label="Basic example">
                        <a href="{{ url('subscribe/delete/'.$row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
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
