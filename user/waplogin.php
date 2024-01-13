<?php
@header('Content-Type: text/html; charset=UTF-8');
$is_defend=true;
include("/includes/common.php");
if(isset($_GET['logout'])){
	if(!checkRefererHost())exit();
	setcookie("user_token", "", time() - 604800, '/');
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户登录 - <?php echo $conf['sitename'];  ?></title>
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
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			<h3 class="title">用户登录</h3>
			<a style="font-size:.27rem;color:#fff;letter-spacing: 2px;" href="reg.php">注册</a>
		</div>
		<!-- 头部 - 结束 -->
		<!-- 欢迎文字 - 开始 -->
		<div class="login-txt">
			<h2>Good Morning，</h2>
			<p>登录后享受更快捷的服务哦！</p>
		</div>
		<!-- 欢迎文字 - 结束 -->
		<!-- 登录盒子 - 开始 -->
		<div class="login-container">
			<form action="#">
				<div class="login-input">
					<div class="login-icon"><img src="/assets/yc_kky/wap/image/user_login.png" alt="用户名"></div>
					<input type="text" name="user" value="" required="required" placeholder="请输入用户名"/>
				</div>
				<div class="login-hr"></div>
				<div class="login-input">
				<div class="login-icon"><img src="/assets/yc_kky/wap/image/pass_login.png" alt="密码"></div>
					<input type="password" name="pass" value="" required="required" placeholder="请输入密码"/>
				</div>
				<div class="login-btn" id="submit_login">立即登录</div>
				<a href="findpwd.php"><p style="text-align: center;color:#999">点击找回密码</p></a>
				<?php if($conf['login_qq']>=1 || $conf['login_wx']>=1){?>
				<div style="margin: 2rem 0 0">
				<hr style="border-top: 1px solid rgba(0,0,0,.1);"><div style="color:#999;position: relative;top: -10px;width: 100px;background-color: white;margin: auto;text-align: center;">第三方登录</div>
				</div>
				<div class="other-login">
					<?php if($conf['login_qq']>=1){?><div onclick="javascript:connect('qq')" style="width: 45px;height:45px;margin: 15px ;background-image: url(../assets/yc_kky/wap/image/qq_login.png);background-size: 100%;"></div><?php }?>
					<?php if($conf['login_wx']>=1){?><div onclick="javascript:connect('wx')" style="width: 45px;height:45px;margin: 15px ;background-image: url(../assets/yc_kky/wap/image/wexin_login.png);background-size: 100%;"></div><?php }?>
				</div>
				<?php } ?>
			</form>
			<?php if($conf['captcha_open_login']==1 && $conf['captcha_open']>=1){?>
			<input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open']?>"/>
			<?php if($conf['captcha_open']>=2){?><input type="hidden" name="appid" value="<?php echo $conf['captcha_id']?>"/><?php }?>
			<div id="captcha" style="margin: auto;"><div id="captcha_text">
					正在加载验证码
			</div>
			<div id="captcha_wait">
					<div class="loading">
							<div class="loading-dot"></div>
							<div class="loading-dot"></div>
							<div class="loading-dot"></div>
							<div class="loading-dot"></div>
					</div>
			</div></div>
			<div id="captchaform"></div>
			<br/>
			<?php }?>
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
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="../assets/js/login.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>