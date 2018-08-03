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
    <form action="{{route('navs.update',[$nav])}}" method="post">
        {{csrf_field()}}
        @include('_error')
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$nav->name}}">
        </div>

        <div class="form-group">
            <label for="url">地址:</label>
            <input type="text" class="form-control" name="url" id="url" value="{{$nav->url}}">
        </div>

        <div class="form-group">
            权限列表:
            @foreach($permission as $value)
                <label class="checkbox-inline">
                    <input type="radio" name="permission_id"
value="{{$value->id}}"{{$nav->permission_id==$value->id?'checked':''}}> {{$value->name}}
                </label>
            @endforeach
        </div>
        <div class="form-group">
            上级目录:
            <select class="form-control" name="pid">
                <option value="{{$nav->pid}}">
                    @if($pid_name)
                        {{$pid_name->name}}
                    @else
                        顶级分类
                    @endif
                </option>
                @foreach($navs as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection

