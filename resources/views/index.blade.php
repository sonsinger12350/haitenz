<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- module head -->
        @include('home.module.head')

    </head>
    <body>

        <!-- module header -->
        @include('home.module.header')

        <!-- index -->
        @yield('index');

        <!-- module footer -->
        @include('home.module.footer')

    </body>
    <!-- module foot -->
    @include('home.module.foot')

</html>
