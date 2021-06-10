<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('layouts.header')
    @yield('css')
</head>
<body>

    @yield('content')

    @include('layouts.footer')

    @yield('js')

</body>
</html>