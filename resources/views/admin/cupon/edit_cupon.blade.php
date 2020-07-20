@extends('layouts.dashboard_master')
@section('category')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('cupon/add') }}">Add Cupon</a>
    <span class="breadcrumb-item active">{{ $cupon->cupon_name }}</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

    <div class="col-6 m-auto">
        <div class="card">
          <div class="card-header">
            Update Cupon
          </div>
          <div class="card-body">
            <form action="{{ url('cupon/update') }}" method="post">
              @csrf

              <input type="hidden" name="id" value="{{ $cupon->id }}">
              <div class="form-group">
                <label for="name">Cupon Name</label>
                <input type="text" name="cupon_name" value="{{ $cupon->cupon_name }}" class="form-control" id="name" placeholder="Enter Cupon Name..">
                @error ('cupon_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="discount_amount">Discount Amount (%)</label>
                <input type="text" name="discount_amount" value="{{ $cupon->discount_amount }}" class="form-control" id="discount_amount" placeholder="Enter Discount Amount">
                @error ('discount_amount')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="name">Validity Till</label>
                <input type="date" name="validity_till" value="{{ $cupon->validity_till }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" id="name" placeholder="Enter Validit Till..">
                @error ('validity_till')
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
</div>
@endsection
