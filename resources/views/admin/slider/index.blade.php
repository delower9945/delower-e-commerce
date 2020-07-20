@extends('layouts.dashboard_master')
@section('slider')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Slider List</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
        @if (session('slider_message'))
          <div class="col-12">
            <div class="alert alert-success">{{ session('slider_message') }}</div>
          </div>
        @endif
        <div class="col-12">
          <div class="card bd-0">
            <div class="card-header card-header-default">
              Slider List
            </div>
            <div class="card-body bd bd-t-0 rounded-bottom">
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Slider Title</th>
                    <th>Slider Picture</th>
                    <th>Slider Description</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sliders as $slider)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $slider->slider_title }}</td>
                      <td>
                        <img src="{{ asset('uploads/slider_images') }}/{{ $slider->slider_picture }}" width="100" alt="picture">
                      </td>
                      <td>{{ $slider->slider_description }}</td>
                      <td>{{ $slider->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn text-success"><i class="fa fa-edit fa-2x"></i></a>
                          <a href="{{ url('slider/delete/'.$slider->id) }}" class="btn text-danger"><i class="fa fa-trash fa-2x"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>


    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>

@endsection
