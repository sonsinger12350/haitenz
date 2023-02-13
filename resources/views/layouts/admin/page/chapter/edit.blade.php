@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sửa {{ $chapter['name'] }} cho truyện {{ $chapter['comic_chapter']['name'] }}</div> 
                <div class="card-body">
                    @if ( session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('chapter.update',[$chapter['id']])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="comic" value="{{ $chapter['comic_chapter']['id'] }}">
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ $chapter['name'] }}" name="name" id="name" autocomplete="off" placeholder="Tên truyện">
                            <label for="name">Tên chapter</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        
                        <div class="form-floating mb-4">          
                            <textarea name="desc" id="desc" class="form-control h-100 @error('desc') is-invalid @enderror" placeholder="Mô tả" rows="5" style="resize:none">{{ $chapter['desc'] }}</textarea>                 
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
                            @if(!empty($chapter['imgs']))
                                @foreach(explode(',',$chapter['imgs']) as $img)
                                    <img src="{{ asset('upload/chapter/'.$img) }}" alt="{{ $chapter['name'] }}" style="max-width: 100px">
                                @endforeach
                            @endif
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="show" name="show" value="1">
                            <label class="form-check-label" for="show">Hiển thị</label>
                        </div>
                        <div class="text-center"><button class="btn btn-primary" type="submit">Lưu</button></div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection