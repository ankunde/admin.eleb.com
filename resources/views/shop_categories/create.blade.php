@extends('default')
@section('css_file')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

@endsection
@section('js_file')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
@endsection
@section('contents')
    <form action="{{route('shopcategories.store')}}" method="post">
        {{csrf_field()}}
        @include('_error')

        <div class="form-group">
            <label for="shop_name">分类名</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="shop_im">分类图片</label>
            <input type="hidden" id="shop_im" name="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                <img id="img">
            </div>
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
        <script id="container" name="content" type="text/plain"></script>
        <button type="submit" class="btn btn-default">添加</button>
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
        uploader.on( 'uploadSuccess', function(file,response) {
            $('#img').attr('src',response.imgputh)
            $("#shop_im").val(response.imgputh)
        });
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
