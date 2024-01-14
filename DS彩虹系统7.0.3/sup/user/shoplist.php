<?php
$title='商品管理';
include '../head.php';
$bzj=mysqli_query($con,"SELECT * FROM sup_config WHERE k='bzj'");
$bzjs = mysqli_fetch_array($bzj);
$tid=intval($_GET['tid']);
if($userrow['margin']<intval($bzjs['v'])){exit("<script language='javascript'>alert('您的保证金低于{$bzjs['v']}元，无法添加或编辑商品');window.location.href='margin.php';</script>");}
$sql = "SELECT * FROM shua_class WHERE active=1 order by sort asc";
$result = mysqli_query($con,$sql);
$select='<option value="0">未分类</option>';
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($result)) {
        $shua_class[$res['cid']]=$res['name'];
      $select .='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
    }
}
if($tid!==0){
$result = mysqli_query($con,"SELECT * FROM shua_tools WHERE tid='$tid'");
$row = mysqli_fetch_array($result);
if($row['supplier']!=$u){exit("<script language='javascript'>alert('你无权限编辑此商品');window.history.go(-1);</script>");}
}
?>
<div class="wrapper">
<form class="form" id="entry_form" action="?mod=<?php if($tid==null){echo 'tj';}else{echo 'xg&tid='.$tid;} ?>" method="post">
<div class="col-sm-6">
<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">商品管理</div>
	<div class="panel-body">
<div class="form-group" id="goods_type">
<label>商品名称(<font color="#FF0000">必填</font> ):</label><br>
<input type="text" class="form-control" name="name" value="<?php if($tid!==null){echo $row['name'];} ?>" placeholder="不可留空">
</div>
<div class="form-group" id="goods_type">
<label>默认数量(<font color="#FF0000">必填</font> ):</label><br>
<input type="text" class="form-control" name="value" value="<?php if($tid!==null){echo $row['value'];} ?>" placeholder="填写1则默认下单数量是1个">
</div>
<div class="form-group" id="goods_type">
<label>成本价格(<font color="#FF0000">必填</font> ):</label><br>
<input type="text" class="form-control" name="price" value="<?php if($tid!==null){echo $row['price'];} ?>" placeholder="卖出后你获得的金额">
</div>
<div class="form-group" id="goods_type">
<label>第一个输入框标题(<font color="#FF0000">必填</font> ):</label><br>
<input type="text" class="form-control" name="input" value="<?php if($tid!==null){echo $row['input'];} ?>" placeholder="默认下单QQ，填写如下单账号、快手ID、抖音ID等">
</div>
<div class="form-group" id="goods_type">
<label>更多输入框标题:</label><br>
<input type="text" class="form-control" name="inputs" value="<?php if($tid!==null){echo $row['inputs'];} ?>" placeholder="留空则不显示更多输入框">
<pre><font color="green">多个输入框请用|隔开(不能超过4个)</font></pre>
</div>
<div class="form-group" id="goods_type">
<label>商品介绍:</label><br>
<textarea class="form-control" name="desc" rows="3" placeholder="当选择该商品时自动显示，支持HTML代码"><?php if($tid!==null){$arr = explode('<!-- 供货商介绍 -->',$row['desc']); echo $arr[0];} ?></textarea>
<pre><font color="green">请认真填写，写明到账时间、要求、需要什么、商品的各项介绍等！</font></pre>
</div>
<div class="form-group" id="goods_type">
<label>提示内容(没有请留空):</label><br>
<input type="text" class="form-control" name="alert" value="<?php if($tid!==null){echo $row['alert'];} ?>" placeholder="当选择该商品时自动弹出提示，不支持HTML代码">
</div>

</div>
</div>
</div>
<div class="col-sm-6">
	<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">商品管理</div>
	<div class="panel-body">
<div class="form-group" id="goods_type">
<label>商品分类:</label><br>
<select name="cid" class="form-control" default="<?php if($tid!==null){echo $row['cid'];} ?>">';
	<?php echo $select; ?>
	</select>
</div>
<div class="form-group" id="goods_type">
<label>购买后动作:</label><br>
<select name="is_curl" class="form-control" default="<?php if($tid!==null){echo $row['is_curl'];} ?>">';
	<option value="0">无</option><option value="4">自动发送卡密</option>
	</select>
</div>
<div class="form-group" id="goods_type">
<label>显示数量选择框:</label><br>
<select class="form-control" name="multi" default="<?php if($tid!==null){echo $row['multi'];} ?>"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<div class="form-group" id="shopimg">
<label>商品图片(没有请留空):</label><br>
<input type="text" class="form-control" name="shopimg" value="<?php if($tid!==null){echo $row['shopimg'];} ?>">
</div>
<div class="form-group" id="prices">
<label>批发价格优惠设置:</label><br>
<input type="text" class="form-control" name="prices" value="<?php if($tid!==null){echo $row['prices'];} ?>">
<pre><font color="green">填写格式：购满x个|减少x元单价,购满x个|减少x元单价  例如10|0.1,20|0.3,30|0.5</font></pre>
</div>
<input type="submit" class="btn btn-primary btn-block" value="提交">
  </div>
 </div>
</div>
</form>
</div>

<?php
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod!==null){
$is_curl=$_POST['is_curl'];
$tid=$_GET['tid'];
$name=$_POST['name'];
$value=$_POST['value'];
$price=$_POST['price'];
$prices=$_POST['prices'];
$input=$_POST['input'];
$inputs=$_POST['inputs'];
$desc=$_POST['desc'];
$alert=$_POST['alert'];
$shopimg=$_POST['shopimg'];
$multi=$_POST['multi'];
$cid=$_POST['cid'];
if(strpos($name,"抖音")!==FALSE){exit("<script language='javascript'>alert('因支付接口要求禁止添加抖音类商品');window.history.go(-1);</script>");}
if(strpos($name,"软件")!==FALSE){exit("<script language='javascript'>alert('因支付接口要求禁止添加软件类商品');window.history.go(-1);</script>");}
if(strpos($name,"快手")!==FALSE){exit("<script language='javascript'>alert('因支付接口要求禁止添加快手类商品');window.history.go(-1);</script>");}
$s='<!-- 供货商介绍 --><div id="sup"></div><script>$.get("/sup/su.php?user=';
$s2='",function(data){document.getElementById("sup").innerHTML = data;});</script>';
$spjs = $s.$u.$s2;
if ($name==null){exit("<script language='javascript'>alert('商品名称不能为空！');window.history.go(-1);</script>");}
if ($value==null){exit("<script language='javascript'>alert('下单数量不能为空！');window.history.go(-1);</script>");}
if ($price==null){exit("<script language='javascript'>alert('成本价格不能为空！');window.history.go(-1);</script>");}
if($input==null){$input='下单QQ';}
if($price>=100){$mb=11;}else{$mb=10;}
$desc=$desc.$spjs;
if($mod=='xg')
{
mysqli_query($con,"UPDATE `shua_tools` SET `name` = '$name',`value` = '$value',`price` = '$price',`prices` = '$prices',`input` = '$input',`inputs` = '$inputs',`alert` ='$alert',`shopimg` = '$shopimg',`multi` = '$multi',`desc`='$desc',`cid`='$cid',`repeat`=1,`prid`='$mb',`is_curl`='$is_curl' WHERE `tid` = '$tid'");
exit("<script language='javascript'>alert('修改成功！');window.location.href='../classlist.php';</script>");
}
if($mod=='tj')
{
  if($userrow['margin']>=intval($bzjs['v'])){$active=1;}else{$active=0;};
$sql = "INSERT INTO shua_tools (name,value,price,prices,input,inputs,alert,shopimg,multi,supplier,`desc`,cid,`repeat`,`active`,`prid`,`sort`,`is_curl`) VALUES ('$name', '$value','$price','$prices', '$input','$inputs','$alert','$shopimg','$multi','$u','$desc','$cid',1,'$active',$mb,10000,'$is_curl')";
   if ($con->query($sql) === TRUE) {
    exit("<script language='javascript'>alert('添加成功！');window.location.href='../classlist.php';</script>");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}}
echo '<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
function getFloat(number, n) {
	n = n ? parseInt(n) : 0;
	if (n <= 0) return Math.ceil(number);
	number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
	return number;
}
function changeNum(obj){
	var num = parseInt($(obj).val());
	var price = parseFloat($("#price").val());
	if(num == 0 || isNaN(price))return false;
	$("input[name=\'price\']").val(getFloat(num * price, 2));
}
function fileSelect(){
	$("#file").trigger("click");
}
function fileView(){
	var shopimg = $("#shopimg").val();
	if(shopimg==\'\') {
		layer.alert("请先上传图片，才能预览");
		return;
	}
	if(shopimg.indexOf(\'http\') == -1)shopimg = \'../\'+shopimg;
	layer.open({
		type: 1,
		area: [\'360px\', \'400px\'],
		title: \'商品图片查看\',
		shade: 0.3,
		anim: 1,
		shadeClose: true,
		content: \'<center><img width="300px" src="\'+shopimg+\'"></center>\'
	});
}
function fileUpload(){
	var fileObj = $("#file")[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("do","upload");
	formData.append("type","shop");
	formData.append("file",fileObj);
	var ii = layer.load(2, {shade:[0.1,\'#fff\']});
	$.ajax({
		url: "ajax.php?act=uploadimg",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg(\'上传图片成功\');
				$("#shopimg").val(data.url);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg(\'服务器错误\');
			return false;
		}
	})
}
function Addstr(id, str) {
	$("#"+id).val($("#"+id).val()+str);
}
$(document).ready(function(){
	$("select[name=\'is_curl\']").change(function(){
		if($(this).val() == 1){
			$("#curl_display1").css("display","inherit");
			$("#curl_display2").css("display","none");
		}else if($(this).val() == 2){
			$("#curl_display1").css("display","none");
			$("#curl_display2").css("display","inherit");
		}else{
			$("#curl_display1").css("display","none");
			$("#curl_display2").css("display","none");
		}
		if($(this).val() == 4){
			$("#show_value").css("display","none");
		}else{
			$("#show_value").css("display","inherit");
		}
	});
	$("select[name=\'shequ\']").change(function(){
		var type = $("select[name=\'shequ\'] option:selected").attr("type");
		if(type == 4){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","inherit");
		}else if(type == 1 || type == 3 || type == 5 || type == 11 || type == 12){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","none");
		}else if(type == 10){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","none");
		}else if(type >= 6){
			$("#goods_type").css("display","none");
			$("#goods_param").css("display","inherit");
		}else{
			$("#goods_type").css("display","inherit");
			$("#goods_param").css("display","inherit");
		}
		if(type >= 6 && type <= 9){
			$("#show_value").css("display","none");
			$("#goods_id").css("display","none");
			$("#show_goodslist").css("display","none");
			$("#goods_param_name").html("下单页面地址：");
			if($("input[name=\'goods_param\']").val().indexOf(\'http\')<0)$("input[name=\'goods_param\']").val("");
		}else if(type == 10){
			$("#show_value").css("display","inherit");
			$("#goods_id").css("display","inherit");
			$("#show_goodslist").css("display","none");
			$("#goods_param_name").html("下单页面地址：");
		}else if(type == 20){
';
if (class_exists('ExtendAPI')) 
{
	ExtendAPI::shopEditJs();
}
echo "		}else{
			\$(\"#show_value\").css(\"display\",\"inherit\");
			\$(\"#goods_id\").css(\"display\",\"inherit\");
			\$(\"#show_goodslist\").css(\"display\",\"inherit\");
			\$(\"#goods_param_name\").html(\"参数名：\");
		}
		if(type == 4){
			\$(\"#show_goodslist\").css(\"display\",\"none\");
		}
	});
	\$(\"#getGoods\").click(function(){
		var shequ=\$(\"select[name='shequ']\").val();
		if(shequ==''){layer.alert('请先选择一个对接网站');return false;}
		\$('#goodslist').empty();
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		\$.ajax({
			type : \"POST\",
			url : \"ajax.php?act=getGoodsList\",
			data : {shequ:shequ},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					\$('#getGoods').attr('type',data.type);
					\$.each(data.data, function(i, item){
						if(data.type == 'jiuwu')
							\$('#goodslist').append('<option value=\"'+item.id+'\" goodstype=\"'+item.type+'\" shopimg=\"'+item.shopimg+'\" minnum=\"'+item.minnum+'\" maxnum=\"'+item.maxnum+'\" price=\"'+item.price+'\">'+item.name+'</option>');
						else if(data.type == 'yile')
							\$('#goodslist').append('<option value=\"'+item.id+'\">'+item.name+'</option>');
						else if(data.type == 'xingmo')
							\$('#goodslist').append('<option value=\"'+item.id+'\" shopimg=\"'+item.shopimg+'\">'+item.name+'</option>');
						else if(data.type == 'jumeng')
							\$('#goodslist').append('<option value=\"'+item.id+'\" shopimg=\"'+item.shopimg+'\" minnum=\"'+item.minnum+'\" maxnum=\"'+item.maxnum+'\">'+item.name+'</option>');
						else
							\$('#goodslist').append('<option value=\"'+item.id+'\">'+item.name+'</option>');
					});
					if(\$(\"#goodslist\").attr('default')!='undefined'){
						\$('#goodslist').val(\$(\"#goodslist\").attr('default'));
					}
				}else{
					layer.alert(data.msg);
				}
			},
			error:function(data){
				layer.msg('服务器错误');
				return false;
			}
		});
	});
	\$(\"#goodslist\").change(function () {
		var type = \$('#getGoods').attr('type');
		if(type == 'jiuwu'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var goodstype = \$(\"#goodslist option:selected\").attr('goodstype');
			var minnum = \$(\"#goodslist option:selected\").attr('minnum');
			var maxnum = \$(\"#goodslist option:selected\").attr('maxnum');
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			var price = \$(\"#goodslist option:selected\").attr('price');
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"input[name='goods_type']\").val(goodstype);
			\$(\"input[name='shopimg']\").val(shopimg);
			\$(\"#price\").val(price);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"input[name='goods_param']\").val(data.param);
						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/index.php?m=Home&c=Goods&a=detail&id='+goodsid+'&goods_type='+goodstype+'\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>社区商品售价：</b>'+data.price+'<br/><b>最小下单数量：</b>'+minnum+'<br/><b>最大下单数量：</b>'+maxnum);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else if(type == 'yile'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"input[name='shopimg']\").val(data.image);
						var paramname = data.paramname;
						var inputs ='';
						\$.each(paramname.split('|'), function(i, v) {
							if(i==0){
								\$(\"input[name='input']\").val(v);
							}else{
								if(v=='QQ空间说说ID')v='说说ID';
								inputs += '|'+v;
							}
						});
						\$(\"input[name='inputs']\").val(inputs.substr(1));
						\$(\"#price\").val(data.price);

						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/home/order/'+goodsid+'\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>商品简介：</b>'+data.desc+'<br/><b>社区商品售价：</b>'+data.price+' 元<br/><b>最小下单数量：</b>'+data.limit_min+'<br/><b>最大下单数量：</b>'+data.limit_max);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else if(type == 'jumeng'){
			var shequ=\$(\"select[name='shequ']\").val();
			var goodsid = \$(\"#goodslist option:selected\").val();
			var minnum = \$(\"#goodslist option:selected\").attr('minnum');
			var maxnum = \$(\"#goodslist option:selected\").attr('maxnum');
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			var name = \$(\"#goodslist option:selected\").html();
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"input[name='shopimg']\").val(shopimg);
			var ii = layer.load(2, {shade:[0.1,'#fff']});
			\$.ajax({
				type : \"POST\",
				url : \"ajax.php?act=getGoodsParam\",
				data : {shequ:shequ,goodsid:goodsid},
				dataType : 'json',
				success : function(data) {
					layer.close(ii);
					if(data.code == 0){
						\$(\"#price\").val(data.money);
						\$(\"#GoodsInfo\").html('<b>商品名称：</b><a style=\"color:white\" href=\"http://'+\$(\"select[name='shequ'] option:selected\").html()+'/login'+goodsid+'.html\" target=\"_blank\" rel=\"noreferrrer\">'+name+'</a><br/><b>社区商品售价：</b>'+data.money+'<br/><b>最小下单数量：</b>'+minnum+'<br/><b>最大下单数量：</b>'+maxnum);
						\$(\"#GoodsInfo\").slideDown();
					}else{
						layer.alert(data.msg);
					}
				},
				error:function(data){
					layer.msg('服务器错误');
					return false;
				}
			});
		}else{
			var goodsid = \$(\"#goodslist option:selected\").val();
			var shopimg = \$(\"#goodslist option:selected\").attr('shopimg');
			if(typeof (shopimg) != \"undefined\")\$(\"input[name='shopimg']\").val(shopimg);
			\$(\"input[name='goods_id']\").val(goodsid);
			\$(\"#GoodsInfo\").hide();
			\$(\"#price\").val('');
		}
	});
	var items = \$(\"select[default]\");
	for (i = 0; i < items.length; i++) {
		\$(items[i]).val(\$(items[i]).attr(\"default\")||0);
	}
	\$(\"select[name='shequ']\").change();
});
</script>";
?>