@extends('default')
@section('css_file')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
@endsection
@section('contents')
    <form action="{{route('eventprizes.update',[$eventprize])}}" method="post">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">活动名称</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{$eventprize->name}}">
        </div>

        <div class="form-group">
            <label for="container">活动内容</label>
            <script id="container"  name="description" type="text/plain">{!! $eventprize->description !!}</script>
        </div>
        <div class="form-group">
            <label for="shop_name">活动id</label>
            <select name="events_id" id="">
                <option value="{{$eventprize->events_id}}">{{$eventprize->event->title}}</option>
                @foreach($event as $value)
                    <option value="{{$value->id}}">{{$value->title}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">修改</button>
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