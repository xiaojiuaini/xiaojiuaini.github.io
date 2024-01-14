<?php
$title='供货商主页';
$yh=$_GET['yh'];
include("config.php");
$ress = mysqli_fetch_array(mysqli_query($con,"SELECT qq,wx,margin FROM supplier WHERE user='$yh'"));
//$ress = $DB->get_row("SELECT qq,wx,margin FROM supplier WHERE user='$yh'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//s1.pstatp.com/cdn/expire-1-M/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//s1.pstatp.com/cdn/expire-1-M/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/assets/simple/css/plugins.css">
  <link rel="stylesheet" href="/assets/simple/css/main.css">
  <link rel="stylesheet" href="/assets/css/common.css">
  <script src="//s1.pstatp.com/cdn/expire-1-M/modernizr/2.8.3/modernizr.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//s1.pstatp.com/cdn/expire-1-M/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//s1.pstatp.com/cdn/expire-1-M/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body><img src="../assets/img/bj.png" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
  <br />
    <div class="widget">
    <div class="widget-content themed-background-flat text-center"  style="background-image: url(//cdn.qqzzz.net/assets/simple/img/userbg.jpg);background-size: 100% 100%;" >
<img  class="img-circle"src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $ress['qq']; ?>&spec=100" alt="Avatar" alt="avatar" height="60" width="60" />
    </div>
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
            <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><span id="demo"></span></h2>
        </div>
           <div class="table-responsive">
        <table class="table table-striped">
<tbody><form id="classlist">
  <div id="supjs" class="alert alert-success" style="padding: 10px; font-size: 90%; text-align:left;font-weight:bold;background-color:#dae0e8" ></div>
<?php
if ($yh!==''){
$rs=mysqli_query($con,"SELECT * FROM shua_tools WHERE supplier='$yh'  and active=1 order by tid desc");
while($res = mysqli_fetch_array($rs)){
  $i = $i + 1;
   echo '<tr><td><a href="/?cid='.$res['cid'].'&tid='.$res['tid'].'" target="_blank" style="color:#5ccdde;">'.$res['name'].'</a></td><td><a href="/?cid='.$res['cid'].'&tid='.$res['tid'].'" target="_blank" class="btn btn-sm btn-success">查看</a></td></td></tr>';
} echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "他目前的商品数量'.$i.'个";
           document.getElementById("supjs").innerHTML = "<span style=\"color:#777;font-size: 10px;\">以下业务由供货商提供，由平台担保购买具体业务详情可联系供货商！</span><br><span style=\"color:red;font-size: 10px;\";>保证金:'.$ress['margin'].'元</span><br><span style=\"color:#EE33EE;font-size: 10px;\";>请勿脱离平台交易，谨防受骗！（线下交易，平台不负任何责任！）</span><br>";
         </script>';
}


?>
</table></tbody></form></div></div></div></div>
<script src="//s1.pstatp.com/cdn/expire-1-M/jquery/1.12.4/jquery.min.js"></script>
<script src="//s1.pstatp.com/cdn/expire-1-M/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>