<?php
include '../head.php';
$id=intval($_GET['id']);
$status=intval($_GET['status']);
$rmb=(float)$userrow['rmb'];
$time=date('Y-m-d h:i:s', time());
$res = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_orders WHERE id='$id'"));
$ress = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM shua_tools WHERE tid='{$res['tid']}'"));
$jg=$ress['price']*$res['value'];
if($res['money']<$jg){$jg=$res['money'];}
$rmbs=$jg+$rmb;
if($res['status']==1){exit('非法提交');}
if ($status==1){
mysqli_query($con,"UPDATE shua_orders SET status='$status' WHERE id='{$id}'");
$sql = "INSERT INTO sup_pay (`time`,`name`,`sup`,`money`) VALUES ('$time', '编号:{$id}订单完成获得金额{$jg}元','$u',$jg);";
if ($con->multi_query($sql) === TRUE) {
mysqli_query($con,"UPDATE supplier SET rmb='$rmbs' WHERE user='{$u}'");
exit('cgts');
mysqli_close($con);}
}else{
mysqli_query($con,"UPDATE shua_orders SET status='$status' WHERE id='{$id}'");
exit('cgts');
}
?>