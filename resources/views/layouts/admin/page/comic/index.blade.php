@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sánh truyện</div>

                <div class="card-body">                    
                    <a href="{{route('truyen.create')}}" class="btn btn-outline-primary">Thêm mới</a>
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
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Danh mục</th>
                                    <th>Hiển thị</th>
                                    <th style="width:100px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(empty($comic))
                                    <tr><td colspan="5" class="text-center">Không có dữ liệu</td></tr>
                                @else
                                @foreach($comic as $v)

                                    <tr>
                                        <td>{{ $v['id'] }}</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td><img src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}" style="max-width:100px"></td>
                                        <td>{{ $v['category']['name'] }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                @if($v['show']==1)
                                                    <input class="form-check-input" checked type="checkbox" id="show" name="show" value="0">
                                                @else
                                                <input class="form-check-input" type="checkbox" id="show" name="show" value="0">    
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('chapter.create',['id'=>$v['id']]) }}" class="btn btn-primary btn-sm me-2">Chapter</a>
                                                <a href="{{ route('truyen.edit',[$v['id']]) }}" class="btn btn-warning btn-sm me-2">Sửa</a>
                                                <form action="{{ route('truyen.destroy',[$v['id']]) }}" method="POST">
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
