@extends('default')
@section('contents')
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>
                    <a href="{{route('Permission.edit',[$row])}}">修改</a>

                    {{--<form action="{{route('admins.pwd',[$row])}}" method="post">--}}
                        {{--{{csrf_field()}}--}}
                        {{--<button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-repeat"></span></button>--}}
                    {{--</form>--}}

                    <form action="{{route('Permission.destroy',[$row->id])}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a class="btn btn-primary btn-lg" href="{{route('Permission.create')}}" role="button">添加权限</a>
@endsection




