<?php
error_reporting(0);
$title = '商品管理';
include 'head.php';
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >商品管理 &nbsp;<a href="/sup/user/shoplist.php"><span class="btn btn-warning btn-xs">点击添加商品</span></a></div>
<div class="panel-body">
 <table class="table table-striped">
           <thead><tr><th>商品名称</th><th>操作</th></tr></thead>
 <tbody>
 <form id="classlist">
 <?php
 $result = mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$u' order by tid desc");
 $i = 0;
 while($res = mysqli_fetch_array($result))
 {
   $i = $i + 1;
     echo '<tr><td><a href="/index.php?cid='.$res['cid'].'&tid='.$res['tid'].'">'.$res['name'].'</a></td><td>'.($res['active']==1?'<button class="btn btn-success btn-sm" onmousedown="setactive('.$res['tid'].')">显示</button>':null).''.($res['active']==0?'<button class="btn btn-sm btn-warning" onmousedown="setactive('.$res['tid'].')">隐藏</button>':null).'&nbsp;'.($res['close']==0?'<button class="btn btn-info btn-sm" onmousedown="setclose('.$res['tid'].')">正常</button>':null).''.($res['close']==1?'<button class="btn btn-sm btn-warning" onmousedown="setclose('.$res['tid'].')">维护</button>':null).'&nbsp;<a href="user/shoplist.php?tid='.$res['tid'].'" class="btn btn-primary btn-sm">编辑</a>&nbsp;<a href="/index.php?cid='.$res['cid'].'&tid='.$res['tid'].'" class="btn btn-sm btn-danger">查看</a></td></tr>';
 }
        echo '<script type="text/javascript">
            document.getElementById("demo").innerHTML = "你目前的商品数量'.$i.'个";
          </script>';
 ?>
 
 			</form>
           </tbody>
         </table>
  </div>
</div>
<script>
  function setactive(tid){
    $.get("/sup/ajax.php?my=spxs&tid="+tid,function(data){
    	var a = data.indexOf("成功"); 
      if (a!==-1){window.location.reload();}else{alert('请先缴纳保证金');}	
      });}
    function setclose(tid){
    $.get("/sup/ajax.php?my=spxj&tid="+tid,function(data){
    	var a = data.indexOf("成功");
      if (a!==-1) {window.location.reload();}else{alert('请先缴纳保证金');}	
      });}
</script>