<?php
include '../head.php';
$money=strip_tags($_POST['money']);
if(!is_numeric($money) || !preg_match('/^[0-9.]+$/', $money)){exit("<script language='javascript'>alert('提现金额输入不规范！');history.go(-1);</script>");};
$realmoney = round($money-$money*$userrow['tixian_rate']/100,2);
if(empty($userrow['pay_account']) || empty($userrow['pay_name'])){
	exit("<script language='javascript'>alert('您还未设置收款账号！');history.go(-1);</script>");
}
if($money>$userrow['rmb'] || $money<=0){
	exit("<script language='javascript'>alert('所输入的提现金额大于你所拥有的余额！');history.go(-1);</script>");
}
if($money<$userrow['tixian_min']){
	exit("<script language='javascript'>alert('单笔提现金额不能低于{$userrow['tixian_min']}元！');history.go(-1);</script>");
}
$pay_type=$userrow['pay_type'];
$pay_account=$userrow['pay_account'];
$pay_name=$userrow['pay_name'];
$time=date('Y-m-d h:i:s', time()); 
$ye=$userrow['rmb']-$money;
$sql = "INSERT INTO sup_tx (user,money,addtime,realmoney,pay_type,pay_account,pay_name,rmb) VALUES ('$u', '$money','$time','$realmoney','$pay_type','$pay_account','$pay_name','$ye')";
if ($con->query($sql) === TRUE) {
    mysqli_query($con,"update supplier set rmb=rmb-{$money} where user='$u'");
  $sql = "INSERT INTO sup_pay (`time`,`name`,`sup`,`money`) VALUES ('$time', '提现{$money}元','$u',$money);";
  mysqli_query($con,$sql);
  exit("<script language='javascript'>alert('提现操作成功，本次实际到账金额:{$realmoney}元，请等待管理员人工转账！');window.location.href='tixian.php';</script>");
}else{
	exit("<script language='javascript'>alert('提现失败！');history.go(-1);</script>");
}
?>