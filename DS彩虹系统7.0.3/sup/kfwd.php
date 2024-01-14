<?php
$title='开发文档';
include 'head.php';
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>

<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >开发文档</div>
<div class="panel-body">
<p>	ps:<a href="user/key.php">KEY可以在资料修改中或点我查看！</a></p>
<p>
	<strong><span style="font-size:24px;">1.获取订单</span></strong> 
</p>
<p>
	接口：http://<?php echo $_SERVER['HTTP_HOST'];?>/sup/api.php?<span>my=</span>orderacquisition
</p>
<p>
	提交参数：<span>user、<span>key</span>、<span>status</span></span> 
</p>
<p>
	<span>提交方式：GET</span> 
</p>
<p>
	<span>示例：<span>http://<?php echo $_SERVER['HTTP_HOST'];?>/sup/api.php?</span></span><span style="font-size:12px;">my=orderacquisition&amp;</span><span style="font-size:12px;">user=cs&amp;key=4544&amp;status=1</span><span style="font-size:12px;"></span><span style="font-size:12px;"></span> 
</p>
<p>
	<span style="font-size:12px;">参数说明：user是用户名；<span>key是秘钥</span>；<span><span>status是订单状态(0、1、2、3、4分别对应待处理、已完成、正在处理、异常、已退款)；</span></span></span>
</p>
<p>
	<span style="font-size:12px;"><span>返回数据：json数据</span>
</span> 
</p>
<p>
	<span style="font-size:12px;color:#EE33EE;"><span style="color:#EE33EE;"><span style="color:#EE33EE;"><span style="font-family:&quot;font-size:14px;color:#EE33EE;">返回格式：</span></span></span></span><span style="font-family:&quot;font-size:12px;">&nbsp;&nbsp;</span>
</p>
<p>
	<span style="font-size:12px;"><span><span> <span style="font-family:&quot;font-size:14px;"><span style="font-family:&quot;font-size:medium;">{"id":"订单编号",<br />
"tid":"商品id",<br />
"input":"下单数据",<br />
"input2":"下单数据2",<br />
"input3":"下单数据3",<br />
"input4":"下单数据4",<br />
"input5":"下单数据5",<br />
"value":"下单份数",<br />
"status":"订单状态",<br />
"tradeno":"订单号",<br />
"addtime":"下单时间"<br />
}</span></span><br />
</span></span></span> 
</p>
<p>
	<span style="font-size:12px;"> </span> 
</p>
<p>
	<span style="font-size:24px;"><strong>2.更改订单状态</strong></span> 
</p>
<p>
	接口：http://<?php echo $_SERVER['HTTP_HOST'];?>/sup/api.php?my=orderprocessing
</p>
<p>
	提交参数：user、key、status、id
</p>
<p>
	提交方式：GET
</p>
<p>
	示例：http://<?php echo $_SERVER['HTTP_HOST'];?>/sup/api.php?my=orderprocessing&amp;user=cs&amp;key=4544&amp;status=1&amp;id=20483<span style="font-size:12px;"></span><span style="font-size:12px;"></span><span style="font-size:12px;"></span> 
</p>
<p>
	<span style="font-size:12px;">参数说明：id是订单编号；user是用户名；key是秘钥；status是订单状态(0、1、2、3、4分别对应待处理、已完成、正在处理、异常、已退款)；</span>
</p>
<p>
	<span style="font-size:12px;">返回数据：<span style="font-family:&quot;font-size:medium;">success则更改成功，返回fail则失败！</span></span>
</p>

<p>
	<span style="font-size:24px;"><strong>3.订单退款</strong></span> 
</p>
<p>
	接口：http://<?php echo $_SERVER['HTTP_HOST'];?>/user/dindantuikuan.php?mod=tk
</p>
<p>
	提交参数：id
</p>
<p>
	提交方式：GET
</p>
<p>
	示例：http://<?php echo $_SERVER['HTTP_HOST'];?>/<span>user/dindantuikuan.php?mod=tk</span>&amp;id=20483<span style="font-size:12px;"></span><span style="font-size:12px;"></span><span style="font-size:12px;"></span> 
</p>
<p>
	<span style="font-size:12px;">参数说明：id是订单编号；</span> 
</p>
<p>
	<span style="font-size:12px;">返回数据：<span style="font-family:&quot;font-size:medium;">结果</span></span> 
</p>
  </div>
</div>