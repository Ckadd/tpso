<!DOCTYPE html>
<html>
<head>
    @include('layouts-internal.inc-header')
    @stack('css')
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>กรมการท่องเที่ยว</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container-fluid">

        @include('layouts-internal.inc-menu')
        @yield('content')
        @include('layouts.inc-footer')
    </div>
    @stack('scripts')

</body>
</html>