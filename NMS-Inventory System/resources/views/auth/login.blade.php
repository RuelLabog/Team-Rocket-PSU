
@extends('layouts.apps')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="login"><b>TeamRocket</b>Inventory</a>
    </div>
    <!-- /.login-logo -->

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    <div class="input-group-append">

                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                        <!-- /.input-group-text -->
                    </div>
                    <!-- /. input-group-append -->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- /. input-group mb-3 -->

                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        <!-- /. input-group-text -->
                    </div>
                    <!-- /. input-group-append -->

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <!-- /. input-group mb-3 -->

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">

                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <!-- /.icheck-primary -->
                        </div>
                        <!-- /.col-8-->

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col-4 -->
                    </div>
                    <!-- /.row -->
            </form>



            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>

        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection
