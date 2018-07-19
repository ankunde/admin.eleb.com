@extends('default')
@section('contents')
    <form action="{{route('users.update',[$user])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')
        <div class="form-group">
            <label for="shop_name">名称</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="shop_img">邮箱</label>
            <input type="email" class="form-control" id="shop_img" name="email" value="{{old('email')}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="password">密码</label>--}}
            {{--<input type="password" id="password" name="password">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="password">密码</label>--}}
            {{--<input type="password" id="password" name="password">--}}
        {{--</div>--}}
        <div class="form-group">
            状态:
            <label class="radio-inline">
                <input type="radio" name="status"  id="inlineRadio9" value="0"
                <?=$user->status?'':'checked'?>> 隐藏
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio10" value="1"
                <?=$user->status?'checked':''?>> 显示
            </label>
        </div>
        <div class="form-group">
            所属商家:
            <select class="form-control" name="shop_id">
                <option value="{{$user->shop_id}}">{{$user->shop_id}}</option>
                <option value="1">东</option>
                <option value="2">南</option>
                <option value="3">西</option>
                <option value="4">北</option>
                <option value="5">中</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@endsection

