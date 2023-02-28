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

                <div class="d-flex comic">
                    <div class="comic_img me-4">
                        <img src="{{ asset('upload/comic/'.$comic['thumb']) }}" alt="{{ $comic['name'] }}">
                    </div>
                    <div class="comic_info">
                        <h3 class="mb-0">{{ $comic['name'] }}</h3>
                        <p class="small fst-italic">[Cập nhật lúc {{ Helper::dateTimeFormat($comic['updated_chapter']) }}]</p>
                        <p>Chapter mới nhất: @if(!empty($chapters[0]))<a href="{{ route('chapter',['slug'=>$chapters[0]['slug']]) }}" class="btn btn-sm btn-outline-primary btn-outline-web">Chapter {{ $comic['chapter'] }}</a>@endif</p>
                        <p>Tác giả: @if(!empty($comic['Author']))<a href="{{ url('tac-gia/'.$comic['Author']['slug']) }}">{{ $comic['Author']['name'] }}</a>@endif</p>
                        <p>Tình trạng: Đang cập nhật</p>
                        <p>Số chương: {{ $comic['chapter_amount'] }}</p>
                        <p>Lượt xem: {{ $comic['count_view'] }}</p>
                        <div class="d-flex mb-4">
                            <span class="me-2">Đánh giá:</span>
                            <div class="rating justify-start">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>                            
                        </div>
                        @if(!empty($comic['list_cat']))
                            <div class="mb-4">
                                @foreach($comic['list_cat'] as $v)
                                    <a href="{{ route('the-loai',['slug'=>$v['slug']]) }}" class="btn btn-sm btn-outline-primary btn-outline-web">{{ $v['name'] }}</a>    
                                @endforeach
                            </div>
                        @endif
                        <div class="comic_action mb-2">                            
                            <div class="justify-start">
                                <a href="#" class="btn btn-success me-2">Đọc từ đầu</a>
                                <a href="#" class="btn btn-primary me-4">Đọc mới nhất</a>
                                <div class="justify-start">
                                    <a href="javascript:void(0)" class="follow text-danger me-2" data-id="{{ $comic['id'] }}" data-follow="{{ in_array($comic['id'], $follow) ? 0 : 1 }}"><i class="fa-{{ in_array($comic['id'], $follow) ? 'solid' : 'regular' }} fa-heart"></i></a>
                                    <span><b>{{ Helper::numberFormat($comic['follow'] )}}</b> người đã theo dõi</span>
                                </div>
                            </div>
                        </div>
                        <p>{{ $comic['desc'] }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="color_main"><i class="fa-solid fa-list-ul"></i> Danh sách chapter</h3>
                    <div class="list_chapter shadow rounded border p-3">
                        @if($chapters->isEmpty())
                            <p class="mb-0 text-center" style="opacity:0.6">Đang cập nhật</p>
                        @else
                            @foreach($chapters as $v)
                            <a href="{{ route('chapter',['slug'=>$v['slug']]) }}" class="chapter justify-between">
                                <p class="mb-0">{{ $v['name'] }}</p>
                                <p class="mb-0">{{ Helper::dateFormat($v['created_at']) }}</p>
                            </a>
                            @endforeach                        
                        @endif
                        
                    </div>
                </div>
                @if(!$relate->isEmpty())
                    <div>                    
                        <h4 class="color_main">Truyện liên quan</h4>
                        <div class="swiper slide_comic_relate slide_comic">
                            <div class="swiper-wrapper">                            
                                @foreach($relate as $v)
                                    <div class="swiper-slide">
                                        <a href="{{ url('truyen/'.$v['slug']) }}" class="d-block comic">
                                            <div class="comic_thumb text-center mb-3">              
                                                <div class="comic_info d-flex">
                                                    <p class="mb-0 time me-2 bg-warning"><i class="fa fa-eye"></i> {{ $v['count_view'] }}</p>
                                                    <p class="mb-0 hot">Hot</p>
                                                </div>
                                                <img src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}">                                    
                                            </div>
                                            <h5 class="mb-0 text-center text-black fw-bold">{{ $v['name'] }}</h5>
                                            <p class="mb-0 text-center text-black">Chapter {{ $v['chapter'] }}</p>
                                        </a>                                    
                                    </div>
                                @endforeach                            
                            </div>
                        </div>
                    </div>
                @endif              
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function () {
        let swiper = new Swiper(".slide_comic_relate", {
            loop:true,
            speed:300,
            pagination: {
                clickable: true,
            },
            breakpoints: {
                480: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                1198: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
                1199: {
                    slidesPerView: 6,
                    spaceBetween: 10,
                }
            }
        });
    }, 500);    
</script>
@endsection