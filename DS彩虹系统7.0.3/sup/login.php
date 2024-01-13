<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>供货商登录系统</title>

<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/vector.js"></script>

</head>
<body>

<div id="container">
	<div id="output">
		<div class="containerT">
			<h1>供货商登录系统</h1>
			<form class="form" id="entry_form" action="login.php?login=yhdl" method="post">
				<input type="text" name="user" placeholder="用户名" id="entry_name" value="">
				<input type="password" name="pwd" placeholder="密码" id="entry_password" value="">
				<button type="submit" id="entry_btn">登录</button>
				<br><br>
              <a href="user/reg.php" class="btn btn-primary btn-rounded">申请入驻</a><br><br><a href="user/mmzh.php" class="btn btn-primary btn-rounded">忘记密码</a>
				<div id="prompt" class="prompt"></div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(function(){
        Victor("container", "output");   //登录背景函数
        $("#entry_name").focus();
        $(document).keydown(function(event){
            if(event.keyCode==13){
                $("#entry_btn").click();
            }
        });
    });
</script>
</body>
</html>
<?php
if(file_exists("install.lock")==false){exit("<script language='javascript'>alert('即将前往安装本插件');window.location.href='/sup/install.php';</script>");}
include 'config.php';
if($u!==null&&$p!==null){exit("<script language='javascript'>alert('您已登陆');window.location.href='/sup';</script>");}
?>