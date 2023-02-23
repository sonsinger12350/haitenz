@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm chapter cho truyện {{ @$comic['name'] }}</div> 
                <div class="card-body">
                    @if ( session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('chapter.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="comic" value="{{ @$_GET['id'] }}">
                        <input type="hidden" name="comic_slug" value="{{ @$comic['slug'] }}">
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" autocomplete="off" placeholder="Tên truyện">
                            <label for="name">Tên chapter</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('chap')) ? old('chap') : $comic['chapter']+1 }}" name="chap" id="chap" autocomplete="off" placeholder="Chapter số">
                            <label for="name">Chapter số</label>
                            @error('chap')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <textarea name="desc" id="desc" class="form-control h-100 @error('desc') is-invalid @enderror" placeholder="Mô tả" rows="5" style="resize:none">{{ old('desc') }}</textarea>                 
                            <label for="desc">Mô tả</label>
                            @error('desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input class="form-control-file @error('imgs') is-invalid @enderror" name="imgs[]" type="file" multiple>
                            @error('imgs')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="show" name="show" value="1">
                            <label class="form-check-label" for="show">Hiển thị</label>
                        </div>
                        <div class="text-center"><button class="btn btn-primary" type="submit">Thêm</button></div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection