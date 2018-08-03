@extends('default')
@section('contents')
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>活动名称(id)</th>
            <th>商家账号(id)</th>
            <th>操作</th>
        </tr>
        @foreach($eventmember as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->event->title}}</td>
            <td>{{$value->user->name}}</td>
        </tr>
        @endforeach
    </table>
@endsection
