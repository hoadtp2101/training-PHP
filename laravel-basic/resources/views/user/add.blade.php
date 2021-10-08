@extends('layout.main')
@section('content')
<div class="wrapper">
    <p class="text-uppercase text-center p-2 fw-bold" style="font-size: 30px;">User</p>
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
                <label>Email</label>
                <input type="text" name="email" value="{{old('email')}}">               
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="{{old('password')}}">               
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
@endsection