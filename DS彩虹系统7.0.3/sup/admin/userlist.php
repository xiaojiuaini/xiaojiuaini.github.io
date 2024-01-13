<?php
$user=$_GET['user'];
$title='供货商资料';
include '../head.php';
$result = mysqli_query($con,"SELECT * FROM supplier WHERE user='$user' limit 1");
$userrows=mysqli_fetch_array($result);
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}

?>

<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod=='user_n'){
	$user=$_GET['user'];
	$qq=$_POST['qq'];
    $wx=$_POST['wx'];
	$tixian_rate=$_POST['tixian_rate'];
	$status=$_POST['status'];
	$rmb=$_POST['rmb'];
	$pwd=$_POST['pwd'];
	$margin=$_POST['margin'];
	if(!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/',$pwd)){
		exit("<script language='javascript'>alert('密码只能为英文与数字！');history.go(-1);</script>");
	}elseif(!preg_match('/^[0-9]{5,11}+$/', $qq)){
		exit("<script language='javascript'>alert('QQ格式不正确！');history.go(-1);</script>");
	}else{
      mysqli_query($con,"UPDATE `supplier` SET `qq`='$qq',`status`='$status',`margin`='$margin',`tixian_rate`='$tixian_rate',`rmb`='$rmb',`wx`='$wx' WHERE `user`='{$user}'");
		if(empty($pwd)==FALSE){$pwd=password_hash($pwd, PASSWORD_DEFAULT);mysqli_query($con,"update supplier set pwd='$pwd' where user='{$user}'");}
		exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
	}
}
  echo '
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >资料修改</div>
<div class="panel-body">
  <form method="post" action="userlist.php?mod=user_n&user='.$user.'" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">ＱＱ</label>
	  <div class="col-sm-10"><input type="text" name="qq" value="';
 echo $userrows['qq'];
    echo '" class="form-control" placeholder="用于联系与找回密码" /></div>
	</div><br/>
    	<div class="form-group">
	  <label class="col-sm-2 control-label">微信</label>
	  <div class="col-sm-10"><input type="text" name="wx" value="';
 echo $userrows['wx'];
    echo '" class="form-control" placeholder="用于联系和展示给用户" /></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">状态</label>
	  <div class="col-sm-10"><select class="form-control" name="status" default="';
  echo $userrows['status']; 
  echo '"><option value="0">正常</option><option value="1">封禁</option></select></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">提现费率</label>
	  <div class="col-sm-10"><input type="text" name="tixian_rate" value="';echo $userrows['tixian_rate']; echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">余额</label>
	  <div class="col-sm-10"><input type="text" name="rmb" value="'; echo $userrows['rmb'];echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">保证金</label>
	  <div class="col-sm-10"><input type="text" name="margin" value="'; echo $userrows['margin'];echo '" class="form-control"/></div>
	</div><br/>
	<?php }?>
	<div class="form-group">
	  <label class="col-sm-2 control-label">重置密码</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>';
 ?>