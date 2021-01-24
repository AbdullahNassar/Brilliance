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
</head>

<body>

    <div class="container-fluid remove-padding log-in-main">
        <div class="container remove-padding sub-login-page">
            <img src="{{asset('vendors/site/img/logo.png')}}">
            <div class="col-md-4 col-md-offset-4 col-sm-offset-3 col-xs-12 col-sm-6 log-form-main">
                <span class="icon-29envelope"></span>
                <h3>Reset Password</h3>
                <p>Enter your email address below, we’ll send email with instructions</p>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="col-3 input-effect">
                        <input type="text" name="email"  class="effect-16 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter E-mail Address...">
                        <span class="focus-border"></span>
                    </div>
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    <button type="submit">{{ __('Send Link') }}</button>
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