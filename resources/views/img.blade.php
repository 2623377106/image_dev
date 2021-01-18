<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 向列表组添加链接</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/layer-v3.1.1/layer/layer.js"></script>
</head>
<body>
@foreach($data as $val)
<div>
    <a href="#" class="list-group-item active">
        {{$val->title}}
    </a>
    <a href="#" class="list-group-item"><img src="{{$val->file}}" alt="" width="200px" height="200px"></a>
    <a href="{{route('del',['id'=>$val->id])}}" class="list-group-item del" >删除</a>
</div>
@endforeach
</body>
</html>
<script>
    $(document).ready(function(){
        $(".list-group-item").click(function(){
            // 获取删除的url地址
            var url=$(this).attr('href')
            //询问框
            layer.confirm('你确定要删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                // 发送ajax
                $.ajax({
                    type: "DELETE",
                    url,
                    data:{
                      _token:"{{csrf_token()}}"
                    },
                    success: function(e){
                        if(e.code==200){
                            layer.msg('删除成功', {icon: 1},function () {
                                location.reload()
                            });
                        }
                    }
                });

            })
            return false
        });
    });
</script>
