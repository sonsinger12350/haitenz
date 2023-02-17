<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- module head -->
        @include('layouts.client.module.head')

    </head>
    <body>

        <!-- module header -->
        @include('layouts.client.module.header')
        
        <!-- index -->
        @yield('index')

        <!-- module footer -->
        @include('layouts.client.module.footer')

    </body>
    <!-- module foot -->
    @include('layouts.client.module.foot')

</html>
