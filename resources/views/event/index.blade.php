@extends('default')
@section('contents')
    {{--<ul class="nav nav-pills">--}}
        {{--<li role="presentation" class="active"><a href="{{route('activity.index',['keyword'=>0])}}">所有活动</a></li>--}}
        {{--<li role="presentation"><a href="{{route('activity.index',['keyword'=>1])}}">未开始</a></li>--}}
        {{--<li role="presentation"><a href="{{route('activity.index',['keyword'=>2])}}">正在进行中</a></li>--}}
        {{--<li role="presentation"><a href="{{route('activity.index',['keyword'=>3])}}">已结束</a></li>--}}
    {{--</ul>--}}
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>活动名称</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($event as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->title}}</td>
            <td>{{$value->signup_start}}</td>
            <td>{{$value->signup_end}}</td>
            <td>{{$value->prize_date}}</td>
            <td>{{$value->signup_num}}</td>
            <td>{{$value->is_prize?'是':'否'}}</td>
            <td>
                <a href="{{route('events.show',[$value])}}" class="btn btn-primary"><span class="
glyphicon glyphicon-search">查看</span></a>
                <a href="{{route('events.edit',[$value])}}" class="btn btn-info"><span class="glyphicon glyphicon-pencil">修改</span></a>
                @if(strtotime($value->prize_date)>=time())
                    <a href="{{route('events.lottery',[$value])}}" class="btn btn-warning"><span class="
glyphicon glyphicon-jpy">开奖</span></a>
                @endif
                <form action="{{route('events.destroy',[$value])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-warning "><span class="glyphicon glyphicon-remove">删除</span></button>
                </form>

            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7"><a href="{{route('events.create')}}">添加<span class="glyphicon glyphicon-plus"></span></a></td>
        </tr>

    </table>
{{--    {{$rows->links()}}--}}
@endsection
