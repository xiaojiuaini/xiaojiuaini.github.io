<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>找回密码</title>
  <link rel="shortcut icon" href="http://ds.xh66.cn/favicon.ico" />
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php
$mod=$_GET['mod'];
$email= $_POST['email'];
if($mod=='mmzh'){
include '../config.php';
$mail_name=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_config WHERE k='mail_name'"));
$mail_pwd=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_config WHERE k='mail_pwd'"));
$sitename=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_config WHERE k='sitename'"));
	require_once('../email/Email.pdk.php');
	$strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
	$name=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);
	$pwd=password_hash($name, PASSWORD_DEFAULT);
	$flag = sendMail($email,"密码找回","密码重置为：$name",$mail_name['v'],$mail_pwd['v'],$sitename['v']);
  	if($flag){mysqli_query($con,"UPDATE `supplier` SET `pwd`='$pwd' WHERE email='$email'");
  		exit("<script language='javascript'>alert('已将密码发送到所绑定的邮箱');window.history.go(-1);</script>");
  	}else{exit("<script language='javascript'>alert('异常');window.history.go(-1);</script>");//发送邮件失败
  	}
}
?>


    <div class="container" style="padding-top:70px;">
      <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">找回密码</h3></div>
  <div class="panel-body">
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>找回密码</b></h2>
        </div>
          <form action="?mod=mmzh" method="post">
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-envelope"></span></div>
			  <input type="text" name="email" class="form-control" required="required" placeholder="输入所绑定的邮箱账号"/>
			</div><br/>
            <div class="form-group">
              <input type="submit" value="找回" id="submit_reg" class="btn btn-danger btn-block"/>
            </div>
			<hr>
			<div class="form-group">
		
			<a href="../login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa fa-user"></i>&nbsp;登录</a>
			</div>
          </form>
    </div>
  </div>
  </div>
  </div>

<script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>