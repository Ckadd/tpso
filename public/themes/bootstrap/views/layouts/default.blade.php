<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Theme</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ Theme::path('assets/css/style.css') }}">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="theme">        
    @yield('content')
    
    <script src="{{ Theme::path('assets/js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>