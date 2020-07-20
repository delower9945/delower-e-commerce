@extends('layouts.dashboard_master')
@section('faq')
  active
@endsection
@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <span class="breadcrumb-item active">FAQ</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-12">
        <div class="float-right">
          <a href="{{ url('faq/add') }}" class="btn btn-success">Add FAQ</a>
        </div>
      </div>
      <div class="col-12">
        @if (session('faq_message'))
          <div class="alert alert-success">{{ session('faq_message') }}</div>
        @endif
        <div class="card mt-3">
          <div class="card-header">
            FAQ List
          </div>
          <div class="card-body">
            <table class="table table-border table-responsive">
              <thead>
                <tr>
                  <td>SL NO.</td>
                  <td>Question</td>
                  <td>Answer</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @forelse($faqs as $row)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $row->question }}</td>
                    <td>{{ Str::limit($row->answer,40) }}</td>
                    <td>
                      <div class="btn-group text-white" role="group" aria-label="Basic example">
                        <a href="{{ url('faq/edit/'.$row->id) }}" class="btn btn-info btn-sm "><i class="fa fa-edit fa-lg"></i></a>
                        <a href="{{ url('faq/delete/'.$row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="70" class="text-danger text-center">No Data To Show</td>
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
