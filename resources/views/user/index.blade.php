@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">User</p>
    <form action="" method="get">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Nhập từ khoá:</label>
                    <input type="text" name="keyword" class="form-control">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-sm btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <br>
    @if(session('msg'))
    <p class="text-danger">{{session('msg')}}</p>
    @endif
    <br>
    <table class="table">
        <thead>
            <tr class="table-info">
                <th scope="col">STT</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th>
                    <a href="{{route('add_user')}}" class="btn btn-outline-primary">Thêm mới</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $u)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>
                    <a href="{{route('remove_user', ['user'=>$u->id])}}" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-6 offset-3 d-flex justify-content-center">
            {{$user->onEachSide(5)->links()}}
        </div>
    </div>
</div>
@endsection