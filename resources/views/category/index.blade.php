@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">Category</p>
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
                <th>
                    <a href="{{route('add_cate')}}" class="btn btn-outline-primary">Thêm mới</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($cate as $c)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$c->name}}</td>
                <td>
                    <a href="{{route('edit_cate', ['cate'=>$c->id])}}" class="btn btn-success">Sửa</a>
                    <a href="{{route('remove_cate', ['cate'=>$c->id])}}" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection