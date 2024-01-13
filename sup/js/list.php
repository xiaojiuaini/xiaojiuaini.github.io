<?php
/**
 * 订单管理
**/
$title='订单管理';
include '../head.php';
//if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container-fluid" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
      <form action="list.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>条件查询</label>
	<select name="type" class="form-control"><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></select>
  </div>
  <button type="submit" class="btn btn-primary">查询</button>&nbsp;
  <a href="./export.php" class="btn btn-success">导出订单</a>
  <a href="/" class="btn btn-warning">首页</a>
        <a href="/record.php" class="btn btn-info">账单</a>
</form>

	  <form name="form1" method="post" action="list.php?my=op">
	  <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>订单编号</th><th>商品名称</th><th>下单数据</th><th>下单数量</th><th>站点ID</th><th>添加时间</th><th>对接状态</th><th>订单状态</th><th>操作</th></tr></thead>
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
if ($type=='3'){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($ress = mysqli_fetch_array($result))
{
  $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$ress['tid']}' and status='3' order by id desc limit $offset,$pagesize");
  while($res=mysqli_fetch_array($list))
  {
    $arr = explode("|",$ress['inputs']);
    $i=$i+1;
    echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$ress['name'].'</span></td><td><span onclick="inputOrder('.$res['id'].')">'.$ress['input'].':'.$res['input'].($res['input2']?'<br/>'.$arr[0].':'.$res['input2']:null).($res['input3']?'<br/>'.$arr[1].':'.$res['input3']:null).($res['input4']?'<br/>'.$arr[2].':'.$res['input4']:null).($res['input5']?'<br/>'.$arr[3].':'.$res['input5']:null).'</span></td><td>'.$res['value']*$ress['value'].'</td><td>'.$res['zid'].'</span></td><td>'.$res['addtime'].'</td><td>'.($res['status']==0?'未对接':'未对接').'</td><td>'.($res['status']==0?'<font color="blue">待处理</font>':null).''.($res['status']==1?'<font color="green">已完成</font>':null).''.($res['status']==2?'<font color="orange">正在处理</font>':null).''.($res['status']==3?'<font color="red">异常</font>':null).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></td></tr>';
    }
}
                        echo '<font color="blue">亲爱的供货商，您的异常订单有'.$i.'个！</font>';}
?>
            
<?php
$type=$_GET['type'];
if ($type=='2'){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($ress = mysqli_fetch_array($result))
{
  $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$ress['tid']}' and status='2' order by id desc limit $offset,$pagesize");
  while($res=mysqli_fetch_array($list))
  {
    $arr = explode("|",$ress['inputs']);
    $i=$i+1;
    echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$ress['name'].'</span></td><td><span onclick="inputOrder('.$res['id'].')">'.$ress['input'].':'.$res['input'].($res['input2']?'<br/>'.$arr[0].':'.$res['input2']:null).($res['input3']?'<br/>'.$arr[1].':'.$res['input3']:null).($res['input4']?'<br/>'.$arr[2].':'.$res['input4']:null).($res['input5']?'<br/>'.$arr[3].':'.$res['input5']:null).'</span></td><td>'.$res['value']*$ress['value'].'</td><td>'.$res['zid'].'</span></td><td>'.$res['addtime'].'</td><td>'.($res['status']==0?'未对接':'未对接').'</td><td>'.($res['status']==0?'<font color="blue">待处理</font>':null).''.($res['status']==1?'<font color="green">已完成</font>':null).''.($res['status']==2?'<font color="orange">正在处理</font>':null).''.($res['status']==3?'<font color="red">异常</font>':null).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></td></tr>';
    }
}
                        echo '<font color="blue">亲爱的供货商，您正在处理的订单还有'.$i.'个,辛苦您了！</font>';}
?>
            
<?php
$type=$_GET['type'];
if ($type=='0'){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($ress = mysqli_fetch_array($result))
{
  $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$ress['tid']}' and status='0' order by id desc limit $offset,$pagesize");
  while($res=mysqli_fetch_array($list))
  {
    $arr = explode("|",$ress['inputs']);
    $i=$i+1;
    echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$ress['name'].'</span></td><td><span onclick="inputOrder('.$res['id'].')">'.$ress['input'].':'.$res['input'].($res['input2']?'<br/>'.$arr[0].':'.$res['input2']:null).($res['input3']?'<br/>'.$arr[1].':'.$res['input3']:null).($res['input4']?'<br/>'.$arr[2].':'.$res['input4']:null).($res['input5']?'<br/>'.$arr[3].':'.$res['input5']:null).'</span></td><td>'.$res['value']*$ress['value'].'</td><td>'.$res['zid'].'</span></td><td>'.$res['addtime'].'</td><td>'.($res['status']==0?'未对接':'未对接').'</td><td>'.($res['status']==0?'<font color="blue">待处理</font>':null).''.($res['status']==1?'<font color="green">已完成</font>':null).''.($res['status']==2?'<font color="orange">正在处理</font>':null).''.($res['status']==3?'<font color="red">异常</font>':null).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></td></tr>';
    }
}
                        echo '<font color="blue">亲爱的供货商，您还需处理订单'.$i.'个,辛苦您了！</font>';}
?>
            
<?php
$type=$_GET['type'];
if ($type=='1'){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u'");
while($ress = mysqli_fetch_array($result))
{
  $list=mysqli_query($con,"SELECT * FROM shua_orders WHERE tid='{$ress['tid']}' and status='1' order by id desc limit $offset,$pagesize");
  while($res=mysqli_fetch_array($list))
  {
    $arr = explode("|",$ress['inputs']);
    $i=$i+1;
    echo '<tr><td><input type="checkbox" name="checkbox[]" id="list1" value="'.$res['id'].'" onClick="unselectall1()"><b>'.$res['id'].'</b></td><td><span onclick="showOrder('.$res['id'].')" title="点击查看详情">'.$ress['name'].'</span></td><td><span onclick="inputOrder('.$res['id'].')">'.$ress['input'].':'.$res['input'].($res['input2']?'<br/>'.$arr[0].':'.$res['input2']:null).($res['input3']?'<br/>'.$arr[1].':'.$res['input3']:null).($res['input4']?'<br/>'.$arr[2].':'.$res['input4']:null).($res['input5']?'<br/>'.$arr[3].':'.$res['input5']:null).'</span></td><td>'.$res['value']*$ress['value'].'</td><td>'.$res['zid'].'</span></td><td>'.$res['addtime'].'</td><td>'.($res['status']==0?'未对接':'未对接').'</td><td>'.($res['status']==0?'<font color="blue">待处理</font>':null).''.($res['status']==1?'<font color="green">已完成</font>':null).''.($res['status']==2?'<font color="orange">正在处理</font>':null).''.($res['status']==3?'<font color="red">异常</font>':null).'</td><td>无</td></tr>';
    }
}
                        echo '<font color="blue">亲爱的供货商，您已完成订单'.$i.'个！</font>';}
?>
          </tbody>
        </table>
<input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)" value="checkbox">&nbsp;全选&nbsp;
<select name="status"><option selected>操作订单</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option></select>
<input type="submit" name="Submit" value="确定">
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
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$s=10;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
<script>
function setStatus(name,zt){
    var temp_form = document.createElement("form");  
    temp_form .action = "setStatus.php?zt="+zt;  
    temp_form .target = "_blank";  
    temp_form .method = "post";  
    temp_form .style.display = "none";   
    for (var id in name) {   
    var opt = document.createElement("textarea");  
    opt.name = "name";  
    opt.value = name;  
    temp_form .appendChild(opt);  
     }  
     document.body.appendChild(temp_form);  
     temp_form .submit();  
  }
</script>