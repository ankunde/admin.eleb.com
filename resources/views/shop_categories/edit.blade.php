@extends('default')
@section('contents')
    <form action="{{route('shopcategories.update',[$shopcategory])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')
        <div class="form-group">
            <label for="shop_name">分类名</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{$shopcategory->name}}">
        </div>
        <div class="form-group">
            <label for="shop_im">分类图片</label>
            <input type="file" id="shop_im" name="img">
            <img width="100px" src="{{\Illuminate\Support\Facades\Storage::url($shopcategory->img)}}" alt="">
        </div>
        <div class="form-group">
            状态:
            <label class="radio-inline">
                <input type="radio" name="status"  id="inlineRadio9" value="0"
                <?=$shopcategory->status?'':'checked'?>> 隐藏
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio10" value="1"
                <?=$shopcategory->status?'checked':''?>> 显示
            </label>
        </div>
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@endsection

