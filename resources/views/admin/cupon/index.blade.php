@extends('layouts.dashboard_master')
@section('cupon')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Add Cupon</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        @if(session('cupon_message'))
          <div class="col-12">
            <div class="alert alert-success">
              {{ session('cupon_message') }}
            </div>
          </div>
        @endif
        @if(session('cupon_delete_message'))
          <div class="col-12">
            <div class="alert alert-warning">
              {{ session('cupon_delete_message') }}
            </div>
          </div>
        @endif

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Cupon List
            </div>
            <div class="card-body">
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Cupon Name</th>
                    <th>Discount Amount</th>
                    <th>Validit Till</th>
                    <th>Validit Status</th>
                    <th>Create At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($cupons as $cupon)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $cupon->cupon_name }}</td>
                      <td>{{ $cupon->discount_amount }}%</td>
                      <td>{{ $cupon->validity_till }}</td>
                      <td>
                        @if ((\Carbon\Carbon::now()->format('Y-m-d')) <= $cupon->validity_till)
                          <span class="badge badge-success">ok</span>
                        @else
                          <span class="badge badge-danger">Not</span>
                        @endif
                      </td>
                      <td>{{ $cupon->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('cupon/edit') }}/{{ $cupon->id }}" class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                          <a href="{{ url('cupon/delete') }}/{{ $cupon->id }}" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></a>
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
            </div>
          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="card">
            <div class="card-header">
              Cupon List(<span class="text-danger">Deactive</span>)
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Cupon Name</th>
                    <th>Discount Amount</th>
                    <th>Validit Till</th>
                    <th>Validit Status</th>
                    <th>Create At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($delete_cupons as $delete_cupon)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $delete_cupon->cupon_name }}</td>
                      <td>{{ $delete_cupon->discount_amount }}%</td>
                      <td>{{ $delete_cupon->validity_till }}</td>
                      <td>
                        @if ((\Carbon\Carbon::now()->format('Y-m-d')) <= $delete_cupon->validity_till)
                          <span class="badge badge-success">ok</span>
                        @else
                          <span class="badge badge-danger">Not</span>
                        @endif
                      </td>
                      <td>{{ $delete_cupon->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('cupon/restore') }}/{{ $delete_cupon->id }}" class="btn btn-info">Restore</a>
                          <a href="{{ url('cupon/heard/delete') }}/{{ $delete_cupon->id }}" class="btn btn-danger">Hdelte</a>
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
            </div>
          </div>
        </div>


    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
