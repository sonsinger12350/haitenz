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
                                    <th>Nổi bật</th>
                                    <th style="width:100px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if($comic->isEmpty())
                                    <tr><td colspan="5" class="text-center">Không có dữ liệu</td></tr>
                                @else
                                    @foreach($comic as $v)
                                        <tr>
                                            <td>{{ $v['id'] }}</td>
                                            <td>{{ $v['name'] }}</td>
                                            <td><img src="{{ asset('upload/comic/'.$v['thumb']) }}" alt="{{ $v['name'] }}" style="max-width:100px"></td>
                                            <td>{{ implode(',',$v['cat_name']) }}</td>
                                            <td>
                                                <div class="form-check form-switch">                                                
                                                    <input class="form-check-input update_comic" {{$v['show']==1 ? 'checked' : ''}} data-id="{{ $v['id'] }}" name="show" value="{{ $v['show']==0 ? 1 : 0 }}" type="checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">                                                
                                                    <input class="form-check-input update_comic" {{$v['hot']==1 ? 'checked' : ''}} data-id="{{ $v['id'] }}" name="hot" value="{{ $v['hot']==0 ? 1 : 0 }}" type="checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('chapter.index',['id'=>$v['id']]) }}" class="btn btn-primary btn-sm me-2 position-relative">
                                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                            {{ $v['count_chapter'] }}
                                                        </span>
                                                        Chapter
                                                    </a>
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
@push("js")
    <script>
        $('body').on('click','.update_comic',function(){
            let input = $(this);
            let val = input.val();            
            let id = input.attr('data-id');
            let column = input.attr('name');
            if( val != '' && id != '' && column != ''){
                $.ajax({    
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'update-comic/' + id,
                    type:"PUT",
                    data:{column,val},
                    success:function(rs){
                        if(rs.status==200){
                            input.val(val==1 ? 0 : 1);
                            toastr.success(rs.message);
                        }else{
                            toastr.error(rs.message);
                        }                    
                    }
                });
            }
            
        });
    </script>
@endpush