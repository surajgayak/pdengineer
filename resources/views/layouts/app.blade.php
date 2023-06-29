<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('frontend.include.head')

<body class="antialiased bg-blue-500">
    @yield('content')
</body>

</html>
