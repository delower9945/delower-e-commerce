@extends('layouts.dashboard_master')
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('profile') }}">Dashboard</a>
    <span class="breadcrumb-item active">Profile</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

      <div class="col-6 m-auto">
        <div class="card">
          <div class="card-header">
            Profile
          </div>
          @if(session('profile_update'))
            <div class="alert alert-success mt-2">{{ session('profile_update') }}</div>
          @endif
          <div class="card-body">
              <form action="{{ url('profile/update') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" value="{{ Str::title(Auth::user()->name) }}" id="name" aria-describedby="emailHelp" placeholder="Enter Category Name..">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">update</button>
              </form>
          </div>
      </div>
    </div>

    </div><!-- row -->

    <div class="row row-sm">

      <div class="col-6 m-auto">
        <div class="card mt-5">
          <div class="card-header">
            Change Password
          </div>
          @if(session('change_password_message'))
            <div class="alert alert-success mt-2">{{ session('change_password_message') }}</div>
          @endif
          <div class="card-body">
            @if ($errors->all())
              <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif
              <form action="{{ url('profile/change/password') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" name="old_password" class="form-control" id="old_password" aria-describedby="emailHelp" placeholder="Enter Your Old Password">
                  @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Enter New password">
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="confirm_password" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
                  @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-warning">Change</button>
              </form>
          </div>
      </div>
    </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>







@endsection
