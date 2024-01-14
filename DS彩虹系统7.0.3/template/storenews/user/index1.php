
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-param" content="_csrf">
     <title>会员中心-<?php echo $conf['sitename']; ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="shortcut icon" href="<?php echo $conf['default_ico_url'] ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/assets/style1.css">
        <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/layui/2.5.7/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/assets/styel2.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/assets/icosn.css">
    <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//cdn.staticfile.org/toastr.js/latest/css/toastr.min.css">
    <script src="//cdn.staticfile.org/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
    <style>html{ background:#ecedf0 url("//puep.qpic.cn/coral/Q3auHgzwzM4fgQ41VTF2rNW4Uq2HNeh8aHey8bmupSJ3yO7RPpZkCg/0") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>    
</head>
    <?php 
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
<style>
body {
    width: 100%;
    max-width: 650px;
    margin: auto;
    background: #f3f3f3;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
 
}
::-webkit-scrollbar{ 
	display: none;
   /* background-color:transparent; */
}
.label{
    color: unset;
    line-height: 1.8;
}
.account-main{
    height: 100% !important;
}
a {
    text-decoration:none;
}
a:hover{
    text-decoration:none;
}
</style>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 650px;">
<div id="body">


<div class="fui-page  fui-page-current" style="max-width: 650px;left: auto;">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back" onclick="goback();"></a>
        </div>
        <div class="title">会员中心</div>
        <div class="fui-header-right"></div>
    </div>

    <div class="fui-content member-page navbar" style="">
            <div style="overflow: hidden;height: 9rem;position: relative;background: #fff">
            <div class="headinfo" style="z-index:100;border: none;">
                <a class="setbtn" href="uset.php?mod=user"><i class="icon icon-shezhi"></i></a>
                <div class="headinfo-t" style="width:100%;height:50%;">
                    <div class="userinfo">
                         <div class="face"><img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?>&spec=100"></div>
                         <div class="title">
                              <!--$nickname-->
                              <a class="name" href="uset.php?mod=user" ><?php echo $nickname?></a>
                              <div class="power">
                                                                        <div class="power-item" style="background: -webkit-linear-gradient(left, #8470FF,#BBFFFF);"> 
						<?php if($userrow['power'] == 2){ ?>
                            <font color="">高级站长</font>
                        <?php }else if($userrow['power'] == 1){ ?>
                            <font color="">初级站长</font>
                        <?php }else{ ?>
                            普通会员
                        <?php } ?></div>
                                                                  </div>
                         </div>
                    </div>
                    <div class="userinfo-r">
                         <div class="uid">UID:<?php echo $userrow['zid']?></div>
                    </div>
                </div>
                
                <div class="headinfo-b" style="width:100%;height:50%;">
                    <div class="rmb-l" >
                            <font style="font-size:0.5rem;color: #000000;font-weight: 600;">余额</font>
                            <font  style="font-size:1.4rem;font-weight: 600;color:#ff6a54"><?php echo $userrow['rmb']?></font>
                            <div class="info" >
                                
                                <a href="record.php">
                                        <div> 今日收益：</div>
                                        <div class="num" id="income_today"></div>
                                    </a>
                                    <a style="padding-left:10px" href="record.php">
                                        <div> 累计收益：</div>
                                        <div class="num" id="income_count"></div>
                                    </a>
                            </div>
                        </div>
                        <div class="rmb-r">
                            <a href="recharge.php" class="r-btn" style="background: #04ab02;">充值</a>
                            
                                                        <a href="tixian.php"  class="r-btn">提现</a>
                                                    </div>
                    
                    
                </div>
            </div>

            <!--<div class="member_header" style="background: #ff5555;">-->
                
            <!--</div>-->
            
            
            <!--<img class="cover-img" src="../assets/store/picture/cover.png">-->
            
        </div>
    
    <div class="fui-cell-group fui-cell-click" style="margin-top: 0">
	
	
	  <?php if($userrow['power'] == 0){ ?>
	       <a style="width:90%"  href="regsite.php">
                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/vip.png">
            </a>
 <?php }?>
	
	
                    <a class="fui-cell external" style="height:5px;padding:0">
               
               
               
            </a>
            <div class="fui-icon-group selecter col-3">
                
                <a class="fui-icon-col external" href="workorder.php">
                    <div class="icon icon-orange radius">
                        <img src="<?php echo $cdnserver?>template/storenews/image/user/tougao.svg">
                    </div>
                    <div class="text">项目投稿</div>
                </a>
                <a class="fui-icon-col external" href="<?php echo $cdnserver?>/?mod=article&id=4">
                    <div class="icon icon-blue radius">
                       <img src="<?php echo $cdnserver?>template/storenews/image/user/sucai.svg">
                    </div>
                    <div class="text">发圈素材</div>
                </a>
                <a class="fui-icon-col external" href="tuiguang.php">
                    <div class="icon icon-pink radius">
                        <img src="<?php echo $cdnserver?>template/storenews/image/user/haibao.svg">
                    </div>
                    <div class="text">推广海报</div>
                </a>
               
            </div>            
                    
                    
    </div>
       
    <div class="fui-cell-group fui-cell-click" style="margin-top: 0.5rem">
            <a class="fui-cell external" href="../?mod=query">
               
                <div class="fui-cell-text" style="font-weight: 600;">我的订单</div>
               
            </a>
            <div class="fui-icon-group selecter col-4">
                <a class="fui-icon-col external" href="../?mod=query">
                    <div class="icon icon-green radius">
                        <img src="<?php echo $cdnserver?>template/storenews/image/user/dingdan.svg">
                    </div>
                    <div class="text">订单管理</div>
                </a>
                <a class="fui-icon-col external" href="record.php">
                    <div class="icon icon-orange radius">
                        <img src="<?php echo $cdnserver?>template/storenews/image/user/mingxi.svg">
                    </div>
                    <div class="text">收支明细</div>
                </a>
                <a class="fui-icon-col external" href="../?mod=query&status=3">
                    <div class="icon icon-blue radius">
                       <img src="<?php echo $cdnserver?>template/storenews/image/user/yichang.svg">
                    </div>
                    <div class="text">异常订单</div>
                </a>
                <a class="fui-icon-col external" href="workorder.php">
                    <div class="icon icon-pink radius">
                        <img src="<?php echo $cdnserver?>template/storenews/image/user/xixun.svg">
                    </div>
                    <div class="text">售后反馈</div>
                </a>
               
            </div>
    </div>


    <div class="fui-cell-group fui-cell-click">
    
            <div class="fui-according-group " style="display: block;margin-top:unset;">
<!--                      
       <div class="fui-cell-group fui-cell-click" style="margin-top: 0">
            <div class="fui-icon-group selecter col-1">
            
                <a class="fui-icon-col external" style="width:100%; height:130px; display: flex;justify-content: center;align-items: center;" href="tuiguang.php">
                    <div class="fui-cell-text">
                        <img src="http://sgfkw.fkw2.xyz/assets/img/Product/shop_84ad762cd164d0043af4240bd8677f30.png" style="box-sizing:border-box;vertical-align: inherit; width: 93%;" data-ratio="0.6083333333333333" data-w="600" />
                   </div>
                     
                </a>
                
        
            </div>
        </div>
       -->
                <div class="fui-according expanded">
                    <div class="fui-according-header fui-cell">
                      
                        <span class="text"  style="font-weight: 600;">网站管理</span>
                    
                    </div>
                    <div class="fui-according-content" style="display: block;">
                        <div class="fui-icon-group selecter col-3">
						 <?php if($userrow['power'] == 1){ ?>
                            <a class="fui-icon-col external" href="siteinfo.php">
                                <div class="icon icon-green radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/xixin.svg">
                                </div>
                                <div class="text">站点信息</div>
                            </a>
                            <a class="fui-icon-col external" href="shoplist.php">
                                <div class="icon icon-blue radius">
                                   <img src="<?php echo $cdnserver?>template/storenews/image/user/shangpin.svg">
                                </div>
                                <div class="text">商品管理</div>
                            </a>
                            <a class="fui-icon-col external" href="classlist.php">
                                <div class="icon icon-orange radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/fenlei.svg">
                                </div>
                                <div class="text">分类管理</div>
                            </a>
							<?php }?>
							
                             <?php if($userrow['power'] == 2){ ?>
							 <a class="fui-icon-col external" href="siteinfo.php">
                                <div class="icon icon-green radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/xixin.svg">
                                </div>
                                <div class="text">站点信息</div>
                            </a>
                            <a class="fui-icon-col external" href="shoplist.php">
                                <div class="icon icon-blue radius">
                                   <img src="<?php echo $cdnserver?>template/storenews/image/user/shangpin.svg">
                                </div>
                                <div class="text">商品管理</div>
                            </a>
                            <a class="fui-icon-col external" href="classlist.php">
                                <div class="icon icon-orange radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/fenlei.svg">
                                </div>
                                <div class="text">分类管理</div>
                            </a>
							 <a class="fui-icon-col external" href="sitelist.php">
                                <div class="icon icon-pink radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/fenzhan.svg">
                                </div>
                                <div class="text">分站列表</div>
                            </a>
                            <a class="fui-icon-col external" href="userlist.php">
                                <div class="icon icon-pink radius">
                                    <img src="<?php echo $cdnserver?>template/storenews/image/user/yonghu.svg">
                                </div>
                                <div class="text">用户列表</div>
                            </a>
                            <?php }?>

                            
                                                    </div>
                    </div>
                </div>
            </div>
            
						<a class="fui-cell external" href="appCreate.php">
                    <div class="fui-cell-img">
                        <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/app.svg">
                    </div>
                    <div class="fui-cell-text"><p>APP生成</p></div>
                    <div class="fui-cell-remark"></div>
            </a>
			           
    				<a class="fui-cell external" href="qiandao.php">
			    <div class="fui-cell-img">
                    <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/daka.svg">
                </div>
				<div class="fui-cell-text"><p>每日签到</p></div>
				<div class="fui-cell-remark"></div>
		</a>
		         <a class="fui-cell" href="message.php">
            <div class="fui-cell-img">
                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/gonggao.svg">
            </div>
            <div class="fui-cell-text"><p>官方公告</p></div>
            <div class="fui-cell-remark" >
                <span class="badge tiaoshu_cont" style="display:none;"></span>
            </div>
        </a>
    </div>
<!--     <div class="fui-according-group" id="container" style="display: block;">
            <div class="fui-according expanded">
                <div class="fui-according-header">
                    <span class="text">关于</span>
                    <span class="remark"></span>
                </div>
                <div class="fui-according-content" style="display: block;">
                    <div class="content-block"><p><span style="font-size:16px;font-family:黑体">12</span></p></div>
                </div>
            </div>
            </div> -->
    


    <div class="fui-cell-group fui-cell-click">
            <div class="fui-according-group " style="display: block;margin-top:unset;">
                <div class="fui-according">
                    <div class="fui-according-header fui-cell">
                        <div class="fui-cell-img">
                            <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/shezhi.svg">
                        </div>
                        <span class="text">系统设置</span>
                        <span class="remark"></span>
                    </div>
                    <div class="fui-according-content" style="display: none;">
                        <div class="fui-icon-group selecter col-2">
                            <a class="fui-icon-col external" href="uset.php?mod=user" >
                                <div class="icon icon-green radius">
                                    <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/wangzhan.svg">
                                </div>
                                <div class="text">用户资料设置</div>
                            </a>
                                                        <a class="fui-icon-col external" href="uset.php?mod=site">
                                <div class="icon icon-orange radius">
                                    <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/yonghu1.svg">
                                </div>
                                <div class="text">网站信息设置</div>
                            </a>
                                                    </div>
                    </div>
                </div>
            </div>
    </div>      
                
<!--         <div class="fui-cell-group fui-cell-click">
            <a class="fui-cell" href="">
                <div class="fui-cell-icon"><i class="icon icon-cart"></i></div>
                <div class="fui-cell-text"><p>我的购物车</p></div>
                <div class="fui-cell-remark"></div>
            </a>
            <a class="fui-cell external" href="">
                <div class="fui-cell-icon"><i class="icon icon-daituikuan2"></i></div>
                <div class="fui-cell-text"><p>收益明细</p></div>
                <div class="fui-cell-remark"></div>
            </a>
        </div> -->

        <div class="fui-cell-group fui-cell-click transparent">
<!--             <a class="fui-cell external changepwd" href="">
                <div class="fui-cell-text" style="text-align: center;"><p>修改密码</p></div>
            </a> -->
            <a class="fui-cell external btn-logout" href="login.php?logout">
                <div class="fui-cell-text" style="text-align: center;"><p>退出登录</p></div>
            </a>
        </div>
        <div class="footer" style="width: 100%;margin-top: 0.5rem;margin-bottom: 2.5rem;display: block;float: left;">
            <p style="text-align: center;"><span style="color: rgb(37, 36, 36); font-family: 微软雅黑, " microsoft="" font-size:="" text-align:="" background-color:=""></span></p>
        </div>
</div>

    <div class="fui-navbar" style="z-index: 100000;max-width: 650px;">
        <a href="../" class="nav-item  "> <span class="icon icon-homefill"></span> <span class="label">首页</span> </a>
        <a href="../?mod=query" class="nav-item "> <span class="icon icon-babyfill"></span> <span class="label">订单</span> </a>
		<a href="../?mod=cart" class="nav-item " style="display:none"> <span class="icon icon-cart2"></span> <span class="label">购物车</span> </a>
        <a href="../?mod=kf" class="nav-item "> <span class=" icon icon-servicefill"></span> <span class="label">客服</span> </a>
        <a href="./" class="nav-item active"> <span class="icon icon-peoplefill"></span> <span class="label">会员中心</span> </a>
    </div>
   

</div>

script src="<?php echo $cdnpublic?>toastr.js/latest/toastr.min.js"></script>
<script src="../assets/store/js/foxui.js"></script>
<?php  if(substr($userrow['user'],0,3)=='qq_'){ ?>
<script>
toastr.warning('<a href="uset.php?mod=user">系统检测到您为QQ快捷登陆<br/>为确保您的账号后续能够正常使用建议设置登录账号！</a>', '账号安全提醒');
</script>
<?php } ?>
<?php  if($userrow['rmb']>4){ ?>
<?php if(strlen($userrow['pwd'])<6 || is_numeric($userrow['pwd']) && strlen($userrow['pwd'])<=10 || $userrow['pwd']===$userrow['qq']){ ?>
<script>
toastr.error('<a href="uset.php?mod=user">你的密码过于简单，请不要使用较短的纯数字或自己的QQ号当做密码，以免造成资金损失！</a>', '账号安全提醒');
</script>
<?php }else if($userrow['user']===$userrow['pwd']){ ?>
<script>
toastr.error('<a href="uset.php?mod=user">你的用户名与密码相同，极易被黑客破解，请及时修改密码</a>', '账号安全提醒');
</script>
<?php } ?>
<?php } ?>
<script>

function goback()
{
        if(window.document.referrer==""||window.document.referrer==window.location.href){  
        window.location.href="/";  
    }else{  
        window.location.href=window.document.referrer;  
    } 
    // document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
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
				$("#income_count").html(data.income_count);
			}
		}
	});
});
</script>
<script>//禁止右键

 

function click(e) {

 

if (document.all) {

 

if (event.button==2||event.button==3) { alert("欢迎光临寒舍，有什么需要帮忙的话，请与站长联系！谢谢您的合作！！！");

 

oncontextmenu='return false';

 

}

 

}

 

if (document.layers) {

 

if (e.which == 3) {

 

oncontextmenu='return false';

 

}

 

}

 

}

 

if (document.layers) {

 

document.captureEvents(Event.MOUSEDOWN);

 

}

 

document.onmousedown=click;

 

document.oncontextmenu = new Function("return false;")

 

document.onkeydown =document.onkeyup = document.onkeypress=function(){ 

 

if(window.event.keyCode == 12) { 

 

window.event.returnValue=false;

 

return(false); 

 

} 

 

}

 

</script>

 

 

 

  <script>//禁止F12

 

function fuckyou(){

 

window.close(); //关闭当前窗口(防抽)

 

window.location="about:blank"; //将当前窗口跳转置空白页

 

}

 

 

 

function click(e) {

 

if (document.all) {

 

  if (event.button==2||event.button==3) { 

 

alert("欢迎光临寒舍，有什么需要帮忙的话，请与站长联系！谢谢您的合作！！！");

 

oncontextmenu='return false';

 

}

 

 

 

}

 

if (document.layers) {

 

if (e.which == 3) {

 

oncontextmenu='return false';

 

}

 

}

 

}

 

if (document.layers) {

 

fuckyou();

 

document.captureEvents(Event.MOUSEDOWN);

 

}

 

document.onmousedown=click;

 

document.oncontextmenu = new Function("return false;")

 

document.onkeydown =document.onkeyup = document.onkeypress=function(){ 

 

if(window.event.keyCode == 123) { 

 

fuckyou();

 

window.event.returnValue=false;

 

return(false); 

 

} 

 

}

 

</script>
</body>
</html>