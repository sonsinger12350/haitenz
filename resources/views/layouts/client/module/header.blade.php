<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <form class="header_search d-flex">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm truyện tranh" aria-label="Search">
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="menu d-none d-lg-block">
        <nav class="navbar navbar-expand-lg navbar-light h-100 py-0">
            <div class="container h-100 py-0">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Truyện tranh</a></li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-decoration-none" href="javascript:void(0)" id="dropdown_cat" data-bs-toggle="dropdown" aria-expanded="false">
                            Thể loại
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown_cat">
                                @foreach($cats as $v)
                                    <li class="text-start p-2"><a class="dropdown-item" href="{{ url('the-loai/'.Helper::slug($v['name'])) }}">{{ $v['name'] }}</a></li>
                                @endforeach                             
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">HOT</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Truyện mới cập nhật</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tin Tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('theo-doi') }}">Theo dõi</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>