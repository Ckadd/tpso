<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thank You</title>
    <link href="{{url('library/bootstrap-3.0.3/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{url('library/bootstrap-3.0.3/js/bootstrap.min.js')}}"></script>
    <script src="{{url('library/jquery-1.11.1.min.js')}}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 5%; text-align: center;">
        <div class="jumbotron text-xs-center">
            <h1 class="display-3">Thank You!</h1>
            <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
            <hr>
            <p>
                Having trouble? <a href="">Contact us</a>
            </p>
            <p class="lead">
                <button type="button" class="btn btn-primary btn-sm" role="button">
                    Continue to homepage
                </button>
            </p>
        </div>
    </div>
</div>

</body>
</html>
