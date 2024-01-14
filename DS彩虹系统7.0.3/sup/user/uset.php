<?php
error_reporting(0);
$title = '资料设置';
include '../head.php';
$mod=$_GET['mod'];
if($mod=='user_n'){
	$qq=$_POST['qq'];
	$email=$_POST['email'];
    $wx=$_POST['wx'];
	$pay_type=$_POST['pay_type'];
	$pay_account=$_POST['pay_account'];
	$pay_name=$_POST['pay_name'];
	$pwd=$_POST['pwd'];
	if(!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/',$pwd)){
		exit("<script language='javascript'>alert('密码只能为英文与数字！');history.go(-1);</script>");
	}elseif(!preg_match('/^[0-9]{5,11}+$/', $qq)){
		exit("<script language='javascript'>alert('QQ格式不正确！');history.go(-1);</script>");
	}else{
      mysqli_query($con,"UPDATE supplier SET qq='$qq',pay_type='$pay_type',pay_account='$pay_account',pay_name='$pay_name',wx='$wx',email='$email' WHERE user='{$u}'");
      if(empty($pwd)==FALSE){$pwd=password_hash($pwd, PASSWORD_DEFAULT);mysqli_query($con,"update supplier set pwd='$pwd' where user='{$u}'");}
		exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
	}
	}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >用户资料设置</div>
<div class="panel-body">
  <form action="./uset.php?mod=user_n" method="post" role="form">
	 <div class="form-group">
	   <label>绑定邮箱:</label><br/>
	   <input type="text" name="email" value="<?php echo $userrow['email']; ?>" class="form-control" placeholder="用于联系与找回密码"/>
	 </div>
	 <div class="form-group">
	   <label>绑定微信:</label><br/>
	   <input type="text" name="wx" value="<?php echo $userrow['wx']; ?>" class="form-control" placeholder="用于联系与找回密码"/>
	 </div>
	<div class="form-group">
	  <label>绑定ＱＱ:</label><br/>
	  <input type="text" name="qq" value="<?php echo $userrow['qq']; ?>" class="form-control" placeholder="用于联系与找回密码"/>
	</div>
	<div class="form-group">
	  <label>提现方式:</label><br/>
	  <select class="form-control" name="pay_type" default="<?php echo $userrow['pay_type']?>"><option value="0">支付宝</option><option value="1">微信</option><option value="2">QQ钱包</option></select>
	</div>
	<div class="form-group">
	  <label>提现账号:</label><br/>
	  <input type="text" name="pay_account" value="<?php echo $userrow['pay_account']; ?>" class="form-control"/>
      <a href="javascript:getopenid()" class="btn btn-info" style="display:none" id="getopenid">自动获取</a>
	</div>
	<div class="form-group">
	  <label>提现姓名:</label><br/>
	  <input type="text" name="pay_name" value="<?php echo $userrow['pay_name']; ?>" class="form-control"/>
	</div>
	<div class="form-group">
	  <label>key:</label><br/>
	  <input type="text" value="<?php echo $userrow['key']; ?>" class="form-control" disabled="disabled"/>
	  <pre><font color="green">key是用于对接或者自动化处理的秘钥，详情参考开发文档！<a href="key.php">修改key</a></font></pre>
	</div>
	<div class="form-group">
	  <label>重置密码:</label><br/>
	  <input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/>
	</div>
	<div class="form-group">
	  <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
	</div>	
  </form>
  </div>
</div>