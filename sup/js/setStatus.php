<?php
/**
 * 设置补领状态
**/
include("../head.php");
@header('Content-Type: application/json; charset=UTF-8');
$id=intval($_POST['name']);
$zt=intval($_GET['zt']);
if ($id!==null){
//$res = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_orders WHERE id='$id'"));
$ress = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_tools WHERE tid='1370'"));
//$jg=$ress['cost2']*$res['value'];
  
  echo $ress['cost2'];
}
//$status=intval($_GET['status']);
//$jg=(float)$_GET['jg'];
//$vl=(float)$_GET['vl'];
//$rmb=(float)$userrow['rmb'];
//$jg=$jg*$vl;
//$rmbs=$jg+$rmb;
//$time=date('Y-m-d h:i:s', time()); 
//if ($status==1){
//mysqli_query($con,"UPDATE shua_orders SET status='$status' WHERE id='{$id}'");
//$sql = "INSERT INTO sup_pay (`time`,`name`,`sup`,`money`) VALUES ('$time', '编号:{$id}订单完成获得金额【{$jg}】元','$u',$jg);";
 //if ($con->multi_query($sql) === TRUE) {
 //   mysqli_query($con,"UPDATE supplier SET rmb='$rmbs' WHERE user='{$u}'");
 //   exit('{"code":200}');
 //     else
//		exit('{"code":400,"msg":"修改订单失败！"}');
//mysqli_close($con);}
//}else{
//  mysqli_query($con,"UPDATE shua_orders SET status='$status' WHERE id='{$id}'");
 //  exit('{"code":200}');
   //   else
	//	exit('{"code":400,"msg":"修改订单失败！"}');}
?>