@extends('admin.auth.layouts.app')

@section('title')
    Confirm-Code
@endsection

@section('css-section')
    <style>
        .recovery-code-box {
            display: none;
        }
    </style>
@endsection


@section('content')

    <body class="hold-transition login-page">
        <div class="login-box ">
            <div class="card card-outline card-primary code-box">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>B</b>outique</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">you need to two-factor authentication <span class="font-weight-bold">code</span></p>
                    <form action="two-factor-challenge" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                placeholder="Code">
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
                                <p class="my-2">
                                    <a href="#" class="text-center recovery-code-btn">use recovery codes</a>
                                </p>
                            </div>

                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <br>
        <div class=" recovery-code-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>B</b>outique</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">you need to two-factor authentication <span class="font-weight-bold">recovery code</span></p>
                    <form action="two-factor-challenge" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="recovery_code" type="text"
                                class="form-control @error('recovery_code') is-invalid @enderror" placeholder="Recovery code">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('recovery_code')
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
                                <p class="my-2">
                                    <a href="#" class="text-center code-btn">use codes</a>
                                </p>
                            </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    @endsection

    @push('custom-auth-scripts')
        <script>
            $('.recovery-code-btn').on('click',  function(event) {
                event.preventDefault();
                $('.code-box').fadeOut(1000 , function(){
                    $('.recovery-code-box').fadeIn(1000);
                });
            })

            $('.code-btn').on('click',  function(event) {
                event.preventDefault();
                $('.recovery-code-box').fadeOut(1000 , function(){
                    $('.code-box').fadeIn(1000);
                });
            })
        </script>
    @endpush
