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
                    <form action="{{route('truyen.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" autocomplete="off" placeholder="Tên truyện">
                            <label for="name">Tên truyện</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">    
                            <select class="form-control @error('cat') is-invalid @enderror" name="cat[]" id="cat">
                                @foreach($cats as $v)
                                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                @endforeach
                            </select>                        
                            @error('cat')
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
                        <div class="form-floating mb-4">
                            <select name="author" id="author" class="form-select @error('author') is-invalid @enderror">
                                @foreach($authors as $v)
                                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="author">Tác giả</label>
                            @error('owner')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <select name="status" id="status" class="form-select">
                                <option value="0">Đang cập nhật</option>
                                <option value="1">Hoàn thành</option>
                                <option value="-1">Đã hủy</option>
                            </select>
                            <label for="status">Trạng thái</label>                            
                        </div>
                        <div class="mb-4">
                            <input class="form-control-file @error('thumb') is-invalid @enderror" value="{{ old('thumb') }}" name="thumb" type="file">
                            @error('thumb')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="show" name="show" value="1">
                            <label class="form-check-label" for="show">Hiển thị</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="hot" name="hot" value="1">
                            <label class="form-check-label" for="hot">Nổi bật</label>
                        </div>
                        <div class="text-center"><button class="btn btn-primary" type="submit">Thêm</button></div>
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
        $('#cat').val('').trigger('change');
    </script>
@endpush