@extends('layouts.dashboard_master')

@section('contact')
  active
@endsection

@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
      <a class="breadcrumb-item" href="{{ url('contact/message/show') }}">Contact Messages</a>
      <span class="breadcrumb-item active">{{ $message->name }}</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-8 m-auto">
          <div class="card">
            <div class="card-body">
              <div class="row mt-3">
                <div class="col-3 text-success"><h6>Name</h6></div>
                <div class="col-9">{{ $message->name }}</div>
              </div>
              <div class="row mt-3">
                <div class="col-3 text-success"><h6>Email Address</h6></div>
                <div class="col-9">{{ $message->email }}</div>
              </div>
              <div class="row mt-3">
                <div class="col-3 text-success"><h6>Subject</h6></div>
                <div class="col-9">{{ $message->subject }}</div>
              </div>
              <div class="row mt-3">
                <div class="col-3 text-success"><h6>Message</h6></div>
                <div class="col-9">{{ $message->message }}</div>
              </div>

            </div>
            <div class="card-footer">
              <a href="{{ url('contact/message/show') }}" class="btn btn-primary float-right">ok</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
