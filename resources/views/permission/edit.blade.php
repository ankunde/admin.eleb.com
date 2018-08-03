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
    权限修改
@endsection
@section('contents')
    @include('_error')
    <form method="post" action="{{route('Permission.update',[$Permission])}}">
        {{csrf_field()}}
        {{method_field("PATCH")}}
        <div class="form-group">
            <label for="exampleInputEmail1">权限名</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$Permission->name}}">
        </div>
        <button type="submit" class="btn btn-default">确认修改</button>
    </form>
@endsection