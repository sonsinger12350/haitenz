@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sánh chapter</div>

                <div class="card-body">                    
                    @if ( session('status'))
                        <span class="text-success my-2 d-block" role="alert">
                            {{ session('status') }}
                        </span>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>                                    
                                    <th>Truyện</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Hiển thị</th>
                                    <th style="width:100px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(empty($chapter))
                                    <tr><td colspan="5" class="text-center">Không có dữ liệu</td></tr>
                                @else
                                @foreach($chapter as $v)

                                    <tr>
                                        <td>{{ $v['id'] }}</td>
                                        <td>{{ $v['comic_chapter']['name'] }}</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td>
                                            @foreach(explode(',',$v['imgs']) as $img)
                                                <img src="{{ asset('upload/chapter/'.$img) }}" alt="{{ $v['name'] }}" style="max-width:50px">
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"{{$v['show']==1 ? 'checked' : ''}} type="checkbox" id="show" name="show" value="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('truyen.index',['id'=>$v['comic_chapter']['id']]) }}" class="btn btn-primary btn-sm me-2">Truyện</a>
                                                <a href="{{ route('chapter.edit',[$v['id']]) }}" class="btn btn-warning btn-sm me-2">Sửa</a>
                                                <form action="{{ route('chapter.destroy',[$v['id']]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm me-2" type="submit" onclick="return confirm('Bạn muốn xóa {{ $v['name'] }}');">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
