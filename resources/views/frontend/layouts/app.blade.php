<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Customer Area')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('frontend.layouts.header')
    <main class="content">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
</body>
</html>
