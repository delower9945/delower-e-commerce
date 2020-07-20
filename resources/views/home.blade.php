@extends('layouts.dashboard_master')
@section('dashboard')
  active
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">

      <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h1>Welcome : {{ Auth::user()->name }}</h1>
                <h2>Email : {{ Auth::user()->email }}</h2>
                <h3>Total User: {{ $total_users }}</h3>
            </div>
          </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card">
              <div class="card-header">
                User List
              </div>
              <div class="card-body">
                <table class="table table-bordered" id="categore-Table">
                  <thead>
                    <tr>
                      <th>SL No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Create At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          {{ $user->created_at->format("d/m/Y  h:i:s a") }}
                          <br>
                          {{ $user->created_at->diffForHumans() }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $users->links() }}
              </div>

            </div>

          </div>

    </div><!-- row -->

  </div><!-- sl-pagebody -->
</div>


@endsection
