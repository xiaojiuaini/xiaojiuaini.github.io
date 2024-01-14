<?php
/*
 本代码由 小森 创建
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/
if(!defined('IN_CRONLITE'))exit();
$zid = $conf['zid'];
$site_info=$DB->getRow("select appurl from pre_site where zid='$zid' limit 1");
if (empty($site_info['appurl'])) {
  $xr=$conf['appurl'];
} else {
  $xr=$site_info['appurl'];
}
?>
<!-- 
  本代码由 小森 创建
  严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
 -->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css?ver=<?php echo VERSION ?>">
  <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
#submit_cart_shop {
    background: linear-gradient(to right,#FFE4E1,#8B0000);
    border-radius: 25px 0 0 25px;
}
#submit_buy {
    background: linear-gradient(to right,#FFE4E1,#8B0000);
    border-radius: 0 25px 25px 0;
}
  </script>
<?php echo $background_css?>
</head>
<body>
<?php if($background_image){?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<?php }?>
<div style="padding-top:6px;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;">
<!--弹出公告-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename']?></h4>
       </div>
        <div class="modal-body">
         	<?php echo $conf['modal']?>
  	    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道啦</button>
      </div>
    </div>
  </div>
</div>
<!--弹出公告-->
<!--公告-->
<div class="modal fade" align="left" id="anounce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">公告</h4>
      </div>
	  <div class="modal-body">
	  <?php echo $conf['anounce']?>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
 </div>
<!--公告-->
<!--查单说明开始-->
<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询内容是什么？该输入什么？</h4>
      </div>
      	<li class="list-group-item">例如您购买的是预留的手机号，输入下单的手机号即可查询订单</li>
        <li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!--查单说明结束-->

	<div class="panel-heading font-bold text-center" style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><font color="#fff">&nbsp;&nbsp;<b>   <a class="btn btn-default" href="https://work.weixin.qq.com/kfid/kfc21fe527a6961f1e1" target="_blank"><font color="#FF0000">《7X24》 11:00-23:00  </font><font color="#006400"> ♛  平台人工客服中心 ♛ </font></a>
   </b></font></h3></div>
    <div class="block block-link-hover3" style="box-shadow:0px 5px 10px 0 rgba(0, 0, 0, 0.25);">
        
    <div>
                     

            <center>
<!--客服系统-->

<!--顶部导航-->
     <div class="block block-link-hover3" style="box-shadow:0px 5px 10px 0 rgba(0, 0, 0, 0.26);">
        <div class="block-content block-content-full text-center bg-image"
             style="background-image: url('https://z3.ax1x.com/2021/06/19/RC2bdA.jpg');background-size: 100% 100%;">
            <div>
                <div>
 <div class="img-avatar"></div>
                </div>
            </div>
        </div>
        <center>
<h2>     <a href="javascript:void(alert('詆.价.平.台，建议收藏到浏览器书签哦！'));"><b>
    <font color=#BE0041><?php echo $conf['sitename']?></b></b></a></h2></font><img src="https://z3.ax1x.com/2021/06/19/RCRVzT.png"/><font color=#0000FF>全网货源-信誉保证<img src="https://z3.ax1x.com/2021/06/19/RCRVzT.png"/>
    
</center>
        <div class="block-content block-content-mini block-content-full">
            <div class="btn-group btn-group-justified">
				<div class="btn-group">
					<a class="btn btn-default" data-toggle="modal" href="#anounce"><img src="https://z3.ax1x.com/2021/06/19/RCRtyD.gif"/></i>&nbsp;<font color=#DC143C><span style="font-weight:bold">通知/公告</span></font></a>
					</div>
					 	<a href="http://cd.62sq.com/" target="_blank" data-toggle="modal" class="btn btn-default"><img src="https://z3.ax1x.com/2021/06/19/RCoJN4.jpg"/></i>&nbsp;<span style="font-weight:bold"><font color=#0000FF>漏单/补单</font></span></a>
	 	
						                <div class="btn-group">
                 <a class="btn btn-default" data-toggle="modal" href="/user/regsite.php"><img src="https://z3.ax1x.com/2021/06/19/RCRNOe.gif"/></i>&nbsp;<font color=Red>加盟/站长</font></a>
    </div>
	 
	  </div>
             <center>
                    <a href="https://www.xhy-fk0.top/app/#" target="_blank"></a><a class="btn btn-default" href="https://www.xhy-fk0.top/app/#" target="_blank"><font color="#FF0000"><span style="font-weight:bold">《狗子货源》 高效|安全|快捷 </span></font><font color="#006400"><span style="font-weight:bold">🔅精致APP下载🔅 </font></span></a>
</div>
	  
    	<style>
    #nr{
    	font-size:20px;
    	margin: 0;
        background: -webkit-linear-gradient(left,
            #ffffff,
            #ff0000 7.26%,
            #ff7d00 12.5%,
            #ffff00 18.75%,
            #00ff00 26%,
            #00ffff 31.26%,
            #0000ff 37.5%,
            #ff00ff 43.75%,
            #ffff00 50%,
            #ff0000 56.26%,
            #ff7d00 62.5%,
            #ffff00 68.75%,
            #00ff00 75%,
            #00ffff 81.26%,
            #0000ff 87.5%,
            #ff00ff 93.75%,
            #ffff00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% 100%;
        animation: masked-animation 2s infinite linear;
    }
    @keyframes masked-animation {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: -100%, 0;
        }
    }
</style>
<!--顶部导航-->

<div class="block" style="margin-top:15px;font-size:15px;padding:1px;border-radius:15px;background-color: white;">

        <ul class="nav nav-tabs btn btn-block animated zoomInLeft btn-rounded" data-toggle="tabs">
            <li style="width: 25%;" align="center" class="active"><a href="#shop" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-shopping-bag fa-fw"></i> <font color=#0000FF>下单</font></span></a></li>
            <li style="width: 25%;" align="center"><a href="#search" data-toggle="tab" id="tab-query"><span style="font-weight:bold"><i class="fa fa-search"></i> <font color=#8B008B>查单</font></span></a></li>
			<li style="width: 25%;" align="center" ><a href="#Substation" data-toggle="tab"><span style="font-weight:bold"><font color="#ff0000"><img src="https://z3.ax1x.com/2021/06/19/RCoGEF.png"/></i>分战</span></font></a></li>
		
			<li style="width: 25%;" align="center"><a href="#more" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-folder-open"></i> <font color=#FF8C00>更多</font></span></a></li>
        </ul> </div>
        
    <!-TAB标签-->
<a href="./user/regsite.php"><img src="https://ftp.bmp.ovh/imgs/2020/01/a0e42112bae39699.gif"width="100%"></a><br/>
<a href="./user/regsite.php"><img src="img/fz2.gif" width="100%"></a><br>
    <div class="block-content tab-content">  
</style>
<!-TAB标签-->

<!--在线下单-->
    <div class="tab-pane active" id="shop">	
<?php include TEMPLATE_ROOT.'default/shop.inc.php'; ?>
  	</div>
<!--在线下单-->	
		
	
<!--查询订单-->			
						<div class="tab-pane fade fade-up" id="search">
							<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
								<tbody>
									<tr class="shuaibi-tip animation-fadeInQuick2">
										<td class="text-center" style="width: 100px;">
											<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100" alt="avatar"
											class="img-circle img-thumbnail img-thumbnail-avatar">
										</td>
										<td>
											<h5>
												<strong>
													官方站长
												</strong>
											</h5>
											<i class="fa fa-comment-o text-success">
											</i>
											站长QQ:<?php echo $conf['kfqq']?>
										</td>
										<td class="text-right" style="width: 20%;">
											<a styel="letter-spacing: 3px;"   <a href="#customerservice" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系站长</a>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="col-xs-12 well well-sm animation-pullUp">
								<p align="left">
									<font color="blue">
										<i class="">
										</i>
									</font>
									<font color="blue">
										付款未收到卡密,请在二十四小时内联系客服<br>-------------最简单的查单方式--------------<br>自助查单地址:cd.62sq.com
									</font>							
									<br>
									<font color="red">
										<i class="">
										</i>
									</font>
									<font color="red">
										什么浏览器购买的，直接用什么浏览器打开，什么也别填写，直接点立即查询。在手机QQ打开的购买的，用手机QQ打开网址点立即查询~！
									</font>						
								</p>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-btn">
										<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px">
											<option value="0">
												下单账号
											</option>
											<option value="1">
												订单号
											</option>
										</select>
									</div>
									<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）"
									required/>
									<span class="input-group-btn">
										<a href="#cxsm" target="_blank" data-toggle="modal" class="btn btn-warning">
											<i class="glyphicon glyphicon-exclamation-sign">
											</i>
										</a>
									</span>
								</div>
							</div>
							<input type="submit" id="submit_query" class="btn btn-primary btn-block"
							value="立即查询">
								<font color="red">
										<i class="">
										</i>
									</font>
									<font color="red">
								1.查单号:请输入您购买时候填写的手机号，如果填写的时候忘记填写的手机号请留空点击立即查询即可！
									</font>						
							<br/>
							<div id="result2" class="form-group" style="display:none;">
								<center>
									<small>
										<font color="#ff0000">
											手机用户可以左右滑动
										</font>
									</small>
								</center>
								<div class="table-responsive">
									<table class="table table-vcenter table-condensed table-striped">
										<thead>
											<tr>
												<th class="hidden-xs">
													下单账号
												</th>
												<th>
													商品名称
												</th>
												<th>
													数量
												</th>
												<th class="hidden-xs">
													购买时间
												</th>
												<th>
													状态
												</th>
												<th>
													操作
												</th>
											</tr>
										</thead>
										<tbody id="list">
										</tbody>
									</table>
								</div>
							</div>
						</div>
   						<!-- 
  本代码由 小林 创建
  技术支持 QQ:26731520 wwwxranwl.cn
  严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
 -->
<!--查询订单-->
<!--开通分战-->
    <div class="tab-pane" id="Substation">
	<table class="table table-borderless animated bounceIn" style="text-align: center;">
    <tbody>
      <tr class="active">
        <td>
          <h4>
            <span style="font-weight:bold">
              <font color="#FF8000">搭</font>
              <font color="#EC6D13">建</font>
              <font color="#D95A26">属</font>
              <font color="#C64739"></font>
              <font color="#A0215F">自</font>
              <font color="#8D0E72">己</font>
              <font color="#5400AB">的</font>
              <font color="#4100BE">货</font>
              <font color="#2E00D1">源</font>
              <font color="#1B00E4">站</font></span>
          </h4>
        </td>
      </tr>
      <tr class="active">
        <td>学生/上班族/创业/休闲挣￥必备工具</td></tr>
      <tr class="active">
        <td>
          <strong>
            网站轻轻松松推广日挣上千￥不是梦</strong></td>
      </tr>
            <tr class="active">
        <td><span class="glyphicon glyphicon-magnet"></span>&nbsp;快加入我们成为大家庭中的一员吧<hr> <a href="#userjs" data-toggle="modal" class="btn btn-effect-ripple  btn-info btn-sm" style="float:left;overflow: hidden; position: relative;">
            <span class="glyphicon glyphicon-eye-open"></span>&nbsp;网站详情介绍</a>
          <a href="./user/regsite.php" target="_blank" class="btn btn-effect-ripple  btn-success btn-sm" style="float:right;overflow: hidden; position: relative;">
            <span class="glyphicon glyphicon-share-alt"></span>&nbsp;开通网站</a></td></tr>
      <tr>
    </tbody>
  </table>
	</div>
<!--开通分战-->
<!--抽奖-->
    <div class="tab-pane" id="gift">
		<div class="panel-body text-center">
		<div id="roll">点击下方按钮开始</div>
		<hr>
		<p>
		<a class="btn btn-info" id="start" style="display:block;">开始</a>
		<a class="btn btn-danger" id="stop" style="display:none;">停止</a>
		</p> 
		<div id="result"></div><br/>
		<div class="giftlist" style="display:none;"><strong>最近记录</strong><ul id="pst_1"></ul></div>
		</div>
	</div>
<!--抽奖-->
<!--更多-->
						<div class="tab-pane fade fade-right" id="more">
							<div class="col-xs-6 col-sm-4 col-lg-4">
								<a class="block block-link-hover2 text-center" href="/user" target="_blank">
									<div class="block-content block-content-full bg-city">
										<i class="fa fa-certificate fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											我的后台
										</div>
										
										</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4 hide">
								<a class="block block-link-hover2 text-center btn btn-block animated zoomInLeft btn-rounded"
								data-toggle="modal" href="#lqq">
									<div class="block-content block-content-full bg-primary">
										<i class="fa fa-circle-o fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											免.费.卡.密
										</div>
									</div>
								</a>
							</div>
	</div>
<!--更多-->
<!--版本介绍-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">版本介绍</h4>
		</div>
		<div class="block">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">个人版/股东版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>专属发卡平台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                        <tr class="">
                            <td>三种在线支付接口</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>賺取用户提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>賺取下级分战提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="warning">
                            <td>设置下级分战商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>搭建下级分战</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送专属精致APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
				<center style="color: #b2b2b2;"><small><em>* 自己的能力决定着你的收入！</em></small></center>
        </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--版本介绍-->
    </div>
</div>
<!-- 
  本代码由 小林 创建
  技术支持 QQ:26731520 wwwxranwl.cn
  严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
 -->
<!--关我们弹窗-->
<div class="modal fade" align="left" id="customerservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">客服与帮助</h4>
		</div>
		<div class="modal-body" id="accordion">
			<div class="panel panel-default" style="margin-bottom: 6px;">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">为什么订单显示已完成了却一直没到账？</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse in" style="height: auto;">
					<div class="panel-body">
					订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。<br>
					可以立即提交工单，客服会优先给您处理！<br>
					订单长时间显示（待处理）请联系客服！
					</div>
				</div>
			</div>
			<div class="panel panel-default" style="margin-bottom: 6px;">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">QQ会员/钻类等什么时候到账？</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
					<div class="panel-body">
					下单后的48小时内到账（会员或钻全部都是一样48小时内到账）！<br>
					如果超过48小时，请联系客服退款或补单，提供QQ号码！或提交工单
					</div>
				</div>
			</div>
			<div class="panel panel-default" style="margin-bottom: 6px;">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">卡密/CDK没有发送我的邮箱？</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
					<div class="panel-body">没有收到请检查自己邮箱的垃圾箱！也可以去查单区：输入自己下单时填写的邮箱进行查单。<br>
					查询到订单后点击（详细）就可以看到自己购买的卡密/cdk！
					</div>
				</div>
			</div>
			<div class="panel panel-default" style="margin-bottom: 6px;">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed">已付款了没有查询到我订单？</a>
					</h4>
				</div>
				<div id="collapseFourth" class="panel-collapse collapse" style="height: 0px;">
					<div class="panel-body" style="margin-bottom: 6px;">联系客服处理，请提供（付款详细记录截图）（下单商品名称）（下单账号）<br>直接把三个信息发给客服，然后等待客服回复处理（请不要发抖动窗口或者QQ电话）！
					</div>
				</div>
			</div>
			<ul class="list-group" style="margin-bottom: 0px;">
			<li class="list-group-item">   
			   <div class="media">
					<span class="pull-left thumb-sm"><img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100" alt="..." class="img-circle img-thumbnail img-avatar"></span>
			   <div class="pull-right push-15-t">
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes" target="_blank"  class="btn btn-sm btn-info">联系</a>
			   </div>
			   <div class="pull-left push-10-t">
					<div class="font-w600 push-5">售.后.客.服</div>
					<div class="text-muted"><b>QQ：<?php echo $conf['kfqq'] ?></b>
					</div>
			   </div>
			   </div>
			</li>
			<li class="list-group-item">
			想要快速回答你的问题就请把问题描述讲清楚!<br>
			下单账号+业务名称+问题，直奔主题，按顺序回复!<br>
			有问题直接留言，请勿抖动语音否则直接无视。<br>			
			</li>
			</ul>
		</div>
    </div>
  </div>
</div>
       
<div class="block animated bounceInDown btn-rounded" style="border:1px solid #FFF0F5;margin-top:15px;font-size:15px;padding:15px;border-radius:15px;background-color: white;"><div class="panel-heading"><h3 class="panel-title" types=""><font color="#000000"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;<b>今日订单详细</b><img src="https://z3.ax1x.com/2021/06/19/RCRtyD.gif"/></i></a></span></h3></div>
<div class="btn-group btn-group-justified">
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">购买用户</font></b></a>
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">下单日期</font></b></a>
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">物品名称</font></b></a>
		</div>  
		<marquee class="zmd" behavior="scroll" direction="UP" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" style="height:16em">
			<table class="table table-hover table-striped" style="text-align:center">
				<thead>
				    <h4 class="modal-title" id="myModalLabel">
                    <?php
                    $c = 80;
                    for ($a = 0; $a < $c; $a++) {
                        $sim = rand(1, 5); #随机数
                        $a1 = ''; #超级会员
                        $a2 = ''; #视频会员
                        $a3 = ''; #豪华黄钻
                        $a4 = ''; #豪华绿钻
                        $a5 = ''; #名片赞
                        $e = 'a' . $sim;
                        if ($sim == '1') {
                            $name = '和平【战斗机直装】天卡';
                        } else if ($sim == '2') {
                            $name = '和平直装【内部X助手】周卡';
                        } else if ($sim == '3') {
                            $name = '和平国际【引领时代直装】天卡';
                        } else if ($sim == '4') {
                            $name = '和平【微微直装】天卡';
                        } else if ($sim == '5') {
                            $name = '和平【快球直装】天卡';
                        } else if ($sim == '6') {
                            $name = '王者【T直装】天卡';
                        } else if ($sim == '7') {
                            $name = '和平【雷神直装】天卡';
                        } else if ($sim == '8') {
                            $name = '和平国际【饭饭直装】天卡';
                        } else if ($sim == '9') {
                            $name = rand(1000, 100000) . '和平【彩虹】天卡';
                        }
                        $date = date('Y-m-d'); #今日
                        $time = date("Y-m-d", strtotime("-1 day"));
                        if ($a > 50) {
                            $date = $time;
                        } else {
                            if (date('H') == 0 || date('H') == 1 || date('H') == 2) {
                                if ($a > 9) {
                                    $date = $time;
                                }
                            }
                        }
                        echo '<tr></tr><tr><td>本站用户' . rand(10, 999) . '**' . rand(100, 999) . '**</td><td>于' . $date . '日下单成功</td><td><font color="salmon"><img src="' . $$e . '" width="15">' . $name . '</font></td></tr>';
                    }
                    ?>
                    </thead>
                </table>
            </marquee>
        </div>
<?php if($conf['articlenum']>0){
$limit = intval($conf['articlenum']);
$rs=$DB->query("SELECT id,title FROM pre_article WHERE active=1 ORDER BY top DESC,id DESC LIMIT {$limit}");
$msgrow=array();
while($res = $rs->fetch()){
	$msgrow[]=$res;
}
$class_arr = ['danger','warning','primary','success','info'];
$i=0;
?>

<a href="http://mtxiazai.uupan.net/ "><img src="https://z3.ax1x.com/2021/06/19/RCh1Fs.jpg"width="100%"></a>



	<!--文章列表-->
<div class="block block-themed" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
	<div class="block-header bg-amethyst" style="background-color: #6a67c7; border-color: #6a67c7; padding: 10px 10px;">
		<h3 class="block-title"><i class="fa fa-newspaper-o"></i> <font color="#7FFF00">  ============公告文章============</font></h3>
	</div>
		<a href="./?mod=articlelist" title="查看全部文章" class="btn-default btn btn-block" target="_blank">查看全部文章</a>
</div>
<!--文章列表-->

<?php }?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><font color="#000000"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;<b>近30天数据统计</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
<td align="center"><font size="2"><b><font color=#0000FF>8976<span id="count_yxts"></span>关键词</font><b/><br><font color="#65b1c9"><img src="https://z3.ax1x.com/2021/06/19/RC44DU.jpg"/></i></font><br>百度收录</font></td>
<td align="center"><font size="2"><b><font color="#DC143C">0<span id="cou1nt_yxts"></span>元</font><b/><br><font color="#65b1c9"><img src="https://z3.ax1x.com/2021/06/19/RC595d.jpg"/></i></font><br>累计退款</font></td>
<td align="center"><font size="2"><b><font color=#8B4513>0<span id="co1unt_yxts"></span>次</font><b/><br><font color="#65b1c9"><img src="https://z3.ax1x.com/2021/06/19/RC45bF.jpg"/></i></font><br>交易投诉</font>

</tbody>
</table>

<div class="block block-content block-content-mini block-content-full" style="box-shadow:0px 5px 10px 0 rgba(0, 0, 0, 0.26);">
	<!--网站日志-->
	<!--<div class="row text-center" >-->
	<!--	<div class="col-xs-4">-->
	<!--		<h5 class="widget-heading"><small>订单总数</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_orders"></span>条</a></h5>-->
	<!--	</div>-->
	<!--	<div class="col-xs-4">-->
	<!--		 <h5 class="widget-heading"><small>今日订单</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_orders2"></span>条</a></h5>-->
	<!--	</div>-->
	<!--	<div class="col-xs-4">-->
	<!--		<h5 class="widget-heading"><small>运营天数</small><br><a href="javascript:void(0)" class="themed-color-flat"><span id="count_yxts"></span>天</a></h5>-->
	<!--	</div>-->
	<!--</div>-->
		
<script src="https://player.lzti.com/api/player/166063537182" id="myhk" key="166063537182" m="1"></script>

<!--底部导航-->
	<div class="block-content text-center border-t">
		<a href="javascript:void(0);" onclick="AddFavorite('QQ代刷网',location.href)">
  <b style="text-shadow: LightSteelBlue 1px 0px 0px;">
  <i class="fa fa-heart text-danger animation-pulse"></i>
  <font color="#CB0034">工</font>
  <font color="#BE0041">作</font>
  <font color="#B1004E">室</font>
  <font color="#A4005B">网址</font>
  <font color="#970068">：<?php echo $_SERVER['HTTP_HOST'];?></font>
  </font>
  <font color="#2F00D0"></font>
  <font color="#CB0034">&nbsp;</font></br>
  <font color="#FF0000">点我</font>
  <font color="#FF0000">收藏</font>
  <font color="#FF0000"></font>
  <font color="#FF0000"></font><br>
  </b>
</a>
<img src="img/favicon.ico" alt="鲁ICP备2021009311号" width="13px">公安ICP备案:琼ICP备2021009631号
	<!--底部导航-->
</div>
</div>
</font></div><font color="#000000">

<!-- 收藏代码开始-->
<script>
    function AddFavorite(title, url) {
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("手机用户：点击底部 “≡” 添加书签/收藏网址!\n\n电脑用户：请您按 Ctrl+D 手动收藏本网址! ");
     }
  }
}
</script>
<!-- 收藏代码结束-->

<!-- 
  本代码由 小林 创建
  技术支持 QQ:26731520 wwwxranwl.cn
  严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
 -->
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
	<script type="text/javascript">
		var isModal = <?php echo empty($conf['modal']) ? 'false' : 'true'; ?> ;
		var homepage = true;
		var hashsalt = <?php echo $addsalt_js ?> ;
		$(function() {
   		 	$("img.lazy").lazyload({
        		effect: "fadeIn"
    		});
		});
		var ss = 0,
		    mm = 0,
		    hh = 0;
		
		function TimeGo() {
		    ss++;
		    if (ss >= 60) {
		        mm += 1;
		        ss = 0
		    }
		    if (mm >= 60) {
		        hh += 1;
		        mm = 0
		    }
		    ss_str = (ss < 10 ? "0" + ss : ss);
		    mm_str = (mm < 10 ? "0" + mm : mm);
		    tMsg = "" + hh + "小时" + mm_str + "分" + ss_str + "秒";
		    document.getElementById("stime").innerHTML = tMsg;
		    setTimeout("TimeGo()", 1000)
		}
		TimeGo();
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<?php if($conf['classblock']==1 || $conf['classblock']==2 && checkmobile()==false)include TEMPLATE_ROOT.'default/classblock.inc.php'; ?>
</body>
</html>
</body>
</html>