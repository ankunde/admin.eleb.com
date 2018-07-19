@extends('default')
@section('contents')
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">小吃</a></li>
        <li role="presentation" ><a href="#">快餐</a></li>
        <li role="presentation"><a href="#">美食</a></li>
    </ul>

    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>店铺分类ID</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>审核状态</th>
            <th>查看</th>
        </tr>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->shop_category_id}}</td>
            <td>{{$row->shop_name}}</td>
            <td>
                <img width="100px" src=" {{\Illuminate\Support\Facades\Storage::url($row->shop_img)}}" >
            </td>
            <td>{{$row->shop_rating}}</td>
            <td><?=$row->status?'审核通过':'审核中'?></td>
            <td>
                <a href="{{route('shops.show',[$row])}}"><span class="
glyphicon glyphicon-search"></span></a>|
                <a href="{{route('shops.edit',[$row->id])}}" class="glyphicon glyphicon-pencil"></a>|
                <form action="{{route('shops.destroy',[$row->id])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7"><a href="{{route('shops.create')}}">添加<span class="glyphicon glyphicon-plus"></span></a></td>
        </tr>
    </table>
@endsection
