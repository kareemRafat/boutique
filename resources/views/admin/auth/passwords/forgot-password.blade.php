@extends('admin.auth.layouts.app')

@section('title')
    Forgot-Password
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>B</b>outique</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
          <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input name="email" type="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
              </div>
              <!-- /.col -->
              <div class="col-12">
                @if (session('status'))
                    <div class="mt-2 alert alert-success mb-4 font-medium text-sm">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
          </form>
          <p class="mt-3 mb-1">
            <a href="{{ route('login') }}">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
@endsection
