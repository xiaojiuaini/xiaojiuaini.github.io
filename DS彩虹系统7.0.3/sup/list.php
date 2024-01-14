<?php
$title='订单管理';
include 'head.php';
$mod=$_GET['mod'];
?>
<style>
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
                    <h4 class="modal-title" id="myModalLabel">搜索订单</h4>
                </div>
                <div class="modal-body">
                    <form method="get"><input type="text" class="form-control" name="kw" placeholder="请输入订单编号"><br/>
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
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >订单管理</div>
<div class="panel-body">
<form action="list.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>条件查询</label>
	<select name="type" class="form-control"><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></select>
  </div>
  <button type="submit" class="btn btn-primary">查询</button>&nbsp;
  <a href="user/export.php" class="btn btn-success">导出订单</a>
        <a href="record.php" class="btn btn-info">账单</a>
        <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-danger">搜索</a>
</form>

	  <form name="form1" method="post" action="list.php?my=op">
	  <div class="table-responsive">
        <table class="table table-striped" border="0">
          <thead style="font-weight: bold;"><tr><th>订单编号</th><th>商品名称</th><th>下单数据</th><th>下单数量</th><th>站点ID</th><th>时间</th><th>对接状态</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$i=0;
$offset=$pagesize*($page - 1);     
?>
  <?php
$type=$_GET['type'];
$kw=$_GET['kw'];
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($ress = mysqli_fetch_array($result))
{
	if($kw!==null){ $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE id='$kw'");}else{
  $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$ress['tid']}' and status='$type' order by id desc limit $offset,$pagesize");}
  while($res=mysqli_fetch_array($list))
  {
    $arr = explode("|",$ress['inputs']);
    $i=$i+1;
    if($ress['tid']==$res['tid']){
    echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$ress['name'].'</span></td><td><span onclick="inputOrder('.$res['id'].')">'.$ress['input'].':'.$res['input'].($res['input2']?'<br/>'.$arr[0].':'.$res['input2']:null).($res['input3']?'<br/>'.$arr[1].':'.$res['input3']:null).($res['input4']?'<br/>'.$arr[2].':'.$res['input4']:null).($res['input5']?'<br/>'.$arr[3].':'.$res['input5']:null).'</span></td><td>'.$res['value']*$ress['value'].'</td><td>'.$res['zid'].'</span></td><td>'.$res['addtime'].'</td><td>'.($res['status']==0?'未对接':'未对接').'</td><td>'.($res['status']==0?'<font color="blue">待处理</font>':null).''.($res['status']==1?'<font color="green">已完成</font>':null).''.($res['status']==2?'<font color="orange">正在处理</font>':null).''.($res['status']==3?'<font color="red">异常</font>':null).'</td>';
    if($res['status']!=='1'){echo '<td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option>'.($res['zid']>1||is_numeric($res['userid'])?'<option value="6">退款</option>':null).'</td>';} echo '</tr>';
    }
    }
}
if($kw==null){echo '<font color="blue">当前状态订单有'.$i.'个！</font>';}
?>

          </tbody>
        </table>

      </div>
	 </form>


<script>
var checkflag1 = "false";
function check1(field) {
if (checkflag1 == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag1 = "true";
return "false"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag1 = "false";
return "true"; }
}

function unselectall1()
{
    if(document.form1.chkAll1.checked){
	document.form1.chkAll1.checked = document.form1.chkAll1.checked&0;
	checkflag1 = "false";
    }
}
</script>

    </div>
  </div>
<script>
  function setStatus(id,status){
  	if(status==6){tk(id);return;}
    $.get("/sup/user/su.php?id="+id+"&status="+status,function(data){
      if (data='cgts') {
        window.location.reload();
        }	
      });
    }
    function tk(id){
    $.get("/user/dindantuikuan.php?mod=tk&id="+id,function(data){
      if (data!='') {
      	alert(data);
        window.location.reload();
        }	
      });
      return;
    }
</script>
  </div>
</div>