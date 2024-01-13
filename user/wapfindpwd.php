<?php
if (!defined('IN_CRONLITE')) die();
@header('Content-Type: text/html; charset=UTF-8');
list($background_image, $background_css) = \lib\Template::getBackground();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>找回密码 - <?php echo $conf['sitename'];  ?></title>
	<meta name="keywords" content="<?php echo $conf['keywords']?>">
	<meta name="description" content="<?php echo $conf['description']?>">
	<link rel="shortcut icon " type="images/x-icon" href="http://img.yxp8.cn/06108202012012131558141.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
	<link href="/assets/yc_kky/wap/css/public.css" rel="stylesheet" type="text/css">
	<link href="/assets/yc_kky/wap/css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		(function (d) { function e() { var a = c.getBoundingClientRect().width; 750 < a && (a = 750); a = a / 750 * 100; c.style.fontSize = a + "px"; var b = parseFloat(window.getComputedStyle(document.documentElement)["font-size"]); b !== a && 0 < b && 1 < Math.abs(b - a) && (c.style.fontSize = a * a / b + "px") } var c = d.document.documentElement, f; d.addEventListener("resize", function () { clearTimeout(f); f = setTimeout(e, 100) }, !1); e() })(window);            
	</script>
	<link rel="stylesheet" href="/assets/yc_kky/wap/css/swiper-bundle.min.css">
</head>
<body>
	<div class="index">
		<!-- 头部 - 开始 -->
		<div class="login-header">
    <a href="javascript:;" onclick="window.history.go(-1)" class="fh"><img style="width:0.18rem;height:0.33rem" src="/assets/yc_kky/wap/image/page_fh_w.png" alt=""></a>
			<h3 class="title">找回密码</h3>
			<a>&nbsp;&nbsp;&nbsp;</a>
		</div>
		<!-- 头部 - 结束 -->
		<!-- 欢迎文字 - 开始 -->
		<div class="login-txt">
			<h2>Good Morning，</h2>
			<p>仅限注册时填写QQ的用户找回哦！</p>
		</div>
		<!-- 欢迎文字 - 结束 -->
		<!-- 登录盒子 - 开始 -->
		<div class="login-container">
      <div class="findpwd">
				<span id="loginmsg" style="font-weight: bold;">请使用QQ手机版扫描二维码</span><span id="loginload" style="padding-left: 10px;color: #790909;">.</span><br/><br/>
				<div id="qrimg"></div>
				<div class="btn-group">
					<button type="button" id="mlogin" onclick="mloginurl()" class="btn1">跳转QQ快捷登录</button>
					<button type="button" onclick="qrlogin()" class="btn2">我已完成登录</button>
				</div>
      </div>
      <?php if($conf['login_qq']==1){?><center><div class="alert alert-info" style="position:unset;width:90%;">提示：只能找回注册时填写了QQ号码的帐号密码，QQ快捷登录的暂不持支该方式找回密码。</div></center><?php }?>
		</div>
		<!-- 登录盒子 - 结束 -->
		<!-- 底部导航 - 开始 -->
		<footer class="footerBox">
			<a href="/">
				<img src="/assets/yc_kky/wap/picture/home.png" alt="">
				<p>首页</p>
			</a>
				<a href="/?mod=waplist">
				<img src="/assets/yc_kky/wap/picture/shop.png" alt="">
				<p>分类</p>
			</a>
				<a href="/?mod=wapquery">
				<img src="/assets/yc_kky/wap/picture/dd.png" alt="">
				<p>订单</p>
			</a>
			<?php if($conf['wapdt']=="1"){ ?>
				<a href="/?mod=wapdt">
				<img src="/assets/yc_kky/wap/picture/dt.png" alt="">
				<p>动态</p>
			</a>
			<?php }?>
				<a href="/?mod=wapkf">
				<img src="/assets/yc_kky/wap/picture/kf.png" alt="">
				<p>客服</p>
			</a>
				<a href="/user">
				<img src="/assets/yc_kky/wap/picture/me-active.png" alt="">
				<p>我的</p>
			</a>
		</footer>
		<!-- 底部导航 - 结束 -->
	</div>
<script src="<?php echo $cdnpublic ?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>layui/2.5.6/layui.all.min.js"></script>
<script src="../assets/js/qrlogin.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>