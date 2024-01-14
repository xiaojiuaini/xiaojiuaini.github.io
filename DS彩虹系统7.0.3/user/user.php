<?php
if (!defined('IN_CRONLITE')) die();
@header('Content-Type: text/html; charset=UTF-8');

if($islogin2==1){
  if($userrow['status']==0){
      sysmsg('你的账号已被封禁！',true);exit;
  }elseif($userrow['power']>0 && $conf['fenzhan_expiry']>0 && $userrow['endtime']<$date){
      //sysmsg('你的账号已到期，请联系管理员续费！',true);exit;
      echo '<script>layer.msg("您的分站已到期，请联系管理员续费！")</script>';
  }
}else{
  exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户中心 - <?php echo $conf['sitename'];  ?></title>
	<meta name="keywords" content="<?php echo $conf['keywords']?>">
	<meta name="description" content="<?php echo $conf['description']?>">
	<link rel="shortcut icon " type="images/x-icon" href="http://img.yxp8.cn/06108202012012131558141.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
	<link href="/assets/yc_kky/wap/css/public.css" rel="stylesheet" type="text/css">
	<link href="/assets/yc_kky/wap/css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		(function (d) { function e() { var a = c.getBoundingClientRect().width; 750 < a && (a = 750); a = a / 750 * 100; c.style.fontSize = a + "px"; var b = parseFloat(window.getComputedStyle(document.documentElement)["font-size"]); b !== a && 0 < b && 1 < Math.abs(b - a) && (c.style.fontSize = a * a / b + "px") } var c = d.document.documentElement, f; d.addEventListener("resize", function () { clearTimeout(f); f = setTimeout(e, 100) }, !1); e() })(window);            
	</script>
    <link rel="stylesheet" href="<?php echo $cdnpublic?>toastr.js/latest/css/toastr.min.css">
    <script src="<?php echo $cdnpublic ?>jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
</head>
<body>
	<div class="index">
		<!-- 头部 - 开始 -->
		<div class="login-header">
			<p></p>
			<h3 class="title">用户中心</h3>
			<p></p>
		</div>
		<!-- 头部 - 结束 -->
		<!-- 欢迎文字 - 开始 -->
		<div class="user-info">
      <div class="user-img">
        <img src="<?php echo $faceimg ?>" alt="用户头像">
      </div>
			<div class="user-name">
        <h2><?php echo $nickname?></h2>
        <div style="display:flex">
          <div class="user-level">
            <img style="width: 14px;transform: translateY(-0.5px);" src="/assets/yc_kky/wap/picture/vip.svg" alt="等级图标">
            <?php if($userrow['power'] == 2){ ?>
              高级代理
            <?php }else if($userrow['power'] == 1){ ?>
              普通代理
            <?php }else{ ?>
              普通会员
            <?php } ?>
          </div>
          <div class="user-level">
            <img style="width: 18px;transform: translateY(-1.2px);margin-right: 2px" src="/assets/yc_kky/wap/picture/uid.svg" alt="等级图标">
            UID: <?php echo $userrow['zid']?>
          </div>
        </div>
      </div>
		</div>
		<!-- 欢迎文字 - 结束 -->
		<!-- 余额卡片 - 开始 -->
		<div class="user-card">
			<div class="card-body">
        <div class="user-money">
          <div class="money-txt"><img src="/assets/yc_kky/wap/picture/money.svg" alt="">余额</div>
          <h2><?php echo $userrow['rmb']?></h2>
          <a href="recharge.php">充值</a>
        </div>
        <div style="width: 2px;height: 40px;background: #f5f5f5;border-radius: 25px;"></div>
        <div class="user-money">
          <div class="money-txt"><img src="/assets/yc_kky/wap/picture/sy.svg" alt="">收益</div>
          <h2 id="income_today">0.0</h2>
          <?php if($userrow['power'] > 0){ ?>
          <a href="tixian.php">提现</a>
          <?php }else{ ?>
          <a href="javascript:layer.msg('只有开通分站才可进行提现');">提现</a>
          <?php } ?>
        </div>
      </div>
		</div>
		<!-- 余额卡片 - 结束 -->
    <!-- 订单卡片 - 开始 -->
		<div class="user-order-card">
			<div class="card-body">
        <h3>我的订单</h3>
        <div class="order-container">
          <a href="../?mod=query"><img src="/assets/yc_kky/wap/picture/sydd.png" alt=""><p>所有订单</p></a>
          <a href="../?mod=query&status=1"><img src="/assets/yc_kky/wap/picture/ywc.png" alt=""><p>已完成</p></a>
          <a href="../?mod=query&status=0"><img src="/assets/yc_kky/wap/picture/dcl.png" alt=""><p>待处理</p></a>
          <a href="../?mod=query&status=4"><img src="/assets/yc_kky/wap/picture/td.png" alt=""><p>已退单</p></a>
        </div>
      </div>
		</div>
		<!-- 订单卡片 - 结束 -->
    <!-- 分站管理 - 开始 -->
    <?php if($userrow['power']>0){?>
		<div class="user-order-card">
			<div class="card-body">
        <h3>分站管理</h3>
        <div class="serve-container">
          <a href="siteinfo.php"><img src="/assets/yc_kky/wap/picture/fzlb2.svg" alt=""><p>站点信息</p></a>
          <?php if($userrow['power']>0){?>
          <a href="uset.php?mod=site"><img src="/assets/yc_kky/wap/picture/set.svg" alt=""><p>站点设置</p></a>
          <a href="uset.php?mod=skimg"><img src="/assets/yc_kky/wap/picture/sksz.svg" alt=""><p>收款设置</p></a>
          <?php } ?>
          <a href="classlist.php"><img src="/assets/yc_kky/wap/picture/flgl.svg" alt=""><p>分类管理</p></a>
          <a href="shoplist.php"><img src="/assets/yc_kky/wap/picture/spgl.svg" alt=""><p>商品管理</p></a>
          <?php if($userrow['power']==2){?>
          <a href="userlist.php"><img src="/assets/yc_kky/wap/picture/ktdl.svg" alt=""><p>用户列表</p></a>
          <a href="sitelist.php"><img src="/assets/yc_kky/wap/picture/fzlb.svg" alt=""><p>分站列表</p></a>
          <?php } ?>
          <a href="tuiguang.php"><img src="/assets/yc_kky/wap/picture/tgwa.svg" alt=""><p>推广文案</p></a>
          <?php if( $conf['fenzhan_rank']==1){?>
          <a href="rank.php"><img src="/assets/yc_kky/wap/picture/fzph.svg" alt=""><p>分站排行</p></a>
          <?php }?>
          <a href="list.php"><img src="/assets/yc_kky/wap/picture/ddgl.svg" alt=""><p>订单管理</p></a>
          <a href="faq.php"><img src="/assets/yc_kky/wap/picture/cjwt.svg" alt=""><p>常见问题</p></a>
        </div>
      </div>
		</div>
    <?php } ?>
		<!-- 分站管理 - 结束 -->
    <!-- 菜单卡片 - 开始 -->
		<div class="user-order-card">
			<div class="card-body">
        <h3>更多服务</h3>
        <div class="serve-container">
          <?php if($userrow['power']>0){?>
          <?php }else{ ?>
          <a href="regsite.php"><img src="/assets/yc_kky/wap/picture/ktfz.svg" alt=""><p>开通分站</p></a>
          <?php } ?>
          <?php if($conf['qiandao_reward']){?>
          <a href="qiandao.php"><img src="/assets/yc_kky/wap/picture/mrqd.svg" alt=""><p>每日签到</p></a>
          <?php } ?>
          <?php if($conf['workorder_open']==1){?>
          <a href="workorder.php"><img src="/assets/yc_kky/wap/picture/wdgd.svg" alt=""><p>我的工单</p></a>
          <?php } ?>
          <a href="message.php"><img src="/assets/yc_kky/wap/picture/xxtz.svg" alt=""><p>消息通知</p></a>
          <a href="record.php"><img src="/assets/yc_kky/wap/picture/szmx.svg" alt=""><p>收支明细</p></a>
          <a href="uset.php?mod=user"><img src="/assets/yc_kky/wap/picture/xgzl.svg" alt=""><p>修改资料</p></a>
          <a href="login.php?logout"><img src="/assets/yc_kky/wap/picture/tcdl.svg" alt=""><p>退出登录</p></a>
        </div>
      </div>
		</div>
		<!-- 菜单卡片 - 结束 -->
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
<script src="<?php echo $cdnpublic?>toastr.js/latest/toastr.min.js"></script>
<!-- 获取收益 -->
<script>
$(document).ready(function(){
	$.ajax({
		type : "GET",
		url : "ajax_user.php?act=msg",
		dataType : 'json',
		async: true,
		success : function(data) {
			if(data.code==0){
				if(data.count>0){
					$(".tiaoshu_cont").text(data.count);
					$(".tiaoshu_cont").show();

				}
				if(data.count2>0){
					$(".work_cont").text(data.count2);
					$(".work_cont").show();
				}
				$("#income_today").html(data.income_today);
			}
		}
	});
});
</script>
</body>
</html>