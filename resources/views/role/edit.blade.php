@extends('default')
@section('css_file')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@endsection
@section('title')
    角色修改
@endsection
@section('contents')
    @include('_error')
    <form method="post" action="{{route('Role.update',[$Role])}}">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="exampleInputEmail1">角色名</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$Role->name}}">
        </div>
        <div class="form-group">
            @foreach($permission as $value)
            <input type="checkbox"  name="permission_id[]" {{$Role->hasPermissionTo($value)?'checked':''}} value="{{$value->id}}">{{$value->name}}
            @endforeach
        </div>
        <button type="submit" class="btn btn-default">确认添加</button>
    </form>
@endsection