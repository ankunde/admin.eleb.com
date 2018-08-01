
@extends('default')
@section('title')
    订单统计
@stop
@section('contents')
    <div class="container" style="margin-top: 10px;">
        @include('_error')
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="margin-bottom: 10px;">
                <h1 style="text-align: center">只取商家订单量前10位</h1>
                <form action="{{ route('OrderDay') }}" method="get" style="text-align: right;">
                    <input type="date" name="day" style="margin-right: 20px;">
                    <button type="submit" class="button btn-info">开始搜索</button>
                </form>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <th>商家名</th>
                        <th>{{ substr($time,0,4) }}年{{ substr($time,5,2) }}月{{ substr($time,-2) }}日订单</th>
                    </tr>
                    @foreach($day as $val)
                        <tr>
                            <td>{{ $val->shop_name==null?'没有商家上榜':$val->shop_name }}</td>
                            <td>{{ $val->sum==null?0:$val->sum}}&nbsp;单</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                    <a href="{{ route('CountOrder') }}" class="btn btn-primary btn-lg" style="width: 200px;">返回</a>
                </div>
            </div>
        </div>
    </div>
@stop
