@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">Item</p>
    <br>
    @if(session('msg'))
    <p class="text-danger">{{session('msg')}}</p>
    @endif
    <br>
    <div class="container">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{old('name')}}">               
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Cate_id</label>  
                <select name="cate_id" class="form-control" >
                    @foreach($cate as $c)
                    <option @if($c->id == old('cate_id')) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>           
                @error('cate_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>User_id</label>
                <select name="user_id" class="form-control" >
                    @foreach($user as $u)
                    <option @if($u->id == old('user_id')) selected @endif value="{{$u->id}}">{{$u->name}}</option>
                    @endforeach
                </select>             
                @error('user_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
@endsection