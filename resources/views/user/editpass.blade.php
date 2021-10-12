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
                        <label>New password: </label>
                        <input type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label>Confirm: </label>
                        <input type="password" name="cf_password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        @endauth
    </div>
</div>
@endsection