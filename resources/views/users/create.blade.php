@extends('default')
@section('contents')
    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">名称</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="email">邮箱</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="password1">密码</label>
            <input type="password" class="form-control" name="password" id="password1">
        </div>
        <div class="form-group">
            <label for="password">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="password">
        </div>
        <div class="form-group">
            状态:
            <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio30" value="1" checked>通过
            </label>
        </div>
        {{--<div class="form-group">--}}
            {{--所属商家:--}}
            {{--<select class="form-control" name="shop_id">--}}
                {{--<option value="1">东</option>--}}
                {{--<option value="2">南</option>--}}
                {{--<option value="3">西</option>--}}
                {{--<option value="4">北</option>--}}
                {{--<option value="5">中</option>--}}
            {{--</select>--}}
        {{--</div>--}}








        {{--商户添加--}}
            店铺分类选择:
            <select class="form-contro2" name="shop_category_id">
                <option value="1">美食</option>
                <option value="2">快餐</option>
                <option value="3">下午茶</option>
                <option value="4">大牌5折</option>
                <option value="5">小吃</option>
            </select>

            <div class="form-group">
                <label for="shop_name2">店名</label>
                <input type="text" class="form-control" name="shop_name" id="shop_name2" value="{{old('shop_name')}}">
            </div>
            <div class="form-group2">
                <label for="shop_im">商品图片</label>
                <input type="file" id="shop_im" name="shop_img">
            </div>
            <div class="form-group">
                是否是品牌:
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio1" value="0"> 不是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio2" value="1"> 是
                </label>
            </div>
            <div class="form-group">
                是否准时达:
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio3" value="0"> 不是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio4" value="1"> 是
                </label>
            </div>
            <div class="form-group">
                是否蜂鸟配送:
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio5" value="0"> 不是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio6" value="1"> 是
                </label>
            </div>
            <div class="form-group">
                是否标准达:
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio7" value="0"> 不是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio8" value="1"> 是
                </label>
            </div>
            <div class="form-group">
                是否保标记:
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio9" value="0"> 不是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio10" value="1"> 是
                </label>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">起送金额</label>
                <input type="number" id="start_send" name="start_send" value="{{old('start_send')}}" >
            </div>
            <div class="form-group">
                店铺公告
                <textarea class="form-control" rows="3" name="notice">{{old('notice')}}</textarea>
            </div>
            <div class="form-group">
                优惠信息
                <textarea class="form-control" rows="3" name="discount">{{old('discount')}}</textarea>
            </div>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection

