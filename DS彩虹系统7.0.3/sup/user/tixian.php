<?php
$title='余额提现';
include '../head.php';
function display_zt($zt){
	if($zt==1)
		return '<font color=green>已完成</font>';
	else
		return '<font color=blue>未完成</font>';
}
function display_type($type){
	if($type==1)
		return '微信';
	elseif($type==2)
		return 'QQ钱包';
	else
		return '支付宝';
}
if(isset($_POST['money']))
{
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
$sql = "INSERT INTO `sup_tx`(`user`,`money`,`addtime`,`realmoney`,`pay_type`,`pay_account`,`pay_name`,`rmb`) VALUES ('$u', '$money','$time','$realmoney','$pay_type','$pay_account','$pay_name','$ye')";
if ($con->query($sql) === TRUE) {
  mysqli_query($con,"update supplier set rmb=rmb-{$money} where user='$u'");
  $sql = "INSERT INTO `sup_pay` (`time`,`name`,`sup`,`money`) VALUES ('$time', '提现{$money}元,余额{$ye}元','$u',$money);";
  mysqli_query($con,$sql);
  exit("<script language='javascript'>alert('提现操作成功，本次实际到账金额:{$realmoney}元，请等待管理员人工转账！');window.location.href='tixian.php';</script>");
}else{
	exit("<script language='javascript'>alert('提现失败！');history.go(-1);</script>");
}
}
?>
<div class="wrapper">
<div class="col-sm-6">
<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
		余额提现
	</div>
	<div class="list-group-item list-group-item-info">
	<?php if(!empty($userrow['pay_account']) && !empty($userrow['pay_name'])){?>
		已绑定结算账号信息：结算方式：<?php echo display_type($userrow['pay_type']); ?> 账号：<?php echo $userrow['pay_account']; ?> 姓名：<?php echo $userrow['pay_name']; ?> <a href="uset.php?mod=user" class="btn btn-warning btn-sm">修改绑定</a>
	<?php }else{?>
		请先绑定收款支付宝账号！ <a href="uset.php?mod=user" class="btn btn-warning btn-sm">点此设置</a>
	<?php }?>
	</div>
	<div class="list-group-item list-group-item-warning">
		单笔提现金额最低<?php echo $userrow['tixian_min'] ?>元。提现手续费<?php echo $userrow['tixian_rate'] ?>%。
	</div>
	<div class="panel-body">
		<form method="post" class="form-horizontal">
			<input type="hidden" name="action" value="tixian">
			<div class="form-group">
				<label class="col-lg-3 control-label">账户余额</label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?php echo $userrow['rmb']?>元" disabled>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label">提现金额</label>
				<div class="col-lg-8">
					<input type="number" name="money" class="form-control" placeholder="输入要提现金额">
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-offset-3 col-lg-8">
					<button class="btn btn-primary" type="submit">确认提现</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<div class="col-sm-6">
	<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">提现记录</div>
		  <div class="panel-body">

      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>金额</th><th>实际到账</th><th>提现方式</th><th>提现账号</th><th>姓名</th><th>申请时间</th><th>完成时间</th><th>状态</th></tr></thead>
          <tbody>
<?php
$sql = "SELECT * FROM sup_tx WHERE user='{$userrow['user']}' order by id desc limit 10";
$rs=mysqli_query($con, $sql);
if (mysqli_num_rows($rs) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($rs)) {
        echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['money'].'</td><td>'.$res['realmoney'].'</td><td>'.display_type($res['pay_type']).'</td><td>'.$res['pay_account'].'</td><td>'.$res['pay_name'].'</td><td>'.$res['addtime'].'</td><td>'.($res['status']==1?$res['endtime']:null).'</td><td>'.display_zt($res['status']).'</td></tr>';
    }
}
?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
 </div>
</div>