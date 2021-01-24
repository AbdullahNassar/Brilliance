<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="{{asset('vendors/site/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/site/css/icon.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/site/css/style.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('vendors/img/favicon.png')}}" type="" sizes="16x16">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid remove-padding log-in-main">
        <img src="{{asset('vendors/site/img/1.png')}}">
        <div class="container remove-padding">
            <h1 class="have-account">Welcome Dear.</h1>
            <div class="col-md-5 col-sm-6 col-xs-12 welcome-screen">
                <div class="col-xs-12 remove-padding">
                    <h1>Welcome to Brilliance Business School</h1>
                    <p>Brilliance Business School is a prestigious management educational institution that offers a wide spectrum of business and management postgraduate programs in collaboration with international partners and global bodies.</p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-2 col-xs-12 col-sm-6 log-form-main">
                <div class="clearfix"></div>
                <img src="{{asset('vendors/img/logo.png')}}" style="max-width: 360px;">
                <h3>Sign in</h3>
                <form method="POST" id="login_form">
                    @csrf
                    <div class="col-3 input-effect">
                        <input type="text" class="effect-16 @error('email') is-invalid @enderror" type="text" placeholder="" id="email" name="email" value="{{ old('email') }}"  autocomplete="off" autofocus>
                        <label for="email">{{ __('Email') }}</label>
                        <span class="focus-border"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="col-3 input-effect">
                        <input class="effect-16 @error('password') is-invalid @enderror" type="password" placeholder="" id="password" name="password"  autocomplete="off">
                        <label for="password">{{ __('Password') }}</label>
                        <span class="focus-border"></span>
                        <div class="toggle-password" toggle="#password">Show</div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox-item">
                        <input class="inp-cbx" id="cbx1" type="checkbox" style="display: none;" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <label class="cbx" for="cbx1"><span><svg width="12px" height="10px" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></svg></span><span>{{ __('Remember Me') }}</span></label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-pass-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <div class="clearfix"></div>
                    <button type="submit">
                        {{ __('Login') }}
                    </button>

                </form>

                <!--<span class="or-span">or</span>

                <ul>
                    <li><a href="{{route('login.provider', ['provider' => 'facebook'])}}"><span class="icon-31facebook"></span> Use Facebook</a></li>
                    <li><a href="{{route('login.provider', ['provider' => 'google'])}}"><span class="icon-40google"></span> Use Google</a></li>
                </ul>-->

            </div>

        </div>

    </div>
    
    <script src="{{asset('vendors/site/js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('vendors/site/js/bootstrap.js')}}"></script>
    <script src="{{asset('vendors/toastr/toastr.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#login_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('login') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 15000});
                        window.location.href = "{{route('dashboard')}}"
                    },
                    error: function(data) { 
                        var error = data.responseJSON.errors;
                        $.each(error, function(k, v) {
                            toastr.error(v, 'Error!', {timeOut: 5000});
                        });
                    } 
                })
            });
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

            $.fn.toggleText = function(t1, t2) {
                if (this.text() == t1) this.text(t2);
                else this.text(t1);
                return this;
            };

            $(".toggle-password").click(function() {

                $(this).toggleText('Show', 'Hide');
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

        });
    </script>
</body>

</html>