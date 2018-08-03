@extends('default')
@section('contents')
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>活动id</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($eventprize as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->events_id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->description}}</td>
            <td>{{$value->member_id}}</td>
            <td>
                <a href="{{route('eventprizes.show',[$value])}}" class="btn btn-primary"><span class="
glyphicon glyphicon-search">查看</span></a>
                <a href="{{route('eventprizes.edit',[$value])}}" class="btn btn-info"><span class="glyphicon glyphicon-pencil">修改</span></a>
                <form action="{{route('eventprizes.destroy',[$value])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-warning "><span class="glyphicon glyphicon-remove">删除</span></button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            {{--<td colspan="7"><a href="{{route('eventprizes.create')}}">添加<span class="glyphicon glyphicon-plus"></span></a></td>--}}
        </tr>

    </table>
{{--    {{$rows->links()}}--}}
@endsection
