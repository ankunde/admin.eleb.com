@extends('default')
@section('css_file')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
@endsection
@section('contents')
    <form action="{{route('activity.store')}}" method="post">
        {{csrf_field()}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">活动名称</label>
            <input type="text" class="form-control" name="title" id="shop_name" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="container">活动内容</label>
            <script id="container"  name="content" type="text/plain"></script>
        </div>
        <div class="form-group">
            <label for="password1">开始时间</label>
            <input type="datetime-local" class="form-control" name="start_time" id="password1">
        </div>
        <div class="form-group">
            <label for="password">结束时间</label>
            <input type="datetime-local" class="form-control" name="end_time" id="password">
        </div>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection