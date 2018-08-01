@extends('default')
@section('contents')
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>创建时间</th>
            <th>查看</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>
                    {{$row->create_time}}
                </td>
                <td>
                    {{--@can('9999')--}}
                    <a href="{{route('admins.edit',[$row])}}" class="btn btn-success btn-xs" role="button">修改</a>
                    {{--@endcan--}}

                    <form action="{{route('admins.destroy',[$row->id])}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: center">
                <a href="{{route('admins.create')}}"><span class="glyphicon glyphicon-tag">添加</span></a>
            </td>
        </tr>
    </table>
@endsection


