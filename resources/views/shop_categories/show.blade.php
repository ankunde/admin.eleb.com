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
            <th>分类名称</th>
            <th>分类图片</th>
            <th>审核状态</th>
        </tr>
            <tr>
                <td>{{$shopcategory->id}}</td>
                <td>{{$shopcategory->name}}</td>
                <td>
                    <img width="100px" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}" >
                </td>
                <td>{{$shopcategory->status}}</td>
            </tr>
        
    </table>
@endsection


