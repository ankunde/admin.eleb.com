@extends('default')
@section('css_file')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
@endsection
@section('contents')
    <form action="{{route('eventprizes.store')}}" method="post">
        {{csrf_field()}}
        @include('_error')
        <div class="form-group">
            <label for="password2">奖品名称</label>
            <input type="text" class="form-control" name="name" id="password2">
        </div>
        <div class="form-group">
            <label for="shop_name">活动id</label>
            <select name="events_id" id="">
                <option value="">请选择活动</option>
                @foreach($event as $value)
                <option value="{{$value->id}}">{{$value->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="container">奖品详情</label>
            <script id="container"  name="description" type="text/plain"></script>
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="shop_name">中奖商家账号id</label>--}}
            {{--<select name="member_id" id="">--}}
                {{--<option value="">活动id</option>--}}
            {{--</select>--}}
        {{--</div>--}}
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