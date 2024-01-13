<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");
//此模板为供货商的商品介绍卡片
include("config.php");
$rzurl='/sup/user/reg.php';//供货商入驻申请地址
$user=$_GET['user'];
if($user==2871594636||$user=='op'){exit('');}//屏蔽某供货商信息
$bzjs = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM sup_config WHERE k='bzj'"));
//$bzjs = $DB->get_row("SELECT * FROM sup_config WHERE k='bzj'");
$ress = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM supplier WHERE user='$user'"));
//$ress = $DB->get_row("SELECT * FROM supplier WHERE user='$user'");
if($ress['id']=='1'){

exit('<ul class="list-group" style="margin-bottom: 0px;">
<li class="list-group-item">   
<div class="media">
<span class="pull-left thumb-sm"><img src="//q4.qlogo.cn/headimg_dl?dst_uin='.$ress['qq'].'&amp;spec=100" alt="..." class="img-circle img-thumbnail img-avatar" style="width:64px;></span>
<div class="pull-right push-15-t"><span style="color:#999;font-size: 10px;">&nbsp;&nbsp;官方认证&nbsp;<i class="fa fa-check-circle-o fa-fw text-danger"></i></span>
<a href="/sup/sup.php?yh='.$ress['user'].'" target="_blank" class="btn btn-sm btn-info btn-xs">ta的主页</a>
</div>
</div>
</li>
<li class="list-group-item">
<table>
    <tbody>
       <tr class="active">
        <td>
        <span style="color:#999;font-size: 10px;">联系我们：</span><br>
        
        <span style="color:#999;font-size:10px;">微信:'.$ress['wx'].'<br><a href="http://wpa.qq.com/msgrd?v=3&uin='.$ress['qq'].'&site=qq&menu=yes" target="_blank" style="color:#999;font-size:3px;">Q&nbsp;&nbsp;Q:'.$ress['qq'].'</a><br>邮箱:'.$ress['email'].'</span>&nbsp;
            </td></tr>
      </tbody>
    </table>
</li>
</ul>');}
if($ress['margin']>=intval($bzjs['v'])){
echo '
<ul class="list-group" style="margin-bottom: 0px;">
<li class="list-group-item">   
<div class="media">
<span class="pull-left thumb-sm"><img src="//q4.qlogo.cn/headimg_dl?dst_uin='.$ress['qq'].'&amp;spec=100" alt="..." class="img-circle img-thumbnail img-avatar" style="width:64px;></span>
<div class="pull-right push-15-t"><span style="color:#999;font-size: 10px;">&nbsp;&nbsp;供货商认证<i class="fa fa-check-circle-o text-success"></i></span>
<a href="/sup/sup.php?yh='.$ress['user'].'" target="_blank" class="btn btn-sm btn-info btn-xs">ta的主页</a>
</div>
</div>
</li>
<li class="list-group-item">
<table>
    <tbody>
      <tr class="active" style="background-color:#fff">
        <td><span style="color: #ce38b4;font-size: 10px;">请勿脱离平台交易,谨防受骗!（线下交易，平台不负任何责任!)</span></td>
      </tr>
      <tr class="active">
        <td>   
        <strong>
            <span style="color: #337ab7;font-size: 10px;">若供货商要求私下交易请<span style="color:#e8072f;">立即停止交易并联系客服举报</span>，举报有奖励哦!</span>
            </strong>
        </td>
      </tr>
       <tr class="active">
        <td>
        <a href="http://wpa.qq.com/msgrd?v=3&uin='.$ress['qq'].'&site=qq&menu=yes" target="_blank" style="font-size: 10px;">QQ:'.$ress['qq'].'</a><br>
        <span style="color:#13f051;font-size: 10px;">微信:'.$ress['wx'].'<br>
            </td></tr>
      </tbody>
    </table>
    <center>
<a href="'.$rzurl.'" target="_blank" class="btn btn-sm btn-success btn-xs">供货商入驻</a>&nbsp;&nbsp;
<a href="/sup/jb.php" target="_blank" class="btn btn-sm btn-warning btn-xs">举报供货商</a>
</center>
</li>
</ul>';}else{echo'<ul class="list-group" style="margin-bottom: 0px;">
<li class="list-group-item">
<span style="color:#a0b11c;font-size: 10px;">该业务由供货商提供，由平台担保购买具体业务详情可联系供货商！</span><br>
<span style="color:#EE33EE;font-size: 10px;">请勿脱离平台交易，谨防受骗！（线下交易，平台不负任何责任！）</span><br>
<a href="/sup/user/jb.php" target="_blank" style="font-size: 10px;">点我查看已被举报的供货商</a><br>

<a href="'.$rzurl.'" target="_blank" class="btn btn-sm btn-success btn-xs">供货商入驻</a>&nbsp;&nbsp;
<a href="/sup/jb.php" target="_blank" class="btn btn-sm btn-warning btn-xs">举报供货商</a>
</li>
</ul>
';}

?>