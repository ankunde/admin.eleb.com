@extends('default')
@section('contents')
    <table class="table table-striped" width="80%">
        <tr>
            <th>编号</th>
            <td>{{$eventprize->id}}</td>
        </tr>
        <tr>
            <th>活动id</th>
            <td>{{$eventprize->events_id}}</td>
        </tr>
        <tr>
            <th>奖品名称</th>
            <td>
                {{$eventprize->name}}
            </td>
        </tr>
        <tr>
            <th>奖品详情</th>
            <td>{!!$eventprize->description!!}</td>

        </tr>
        <tr>
            <th>中奖商家账号id</th>
            <td>{{$eventprize->member_id}}</td>
        </tr>
    </table>
@endsection


