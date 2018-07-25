@extends('default')
@section('css_file')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@endsection
@section('js_file')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@endsection
@section('contents')
    <form action="{{route('shopcategories.update',[$shopcategory])}}" method="post" >
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')
        <div class="form-group">
            <label for="shop_name">分类名</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{$shopcategory->name}}">
        </div>
        <div class="form-group">
            <label for="shop_im">分类图片</label>
            <input type="text" id="shop_im" name="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="img">
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
@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route('upload')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response ) {//图片上传成功时触发
            $('#img').attr('src',response.imgputh);//回显图片
            $("#shop_im").val(response.imgputh);//将地址保存
        });
    </script>
@endsection
