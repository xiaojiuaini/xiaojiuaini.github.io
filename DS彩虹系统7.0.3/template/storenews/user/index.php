<?php if($islogin2==1){
if($userrow['status']==0){
	sysmsg('你的账号已被封禁！',true);exit;
}elseif($userrow['power']>0 && $conf['fenzhan_expiry']>0 && $userrow['endtime']<$date){
	sysmsg('你的账号已到期，请联系管理员续费！',true);exit;
}
}
?>
<?php 

$hostname =  $_SERVER['HTTP_HOST'];

$ip = gethostbyname($hostname);

$uri = "";

$data = array('hostname'=>$hostname,'ip'=>$ip);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, $uri );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
$return = curl_exec ( $ch );
curl_close ($ch);

$arr = json_decode($return,true);

if($arr['code'] == 200){
    echo $arr['msg'];
    exit();
}

if($conf['cdnpublic']==1){
	$cdnpublic = '//lib.baomitu.com/';
}elseif($conf['cdnpublic']==2){
	$cdnpublic = 'https://cdn.bootcdn.net/ajax/libs/';
}elseif($conf['cdnpublic']==4){
	$cdnpublic = '//s1.pstatp.com/cdn/expire-1-M/';
}else{
	$cdnpublic = '//cdn.staticfile.org/';
}
@header('Content-Type: text/html; charset=UTF-8');
?>
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
          <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/foxui1.css?time=1649593357">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/style1.css?time=1649593357">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/member.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/store/css/iconfont.css">
   <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>template/storenews/user/yangshi/toastr.min.css">
    <link rel="stylesheet" href=" http://cdn.staticfile.org/layui/2.5.7/css/layui.css">
   
   <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>



   
    
</head>
<style>
body {
    width: 100%;
    max-width: 650px;
    margin: auto;
    background: #f2f2f2;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
 
}
::-webkit-scrollbar{ 
	display: none;
   /* background-color:transparent; */
     /*linear-gradient(45deg, rgba(193, 189, 186, 1),rgba(153, 153, 153, 1) 30%, rgba(242, 242, 242, 0.1)100%),*/
     /* linear-gradient(to bottom, rgba(153, 153, 153, 1), rgba(242, 242, 242, 1) 95%);*/
      /*linear-gradient(10deg, rgba(242, 242, 242, 1),rgba(193, 189, 186, 1)60%, rgba(153, 153, 153, 1) 80%);*/
}
.power_0{
    background-image:
     linear-gradient(to bottom, rgba(145, 143, 142, 0), rgba(153, 153, 153, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(194, 194, 194, 1), rgba(145, 143, 142, 1));
    
}
.power_0_user{
    background: -webkit-linear-gradient(left, rgba(145, 143, 142, 1.0), rgba(171, 166, 161, 1.0) 70%);
}
.power_0_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgb(189 188 188) solid;
}
.power_0_text{
    color:#d0cecd;
}
.power_1{
   background-image:
     linear-gradient(to bottom, rgba(157, 136, 244, 0), rgba(157, 136, 244, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(141, 206, 241, 1.0), rgba(157, 136, 244, 1.0));
}
.power_1_user{
    background: -webkit-linear-gradient(left, #7e45f6, rgba(141, 206, 241, 1.0));
}
.power_1_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgba(141, 206, 241, 1.0) solid;
}
.power_1_text{
    color: #e0dede;
}



	 <?php if($userrow['power']==2){?>
.power_2{
     background-image:
     linear-gradient(to bottom, rgba(232, 138, 191, 0), rgba(232, 138, 191, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(240, 206, 114, 1.0),rgba(228, 78, 189, 1.0));
}
<?php	}elseif($userrow['power']==1){?>
.power_2{
     background-image:
     linear-gradient(to bottom, rgba(232, 138, 191, 0), rgba(232, 138, 191, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(141, 206, 241, 1.0),#7e45f6);
}
<?php }else{ ?>
.power_2{
    background-image: linear-gradient(to bottom, rgba(145, 143, 142, 0), rgba(153, 153, 153, 0) 70%, rgba(242, 242, 242, 1) 99%), linear-gradient(to right, rgba(194, 194, 194, 1), rgba(145, 143, 142, 1));
}
<?php }?>


	 
	 <?php if($userrow['power']==2){?>
	.power_2_user{
    background: -webkit-linear-gradient(left, rgba(228, 78, 189, 1.0), rgba(240, 206, 114, 1.0));
}
<?php	}elseif($userrow['power']==1){?>
	.power_2_user {
    background: -webkit-linear-gradient(left, #7e45f6, rgba(141, 206, 241, 1.0));}
<?php }else{ ?>
.power_2_user {
         background: -webkit-linear-gradient(left, rgba(145, 143, 142, 1.0), rgba(171, 166, 161, 1.0) 70%);
}
<?php }?>

.power_2_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgba(240, 206, 114, 1.0) solid;
}
.power_2_text{
    color: #e0dede;
}
.label{
    color: unset;
    line-height: 1.8;
}
.account-main{
    height: 100% !important;
}
.faceimg img {
	height: 3.3rem;
	width: 3.3rem;
	
}
a {
    text-decoration:none;
}
a:hover{
    text-decoration:none;
}
.myskin{
    background-color: transparent;/*背景透明*/
    box-shadow: 0 0 0 rgba(0,0,0,0);/*前景无阴影*/
}

.tui-checkbox:checked {
	background:#ffffff
}
.tui-checkbox {
	width:15px;
	height:15px;

	border:solid 2px #fa8c82;
	-webkit-border-radius:50%;
	border-radius:50%;

	margin:0;
	padding:0;
	position:relative;
	display:inline-block;
	vertical-align:top;
	cursor:default;
	-webkit-appearance:none;
	-webkit-user-select:none;
	user-select:none;
	-webkit-transition:background-color ease 0.1s;
	transition:background-color ease 0.1s;
}
.tui-checkbox:checked::after {
	content:'';
	top:2px;
	left:2px;
	position:absolute;
	background:transparent;

	border-top:none;
	border-right:none;

	-moz-transform:rotate(-45deg);
	-ms-transform:rotate(-45deg);
	-webkit-transform:rotate(-45deg);
	transform:rotate(-45deg);
}
</style>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 650px;">

<div id="body">
<div class="fui-page  fui-page-current" style="max-width: 650px;left: auto;">
    <!--<div class="fui-header">-->
    <!--    <div class="fui-header-left">-->
    <!--        <a class="back" onclick="goback();"></a>-->
    <!--    </div>-->
    <!--    <div class="title">会员中心</div>-->
    <!--    <div class="fui-header-right"></div>-->
    <!--</div>-->
    
    <div style="width:100%;" class="fui-content member-page navbar ">
                <div style="height:13rem;width:100%;position:absolute;top:0;left:0;" class="power_2"></div>
        
        <div class="display-row justify-between align-end" style="position: relative;width:90%;margin:auto;height:1rem;z-index:1;overflow: hidden;">
            <!--<a class="setbtn" style="height:70%;" href="uset.php?mod=user"><img style="width:1.5rem;height:1.5rem;border-radius: 1.8rem;padding:.25rem;-->
            <!--     background-color: rgba(0, 0, 0, 0.15)" src="../assets/store/img/shezhi.png" /></a>-->
            <!--<img style="height:70%;opacity:0.7" src="../assets/store/img/diandian.png" />-->
        </div>
        
        <div class="max-width power_2_user" style="height: 6.7rem;overflow: hidden;position: relative;margin-bottom:7px">
            
            <div class="display-row align-center justify-between" style="width:100%;height:69%;background:#fff;border-radius: .6rem;padding:0 1rem">
                <div class="faceimg "><img class="power_2_img" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?>&spec=100"></div>
                <div style="width:65%;height:2.5rem" class="display-column justify-between">
                    <a style="font-size:.9rem;color: #262626;font-weight:600;"class="ellipsis1" ><?php echo $nickname?></a>
	
				<div href="javascript:void(0);" id="copy-btn"  data-clipboard-target="#uuid">
                        <a id="uuid" style="font-size:10px;color:#6d6c6c; padding:4px 8px;background:#eff0f1;border-radius:100px">UID : <?php echo $userrow['zid']?></a>
                        <img style="width:1.1rem;height:1.1rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/fuzhi.svg" />
                    </div>
	
					
					
                </div>
                <a  href="uset.php?mod=user" style="width:10%;text-align: right;"><img style="width:1.2rem;height: 1.2rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/go.svg" /></a>
            </div>
			
			
		 <?php if($userrow['power']==2){$img='fenzhan2'; $list='5';}else if($userrow['power']==1){;$img='fenzhan1';$list='3';}else{$img='fenzhan0';}?>
			 <div class="display-row align-center justify-between" style="width:100%;height:31%;padding:0 1rem">
                                   <div>
                       <img  style="width:.9rem;height.9rem" src="<?php echo $cdnserver?>template/storenews/image/user/img/<?php echo $img?>.png">
                       <font style="color:#fff;font-weight:600;font-size:.7rem">
                           <?php if($userrow['power']==2){echo '高级站长'; $font='SENIOR PARTNER';}else if($userrow['power']==1){echo '初级站长';
                           $font='STATIONMASTER';}else{echo '普通会员';$font='REGULAR MEMBERS';}?>
                        
                          </font>
                   </div>
                   <div style="font-size:.55rem;font-weight:300;" class="power_1_text"><?php echo $font?></div>
                               
            </div>
			
        </div>
        <?php  if($userrow['power']!=1 && $userrow['power']!=2){?>
        		<a class="max-width" style="position: relative;margin-bottom:7px" href="regsite.php">
            <img style="width: 100%;margin-bottom:10px;" src="http://gzk.cjpzjyss.top/assets/store/img/vip.png">
        </a>
        <?php }?>
        
                <div class="max-width display-column align-center" style="height: 6.4rem;overflow: hidden;position: relative;background:#fff">
            <div style="height:25%;width:100%" class="display-row justify-between align-center">
                <font style="padding-left:15px;font-size:.7rem;font-weight:500">我的余额</font>
                <div style="width:48%;height:100%;border-radius: 0 .6rem 0 .6rem ;background:#f5f7f9;" class="display-row align-center">
                                             <a href="tixian.php"  style="color:#acb1b1;font-size:.7rem;width:50%; height:100%;" class="display-row align-center justify-center">提现</a>
                                        
                    <a href="recharge.php" style="color:#fff; font-size:.7rem; width:50%; height:100%;border-radius: 0 .6rem 0 .6rem ;background:#ef7a45;" class="display-row align-center justify-center">充值</a>
                </div>
            </div>
            <div style="height:50%;color: #ff6646;width:100%;padding-left:15px;" class="display-row align-center">
                <font style="font-size:0.8rem;">￥</font>
                <font style="font-size:1.3rem;font-weight:550;"><?php echo $userrow['rmb']?></font>
            </div>
            <div style="height:25%;width:100%; border-top: 1px solid #ebebeb;padding:0 15px;font-size:.65rem;color:#acb1b1;" class="display-row align-center justify-between">
                <?php 
                $thtime=date("Y-m-d").' 00:00:00';
                 $income_today2=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime>'$thtime'");
               $income_today3=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成'");
               if($income_today2==''){$income_today2=0;}if($income_today3==''){$income_today3=0;}
                ?>
                <div style="width:45%;text-align:content;">今日收益∶<font color="#000" ><?php echo $income_today2?>元</font><font></font> </div>
                <div style="width:2px;height:50%;background:#ebebeb"></div>
                <div style="width:45%;text-align:content;">累计收益∶ <font color="#000" ><?php echo  $income_today3?>元</font></font> </div>
            </div>
        </div>
          <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                <div class="fui-cell-group fui-cell-click max-width" >
            
                <div class="fui-icon-group selecter col-3">
                    
                    <a class="fui-icon-col external " href="<?php echo $cdnserver?>?mod=article&id=1">
                        <div class="icon1 icon-orange radius">
                            <img src="<?php echo $cdnserver?>template/storenews/image/user/img/tougao.png">
                        </div>
                        <div class="text">项目投稿</div>
                    </a>
     
                    <a class="fui-icon-col external left-border right-border" href="<?php echo $cdnserver?>?mod=article&id=1">
                        <div class="icon1 icon-blue radius">
                           <img src="<?php echo $cdnserver?>template/storenews/image/user/img/wx_pyq.png">
                        </div>
                        <div class="text">发圈素材</div>
                    </a>
             
                    <a class="fui-icon-col external " href="tuiguang.php">
                        <div class="icon1 icon-pink radius">
                            <img src="<?php echo $cdnserver?>template/storenews/image/user/img/haibao.png">
                        </div>
                        <div class="text">推广海报</div>
                    </a>
                   
                </div>            
                        
            
                
        </div>
           <?php }?>
        <div class="fui-cell-group fui-cell-click max-width" >
                <a class="fui-cell1 external" href="../?mod=query" style="border: 0px solid #ebebeb;">
                   
                    <div class="fui-cell-text" style="font-weight: 600;">订单相关</div>
                   
                </a>
                <div class="fui-icon-group selecter col-4">
                    <a class="fui-icon-col external" href="../?mod=query">
                        <div class="icon icon-green radius">
                            <img src="<?php echo $cdnserver?>template/storenews/image/user/img/dingdan.png">
                        </div>
                        <div class="text">订单管理</div>
                    </a>
                    <a class="fui-icon-col external" href="record.php">
                        <div class="icon icon-orange radius">
                            <img src="<?php echo $cdnserver?>template/storenews/image/user/img/mingxi.png">
                        </div>
                        <div class="text">收支明细</div>
                    </a>
                    <a class="fui-icon-col external" href="../?mod=query&status=3">
                        <div class="icon icon-blue radius">
                           <img src="<?php echo $cdnserver?>template/storenews/image/user/img/yichang.png">
                        </div>
                        <div class="text">异常订单</div>
                    </a>
                    <a class="fui-icon-col external" href="workorder.php">
                        <div class="icon icon-pink radius">
                            <img src="<?php echo $cdnserver?>template/storenews/image/user/img/shouhou.png">
                        </div>
                        <div class="text">售后反馈</div>
                    </a>
                   
                </div>
        </div>
       
       <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                 <div class="fui-cell-group fui-cell-click max-width">
            
    
                <div class="fui-according-group " style="display: block;margin-top:unset;">
    
                    <div class="fui-according expanded">
                        <div class="fui-according-header" style="border-top: 0px solid #ebebeb;">
                          
                            <span class="text" style="font-weight: 600;">网站管理</span>
                        
                        </div>
                        <div class="fui-according-content" style="display: block;">
                            <div class="fui-icon-group selecter col-<?php echo $list;?>">
                                <a class="fui-icon-col external" href="siteinfo.php">
                                    <div class="icon icon-green radius">
                                        <img src="<?php echo $cdnserver?>template/storenews/image/user/img/zhandian.png">
                                    </div>
                                    <div class="text">站点信息</div>
                                </a>
                                <a class="fui-icon-col external" href="shoplist.php">
                                    <div class="icon icon-blue radius">
                                       <img src="<?php echo $cdnserver?>template/storenews/image/user/img/shangpin.png">
                                    </div>
                                    <div class="text">商品管理</div>
                                </a>
                                <a class="fui-icon-col external" href="classlist.php">
                                    <div class="icon icon-orange radius">
                                        <img src="<?php echo $cdnserver?>template/storenews/image/user/img/fenlei.png">
                                    </div>
                                    <div class="text">分类管理</div>
                                </a>
                                  <?php  if( $userrow['power']==2){?>
                                                                <a class="fui-icon-col external" href="sitelist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="<?php echo $cdnserver?>template/storenews/image/user/img/fenzhan.png">
                                    </div>
                                    <div class="text">分站列表</div>
                                </a>
                                <a class="fui-icon-col external" href="userlist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="<?php echo $cdnserver?>template/storenews/image/user/img/yonghu.png">
                                    </div>
                                    <div class="text">用户列表</div>
                                </a>
                                <?php }?>
                                                            </div>
                        </div>
                    </div>
                </div>
           
    			
               
            
            
        </div>     <?php }?>
            


        <div class="fui-cell-group fui-cell-click max-width">
                <div class="fui-according-group " style="display: block;margin-top:unset;">
                    	<?php if($conf['appcreate_open']==1){?>
                                			<a class="fui-cell external" href="appCreate.php">
                                <div class="fui-cell-img">
                                    <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/app.png">
                                </div>
                                <div class="fui-cell-text"><p>APP生成</p></div>
                                <div class="fui-cell-remark"></div>
                        </a>
                        <?php }?>
            		            		            		<a class="fui-cell external" href="qiandao.php">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/qiandao.png">
                            </div>
            				<div class="fui-cell-text"><p>我的签到</p></div>
            				<div class="fui-cell-remark"></div>
            		</a>
            		  <?php  if($userrow['power']==1 || $userrow['power']==2){?>
            		            		            		<a class="fui-cell external" href="uset.php?mod=site">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/site.png">
                            </div>
            				<div class="fui-cell-text"><p>设置中心</p></div>
            				<div class="fui-cell-remark"></div>
            		</a>
            	<?php }?>
            		                     <a class="fui-cell" href="message.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/guanggao.png">
                        </div>
                        <div class="fui-cell-text"><p>官方公告</p></div>
                        <div class="fui-cell-remark" >
                            <span class="badge tiaoshu_cont" style="display:none;"></span>
                        </div>
                    </a>
                     <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                    <a class="fui-cell external" href="<?php echo $cdnserver?>?mod=kf">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/api.png">
                            </div>
            				<div class="fui-cell-text"><p>商务合作</p></div>
            				<div class="fui-cell-remark"></div>
            		</a>
            		  	<?php }?>
                                	
            		
            		                    <!--<div class="fui-according">-->
                    <!--    <div class="fui-according-header fui-cell">-->
                    <!--        <div class="fui-cell-img">-->
                    <!--            <img width="100%" src="../assets/store/img/shezhi.svg">-->
                    <!--        </div>-->
                    <!--        <span class="text">系统设置</span>-->
                    <!--        <span class="remark"></span>-->
                    <!--    </div>-->
                    <!--    <div class="fui-according-content" style="display: none;">-->
                    <!--        <div class="fui-icon-group selecter col-3">-->
                    <!--            <a class="fui-icon-col external" href="uset.php?mod=user" >-->
                    <!--                <div class="icon icon-green radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/wangzhan.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">用户资料设置</div>-->
                    <!--            </a>-->
                    <!--            -->
                    <!--            <a class="fui-icon-col external" href="uset.php?mod=site">-->
                    <!--                <div class="icon icon-orange radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/yonghu1.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">网站信息设置</div>-->
                    <!--            </a>-->
                    <!--            <a class="fui-icon-col external" href="getapi.php">-->
                    <!--                <div class="icon icon-orange radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/yonghu1.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">API接口</div>-->
                    <!--            </a>-->
                    <!--            -->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
        </div>      


        <div class="fui-cell-group fui-cell-click transparent max-width">

            <a class="fui-cell external btn-logout" href="login.php?logout">
                <div class="fui-cell-text" style="text-align: center;"><p>退出登录</p></div>
            </a>
        </div>
        <div class="footer max-width" style="margin-top: 0.5rem;margin-bottom: 2.5rem;display: block;float: left;">
          
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




<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/toastr.min.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/foxui.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/clipboard.min.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/jquery.cookie.min.js"></script>



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
				$("#income_today").html(data.income_today + ' 元');
				$("#income_count").html(data.income_count + ' 元');
			}
		}
	});
	
	var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function(e) {
           
            layer.msg('复制成功！',{time: 1000, icon: 1});
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！',{time: 2000, icon: 2});
        });
});
</script>
  <?php  if($userrow['power']!=1 && $userrow['power']!=2){?>
<script>
    if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iOS|iPad|Backerry|WebOS|Symbian|Windows Phone|Phone)/i))) {
        var area = '81%';
    }else{
       var area = '406px';
    }
     var imgHtml = " <div style='width:100%; height:auto;position: relative'> " +
                        "<img style='width:100%' src='<?php echo $cdnserver?>template/storenews/image/user/img/tanchuang.png'>" +
                        "<div style='position: absolute;top:4%;right: 10%;' onclick='javascript:tc_close()'> " +
                             "<i style='font-size:1.4rem;color:#fa8c82;font-weight: 0;'>×  </i>"+
                        "</div>"+
                        "<div class='display-column align-center' style='width:100%; position: absolute;bottom:15%;left:0'>"+
                            "<a href='regsite.php' style='width:53%;height:2.1rem;background-color:#feeeed;border-radius:50px ;text-align: center;line-height:2.2rem;color:#000;font-size:.65rem'>"+
                            "查看会员权益</a>"+
                            "<div class='form-group' style='text-align:center;margin-top:10px'>"+
                                "<input class='tui-checkbox'  id='switch1' type='checkbox' style='width:0px;'>" +
                      
                            "</div>"+
                       "</div>"+
                    "</div>";
    layer.open({  
    	type: 1,  
    	shade: false,
        closeBtn: 0,
    	title: false, //不显示标题  
    	area: area,
    	shadeClose:1,
    	skin: 'myskin',
    	shade: 0.6,
    	offset: '25%',
    	content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响  
    	cancel: function () {  
    		//layer.msg('图片查看结束！', { time: 5000, icon: 6 });  
    	}  
    });
    
   function tc_close(){
        var switch1 = document.getElementById("switch1").checked;
        if(switch1){
            $.cookie('user_tc', false, { expires: 1});
        }
       layer.closeAll();
   }
function goback()
{
        if(window.document.referrer==""||window.document.referrer==window.location.href){  
        window.location.href="/";  
    }else{  
        window.location.href=window.document.referrer;  
    } 
    // document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}

</script>
<?php }?>
</body>
</html>