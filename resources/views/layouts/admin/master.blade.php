<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- module head -->
    @include('layouts.admin.module.head')

    @stack("css")
    
</head>
<body>
    <div id="app">

        <!-- module header -->
        @include('layouts.admin.module.header')

        @guest
        
        @else
           <!-- module menu -->
            @include('layouts.admin.module.menu')
        @endguest
        
        <main class="py-4">
            @yield('content')
            @stack("js")
        </main>
    </div>
</body>
</html>
