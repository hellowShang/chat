<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://client.lab993.com/js/jquery.js"></script>
    <title>聊天室</title>
</head>
<body>
    <h1>聊天室</h1>
    当前登录人：<font color="blue">{{$username}}</font>
    <br>
    <div id="show">
        @foreach($content as $k=> $v)
            <font color="red">用户{{$v->username}}：</font> <span>{{$v->content}}</span><br>
        @endforeach
    </div>
    <input type="text" name="content" id="content">
    <button id="btn">发送</button>

    <script>
        // 聊天数据实时更新
        setInterval(function(){
            var _desc ="";
            $.post(
                "/user/detail",
                function(res){
                    for(var i=0;i<res.info.length;i++){
                        _desc += "<font color='red'>用户"+res.info[i].username+"：</font> <span>"+res.info[i].content+"</span><br>";
                    }
                    $('#show').html(_desc);
                },
                'json'
            );
        },1000);

        $(function(){
            // 聊天数据入库
            $('#btn').click(function(){
                var _this = $(this);
                var content = $('#content').val();
                if(content == ''){
                    alert('发送内容不能为空');
                    return false;
                }
                $.post(
                    '/user/desc',
                    {content:content},
                    function(res){
                        if(res.code == 1){
                            $('#content').val('');
                        }
                    },
                    'json'
                );
            });
        });
    </script>
</body>
</html>