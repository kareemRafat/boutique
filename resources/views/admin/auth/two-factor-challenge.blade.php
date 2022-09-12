@extends('admin.auth.layouts.app')

@section('title')
    Confirm-Code
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>B</b>outique</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">you need to two-factor authentication code</p>
          <form action="{{ url('/two-factor-challenge') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input name="code" type="text"  class="form-control @error('code') is-invalid @enderror" placeholder="Code">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('code')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">confirm code</button>
              </div>
              <!-- /.col -->
              <div class="col-12">
                @if (session('status'))
                    <div class="mt-2 alert alert-default-success mb-4 font-medium text-sm">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
