@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">Infomation</p>
    <br>
    @if(session('msg'))
    <p class="text-danger">{{session('msg')}}</p>
    @endif
    <br>
    <div class="container">
        @auth
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3">
                <img src="{{asset('lte3/dist/img/user.jpg')}}" class="">
            </div>
            <div class="col-6">
                <br><br><br>
                <label>Name: </label>
                <span>{{Auth::user()->name}}</span> <br>

                <label>Email: </label>
                <span>{{Auth::user()->email}}</span> <br>

                <label>Role: </label>
                <span>
                    @if(Auth::user()->role == 1)
                    Nhân viên
                    @elseif(Auth::user()->role == 0)
                    admin
                    @endif
                </span> <br><br><br>

                <a href="{{route('edit_info', ['id' => Auth::user()->id])}}" class="btn btn-success">Edit</a>
                <a href="{{route('edit_pass', ['id' => Auth::user()->id])}}" class="btn btn-info">Đổi mật khẩu</a>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection