@extends('default')
@section('contents')
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>名称</th>
            <th>路由</th>
            <th>操作</th>
        </tr>
        @foreach($nav_all as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->url}}</td>
                <td>

                    <a href="{{route('navs.edit',[$row])}}" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil">修改</span></a>
                    <a href="{{route('navs.destroy',[$row])}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-remove">删除</span></a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection