<!doctype html>
<html>
<head>
    @include('layouts.inc-header')
    <style>
        html {
            height: 100%;
        }
    </style>
</head>
<body class="bg_intranet_login">
<div class="container-fluid">
    <section class="row wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 wrap_logo_login">
                    <img src="{{ThemeService::path('assets/images/intranet/intranet_login_logo.png')}}">
                </div>
                <form method="post" action="{{route('intranet.login')}}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <div class="bg_login">
                            <h1>WELCOME TO</h1>
                            <h2>DEPARTMENT OF TOURISM</h2>
                            <input class="input_user" type="text" name="username" placeholder="Username">
                            <input class="input_pass" type="password" name="password" placeholder="Password">
                            <div class="wrap_btn_forgetpass"><a class="btn_forgetpass" href="#">Forgot Password</a>
                            </div>
                            <div class="warp_btn_login">
                                <input type="submit" class="btn_login" value="Sign up">
                            </div>
                            @if (session('status'))
                                <div class="alert alert-danger" style="padding: 5px 10px; margin-top: 15px;">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        if (Modernizr.mq('(min-width: 991px)')) {
            var wdh = $(window).height();
            var lgh = $('.wrap_logo_login').height();
            var bglnh = $('.bg_login').outerHeight();
            $('.wrap_logo_login').css('margin-top', (wdh - lgh) / 2);
            $('.bg_login').css('margin-top', (wdh - bglnh) / 2);
        }
    });
</script>

</body>
</html>
