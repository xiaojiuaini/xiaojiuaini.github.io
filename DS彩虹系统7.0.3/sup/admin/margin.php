<?php
$title='保证金管理';
$mod=$_GET['mod'];
$time=date('Y-m-d h:i:s', time()); 
include '../head.php';
@header('Content-Type: text/html; charset=UTF-8');
if($mod=='jd'){
  $je=$_POST['je'];
  $yh=$_POST['yh'];
  mysqli_query($con,"UPDATE`supplier` SET `margin`=margin+{$je} WHERE user='$yh'");
  mysqli_query($con,"INSERT INTO sup_pay (`time`,`name`,`sup`,`money`) VALUES ('$time', '缴纳保证金{$je}元','$yh',$je)");
  exit("<script language='javascript'>alert('缴纳成功');window.location.href='./';</script>");}
?>
  <style>
  .msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
  .msg-body{padding: 15px;margin-bottom: 20px;}
  </style>
  <div class="wrapper">
  <div class="col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >缴纳保证金</div>
  <div class="panel-body">
  <form action="?mod=jd" method="post" class="form-horizontal" role="form">
  	    <div class="form-group">
	  <label class="col-sm-2 control-label">用户名</label>
	  <div class="col-sm-10"><input type="text" name="yh" value="" class="form-control" placeholder="用户名"/></div>
	</div><br/>
        <div class="form-group">
	  <label class="col-sm-2 control-label">保证金</label>
	  <div class="col-sm-10"><input type="text" name="je" value="" class="form-control"/></div>
	</div><br/>
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="缴纳" class="btn btn-primary form-control"/></div><br/><br/>
  </form>
</div></div>
    