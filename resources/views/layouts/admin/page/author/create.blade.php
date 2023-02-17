@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm tác giả</div> 
                <div class="card-body">
                    @if ( session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('tac-gia.store')}}" method="POST">
                        @csrf
                        <div class="form-floating mb-4">                            
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" autocomplete="off" placeholder="Tên tác giả">
                            <label for="name">Tên tác giả</label>
                            @error('name')
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
