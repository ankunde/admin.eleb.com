@extends('default')
@section('title')
    会员
@stop
@section('contents')
    <div class="container" style="margin-top: 10px;">
        @include('_error')
    </div>
    <div class="container" style="margin-top: 10px;">
        <form action="{{ route('member.index') }}" method="get" class="form">
            <div class="form-group">
                <input type="text" name="keyword" placeholder="输入会员名搜索" style="margin-right: 20px;">
                <input type="number" name="tel" placeholder="输入会员电话号码搜索" style="margin-right: 20px;">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-info btn-sm">开始搜索</button>
            </div>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>会员名</th>
                <th>电话号码</th>
                <th>注册时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            @foreach($member as $val)
                <tr>
                    <td>{{ $val->username }}</td>
                    <td>{{ $val->tel }}</td>
                    <td>{{ $val->created_at }}</td>
                    <td>{{ $val->status==0?'禁用':'正常' }}</td>
                    <td>
                            @if($val->status==0)
                                <a href="{{ route('member.status',[$val,'status'=>1]) }}" role="button" class="btn btn-success">启用</a>
                            @endif
                            @if($val->status==1)
                                <a href="{{ route('member.status',[$val,'status'=>0]) }}" role="button" class="btn btn-primary">禁用</a>
                            @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="text-align: center;">
            {{ $member->appends($where)->links() }}
        </div>
    </div>
@stop
