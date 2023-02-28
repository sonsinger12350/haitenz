@extends('layouts.client.master')

@section('title') {{ $comic['name'] }} @endsection

@section('index')
<div id="page_comic">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">{{ $comic['name'].' '.$chapter['name'] }}</h3>
                <div class="web_breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('truyen',['slug'=>$comic['slug']]) }}">{{ $comic['name'] }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $chapter['name'] }}</li>
                        </ol>
                    </nav>
                </div>         
            </div>
        </div>
        <div class="comic_imgs text-center mt-4">
            @foreach($chapter['imgs'] as $img)
                <div class="comic_img">
                    <img src="{{ asset('upload/chapter/'.$img) }}" alt="{{ $comic['name'] }}" loading="lazy">
                </div>                
            @endforeach
        </div>
    </div>
</div>
@endsection