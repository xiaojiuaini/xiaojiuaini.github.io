<?php
include("../con.php");
$tid=intval($_GET['tid']);
$status=intval($_GET['status']);
$sign=intval($_GET['sign']);
$orderby=($_GET['orderby']==1)?"desc":"asc";
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
$tool=mysqli_fetch_assoc($result);
$value=$tool['value']>0?$tool['value']:1;
$date=date("Y-m-d");
$data='';
if($sign==2){exit("<script language='javascript'>alert('非法操作！');history.go(-1);</script>");}
if($status==2){exit("<script language='javascript'>alert('非法操作！');history.go(-1);</script>");}
if($tool['supplier']!==$u){exit("<script language='javascript'>alert('非法操作！');history.go(-1);</script>");}
$rs = mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$tid}' and status={$status} order by addtime {$orderby} limit 1000");

while($row = mysqli_fetch_assoc($rs))
{
	$data.=$row['input'] . ($row['input2']?'----'.$row['input2']:null) . ($row['input3']?'----'.$row['input3']:null) . ($row['input4']?'----'.$row['input4']:null) . ($row['input5']?'----'.$row['input5']:null) . '----' . $row['value']*$value."\r\n";
	if($sign>0)mysqli_query($con,"update `shua_orders` set status={$sign} where `id`='{$row['id']}'");
}

$file_name='output_'.$tid.'_'.$date.'__'.time().'.txt';
$file_size=strlen($data);
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
echo $data;
?>