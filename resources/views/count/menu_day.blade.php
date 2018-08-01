@extends('default')
@section('title')
    菜品销量统计
@stop
@section('contents')
    <div class="container" style="margin-top: 10px;">
        @include('_error')
    </div>
    <div class="container">
        <div class="col-xs-12" style="margin-bottom: 10px;">
            <h1 style="text-align: center">取所有商家菜品销量的前10位</h1>
            <form action="{{ route('MenuMonth') }}" method="get" style="text-align: right;">
                {{--<select name="year" style="height: 26.5px;margin-right:20px;">--}}
                    {{--<option value="">请选择年</option>--}}
                    {{--@foreach($years as $val)--}}
                        {{--<option value="{{ $val }}">{{ $val }}年</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
                <select name="month" style="height: 26px;margin-right:20px;">
                    <option value="">请选择月份</option>
                    <option value="01">1月</option>
                    <option value="02">2月</option>
                    <option value="03">3月</option>
                    <option value="04">4月</option>
                    <option value="05">5月</option>
                    <option value="06">6月</option>
                    <option value="07">7月</option>
                    <option value="08">8月</option>
                    <option value="09">9月</option>
                    <option value="10">10月</option>
                    <option value="11">11月</option>
                    <option value="12">12月</option>
                </select>
                <button type="submit" class="button btn-info">开始搜索</button>
            </form>
        </div>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <tr>
                    <th>菜品名</th>
                    <th>所属商家</th>
                    {{--<th>{{ $year }}年{{ $month }}月销量</th>--}}
                </tr>
                {{--@foreach($menu as $value)--}}
                    {{--<tr>--}}
                        {{--<td>{{ $value->goods_name }}</td>--}}
                        {{--<td>{{ $value->shop_name }}</td>--}}
                        {{--<td>{{ $value->sum }}&nbsp;份</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            </table>
        </div>
        <div class="col-xs-12">

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;">
                <a href="{{ route('CountMenu') }}" class="btn btn-primary btn-lg" style="width: 300px;">返回</a>
            </div>
        </div>
    </div>
@stop

