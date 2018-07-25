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
            <th>状态</th>
            <th>查看</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>
                    <img width="100px" src=" {{$row->img}}" >
                </td>
                <td>{{$row->status}}</td>
                <td>
                    <a href="{{route('shopcategories.show',[$row])}}"><span class="
glyphicon glyphicon-search"></span></a>

                    <a href="{{route('shopcategories.edit',[$row])}}"><span class="glyphicon glyphicon-pencil"></span></a>

                    <form action="{{route('shopcategories.destroy',[$row->id])}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection


