@extends('admin.auth.layouts.app')

@section('title')
    Confirm-Password
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>B</b>outique</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">you need to confirm password</p>
          <form action="{{ route('password.confirm') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input name="password" type="password"  class="form-control @error('password') is-invalid @enderror" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('password')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">confirm password </button>
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
