@extends('layouts.client.master')

@section('title')Truyện đang theo dõi @endsection

@section('index')
<div class="container mt-4 follow_list comic_list" style="min-height: 65vh;">
    <div class="block-heading mb-4">
        <h2 class="mb-0 ps-2 cat_title">Truyện đang theo dõi</h2>
    </div>
    <div class="comic_list row">
        @if($comics->isEmpty())
            <div class="text-center">Không có dữ liệu.</div>
        @else
            @foreach($comics as $v)
                <div class="col-6 col-sm-3 col-md-2 mb-3 comic">
                    <a href="{{ url('truyen/'.$v['slug']) }}" class="d-block comic">
                        <div class="comic_thumb text-center mb-3">              
                            <div class="comic_info d-flex">
                                <p class="mb-0 time me-2">
                                    <time class="timeago" datetime="{{ Helper::dateTimeFormat($v['updated_at']) }}"></time>
                                </p>                                
                            </div>
                            <img src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}"> 
                            <a class="follow text-danger" data-id="{{ $v['id'] }}" data-follow="0" href="javascript:void(0)"><i class="fa-solid fa-heart"></i></a>                                   
                        </div>
                        <h5 class="mb-0 text-center text-black fw-bold">{{ $v['name'] }}</h5>
                        <p class="mb-0 text-center text-black">Chapter 1</p>
                    </a>                    
                </div>
            @endforeach
        @endif              
    </div>
</div>
@endsection