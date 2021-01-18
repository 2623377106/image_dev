<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 基本表单</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
</head>
<body>

<form role="form" id="signupForm" action="{{route('save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">名称</label>
        <input type="text" class="form-control" id="title"
               placeholder="请输入标题" name="title">
    </div>
    <div class="form-group">
        <label for="inputfile">文件输入</label>
        <div id="picker">选择文件</div>
        <img src="" alt="" width="200px" height="200px" id="img" hidden>
    </div>
    <input type="hidden" name="file" id="hidd">
    <div class="checkbox">
        是否可见：
        <label>
            <input type="radio" name="state" value="1"> 是
            <input type="radio" name="state" value="0"> 否
        </label>
    </div>
    <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>
<script>
    var uploader = WebUploader.create({
        // 选择文件后是否自动上传
        auto:true,
        // swf文件路径
        swf:  '/webuploader/Uploader.swf',
        // 文件接收服务端。
        server: 'http://images.bawei.com/index.php/file',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#picker',
        formData:{
          _token:"{{csrf_token()}}"
        },
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'jpg,jpeg,png',
            mimeTypes: 'image/*'
        },
    });
    uploader.on( 'uploadSuccess', function( file,e ) {
        // 如果状态码等于200，那么代表上传成功
       if(e.code==200){
           // 把文件名赋值给隐藏域
           $("#hidd").val(e.data)
           // 实现图片预览效果
           $("#img").attr('src',e.data).show()
       }
    });
    $("#signupForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            title: {
                required: "请输入标题",
                minlength: "标题不得少于两个字符"
            },
        },
        submitHandler:function(form){
            form.submit();
        }
    })
</script>
