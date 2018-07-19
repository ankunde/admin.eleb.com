@extends('default')
@section('contents')
    <form action="{{route('shopcategories.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">分类名</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="shop_im">分类图片</label>
            <input type="file" id="shop_im" name="img">
        </div>
        <div class="form-group">
            状态:
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio9" value="0"> 隐藏
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio10" value="1"> 显示
            </label>
        </div>
        <button type="submit" class="btn btn-default">添加</button>
    </form>
@endsection

