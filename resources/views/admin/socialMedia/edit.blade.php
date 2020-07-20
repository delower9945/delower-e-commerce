@extends('layouts.dashboard_master')
@section('social_media')
  active
@endsection
@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('social/media') }}">Socail Medial</a>
    <span class="breadcrumb-item active">Social Media Edit</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-12">
        <div class="float-right">
          <a href="{{ url('social/media') }}" class="btn btn-success">Back</a>
        </div>
      </div>
      <div class="col-6 m-auto">
        <div class="card mt-3">
          <div class="card-header">
            Add Social Media
          </div>
          <div class="card-body">
            <form action="{{ url('social/media/update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id }}">
              <div class="form-group">
                <label for="icon_name">Social Icon Name</label>
                <input type="text" name="icon_name" value="{{ $item->icon_name }}" class="form-control" id="icon_name">
                @error ('icon_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="name">Social Media Link</label>
                <input type="text" name="social_media_link" value="{{ $item->social_media_link }}" class="form-control" id="name">
                @error ('social_media_link')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-success" name="button">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
