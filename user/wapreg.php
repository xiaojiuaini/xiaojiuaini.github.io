<?php
if (!defined('IN_CRONLITE')) die();
@header('Content-Type: text/html; charset=UTF-8');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
$x = new \lib\hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);
list($background_image, $background_css) = \lib\Template::getBackground();
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
      <a href="javascript:;" onclick="window.history.go(-1)" class="fh"><img style="width:0.18rem;height:0.33rem" src="/assets/yc_kky/wap/image/page_fh_w.png" alt=""></a>
			<h3 class="title">用户注册</h3>
			<a>&nbsp;&nbsp;&nbsp;</a>
		</div>
		<!-- 头部 - 结束 -->
		<!-- 欢迎文字 - 开始 -->
		<div class="login-txt">
			<h2>Good Morning，</h2>
			<p>欢迎使用<?php echo $conf['sitename'];?>，全网最优质的货源！</p>
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
					<input type="password" name="pwd" value="" required="required" placeholder="请输入密码"/>
				</div>
        <div class="login-hr"></div>
				<div class="login-input">
				<div class="login-icon"><img src="/assets/yc_kky/wap/image/qq_reg.png" alt="QQ"></div>
					<input type="text" name="qq" value="" required="required" placeholder="请输入QQ"/>
				</div>
        <?php if($conf['captcha_open']>=1 && $conf['captcha_open_reg'] == 1){?>
        <input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open']?>"/>
        <?php if($conf['captcha_open']>=2){?><input type="hidden" name="appid" value="<?php echo $conf['captcha_id']?>"/><?php }?>
        <div id="captcha" style="margin: auto;"><div id="captcha_text">正在加载验证码</div><div id="captcha_wait"><div class="loading"><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div></div></div></div>
        <div id="captchaform"></div>
        <?php }else{?>
        <div class="login-hr"></div>
        <div class="login-input">
				<div class="login-icon"><img src="/assets/yc_kky/wap/image/code_login.png" alt="验证码"></div>
					<input type="text" name="code" value="" required="required" placeholder="请输入验证码"/>
          <img id="codeimg" src="./code.php?r=<?php echo time();?>" onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
				</div>
        <?php }?>
				<div class="login-btn" id="submit_reg">立即注册</div>
      </form>
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
<script src="../assets/js/reguser.js?ver=<?php echo VERSION ?>"></script>
<script>
var hashsalt=<?php echo $addsalt_js?>;
</script>
</body>
</html>