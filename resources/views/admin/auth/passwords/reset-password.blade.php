@extends('admin.auth.layouts.app')

@section('title')
    Reset-password
@endsection


@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
          <form action="{{ route('password.update') }}" method="post">
            @csrf
            {{-- get the email and token form url --}}
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
            <div class="input-group mb-3">
              <input name="password"  type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
            <div class="input-group mb-3">
              <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="login.html">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
