<?php
$title='举报供货商';
include("../includes/common.php");
$ress = $DB->get_row("SELECT qq,wx,email FROM supplier WHERE id='1'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//s1.pstatp.com/cdn/expire-1-M/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//s1.pstatp.com/cdn/expire-1-M/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="//cdn.qqzzz.net/assets/simple/css/plugins.css">
  <link rel="stylesheet" href="//cdn.qqzzz.net/assets/simple/css/main.css">
  <link rel="stylesheet" href="//cdn.qqzzz.net/assets/css/common.css">
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
     <ul class="list-group text-dark" id="checkupdate">
	<li class="list-group-item"><font color="#333">若发现供货商诈骗/私下交易或其他问题请联系我们进行举报，举报奖励2~200元奖励哦！</font></li>
     <li class="list-group-item"><font color="green">QQ：<?php echo $ress['qq']; ?></font></li>
     <li class="list-group-item"><font color="#d00e42">微信：<?php echo $ress['wx']; ?></font></a></li>
     <li class="list-group-item">邮箱：<?php echo $ress['email']; ?></li>
     </ul>
	 </div></div></div></div>
<script src="//s1.pstatp.com/cdn/expire-1-M/jquery/1.12.4/jquery.min.js"></script>
<script src="//s1.pstatp.com/cdn/expire-1-M/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>