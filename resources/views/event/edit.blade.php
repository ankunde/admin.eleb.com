@extends('default')
@section('css_file')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
@endsection
@section('contents')
    <form action="{{route('events.update',[$event])}}" method="post">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">活动名称</label>
            <input type="text" class="form-control" name="title" id="shop_name" value="{{$event->title}}">
        </div>

        <div class="form-group">
            <label for="container">活动内容</label>
            <script id="container"  name="content" type="text/plain">{!! $event->content !!}</script>
        </div>
        <div class="form-group">
            <label for="password1">报名开始时间</label>
            <input type="datetime-local" class="form-control" name="signup_start" id="password1" value="{{date('Y-m-d\TH:i:s',strtotime($event->signup_start))}}">
        </div>
        <div class="form-group">
            <label for="password">报名结束时间</label>
            <input type="datetime-local" class="form-control" name="signup_end" id="password" value="{{date('Y-m-d\TH:i:s',strtotime($event->signup_end))}}">
        </div>
        <div class="form-group">
            <label for="password3">开奖日期</label>
            <input type="datetime-local" class="form-control" name="prize_date" id="password3" value="{{date('Y-m-d\TH:i:s',strtotime($event->prize_date))}}">
        </div>
        <div class="form-group">
            是否已开奖
            <input type="radio" checked  name="is_prize" value="0">否
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