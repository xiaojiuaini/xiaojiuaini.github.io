<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>供货商入驻申请</title>
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
include '../config.php';
$mod=$_GET['mod'];
$user= $_POST['user'];
$pwd= $_POST['pwd'];
$qq= $_POST['qq'];
$wx= $_POST['wx'];
$email= $_POST['email'];
$time=date('Y-m-d h:i:s', time());
if($u!==null&&$d!==null){exit("<script language='javascript'>alert('您已登陆');window.location.href='/sup';</script>");}
if($mod=='reg'){
if (ctype_alnum($user)){}else{exit("<script language='javascript'>alert('用户名只能是数字或字母！');window.history.go(-1);</script>");}
$sql = "SELECT * FROM `supplier` WHERE qq='$qq'";
$result = $con->query($sql);
if ($result->num_rows > 0){exit("<script language='javascript'>alert('当前QQ已被注册！');window.history.go(-1);</script>");}else{
 $sql = "SELECT * FROM `supplier` WHERE user='$user'";
 $result = $con->query($sql);
  if ($result->num_rows > 0){exit("<script language='javascript'>alert('当前用户名已被注册！');window.history.go(-1);</script>");}
  else{
	$pwd=password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `supplier` (`user`,`qq`,`pwd`,`adtime`,`wx`,`email`) VALUES ('$user', '$qq', '$pwd','$time','$wx','$email')";
    if ($con->query($sql) === TRUE) {
    exit("<script language='javascript'>alert('注册成功！');window.location.href='/sup';</script>");
    }else{exit("<script language='javascript'>alert('注册失败！');window.history.go(-1);</script>");}
}}}
?>


    <div class="container" style="padding-top:70px;">
      <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">供货商入驻</h3></div>
  <div class="panel-body">
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>供货商入驻</b></h2>
        </div>
          <form action="reg.php?mod=reg" method="post">
            <div class="input-group"><div class="input-group-addon"><span class="fa fa-user"></span></div>
              <input type="text" name="user" value="" class="form-control" required="required" placeholder="输入登录用户名"/>
            </div><br/>
            <div class="input-group"><div class="input-group-addon"><span class="fa fa-lock"></span></div>
              <input type="text" name="pwd" class="form-control" required="required" placeholder="输入6位以上密码"/>
            </div><br/>
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-qq"></span></div>
              <input type="text" name="qq" class="form-control" required="required" placeholder="输入QQ号，用于找回密码"/>
            </div><br/>
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-globe"></span></div>
			  <input type="text" name="wx" class="form-control" required="required" placeholder="输入微信号，用于找回密码"/>
			</div><br/>
			<div class="input-group"><div class="input-group-addon"><span class="fa fa-envelope"></span></div>
			  <input type="text" name="email" class="form-control" required="required" placeholder="输入邮箱，用于找回密码"/>
			</div><br/>
            <div class="form-group">
              <input type="submit" value="立即入驻" id="submit_reg" class="btn btn-danger btn-block"/>
            </div>
			<hr>
			<div class="form-group">
		
			<a href="../login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa fa-user"></i>&nbsp;供货商登录</a>
			</div>
          </form>
    </div>
  </div>
  </div>
  </div>

<script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>