
@extends('admin.auth.layouts.app')


@section('title')
    Login
@endsection


@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="/admin" class="h1"><b>B</b>outique</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
                @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="input-group mb-3">
              <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} name="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mt-2 mb-3">

          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="{{ route('password.request') }}">I forgot my password</a>
          </p>
          <p class="mb-1 font-weight-bold">
            <a href="{{ route('register') }}" class="text-center">Register new Admin</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
@endsection
