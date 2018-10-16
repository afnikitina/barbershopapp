<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Bob's Barber Shop | @yield('title', 'Home Page') </title>
    </head>
    <body>
        <div class="container mt-5">
            @yield('content')
        </div>
    </body>
</html>