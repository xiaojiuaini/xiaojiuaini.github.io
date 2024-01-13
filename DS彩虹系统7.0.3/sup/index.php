<?php
if(file_exists("install.lock")==false){exit("<script language='javascript'>alert('即将前往安装本插件');window.location.href='/sup/install.php';</script>");}
$title = '供货商管理首页';
include 'head.php';$i=0;
$dcl = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($dclid = mysqli_fetch_array($dcl)){$list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$dclid['tid']}' and status='0'");while($lists=mysqli_fetch_array($list)){$i=$i+1;}}
$ggs=mysqli_query($con,"SELECT * FROM sup_config");
$gg = mysqli_fetch_array($ggs);
if($userrow['email']==null){exit("<script language='javascript'>alert('请配置好邮箱，在进行相关操作！');window.location.href='user/uset.php?mod=user';</script>");}
?>
<style>
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
.span_position{display:inline;background:red;border-radius:50%;width:10px;height:10px;position:absolute}
</style>
<div class="wrapper">
	<div class="col-lg-4 col-md-6 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading font-bold" style="background: linear-gradient(to right,#14b7ff,#b221ff);padding: 15px;color: white;">
				<div class="widget-content text-right clearfix">
					<img src="<?php echo $userrow['qq']?'//q4.qlogo.cn/headimg_dl?dst_uin='.$userrow['qq'].'&spec=100':'../assets/img/user.png'; ?>" alt="Avatar"
					width="66" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
					<h4><b>余额：<?php echo $userrow['rmb']?>元</b></h4>
					 <a href="recharge.php" style="color:#fff; font-size:.7rem; width:50%; height:100%;border-radius: 0 .6rem 0 .6rem ;background:#ef7a45;" class="display-row align-center justify-center">充值保证金</a>
					<span class="text-muted">
						<span class="text-muted"><a href="user/tixian.php" class="btn btn-warning btn-xs">提现</a>&nbsp;<a href="record.php" class="btn btn-success btn-xs">账单</a>&nbsp;<a href="user/margin.php" class="btn btn-danger btn-xs">保证金</a></span>
					</span>
				</div>
			</div>
			
<table class="table">
	<tbody>
			<th class="text-center">
				<font color="#a9a9a9">用户名</font><br><font size="4"><a href="/sup/sup.php?yh=<?php echo $userrow['user']?>"><?php echo $userrow['user']?></a></font>
			</th>
			<th class="text-center">
				<font color="#a9a9a9">保证金</font><br><font size="4"><a href="/sup/user/margin.php"><?php echo $userrow['margin']?></a></font>
			</th>
			<th class="text-center">
				<font color="#a9a9a9">待处理订单</font><br><font size="4" id="income_today"><a href="/sup/list.php?type=0"><?php echo $i ?></a></font>
			</th>
		<tr>
			<td><a href="/sup/classlist.php" class="btn btn-primary btn-block"><i class="fa fa-bullhorn"></i><br/><b>商品管理</b><span id="message_count"></span></a></td>
          <td><a href="/sup/list.php?type=0" class="btn btn-info btn-block"><i class="fa fa-search"></i><br/><b>订单管理</b></a></td>
          <td><a href="/sup/record.php" class="btn btn-warning btn-block"><i class="fa fa-hashtag"></i><br/><b>收支明细</b></a></td>
		</tr>
		<tr>
          <td><a href="/sup/user/tixian.php" class="btn btn-success btn-block"><i class="fa fa-sitemap"></i><br/><b>提现</b></a></td>
			<td><a href="/sup/user/uset.php?mod=user" class="btn btn-primary btn-block"><i class="fa fa-list-alt"></i><br/><b>资料修改</b></a></td>
			<td><a href="/sup/?login=2" class=" btn btn-danger btn-block"><i class="fa fa-sign-out"></i><br/><b>安全退出</b></a></td>
		</tr>
	</tbody>
	</table>
	</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading font-bold"  style="background: linear-gradient(to right,#14b7ff,#b221ff);">
				<h3 class="panel-title"><font color="#fff"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>站点公告</b></font></h3>
			</div>
			<?php echo $gg['v'];?>
		</div>
	</div>
	


<?php
if($tj!==1){
$sus=0;$dd=0;$jye=0;
$time=date('Y-m-d', time());
$sus = mysqli_query($con,"select * from  supplier where to_days(adtime) = to_days(now())");
$result = mysqli_query($con,"select * from sup_pay where to_days(time) = to_days(now()) order by id desc");
while($res = mysqli_fetch_array($result))
{
  $dd = $dd + 1;
  $jye=$jye+$res['money'];
}
}else{$sus='***';$dd='***';$jye='***';}
?>

	<div class="col-lg-4 col-md-6 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading font-bold"  style="background: linear-gradient(to right,#14b7ff,#b221ff);">
				<h3 class="panel-title"><font color="#fff"><i class="fa fa-television"></i>&nbsp;&nbsp;<b>今日实时数据</b></font></h3>
			</div>
			<table class="table table-striped">
			<thead><tr><th>新入驻商户</th><th>完成订单</th><th>交易额</th></tr></thead>
			<tbody><th><?php echo mysqli_num_rows($sus);?>个</th><th><?php echo $dd;?>个</th><th><?php echo $jye;?>元</th></tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>

