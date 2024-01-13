<?php
$title='账单';
include 'head.php';
$mod=$_GET['mod'];
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >账单</div>
<div class="panel-body">
<table class="table table-striped">
<thead><tr><th>ID</th><th>金额</th><th>详情</th><th>时间</th></tr></thead>
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
$offset=$pagesize*($page - 1);
$rs=mysqli_query($con,"SELECT * FROM sup_pay WHERE sup='$u' order by id desc limit $offset,$pagesize");
while($res = mysqli_fetch_array($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['money'].'</td><td>'.$res['name'].'</td><td>'.$res['time'].'</td></tr>';
}
?>
          </tbody>
        </table>
  </div>
</div>
</div>
</div>