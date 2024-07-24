@extends('layouts.dashapp')

@section('content')
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
            @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
            @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Login Form</h1>
                    
                    <div>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Log in</button>
                        @if (Route::has('password.request'))
                        <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                        @endif
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="{{ route('register') }}" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-graduation-cap"></i> Beverages Admin</h1>
                            <p>©2016 All Rights Reserved. Beverages Admin is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
