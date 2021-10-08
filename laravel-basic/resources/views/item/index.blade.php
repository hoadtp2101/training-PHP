@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">Item</p>
    <form action="" method="get">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên item:</label>
                    <input type="text" name="keyword" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Danh mục:</label>
                    <select name="cate_id" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($cate as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
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
                <th scope="col">cate_id</th>
                <th scope="col">user_id</th>
                <th>
                    <a href="{{route('add_item')}}" class="btn btn-outline-primary">Thêm mới</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($item as $i)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$i->name}}</td>
                <td>
                    @foreach($cate as $c)
                    @if($i->cate_id == $c->id)
                    {{$c->name}}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($user as $u)
                    @if($i->user_id == $u->id)
                    {{$u->name}}
                    @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{route('edit_item', ['item'=>$i->id])}}" class="btn btn-success">Sửa</a>
                    <a href="{{route('remove_item', ['id'=>$i->id])}}" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-6 offset-3 d-flex justify-content-center">
            {{$item->onEachSide(5)->links()}}
        </div>
    </div>
</div>
@endsection