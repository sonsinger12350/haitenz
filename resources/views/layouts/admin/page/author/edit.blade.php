@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sửa danh mục</div> 
                <div class="card-body">
                    @if ( session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('tac-gia.update',[$author['id']])}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-4">
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ $author['name'] }}" name="name" id="name" autocomplete="off" placeholder="Tên danh mục">
                            <label for="name">Tên danh mục</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        
                        <div class="form-check form-switch">
                            <input class="form-check-input" {{ $author['show'] == 1 ? 'checked' : ''}} type="checkbox" id="show" name="show" value="1">
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
