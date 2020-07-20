@extends('layouts.dashboard_master')
@section('testimonial')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('testimonial/list') }}">Testimonial List</a>
    <span class="breadcrumb-item active">Show Testimonial</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-8 m-auto">

          <div class="card pd-20 pd-sm-40 mg-t-25">
            <div class="card-body-title mb-4">
              <img src="{{ asset('uploads/testimonial_images/'.$testimonial->client_picture) }}" alt="picture" class="img-fluid">
            </div>

          <dl class="row">
              <dt class="col-sm-4 tx-inverse">Client Name</dt>
              <dd class="col-sm-8">{{ $testimonial->client_name }}</dd>

              <dt class="col-sm-4 tx-inverse">Client Working Position</dt>
              <dd class="col-sm-8">
                <p>{{ $testimonial->client_working_position }}</p>
              </dd>

              <dt class="col-sm-4 tx-inverse">Client Description</dt>
              <dd class="col-sm-8">{{ $testimonial->client_description }}</dd>

          </dl>
        </div><!-- card -->

        </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
