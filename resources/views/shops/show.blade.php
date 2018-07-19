@extends('default')
@section('contents')
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">小吃</a></li>
        <li role="presentation" ><a href="#">快餐</a></li>
        <li role="presentation"><a href="#">美食</a></li>
    </ul>

    <table class="table table-striped" width="80%">
        <tr>
            <th>信息</th>
            <th>商家</th>
        </tr>
        <tr>
            <td>编号</td>
            <td>{{$shop->id}}</td>
        </tr>
        <tr>
            <td>店铺分类ID</td>
            <td>{{$shop->shop_category_id}}</td>
        </tr>
        <tr>
            <td>名称</td>
            <td>{{$shop->shop_name}}</td>
        </tr>
        <tr>
            <td>店铺图片</td>
            <td>
                <img width="100px" src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}" >
            </td>
        </tr>
        <tr>
            <td>评分</td>
            <td>{{$shop->shop_rating}}</td>
        </tr>
        <tr>
            <td>是否品牌</td>
            <td>{{$shop->brand}}</td>
        </tr>
        <tr>
            <td>是否准时达</td>
            <td>{{$shop->on_time}}</td>
        </tr>
        <tr>
            <td>是否蜂鸟配送</td>
            <td>{{$shop->fengniao}}</td>
        </tr>
        <tr>
            <td>是否保标记</td>
            <td>{{$shop->bao}}</td>
        </tr>
        <tr>
            <td>是否标准达</td>
            <td>{{$shop->piao}}</td>
        </tr>
        <tr>
            <td>起送金额</td>
            <td>{{$shop->start_send}}</td>
        </tr>
        <tr>
            <td>配送费</td>
            <td>{{$shop->send_cost}}</td>
        </tr>
        <tr>
            <td>店公告</td>
            <td>{{$shop->notice}}</td>
        </tr>
        <tr>
            <td>优惠信息</td>
            <td>{{$shop->discount}}</td>
        </tr>
        <tr>
            <td>审核状态</td>

            <td>
                <form action="{{route('shops.stusta',[$shop])}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-warning btn-xs">点击审核通过</button>
                </form>
            </td>
        </tr>

    </table>
@endsection


