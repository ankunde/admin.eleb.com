
@extends('default')
@section('title')
    菜品销量统计
@stop
@section('contents')
    <div class="container" style="margin-top: 10px;">
        @include('_error')
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 style="text-align: center">取所有商家菜品销量的前10位</h1>
                <div style="text-align: right;margin-bottom: 10px;">
                    <a href="{{ route('MenuMonth') }}" class="btn btn-info">按月统计</a>
                    <a href="{{ route('MenuDay') }}" class="btn btn-info">按具体日期统计</a>
                </div>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <th>菜品名</th>
                        <th>所属商家</th>
                        <th>今日销量</th>
                        <th>本月销量</th>
                        <th>总计</th>
                    </tr>
                    @foreach($menu as $k=>$v)
                        <tr>
                            <td>{{ $v->goods_name }}</td>
                            <td>{{ $v->shops->shop_name }}</td>
                            <td>{{ $v->day }}&nbsp;份</td>
                            <td>{{ $v->mouth }}&nbsp;份</td>
                            <td>{{ $v->count }}&nbsp;份</td>
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


