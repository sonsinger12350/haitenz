@extends('layouts.client.master')
@section('index')
<div class="container mt-4">
    <div class="row comic_new mb-4">
        <div class="col-md-3">
            <div>
                <a class="d-block comic mb-2" href="#" style="background-image: url({{ asset('upload/comic_new/truyen-spy-x-family.jpg') }})">
                    <div class="comic_chapter">Chương 1</div>
                    <h4 class="comic_title">Gia Đình Điệp Viên</h4>
                </a>
                <a class="d-block comic" href="#" style="background-image: url({{ asset('upload/comic_new/truyen-an-den-oan-tra-2.webp') }})">
                    <div class="comic_chapter">Chương 1</div>
                    <h4 class="comic_title">Ân Đền Oán Trả</h4>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <a class="d-block comic mb-2 h-100" href="#" style="background-image: url({{ asset('upload/comic_new/truyen-chuyen-tinh-xom-noi-tru.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                <h4 class="comic_title">Chuyện Tình Xóm Nội Trú</h4>
            </a>
        </div>
        <div class="col-md-3">
            <a class="d-block comic mb-2" href="#" style="background-image: url({{ asset('upload/comic_new/truyen-tro-choi-mao-hiem-1.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                <h4 class="comic_title">Trò Chơi Mạo Hiểm</h4>
            </a>
            <a class="d-block comic" href="#" style="background-image: url({{ asset('upload/comic_new/truyen-nguoi-di-khieu-goi.webp') }})">
                <div class="comic_chapter">Chương 1</div>
                <h4 class="comic_title">Người Dì Khiêu Gợi</h4>
            </a>
        </div>
    </div>
    <div>

        <div class="block-heading mb-4">
            <h2 class="mb-0 ps-2">Truyện Đề Cử</h2>
        </div>
        <div>
            <div class="swiper slide_comic_hint">
                <div class="swiper-wrapper">
                    @foreach($comic as $v)
                        <div class="swiper-slide">
                            <a href="#" class="d-block comic">
                                <div class="comic_thumb text-center mb-3">
                                    <img src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}">
                                </div>
                                <h5 class="mb-0 text-center text-black fw-bold">{{ $v['name'] }}</h5>
                                <p class="mb-0 text-center text-black">Chapter 1</p>
                            </a>
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    setTimeout(function () {
        let swiper = new Swiper(".slide_comic_hint", {
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