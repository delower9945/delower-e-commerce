@extends('layouts.dashboard_master')
@section('testimonial')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">Testimonial List</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

        <div class="col-12">
          @if (session('testimonial_message'))
            <div class="alert alert-success">{{ session('testimonial_message') }}</div>
          @endif
          @if (session('testimonial_delete_message'))
            <div class="alert alert-warning">{{ session('testimonial_delete_message') }}</div>
          @endif
          <div class="card">
            <div class="card-header">
              Testimonial List
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Client Name</th>
                    <th>Client Working Position</th>
                    <th>Client Picture</th>
                    <th>Client Description</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($testimonials as $testimonial)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $testimonial->client_name }}</td>
                      <td>{{ $testimonial->client_working_position }}</td>
                      <td>
                        <img src="{{ asset('uploads/testimonial_images/'.$testimonial->client_picture) }}" width="100" height="100" alt="">
                      </td>
                      <td>{{ Str::limit($testimonial->client_description, 60) }}</td>
                      <td>{{ $testimonial->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('testimonial/show/'.$testimonial->id) }}" class="btn btn-info btn-sm "><i class="fa fa-eye fa-lg"></i></a>
                          <a href="{{ url('testimonial/edit/'.$testimonial->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit fa-lg"></i></a>
                          <a href="{{ url('testimonial/delete/'.$testimonial->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-lg"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mt-5">
            <div class="card-header text-danger">
              Trashed Testimonial List
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Client Name</th>
                    <th>Client Working Position</th>
                    <th>Client Picture</th>
                    <th>Client Description</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($delete_testimonials as $delete_testimonial)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $delete_testimonial->client_name }}</td>
                      <td>{{ $delete_testimonial->client_working_position }}</td>
                      <td>
                        <img src="{{ asset('uploads/testimonial_images/'.$delete_testimonial->client_picture) }}" width="100" height="100" alt="">
                      </td>
                      <td>{{ Str::limit($delete_testimonial->client_description, 60) }}</td>
                      <td>{{ $delete_testimonial->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a title="Restore" href="{{ url('testimonial/restore/'.$delete_testimonial->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plane fa-lg"></i></a>
                          <a title="Heard Delete" href="{{ url('testimonial/heard/delete/'.$delete_testimonial->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
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
