@extends('layouts.app')

@section('content')

    @include('layouts.admin.module.menu');

    <!-- content -->
    @yield('content');
    
@endsection