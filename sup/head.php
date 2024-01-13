<?php
error_reporting(0);
$tj=0;
include 'config.php';
if($userrow && $d==$userrow['pwd']){}else{setcookie("user","");setcookie("key","");exit("<script language='javascript'>window.location.href='/sup/login.php';</script>");}
if ($userrow['status']==1){exit("<script language='javascript'>alert('当前账号已被封禁！');window.location.href='/login.php';</script>");}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8" />
  <title><?php echo $title ?></title>
  <link rel="shortcut icon" href="http://auth.xingyupay.com/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/sup/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/sup/css/app.css" type="text/css" />
  <script src="/sup/js/app.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<div class="app app-header-fixed  ">
  <header id="header" class="app-header navbar ng-scope" role="menu">
      <div class="navbar-header bg-primary">
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <a href="/sup" class="navbar-brand text-lt">
          <i class="fa fa-desktop hidden-xs"></i>
          <span class="hidden-folded m-l-xs">供货商系统</span>
        </a>
      </div>

      <div class="collapse pos-rlt navbar-collapse box-shadow bg-primary">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"> 菜单</i>
            <i class="fa fa-indent fa-fw text-active">菜单</i>
          </a>
        </div>
        <!-- / buttons -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq'] ?>&spec=100">
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md"><?php echo $userrow['user'] ?></span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
                <a href="./user/uset.php?mod=user">
                  <span>修改资料</span>
                </a>
              </li>
			  <li>
                <a href="/">
                  <span>平台首页</span>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a ui-sref="access.signin" href="./?login=2">退出登录</a>
              </li>
            </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->
  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-primary">
      <div class="aside-wrap">
        <div class="navi-wrap">

          <!-- nav -->
          <nav ui-nav class="navi">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>导航</span>
              </li>
			  <?php if($userrow['id']==1){
				  echo '<li class="">
				    <a href="/sup/admin">
				      <i class="fa fa-wrench"></i>
				      <span>站长后台</span>
				    </a>
				  </li>';
			  }?>
              <li class="">
                <a href="/sup">
                  <i class="fa fa-user"></i>
                  <span>用户中心</span>
                </a>
              </li>
              
              <li class="">
                <a href="/sup/classlist.php">                      
                  <i class="fa fa-cart-plus"></i>
                  <span>商品管理</span>
                </a>
              </li>
			  <li class="">
                <a href="/sup/list.php?type=0">
                  <i class="fa fa-check-square-o"></i>
                  <span>订单管理</span>
                </a>
              </li>
              <li class="">
                <a href="/sup/user/fakalist.php">                      
                  <i class="fa fa-th sidebar-nav-icon"></i>
                  <span>卡密管理</span>
                </a>
              </li>
			  <li class="">
                <a href="/sup/user/uset.php?mod=user">
                  <i class="fa fa-list-alt"></i>
                  <span>资料修改</span>
                </a>
              </li>
              <li>
			  <li class="">
                <a href="/sup/kfwd.php">
                  <i class="fa fa-handshake-o"></i>
                  <span>开发文档</span>
                </a>
              </li>
              <li>
                <a ui-sref="access.signin" href="/sup/?login=2">
                  <i class="fa fa-power-off"></i>
                  <span>退出登录</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
  </aside>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
				<div class="bg-light lter b-b wrapper-sm ng-scope">
					<ul class="breadcrumb" style="padding: 0;margin: 0;">
						<li><i class="fa fa-home"></i><a href="./">管理中心</a></li>
						<li><?php echo $title ?></li>
					</ul>
				</div>
  <!-- / aside -->

