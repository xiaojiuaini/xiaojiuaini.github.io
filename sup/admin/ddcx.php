<?php
$nr=$_POST['nr'];
$mod=$_GET['mod'];
$ddbh=$_GET['ddbh'];
$title='订单查询';
include '../head.php';
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >订单查询</div>
<div class="panel-body">
  <form method="get" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">订单编号</label>
	  <div class="col-sm-10"><input type="text" name="ddbh" value="" class="form-control" placeholder="订单编号"/></div>
	</div><br/>
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit"  value="查询" class="btn btn-primary form-control"/><br/>
	 </div>
  </form>
</div>

</div>
<?php
function display_type($type){
	if($type==0)
		return '<font color=blue>未完成</font>';
	elseif($type==1)
		return '<font color=green>已完成</font>';
	elseif($type==2)
		return '<font color=green>正在处理</font>';
	elseif($type==3)
		return '<font color=#f05050>异常</font>';
}
if($ddbh==null){}else{
	echo '
	    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
      查询结果
    </div>
           <div class="table-responsive">
	<table class="table table-striped">
	<thead><th>商品名称</th><th>下单数据</th><th>订单状态</th><th>时间</th><th>成本</th><th>供货商QQ</th><th>供货商微信</th><th>用户名</th></tr></thead>
    <tbody>';
	$result = mysqli_query($con,"SELECT * FROM `shua_orders` WHERE id='$ddbh'");
	$res = mysqli_fetch_array($result);
	$tool=mysqli_query($con,"SELECT * FROM `shua_tools` WHERE tid='{$res['tid']}'");
	$tools = mysqli_fetch_array($tool);
	$sup=mysqli_query($con,"SELECT * FROM `supplier` WHERE user='{$tools['supplier']}'");
	$sups = mysqli_fetch_array($sup);
	echo '<tr><td>'.$tools['name'].'</td><td>'.$res['input'].'</td><td>'.display_type($res['status']).'</td><td>'.$res['addtime'].'</td><td>'.$tools['price']*$res['value'].'</td><td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$sups['qq'].'&site=qq&menu=yes">'.$sups['qq'].'</a></td><td>'.$sups['wx'].'</td><td><a target="_blank" href="./?mod=user&kw='.$sups['user'].'">'.$sups['user'].'</a></td></tr>';
       echo '
          </tbody>
        </table></div>
    </div>';
	
}
?>