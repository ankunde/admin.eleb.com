@extends('default')
@section("contents")
    @include('_error')
    <form action="{{route('admins.newpwd',$admin)}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="exampleInputFile">
        </div>
        <button type="submit" class="btn btn-default">确认重置</button>
    </form>
@endsection
