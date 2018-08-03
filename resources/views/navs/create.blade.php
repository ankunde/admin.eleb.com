@extends('default')
@section('css_file')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section('js_file')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@endsection
@section('contents')
    <form action="{{route('navs.store')}}" method="post">
        {{csrf_field()}}
        @include('_error')
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
        </div>

        <div class="form-group">
            <label for="url">地址:</label>
            <input type="text" class="form-control" name="url" id="url" value="{{old('url')}}">
        </div>

        <div class="form-group">
            权限列表:
            @foreach($permission as $value)
            <label class="checkbox-inline">
                <input type="radio" name="permission_id" value="{{$value->id}}"> {{$value->name}}
            </label>
            @endforeach
        </div>
        <div class="form-group">
        上级菜单id,菜单级别(1级菜单):
        <select class="form-control" name="pid">
            {{--@foreach($mc as $val)--}}
            <option value="0">顶级菜单</option>
            @foreach($navs as $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
            @endforeach
            {{--@endforeach--}}
        </select>
        </div>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection

