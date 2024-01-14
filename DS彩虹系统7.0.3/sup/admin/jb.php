<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>已被举报供货商查看-星宇网络</title>
  <link rel="shortcut icon" href="http://auth.xingyupay.com/favicon.ico" />
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<div class="wrapper">
  <div class="col-sm-12 col-md-10 col-lg-6 center-block" style="float: none;">
<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
      <span id="demo"></span><a href="/"><span class="btn btn-sm btn-warning">返回</span></a>
    </div>
           <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>用户名</th><th>QQ</th><th>微信</th><th>状态</th></tr></thead>
<tbody><form id="classlist">
<?php 
   function display_us($zt){
	if($zt==1)
		return '<font color=red>封禁</font>';
	else
		return '<font color=blue>正常</font>';
}
  include '../con.php';
$result = mysqli_query($con,"SELECT * FROM supplier WHERE status=1");
$i = 0;
while($res = mysqli_fetch_array($result)){
  $i = $i + 1;
    echo '<tr><td>'.$res['user'].'</td><td>'.$res['qq'].'</td><td>'.$res['wx'].'</td><td>'.display_us($res['status']).'</td><tr>';
}   echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "目前已被举报的供货商数量'.$i.'个,<font color=#1414e4>欢迎举报恶意诈骗、要求私下交易等不良供货商，举报有奖励！</font>";
         </script>';
?>

			</form>
          </tbody>
        </table>
      
      </div>
    </div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
  </div>
</div>