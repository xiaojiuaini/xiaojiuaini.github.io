<?php
$id=$_GET['id'];
$mod=$_GET['mod'];
$title='供货商管理';
include '../head.php';
include 'gx.php';
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}
if($mod==null){
echo '
<div class="wrapper">
<div class="col-sm-6">
<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
		站长管理
	</div>
	<div class="panel-body">
	<tr>
		<td><a href="?mod=shop" class="btn btn-warning"><b>商品管理&nbsp;</b><span id="message_count"></span></a></td>
	      <td><a href="ddcx.php" class="btn btn-warning"><b>订单查询&nbsp;</b></a></td>
	      <td><a href="?mod=user" class="btn btn-warning"><b>用户管理&nbsp;</b></a></td>
		  <td><a href="?mod=tx" class="btn btn-warning"><b>提现&nbsp;</b></a></td>
		  		<td><a href="?mod=set" class="btn btn-warning"><b>设置&nbsp;</b></a></td>
		  		<td><a href="margin.php" class=" btn btn-warning"><b>保证金&nbsp;</b></a></td>
		</tr>
 '.$html.'
</div>
</div>
</div>
';
      echo '
    <div class="col-sm-6">
    	<div class="panel panel-default">
        <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" id="demo">今日交易</div>
    		  <div class="panel-body">
    		  <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>名称</th><th>金额</th><th>用户</th><th>时间</th><th>订单编号</th></tr></thead>
<tbody><form id="classlist">';
$result = mysqli_query($con,"select * from sup_pay where to_days(time) = to_days(now())order by id desc");
$i = 0;$b = 0;
while($res = mysqli_fetch_array($result))
{
  $i = $i + 1;
  if(strpos($res['name'],"编号")!==FALSE){$b=$b+$res['money'];$sj=explode("编号:",$res['name']);$sj1=explode("订单",$sj[1]);}else{$sj1[0]='';}
  if($i<30){echo '<tr><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['money'].'</td><td><a target="_blank" href="./?mod=user&kw='.$res['sup'].'">'.$res['sup'].'</a></td><td>'.$res['time'].'</td><td><a target="_blank" href="ddcx.php?ddbh='.$sj1[0].'">'.$sj1[0].'</a></td></tr>';}
}
       echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "今日订单数量'.$i.'个,交易额'.$b.'元";
         </script></form>
          </tbody>
        </table>
          </div>
        </div>
      </div>
    </div>';}

if ($mod=='tx'){
$title='余额提现';
  echo'
  <style>
  .msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
  .msg-body{padding: 15px;margin-bottom: 20px;}
  </style>
  <div class="wrapper">
  <div class="col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >&nbsp;<span id="demo"></span><a href="?mod=wctx" class="btn btn-sm btn-warning">已完成</a></div>
  <div class="panel-body"><div class="table-responsive">';
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
  echo '
        <table class="table table-striped">
        
          <thead><tr><th>ID</th><th>提现金额</th><th>实际到账</th><th>余额</th><th>提现方式</th><th>提现账号</th><th>姓名</th><th>申请时间</th><th>完成时间</th><th>状态</th><th>操作</th><th>保证金</th></tr></thead>
          <tbody>';
  $b=0;$i=0;$c=0;
$sql = "SELECT * FROM sup_tx WHERE status=0 order by id desc";
$rs=mysqli_query($con, $sql);
if (mysqli_num_rows($rs) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($rs)) {$b=$b+$res['money'];
if($res['status']==0){$i=$i+$res['money'];}else{$c=$c+$res['money'];}
                                             $us=$res['user'];
  $hhhh=mysqli_query($con,"SELECT margin FROM `supplier` WHERE user='$us'");
  $rows = mysqli_fetch_array($hhhh);
       echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['money'].'</td><td>'.$res['realmoney'].'</td><td>'.$res['rmb'].'</td><td>'.display_type($res['pay_type']).'</td><td>'.$res['pay_account'].'</td><td><a href="?mod=yhdd&yhid='.$res['user'].'">'.$res['pay_name'].'</a></td><td>'.$res['addtime'].'</td><td>'.($res['status']==1?$res['endtime']:null).'</td><td>'.display_zt($res['status']).'</td><td><a href="?mod=wc&id='.$res['id'].'" class="btn btn-sm btn-success">完成</a></td><td>'.$rows['margin'].'</td></tr>';
    }echo '<script type="text/javascript">document.getElementById("demo").innerHTML = "待处理提现'.$i.'元";</script>';
}echo '</tbody>
        </table></div>
      </div>
    </div>
 ';}

if ($mod=='wctx'){
$title='余额提现';
  echo'
  <style>
  .msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
  .msg-body{padding: 15px;margin-bottom: 20px;}
  </style>
  <div class="wrapper">
  <div class="col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" id="demo">完成提现</div>
  <div class="panel-body"><div class="table-responsive">';
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
  echo '
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>金额</th><th>实际到账</th><th>余额</th><th>提现方式</th><th>提现账号</th><th>姓名</th><th>申请时间</th><th>完成时间</th><th>状态</th><th>操作</th><th>保证金</th></tr></thead>
          <tbody>';
  $b=0;$i=0;$c=0;
$sql = "SELECT * FROM sup_tx WHERE status=1 order by id desc";
$rs=mysqli_query($con, $sql);
if (mysqli_num_rows($rs) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($rs)) {$b=$b+$res['money'];
if($res['status']==0){$i=$i+$res['money'];}else{$c=$c+$res['money'];}
                                             $us=$res['user'];
  $hhhh=mysqli_query($con,"SELECT margin FROM `supplier` WHERE user='$us'");
  $rows = mysqli_fetch_array($hhhh);
       echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['money'].'</td><td>'.$res['realmoney'].'</td><td>'.$res['rmb'].'</td><td>'.display_type($res['pay_type']).'</td><td>'.$res['pay_account'].'</td><td><a href="?mod=yhdd&yhid='.$res['user'].'">'.$res['pay_name'].'</a></td><td>'.$res['addtime'].'</td><td>'.($res['status']==1?$res['endtime']:null).'</td><td>'.display_zt($res['status']).'</td><td><a href="?mod=wc&id='.$res['id'].'" class="btn btn-sm btn-success">完成</a></td><td>'.$rows['margin'].'</td></tr>';
    }echo '<script type="text/javascript">document.getElementById("demo").innerHTML = "完成提现'.$b.'元";</script>';
}echo '</tbody>
        </table>
      </div>
    </div>
';

}

if($mod=='wc'){$time=date('Y-m-d h:i:s', time());mysqli_query($con,"UPDATE sup_tx SET status=1,endtime='$time' WHERE id='$id'");exit("<script language='javascript'>window.location.href='./?mod=tx';</script>");}
if($mod=='shop'){ echo '<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >用户商品查询</div>
<div class="panel-body">
  <form action="list.php" method="get" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户名</label>
	  <div class="col-sm-10"><input type="text" name="yh" value="" class="form-control" placeholder="用户名"/></div>
	</div><br/>
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="查询" class="btn btn-primary form-control"/><br/>
	 </div>
  </form>
</div>
</div>';
}
$url=$_SERVER ['HTTP_HOST'];
if($mod=='set'){ 
$ggs=mysqli_query($con,"SELECT * FROM sup_config");
$gg = mysqli_fetch_array($ggs);
$bzj=mysqli_query($con,"SELECT * FROM sup_config WHERE k='bzj'");
$bzjs = mysqli_fetch_array($bzj);
  echo '<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-6">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >设置</div>
<div class="panel-body">
  <form action="?mod=sets" method="post" class="form-horizontal" role="form">
  <label">保证金</label><br>
  <input type="text" class="form-control" id="urlid" name="bzj" value="';echo $bzjs['v'].'" placeholder="供货商最低缴纳多少保证金">
 
  <label>公告</label><br>
  <textarea class="form-control" rows="10" name="gg" >';echo $gg['v'].'</textarea>
<label">邮箱监控地址：</label><br>
<a class="form-control" href="http://'.$url.'/sup/email/jk.php">http://'.$url.'/sup/email/jk.php</a><br>
<input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
  </form>
  </div>
  </div>
</div>
</div>';
}
if($mod=='sets'){$gg=$_POST['gg'];$bzj=$_POST['bzj'];$dswz=$_POST['dswz'];mysqli_query($con,"UPDATE `sup_config` SET `v`='$gg' WHERE k='gg'");mysqli_query($con,"UPDATE `sup_config` SET `v`='$bzj' WHERE k='bzj'");mysqli_query($con,"UPDATE `sup_config` SET `v`='$dswz' WHERE k='dswz'");exit("<script language='javascript'>alert('修改完成！');window.location.href='./';</script>");}
?>

 <?php
//订单
  if($mod=='dd'){
    echo '<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" id="demo">订单查看</div>
<div class="panel-body">
<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>名称</th><th>金额</th><th>用户</th><th>时间</th></tr></thead>
<tbody><form id="classlist">';
$result = mysqli_query($con,"SELECT * FROM `sup_pay` order by id desc");
$i = 0;$b = 0;
while($res = mysqli_fetch_array($result))
{
  $i = $i + 1;if(strpos($res['name'],"提现")!==FALSE){$b=$b+$res['money'];}
    echo '<tr><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['money'].'</td><td>'.$res['sup'].'</td><td>'.$res['time'].'</td></tr>';
}
       echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "当前的订单数量'.$i.'个,供货商累计获得金额'.$b.'元";
         </script></form>
          </tbody>
        </table>
        <a href="./">>>返回首页</a>
        </div>
      </div>
    </div>';}
?>
 <?php
//供货商数量
  if($mod=='user'){
  	$kw=$_GET['kw'];
  	if($kw==null){$kw=$_POST['kw'];}
    function display_us($zt){
	if($zt==1)
		return '<font color=red>封禁</font>';
	else
		return '<font color=blue>正常</font>';
}
    echo '<style>-
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>

    <div class="modal" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="?mod=user" form_name><input type="text" class="form-control" name="kw" placeholder="请输入用户名"><br/>
                    <button type="submit" class="btn btn-primary btn-block" id="search_submit">搜索</button></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">供货商列表&nbsp;<span id="demo">&nbsp;</span><a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a></div>
<div class="panel-body">
<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>用户名</th><th>QQ</th><th>邮箱</th><th>状态</th><th>余额</th><th>保证金</th><th>提现费率</th><th>时间</th><th>操作</th></tr></thead>
<tbody><form id="classlist">';
    //$results = mysqli_query($con,"SELECT * FROM `shua_site` WHERE user='$user' and pwd='$pwd'");
if($kw!==null){$result = mysqli_query($con,"SELECT * FROM `supplier` WHERE user='$kw' order by id desc");}else{
$result = mysqli_query($con,"SELECT * FROM `supplier` WHERE email!='' order by id desc");}
$i = 0;$b = 0;
while($res = mysqli_fetch_array($result))
{
  $i = $i + 1;$b=$b+$res['rmb'];
    echo '<tr><td>'.$res['id'].'</td><td><a href="?mod=yhdd&yhid='.$res['user'].'">'.$res['user'].'</a></td><td>'.$res['qq'].'</td><td>'.$res['email'].'</td><td>'.display_us($res['status']).'</td><td>'.$res['rmb'].'</td><td>'.$res['margin'].'</td><td>'.$res['tixian_rate'].'%</td><td>'.$res['adtime'].'</td><td><a href="./userlist.php?user='.$res['user'].'" class="btn btn-success">编辑</a>&nbsp;<a href="./?mod=dd&yhid='.$res['user'].'" class="btn btn-success">账单</a></td></tr>';
}
       echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "当前的供货商数量'.$i.'个,供货商余额'.$b.'元";
         </script></form>
          </tbody>
        </table>
        </div>
      </div>
    </div>
';}
?>

 <?php
//用户订单
  if($mod=='yhdd'){
    $yhid=$_GET['yhid'];
    echo '<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" id="demo">用户订单</div>
<div class="panel-body">
<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>名称</th><th>金额</th><th>用户</th><th>时间</th></tr></thead>
<tbody><form id="classlist">';
$result = mysqli_query($con,"SELECT * FROM `sup_pay` WHERE sup='$yhid' order by id desc");
$i = 0;$b = 0;
while($res = mysqli_fetch_array($result))
{
  if(strpos($res['name'],"提现")==FALSE || strpos($res['name'],"保证金")==FALSE){$b=$b+$res['money'];$i = $i + 1;}
    echo '<tr><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['money'].'</td><td>'.$res['sup'].'</td><td>'.$res['time'].'</td></tr>';
}
       echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "他的订单数量'.$i.'个,他累计获得金额'.$b.'元";
         </script></form>
          </tbody>
        </table>
        <a href="./">>>返回首页</a>
        </div>
      </div>
    </div>
';}
?>