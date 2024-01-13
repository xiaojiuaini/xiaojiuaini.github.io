<?php
require '../includes/common.php';
$mod=$_GET['mod'];
if($mod=='tk'){
	$id=intval($_GET['id']);
	$money=0;
	$row=$DB->getRow("select * from pre_orders where id='$id' limit 1");
	if(!$row)exit('当前订单不存在！');
	if($row['zid']<1 && !is_numeric($row['userid']))exit('退款失败，该订单属于主站');
	if($row['status']==4)exit('该订单已退款请勿重复提交');
	if($row['status']!=0&&$row['status']!=3)exit('只有未处理和异常的订单才支持退款');
	if($money<=0)$money=$row['money'];
	if(is_numeric($row['userid'])){
		$zid = intval($row['userid']);
		changeUserMoney($zid, $money, true, '退款', '订单(ID'.$id.')已退款到余额');
	}
	rollbackPoint($id);
	$DB->exec("update pre_orders set status='4',result=NULL where id='{$id}'");
	if(is_numeric($row['userid'])){
		exit('该订单已成功退款给UID'.$zid.'');
	}else{
		exit('该订单属于未注册用户，需要手动退款！');
	}
}
$title='订单退款申请';
include './head.php';
?>
<div class="wrapper">
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span>
			</button>
			<h4 class="modal-title">相关说明</h4>
		</div>
		<div class="modal-body text-center">
			<b>我当前的账户余额：<span style="font-size:16px; color:#FF6133;"><?php echo $userrow['rmb']?></span> 元</b>
			<hr>
<p>
	<span style="color:#00D5FF;"><strong>可申请退款订单：</strong></span> 
</p>
<p>
	<span style="color:#00D5FF;">1.订单状态为异常！</span> 
</p>
<p>
	<span style="color:#00D5FF;">2.订单<span style="color:#00D5FF;">状态</span>长时间为待处理状态！</span> 
</p>
<p>
	<strong><span style="color:#EE33EE;">仅以上两种状态用户可自助申请退款，其他状态订单或问题请提交工单处理！！！</span></strong> 
</p>
<p>
	<br />
</p>
<p>
	<span style="color:#E53333;"><strong>订单编号获取方法：</strong></span> 
</p>
<p>
	<span style="color:#E53333;">1.在查询订单页面找到订单-点击详情即可看到订单编号！</span> 
</p>
<p>
	<span style="color:#E53333;">2.用户后台-订单记录-订单id就是订单编号！</span> 
</p>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
	</div>
</div>
</div>

  <div class="container" style="padding-top:10px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">订单退款申请&nbsp;<a href="#userjs" data-toggle="modal" class="btn btn-default btn-xs"><b>说明</b></a>&nbsp;<a href="javascript:history.back(-1)"><span class="btn btn-default btn-xs">返回</span></a></h3></div>
<div class="panel-body">
<div class="form-group">
<div class="input-group">
<input type="text" class="form-control" id="id" name="id" value="" placeholder="订单编号"><span class="input-group-btn"><a href="javascript:tk()" class="btn btn-success">申请</a></span>
</div>
</div>
</div>
</div>
  <script> 
  function tk(){
    var id=document.getElementById("id").value;
    if(id==""){alert('订单编号不能为空');return;}
    $.get("dindantuikuan.php?mod=tk&id="+id,function(data){
      if(data==""){alert('获取失败，请检查订单编号是否正确或联系客服'+id);return;}
      alert(data);});}
</script>