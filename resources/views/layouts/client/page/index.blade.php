@extends('layouts.client.master')

@section('title') {{ config('app.name') }} @endsection

@section('index')
<div class="container mt-4">
    <div class="row comic_new mb-4">
        <div class="col-md-3">
            <div>
                <a class="d-block comic mb-2" href="{{ url('truyen/gia-dinh-diep-vien') }}" style="background-image: url({{ asset('upload/comic_new/truyen-spy-x-family.jpg') }})">
                    <div class="comic_chapter">Chương 1</div>
                    <h4 class="comic_title">Gia Đình Điệp Viên</h4>
                </a>
                <a class="d-block comic" href="{{ url('truyen/an-den-oan-tra') }}" style="background-image: url({{ asset('upload/comic_new/truyen-an-den-oan-tra-2.webp') }})">
                    <div class="comic_chapter">Chương 1</div>
                    <h4 class="comic_title">Ân Đền Oán Trả</h4>
                </a>
            </div>
        </div>
        <div class="col-md-6 comic_hover">
            <a class="d-block comic mb-2 h-100" href="{{ url('truyen/chuyen-tinh-xom-noi-tru') }}" style="background-image: url({{ asset('upload/comic_new/truyen-chuyen-tinh-xom-noi-tru.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                
                <h4 class="comic_title">
                    <p class="mb-0 category">Thể loại: Adult, Manhwa 18+, Drama</p>
                    Chuyện Tình Xóm Nội Trú
                </h4>
                <p class="desc mb-0">Nhật Ký Nội Trú là bộ truyện tranh người lớn 18+ Hàn Quốc kể về đời sống tình cảm của cậu sinh viên mới lớn tên Kim Jun Woo. Bước vào đời sống ở trọ, anh chàng này may mắn gặp ngay chị chủ nhà xinh đẹp tên Cho Min Kyung. Vì là truyện 18+ nên sẽ không thiếu những cảnh nóng mặt đâu, còn có NTR không thì chờ bạn khám phá ah. </p>
            </a>
        </div>
        <div class="col-md-3">
            <a class="d-block comic mb-2" href="{{ url('truyen/tro-choi-mao-hiem') }}" style="background-image: url({{ asset('upload/comic_new/truyen-tro-choi-mao-hiem-1.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                <h4 class="comic_title">Trò Chơi Mạo Hiểm</h4>
            </a>
            <a class="d-block comic" href="{{ url('truyen/nguoi-di-khieu-goi') }}" style="background-image: url({{ asset('upload/comic_new/truyen-nguoi-di-khieu-goi.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                <h4 class="comic_title">Người Dì Khiêu Gợi</h4>
            </a>
        </div>
    </div>
    <div class="mb-4">
        <div class="block-heading mb-4">
            <h2 class="mb-0 ps-2">Truyện Đề Cử</h2>
        </div>
        <div class="slide_comic">
            <div class="swiper slide_comic_hot">
                <div class="swiper-wrapper">
                    @foreach($comic_hot as $v)
                        <div class="swiper-slide">
                            <a href="{{ url('truyen/'.$v['slug']) }}" class="d-block comic">
                                <div class="comic_thumb text-center mb-3">              
                                    <div class="comic_info d-flex">
                                        <p class="mb-0 time me-2">
                                            <time class="timeago" datetime="{{ Helper::dateTimeFormat($v['updated_chapter']) }}"></time>
                                        </p>
                                        <p class="mb-0 hot">Hot</p>
                                    </div>
                                    <img loading="lazy" src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}">                                    
                                </div>
                                <h5 class="mb-0 text-center text-black fw-bold">{{ $v['name'] }}</h5>
                                <p class="mb-0 text-center text-black">Chapter {{ $v['chapter'] }}</p>
                            </a>
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="block-heading mb-4">
            <h2 class="mb-0 ps-2">Truyện Mới Cập Nhật</h2>
        </div>
        <div class="comic_list row">            
            @foreach($comic as $v)
                <div class="col-6 col-sm-3 col-md-2 mb-3">
                    <a href="{{ url('truyen/'.$v['slug']) }}" class="d-block comic">
                        <div class="comic_thumb text-center mb-3">              
                            <div class="comic_info d-flex">
                                <p class="mb-0 time me-2">
                                    <time class="timeago" datetime="{{ Helper::dateTimeFormat($v['updated_chapter']) }}"></time>
                                </p>
                            </div>
                            <img loading="lazy" src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}">                                    
                        </div>
                        <h5 class="mb-0 text-center text-black fw-bold">{{ $v['name'] }}</h5>
                        <p class="mb-0 text-center text-black">Chương {{ $v['chapter'] }}</p>
                    </a>                    
                </div>
            @endforeach                
        </div>
    </div>
</div>
<script>
    setTimeout(function () {
        let swiper = new Swiper(".slide_comic_hot", {
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