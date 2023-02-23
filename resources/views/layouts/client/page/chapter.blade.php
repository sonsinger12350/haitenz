@extends('layouts.client.master')

@section('title') {{ $comic['name'] }} @endsection

@section('index')
<div id="page_comic">
    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="web_breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $comic['name'] }}</li>
                        </ol>
                    </nav>
                </div>                             
                               
            </div>
        </div>
    </div>
</div>
@endsection