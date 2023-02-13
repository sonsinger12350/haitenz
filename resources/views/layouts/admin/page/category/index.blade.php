@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh mục truyện</div>

                <div class="card-body">                    
                    <a href="{{route('danh-muc.create')}}" class="btn btn-outline-primary">Thêm mới</a>
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
                                    <th>Slug</th>
                                    <th>Hiển thị</th>
                                    <th style="width:1px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cats as $v)
                                    <tr>
                                        <td>{{ $v['id'] }}</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td>{{ $v['slug'] }}</td>
                                        <td>
                                            <div class="form-check form-switch">                                                
                                                <input class="form-check-input update_show"{{ $v['show']==1 ? 'checked' : '' }} id="show" name="show" data-id="{{ $v['id'] }}" value="{{ $v['show']==0 ? 1 : 0 }}" type="checkbox">    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('danh-muc.edit',[$v['id']]) }}" class="btn btn-warning btn-sm me-2">Sửa</a>
                                                <form action="{{ route('danh-muc.destroy',[$v['id']]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm me-2" type="submit" onclick="return confirm('Bạn muốn xóa danh mục {{ $v['name'] }}');">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
        $('body').on('click','.update_show',function(){
            let input = $(this);
            let show = input.val();            
            let id = input.attr('data-id');
            $.ajax({    
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update-cat/' + id,
                type:"PUT",
                data:{show},
                success:function(rs){
                    if(rs.status==200){
                        input.val(show==1 ? 0 : 1);
                        toastr.success(rs.message);
                    }else{
                        toastr.error(rs.message);
                    }                    
                }
            });
        });
    </script>
@endpush
