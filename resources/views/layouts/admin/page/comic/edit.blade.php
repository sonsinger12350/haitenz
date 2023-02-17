@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm truyện</div> 
                <div class="card-body">
                    @if ( session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('truyen.update',[$comic['id']])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ $comic['name'] }}" name="name" id="name" autocomplete="off" placeholder="Tên truyện">
                            <label for="name">Tên truyện</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">    
                            <select class="form-control @error('name') is-invalid @enderror" name="cat[]" id="cat">
                                @foreach($cats as $v)
                                    <option value="{{ $v['id'] }}" {{ $comic['cat']==$v['id'] ? 'selected' : ''}}>{{ $v['name'] }}</option>
                                @endforeach
                            </select>                        
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">          
                            <textarea name="desc" id="desc" class="form-control h-100 @error('desc') is-invalid @enderror" placeholder="Mô tả" rows="5" style="resize:none">{{ $comic['desc'] }}</textarea>                 
                            <label for="desc">Mô tả</label>
                            @error('desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        
                        <div class="mb-4">                            
                            <input class="form-control-file @error('thumb') is-invalid @enderror" name="thumb" type="file">
                            <img src="{{ asset('upload/comic/'.$comic['thumb']) }}" alt="{{ $comic['name'] }}" style="max-width: 100px">
                            @error('thumb')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ $comic['show']==1 ? 'checked' : ''}} type="checkbox" id="show" name="show" value="{{ $v['show']==0 ? 1 : 0 }}">
                            <label class="form-check-label" for="show">Hiển thị</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ $comic['hot']==1 ? 'checked' : ''}} type="checkbox" id="hot" name="hot" value="{{ $v['hot']==0 ? 1 : 0 }}">
                            <label class="form-check-label" for="hot">Nổi bật</label>
                        </div>
                        <div class="text-center"><button class="btn btn-primary" type="submit">Lưu</button></div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
    <script>
        $('#cat').select2({
            multiple: true,
            placeholder: 'Chọn danh mục',
            allowClear: true,                    
        });
        $('#cat').val('{{ $comic['cat'] }}').trigger('change');
    </script>
@endpush
