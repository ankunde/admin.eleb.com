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
                <div style="text-align: right;">
                    <a href="{{ route('OrderMonth') }}" class="btn btn-info">按月统计</a>
                    <a href="{{ route('OrderDay') }}" class="btn btn-info">按具体日期统计</a>
                </div>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <th>商家名</th>
                        <th>今日订单</th>
                        <th>本月订单</th>
                        <th>总计</th>
                    </tr>
                    @foreach($shop as $k =>$val)
                        <tr>
                            <td>{{ $val->shop_name }}</td>
                            <td>{{ $val->day }}&nbsp;单</td>
                            <td>{{ $val->mouth }}&nbsp;单</td>
                            <td>{{ $val->count }}&nbsp;单</td>
                        </tr>
                        @if($k==9)
                            @break
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                </div>
            </div>
        </div>
    </div>
@stop
