@extends('layouts.dashboard_master')
@section('faq')
  active
@endsection
@section('content')

  <!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ url('faq/list') }}">FAQ</a>
    <span class="breadcrumb-item active">FAQ Add</span>
  </nav>

  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-12">
        <div class="float-right">
          <a href="{{ url('faq/list') }}" class="btn btn-success">Back</a>
        </div>
      </div>
      <div class="col-6 m-auto">
        <div class="card mt-3">
          <div class="card-header">
            Edit FAQ
          </div>
          <div class="card-body">
            <form action="{{ url('faq/update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $faq->id }}">
              <div class="form-group">
                <label for="question">Question</label>
                <input type="text" name="question" value="{{ $faq->question }}" class="form-control" id="question">
                @error ('question')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="answer">Answer</label>
                <textarea name="answer" rows="5" class="form-control" id="answer">{{ $faq->answer }}</textarea>
                @error ('answer')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-success" name="button">update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
