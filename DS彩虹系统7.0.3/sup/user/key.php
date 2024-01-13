<?php
$title='我的key';
include '../config.php';
$my=$_GET['my'];
if($my=='ggkey'){
function getkm($len){
    global $id;
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$strlen = strlen($str);
	$randstr = "";
	for ($i=0;$i<$len;$i++) {
		$randstr .= $str[mt_rand(0,$strlen-1)];
	}
	return 'KEY'.$randstr.$id['id'].'XH';
}
$key=getkm(30);
$sql="UPDATE `supplier` SET `key`='$key' WHERE user='{$u}'";
	if ($con->multi_query($sql) === TRUE){exit($key);}else{exit('fail');}
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">我的key&nbsp;<a href="javascript:history.back(-1)"><span class="btn btn-sm btn-warning">返回</span></a></h3></div>
<div class="panel-body">
<div class="form-group">
<label class="col-sm-2 control-label">秘钥</label>
<div class="input-group">
<input type="text" class="form-control" value="<?php echo $userrow['key']; ?>" placeholder="秘钥" disabled="disabled"><span class="input-group-btn"><a href="javascript:ggkey()" class="btn btn-success">换一个</a></span>
</div>
</div>
<p>
	<span style="color:#E53333;">注意：秘钥泄漏可能会对你的账户造成伤害和经济损失请妥善保管！</span>
</p>
  <script> 
  function ggkey(){
    $.get("key.php?my=ggkey",function(data){
      if(data==""){alert('失败');return;}
      alert('更改成功');
      window.location.reload();
  	});
  }
</script>