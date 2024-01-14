<?php
$title='商品管理';
include '../head.php';
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}
$mod=$_GET['mod'];
$yh=$_GET['yh'];
$tid=$_GET['tid'];
$active=$_GET['active'];
if ($tid!==''){
  if ($active==1){mysqli_query($con,"UPDATE shua_tools SET active=0 WHERE tid='$tid'");}else{mysqli_query($con,"UPDATE shua_tools SET active=1 WHERE tid='$tid'");}
}
if($mod=='xj'){mysqli_query($con,"UPDATE `shua_tools` SET active=0 WHERE `supplier`='$yh'");}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >商品管理&nbsp;<?php if($yh!==''){echo '<a href="?mod=xj&yh='.$yh.'">下架他所有商品</a>';}?><span id="demo"></span></div>
<div class="panel-body">
        <table class="table table-striped">
          <thead><tr><th>商品id</th><th>商品名称</th><th>操作</th></tr></thead>
<tbody><form id="classlist">
  
<?php
$pagesize=30;
$page=intval($_GET['page']);
if ($page==null){$page=1;}
$offset=$pagesize*($page - 1);  
function display_zt($zt){
	if($zt==1)
		return '显示';
	else
		return '已隐藏';
}
?>
  
<?php
if ($yh!==''){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$yh' order by tid desc");
$i = 0;
while($res = mysqli_fetch_array($result)){
  $i = $i + 1;
    echo '<tr><td>'.$res['tid'].'</td><td><a href="/?cid='.$res['cid'].'&tid='.$res['tid'].'" target="_blank">'.$res['name'].'</a></td><td><a href="?tid='.$res['tid'].'&gl='.$gl.'&yh='.$yh.'&active='.$res['active'].'" class="btn btn-sm btn-success">'.display_zt($res['active']).'</a></td></tr>';
}   echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "他目前的商品数量'.$i.'个;
         </script>';
}else{$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier!='0' order by tid desc");
  $i = 0;
while($res = mysqli_fetch_array($result))
{
  $i = $i + 1;
    echo '<tr><td>'.$res['tid'].'</td><td><a href="/?cid='.$res['cid'].'&tid='.$res['tid'].'" target="_blank">'.$res['name'].'</a></td><td><a href="?tid='.$res['tid'].'&gl='.$gl.'&yh='.$yh.'&active='.$res['active'].'" class="btn btn-sm btn-success">'.display_zt($res['active']).'</a></td></tr>';
}echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "供货商商品数量'.$i.'个";
         </script>';
}
?>

			</form>
          </tbody>
        </table>
  </div>
</div>