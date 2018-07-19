@extends('default')

@section('contents')
    <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('_error')
        <div class="form-group">
            <label for="shop_name">名称</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="shop_img">邮箱</label>
            <input type="email" class="form-control" id="shop_img" name="email">
        </div>
        <div class="form-group">
            <label for="password1">密码</label>
            <input type="password" class="form-control" name="password" id="password1">
        </div>
        <div class="form-group">
            <label for="password">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="password">
        </div>
        <button type="submit" class="btn btn-default">添加</button>
    </form>
@endsection



