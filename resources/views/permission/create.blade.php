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
    权限添加
@endsection
@section('contents')
    @include('_error')
    <form method="post" action="{{route('Permission.store')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputEmail1">权限添加</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name')}}">
        </div>
        <button type="submit" class="btn btn-default">确认添加</button>
    </form>
@endsection