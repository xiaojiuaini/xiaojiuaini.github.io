<?php
$mod=$_GET['mod'];
$title='发邮件';
$nr=$_POST['nr'];
include '../head.php';
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}
if($nr!==null){
	require_once('../email/Email.pdk.php');
	$time=date('Y-m-d h:i:s', time());
	$user = "星宇网络";//发件人
	$titles = '情人节活动邀请通知！';// 邮 箱 标 题
	$address = '2984446297@qq.com'; //收件人
	$contents = '<span style="color:#00D5FF;"><strong>为迎接</strong><span style="color:#E53333;"><strong>情人节</strong></span><strong>的到来，星宇代刷平台特邀您参与商品营销活动！</strong></span><br />
<strong>即日起添加</strong><span style="color:#EE33EE;"><strong>活动商品</strong></span><strong>到</strong><span style="color:#E53333;"><strong><u>情人节活动专栏</u></strong></span><strong>即可参与，参与活动有机会获得免手续费提现机会和大大提高商品销量哦！</strong><br />
----------<br />
<a href="http://www.xhsc.top">星宇网络网络</a><br />
<a href="http://ds.xhds.cc/sup/">供货商登录</a>'; //邮 箱 内 容
	$sql = "SELECT * FROM `supplier` WHERE email!=''";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$address = $row['email']; //收件人
			$flag = sendMail($address,$titles,$nr,"2984446297@qq.com","kbvnqruwbshpchgb",$user);
			if($flag){$i=$i+1;}else{$ii=$ii+1;}
			$x=$x+1;
			if($x==30){break;}
		}
	}
	echo '发送邮件成功'.$i.'个，发送邮件失畋'.$ii.'个';
}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-6">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >发送给所有供货商邮件</div>
<div class="panel-body">
  <form method="post" class="form-horizontal" role="form">
  <label>发送内容</label><br>
  <textarea class="form-control" rows="10" name="nr" ></textarea><br>
<input type="submit" name="submit" value="提交" class="btn btn-primary form-control"/>
  </form>
  </div>
  </div>
</div>
</div>