@extends('default')
@section('contents')
    <form action="{{route('shops.update',[$shop])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        @include('_error')
        店铺分类选择:
        <select class="form-control" name="shop_category_id">
            <option value="{{$shop->shop_category_id}}">{{$shop->shop_category_id}}</option>
            <option value="1">美食</option>
            <option value="2">快餐</option>
            <option value="3">下午茶</option>
            <option value="4">大牌5折</option>
            <option value="5">小吃</option>
        </select>

        <div class="form-group">
            <label for="shop_name">店名</label>
            <input type="text" class="form-control" name="shop_name" id="shop_name" value="{{$shop->shop_name}}">
        </div>
        <div class="form-group">
            <label for="shop_im">商品图片</label>
            <input type="file" id="shop_im" name="shop_img">
            <img src="{{ \Illuminate\Support\Facades\Storage::url( $shop->shop_img)}}" alt="">
        </div>
        <div class="form-group">
            是否是品牌:
            <label class="radio-inline">
                <input type="radio" name="brand" id="inlineRadio1" value="0"<?=$shop->brand?'':'checked'?>> 不是
            </label>
            <label class="radio-inline">
                <input type="radio" name="brand" id="inlineRadio2" value="1" <?=$shop->brand?'checked':''?>> 是
            </label>
        </div>
        <div class="form-group">
            是否准时达:
            <label class="radio-inline">
                <input type="radio" name="on_time" id="inlineRadio3" value="0" <?=$shop->on_time?'':'checked'?>> 不是
            </label>
            <label class="radio-inline">
                <input type="radio" name="on_time" id="inlineRadio4" value="1"<?=$shop->on_time?'checked':''?>> 是
            </label>
        </div>
        <div class="form-group">
            是否蜂鸟配送:
            <label class="radio-inline">
                <input type="radio" name="fengniao" id="inlineRadio5" value="0"<?=$shop->fengniao?'':'checked'?>> 不是
            </label>
            <label class="radio-inline">
                <input type="radio" name="fengniao" id="inlineRadio6" value="1"<?=$shop->fengniao?'checked':''?>> 是
            </label>
        </div>
        <div class="form-group">
            是否标准达:
            <label class="radio-inline">
                <input type="radio" name="piao" id="inlineRadio7" value="0"<?=$shop->piao?'':'checked'?>> 不是
            </label>
            <label class="radio-inline">
                <input type="radio" name="piao" id="inlineRadio8" value="1"
                <?=$shop->piao?'checked':''?>> 是
            </label>
        </div>
        <div class="form-group">
            是否保标记:
            <label class="radio-inline">
                <input type="radio" name="bao" id="inlineRadio9" value="0"
                <?=$shop->bao?'':'checked'?>> 不是
            </label>
            <label class="radio-inline">
                <input type="radio" name="bao" id="inlineRadio10" value="1"
                <?=$shop->bao?'checked':''?>> 是
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">起送金额</label>
            <input type="number" id="start_send" name="start_send" value="{{$shop->start_send}}" >
        </div>
        <div class="form-group">
            店铺公告
            <textarea class="form-control" rows="3" name="notice">{{$shop->notice}}</textarea>
        </div>
        <div class="form-group">
            优惠信息
            <textarea class="form-control" rows="3" name="discount">{{$shop->discount}}</textarea>
        </div>
        <button type="submit" class="btn btn-default">确认修改</button>
    </form>
@endsection
