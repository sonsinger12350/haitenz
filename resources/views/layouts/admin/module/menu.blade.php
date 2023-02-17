<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{route('admin')}}">HaitenZ</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link {{Route::is('danh-muc.*') ? 'active' : '' }}" href="{{route('danh-muc.index')}}">Quản lí danh mục</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Route::is('truyen.*') || Route::is('chapter.*') ? 'active' : '' }}"  href="{{route('truyen.index')}}">Quản lí truyện</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Route::is('tac-gia.*') ? 'active' : '' }}"  href="{{route('tac-gia.index')}}">Quản lí tác giả</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>