<?php
$title='保证金管理';
$mod=$_GET['mod'];
$time=date('Y-m-d h:i:s', time()); 
include '../head.php';
@header('Content-Type: text/html; charset=UTF-8');
if($mod=='jd'){
  $je=$_POST['je'];
  if (ctype_alnum($je)){}else{exit("<script language='javascript'>alert('解冻金额只能是数字');window.history.go(-1);</script>");}
  if ($je>$userrow['margin']){exit("<script language='javascript'>alert('保证金额不足');window.history.go(-1);</script>");}
$sql="SELECT * FROM `shua_tools` WHERE supplier='{$userrow['user']}'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0) {while($res = mysqli_fetch_assoc($result)) {if($res['active']==1){exit("<script language='javascript'>alert('解冻保证金需将所有商品隐藏才可以解冻哦！');window.history.go(-1);</script>");}}}
  $jdje=$userrow['margin']-$je;
  $jdjes=$userrow['rmb']+$je;
  mysqli_query($con,"UPDATE `supplier` SET `rmb`=rmb+{$je},`margin`=margin-{$je} WHERE user='$u'");
   mysqli_query($con,"INSERT INTO sup_pay (`time`,`name`,`sup`,`money`) VALUES ('$time', '解冻保证金到余额【{$je}】元','$u',$je)");
    exit("<script language='javascript'>alert('解冻成功');window.location.href='?';</script>");}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >保证金管理</div>
<div class="panel-body">
  <form action="?mod=jd" method="post" class="form-horizontal" role="form">
        <div class="form-group">
	  <label class="col-sm-2 control-label">保证金</label>
	  <div class="col-sm-10"><input type="text" name="bzj" value="<?php echo $userrow['margin'];?>元" class="form-control" disabled="disabled" /></div>
	</div><br/>
    <div class="form-group">
	  <label class="col-sm-2 control-label">解冻</label>
	  <div class="col-sm-10"><input type="text" name="je" value="" class="form-control" placeholder="解冻金额"/><pre><font color="green">解冻金额前需将所有商品隐藏即可解冻</font></pre></div>
	</div><br/>
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="解冻" class="btn btn-primary form-control"/></div><br/><br/>
    <span style="color:#0d47e0;">保证金介绍</span><br><br>
        <span style="color:#f04e66;">1.缴纳保证金上架商品免审（需符合平台要求，否则会受到处罚或封号）！</span><br><br>
        <span style="color:#2ce00e;">2.提现当天到账（保证金需大于提现金额否则7天后到账）！</span><br><br>
	 <span style="color:#e235106;">3.上架3个同类型业务（如快手粉丝、快手播放、快手点赞等）可免费发公告通知新业务上架！</span><br><br>
    <span style="color:#8a6d3b;">4.保证金可随时解冻到余额进行提现，也可以联系客服将余额缴纳到保证金！</span><br><br>
    <span style="color:#00c;">5.商品介绍专属认证标识，商品有需求可填写联系QQ、微信等！</span><br/>
    
  </form>
  </div>
</div>