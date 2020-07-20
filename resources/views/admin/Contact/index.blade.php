@extends('layouts.dashboard_master')
@section('contact')
  active
@endsection

@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
      <span class="breadcrumb-item active">Contact Meassage</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-12">
          @if(session('contact_message'))
            <div class="alert alert-success">{{ session('contact_message') }}</div>
          @endif
          @if(session('contact_delete_message'))
            <div class="alert alert-warning">{{ session('contact_delete_message') }}</div>
          @endif
          <div class="card bd-0">
            <div class="card-header">
              <h5>Contact Messages</h5>
            </div>
            <div class="card-body bd bd-t-0 rounded-bottom">
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>SL. NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Active</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($messages as $message)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $message->name }}</td>
                      <td>{{ $message->email }}</td>
                      <td>{{ $message->subject }}</td>
                      <td>{{ $message->created_at->diffForHumans() }}</td>
                      <td>
                        @if($message->status == 1)
                          <span class="badge badge-pill badge-warning">Unseen</span>
                        @else
                          <span class="badge badge-pill badge-success">Seen</span>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          @if ($message->status == 1)
                            <a href="{{ url('contact/message/seen/'.$message->id) }}" class="btn btn-success">Seen</a>
                          @else
                            <a href="{{ url('contact/message/unseen/'.$message->id) }}" class="btn btn-info">Unseen</a>
                          @endif
                          <a href="{{ url('contact/message/view/'.$message->id) }}" class="btn btn-primary">View</a>
                          <a href="{{ url('contact/message/delete/'.$message->id) }}" class="btn btn-danger">Trashed</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card mt-5">
            <div class="card-header">
              <h5 class="text-danger">Trashed Messages</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>SL. NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Active</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($trashed_messages as $trashed_message)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $trashed_message->name }}</td>
                      <td>{{ $trashed_message->email }}</td>
                      <td>{{ $trashed_message->subject }}</td>
                      <td>
                        @if($trashed_message->status == 1)
                          <span class="badge badge-pill badge-warning">Unseen</span>
                        @else
                          <span class="badge badge-pill badge-success">Seen</span>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                          <a href="{{ url('contact/message/restore/'.$trashed_message->id) }}" class="btn btn-primary">Restore</a>
                          <a href="{{ url('contact/message/heard_delete/'.$trashed_message->id) }}" class="btn btn-danger">Delete</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
