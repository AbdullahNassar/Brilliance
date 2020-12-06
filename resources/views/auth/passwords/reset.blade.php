<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password</title>
    <link href="{{asset('vendors/site/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/site/css/icon.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/site/css/style.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('vendors/site/img/logo-fiv.png')}}" type="" sizes="16x16">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid remove-padding log-in-main">
        <div class="container remove-padding sub-login-page">
            <img src="{{asset('vendors/site/img/logo.png')}}">
            <div class="col-md-4 col-md-offset-4 col-sm-offset-3 col-xs-12 col-sm-6 log-form-main">
                <span class="icon-29envelope"></span>
                <h3>Reset Password</h3>
                <p>Enter your email address below, we’ll send email with instructions</p>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" name="email" value="{{ $email ?? old('email') }}" autocomplete="email">
                        <label> {{ __('E-Mail Address') }}</label>
                        <span class="focus-border"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="password" name="password">
                        <label> {{ __('Password') }}</label>
                        <span class="focus-border"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="password" name="password_confirmation">
                        <label> {{ __('Confirm Password') }}</label>
                        <span class="focus-border"></span>
                    </div>

                    <button type="submit">{{ __('Reset Password') }}</button>
                    <a href="{{ route('login') }}"><span class="icon-8arrowLeft"></span> Back to Login</a>
                </form>

            </div>

        </div>

    </div>

    <!-- header  -->

    <script src="{{asset('vendors/site/js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('vendors/site/js/bootstrap.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(window).load(function() {
                $(".col-3 input").val("");

                $(".input-effect input").focusout(function() {
                    if ($(this).val() != "") {
                        $(this).addClass("has-content");
                    } else {
                        $(this).removeClass("has-content");
                    }
                })
            });

        });
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>