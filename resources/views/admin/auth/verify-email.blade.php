@extends('admin.auth.layouts.app')

@section('title')
    Email Verification
@endsection

@section('content')
<body class="hold-transition login-page">
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 alert alert-default-success">
            A new email verification link has been emailed to you!
        </div>
    @endif
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>B</b>outique</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Before proceeding, please check your email for a verification link.</p>
          <p class="login-box-msg">If you did not receive the email</p>
          <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">click here to request another</button>
              </div>
              <!-- /.col -->
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
