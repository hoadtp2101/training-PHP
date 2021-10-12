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
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" name="name" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label>Email: </label>
                        <input type="text" name="email" value="{{$user->email}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        @endauth
    </div>
</div>
@endsection