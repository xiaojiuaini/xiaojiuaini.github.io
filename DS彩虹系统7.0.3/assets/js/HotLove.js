var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();
layui.use('form', function(){
	var form = layui.form;
	form.on('select', function(data){
		$("#cid").change();
	});
});
layui.use('element', function(){
	var element = layui.element;
});
function activeselect(a){
	$('.active').removeClass('active');
	$(a).addClass('active')
}
function getcount() {
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count_yxts').html(data.yxts);
			$('#count_orders').html(data.orders);
			$('#count_orders1').html(data.orders1);
			$('#count_orders2').html(data.orders2);
			$('#count_orders_all').html(data.orders);
			$('#count_orders_today').html(data.orders2);
			$('#count_money').html(data.money);
			$('#count_money1').html(data.money1);
			$('#count_site').html(data.site);
			if(data.gift != null){
				$.each(data.gift, function(k, v) {
					$('#pst_1').append('<li><strong>'+k+'</strong> 获得&nbsp;'+v+'</li>');
				});
				$('.giftlist').show();
				$('.giftlist ul').css('height',(35*$('#pst_1 li').length)+'px');
				scollgift();
			}
			if(data.cart_count != null && data.cart_count>0){
				$('#cart_count').html(data.cart_count);
				$('#alert_cart').slideDown();
			}
		}
	});
}
var pwdlayer;
function changepwd(id,skey) {
	pwdlayer = layer.open({
	  type: 1,
	  title: '修改密码',
	  skin: 'layui-layer-rim',
	  content: '<div class="form-group"><div class="input-group"><div class="input-group-addon">密码</div><input type="text" id="pwd" value="" class="form-control" placeholder="请填写新的密码" required/></div></div><input type="submit" id="save" onclick="saveOrderPwd('+id+',\''+skey+'\')" class="btn btn-primary btn-block" value="保存">'
	});
}
function saveOrderPwd(id,skey) {
	var pwd=$("#pwd").val();
	if(pwd==''){layer.alert('请确保每项不能为空！');return false;}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=changepwd",
		data : {id:id,pwd:pwd,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				layer.close(pwdlayer);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function scollgift(){
  setInterval(function() {
    var frist_li_idx = $("#pst_1 li:first");
    var c_li = frist_li_idx.clone();
    frist_li_idx.animate({
      "marginTop": "-35px",
      "opacity": "hide"
    }, 600, function() {
      $(this).remove();
      $("#pst_1").append(c_li);
    });
  }, 2000);
}
function getPoint() {
	if($('#tid option:selected').val()=="0"){
		$('#inputsname').html("");
		$('#need').val('');
		$('#alert_frame').hide();
		return false;
	}
	history.replaceState({}, null, './?cid='+$('#cid').val()+'&tid='+$('#tid option:selected').val());
	var multi = $('#tid option:selected').attr('multi');
	var count = $('#tid option:selected').attr('count');
	var price = $('#tid option:selected').attr('price');
	var shopimg = $('#tid option:selected').attr('shopimg');
	var close = $('#tid option:selected').attr('close');
	if(multi==1 && count>1){
		$('#need').val('￥'+price +"元 ➠ "+count+"个");
	}else{
		$('#need').val('￥'+price +"元");
	}
	if(close == 1){
		$('#submit_buy').val('当前商品已停止下单');
		$('#submit_buy').html('当前商品已停止下单');
		layer.alert('当前商品维护中，停止下单！');
	}else if(price == 0){
		$('#submit_buy').val('立即免费领取');
		$('#submit_buy').html('立即免费领取');
	}else{
		$('#submit_buy').val('立即购买');
		$('#submit_buy').html('立即购买');
	}
	if(multi == 1 && price != 0){
		$('#display_num').show();
	}else{
		$('#display_num').hide();
	}
	var inputnametype = '';
	$('#inputsname').html("");
	var inputname = $('#tid option:selected').attr('inputname');
	if(inputname=='hide'){
		$('#inputsname').append('<input type="hidden" name="inputvalue" id="inputvalue" value="'+$.cookie('mysid')+'"/>');
	}else{
		if(inputname=='')inputname='下单账号';
		if(inputname.indexOf('[')>0 && inputname.indexOf(']')>0){
			inputnametype = inputname.split('[')[1].split(']')[0];
			inputname = inputname.split('[')[0];
		}
		$('#inputsname').append('<div class="layui-form layui-form-pane"><div class="layui-form-item"><label class="layui-form-label" id="inputname">'+inputname+'</label><div class="layui-input-block"><input type="text" name="inputvalue" id="inputvalue" value="'+($_GET['qq']?$_GET['qq']:'')+'" class="layui-input layui-form-danger" required onblur="checkInput()"/></div></div></div>');
	}
	var inputsname = $('#tid option:selected').attr('inputsname');
	if(inputsname!=''){
		$.each(inputsname.split('|'), function(i, value) {
			var inputsnametype = '';
			if(value.indexOf('[')>0 && value.indexOf(']')>0){
				inputsnametype = value.split('[')[1].split(']')[0];
				value = value.split('[')[0];
			}
			if(value.indexOf('{')>0 && value.indexOf('}')>0){
				var addstr = '';
				var selectname = value.split('{')[0];
				var selectstr = value.split('{')[1].split('}')[0];
				$.each(selectstr.split(','), function(i, v) {
					if(v.indexOf(':')>0){
						i = v.split(':')[0];
						v = v.split(':')[1];
					}else{
						i = v;
					}
					addstr += '<option value="'+i+'">'+v+'</option>';
				});
				$('#inputsname').append('<div class="layui-form-pane"><div class="layui-form-item"><label class="layui-form-label" id="inputname'+(i+2)+'">'+selectname+'</label><div class="layui-input-block"><select name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" lay-verify="required" class="form-control">'+addstr+'</select></div></div></div>');
			}else if(inputsnametype=='multi'){
				$('#inputsname').append('<div class="layui-form layui-form-pane"><div class="layui-form-item"><label class="layui-form-label" id="inputname'+(i+2)+'" gettype="'+inputsnametype+'">'+value+'</label><div class="layui-input-block"><input type="number" name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" value="1" class="layui-input layui-form-danger" required min="1" max="99999" onchange="getmulti(this)" act="getmulti"/><div class="layui-form-mid layui-word-aux"></div></div></div></div>');
			}else if(inputsnametype=='domain'){
				$('#inputsname').append('<div class="layui-form layui-form-pane"><div class="layui-form-item"><label class="layui-form-label" id="inputname'+(i+2)+'" gettype="'+inputsnametype+'">'+value+'</label><div class="layui-input-block"><input type="text" name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" value="" onchange="getDomain(\'inputvalue'+(i+2)+'\')" class="layui-input layui-form-danger" required/><div class="layui-form-mid layui-word-aux"></div></div></div></div>');
			}else{
			if(value=='说说ID'||value=='说说ＩＤ'||inputsnametype=='ssid')
				var addstr='<div class="layui-btn layui-btn-danger onclick" onclick="get_shuoshuo(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取说说ＩＤ</div>';
			else if(value=='日志ID'||value=='日志ＩＤ'||inputsnametype=='rzid')
				var addstr='<div class="layui-btn layui-btn-warm onclick" onclick="get_rizhi(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取日志ＩＤ</div>';
			else if(value=='作品ID'||value=='作品ＩＤ'||inputsnametype=='zpid')
				var addstr='<div class="layui-btn layui-btn-warm onclick" onclick="getshareid2(\'inputvalue'+(i+2)+'\',$(\'#inputvalue\').val())">自动获取作品ＩＤ</div>';
			else if(value=='收货地址'||value=='收货人地址'||inputsnametype=='address')
				var addstr='<div class="layui-btn layui-btn-warm onclick" onclick="getCity(\'inputvalue'+(i+2)+'\')">点此选择收货地址</div>';
			else
				var addstr='';
			$('#inputsname').append('<div class="layui-form layui-form-pane"><div class="layui-form-item"><label class="layui-form-label" id="inputname'+(i+2)+'" gettype="'+inputsnametype+'">'+value+'</label><div class="layui-input-block"><input type="text" name="inputvalue'+(i+2)+'" id="inputvalue'+(i+2)+'" value="" class="layui-input layui-form-danger" required/><div class="layui-form-mid layui-word-aux">'+addstr+'</div></div></div></div>');
			}
		});
	}
	if($("#inputname2").html() == '说说ID'||$("#inputname2").html() == '说说ＩＤ'||$("#inputname2").attr('gettype')=='ssid'){
		$('#inputvalue2').attr("disabled", true);
		$('#inputvalue2').attr("placeholder", "填写QQ账号后点击→");
	}else if($("#inputname").html() == '作品ID'||$("#inputname").html() == '作品ＩＤ'||$("#inputname").html() == '帖子ID'||$("#inputname").html() == '用户ID'||$("#inputname").html() == '用户ＩＤ'||inputnametype=='shareid'){
		$('#inputvalue').attr("placeholder", "在此输入分享链接 可自动获取");
		$('#inputname').attr("gettype", "shareid");
		if($("#inputname2").html() == '作品ID'||$("#inputname2").html() == '作品ＩＤ'||$("#inputname2").attr('gettype')=='zpid'){
			$('#inputvalue2').attr("placeholder", "填写作品链接后点击→");
			$("#inputvalue2").attr('disabled', true);
		}
	}else if($("#inputname").html() == '作品链接'||$("#inputname").html() == '视频链接'||$("#inputname").html() == '分享链接'||inputnametype=='shareurl'){
		$('#inputvalue').attr("placeholder", "在此输入复制后的链接 可自动转换");
		$('#inputname').attr("gettype", "shareurl");
	}else if(inputnametype=='pinduoduo'){
		$('#inputvalue').attr("placeholder", "在此粘贴你的拼多多助力口令");
		$('#inputname').attr("gettype", "pinduoduo");
	}else if(inputnametype=='domain'){
		$('#inputvalue').removeAttr("placeholder");
		$('#inputname').attr("gettype", "domain");
	}else{
		$('#inputvalue').removeAttr("placeholder");
		$('#inputvalue2').removeAttr("placeholder");
	}
	var stock = $('#tid option:selected').attr('stock');
	if($('#tid option:selected').attr('isfaka')==1){
		$("#iffaka").html('自动发货');
		$('#inputvalue').attr("placeholder", "用于接收卡密以及查询订单使用");
		$('#display_left').show();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getleftcount",
			data : {tid:$('#tid option:selected').val()},
			dataType : 'json',
			success : function(data) {
				$('#leftcount').val(data.count)
			}
		});
		if($.cookie('email'))$('#inputvalue').val($.cookie('email'));
	}else if(stock!=null && stock!='' && stock!='null'){
		$('#display_left').show();
		$('#leftcount').val(stock);
	}else{
		$('#display_left').hide();
	}
}
function getshop(tid,cid,name,price,input,inputs,multi,isfaka,value,desc,alert,shopimg,close,prices,max,min,stock){
	$('#display_selectclass').hide();
	$('#shoplist').hide(); 
	$('#shopinfo').show();
	$("#selected").html('填写商品信息 <select name="tid" id="tid"><option value="'+tid+'" cid="'+cid+'" price="'+price+'" inputname="'+input+'" inputsname="'+inputs+'" multi="'+multi+'" isfaka="'+isfaka+'" count="'+value+'" alert="'+alert+'" shopimg="'+shopimg+'" close="'+close+'" prices="'+prices+'" max="'+max+'" min="'+min+'" stock="'+stock+'">'+name+'</option></select><a class="btn btn-success btn-xs pull-right" href="./?cid='+cid+'">返回重选</a>');
	$("#infoshop").html('<div class="form-group text-center"><img src="'+shopimg+'" width="120" height="120" style="border-radius: 8px" id="shoptypes" onerror="this.src=\'assets/img/Product/noimg.png\'"><hr class="layui-bg-blue"><b>当前商品：'+generate(name)+(desc!=''?'<hr class="layui-bg-orange">'+unescape(desc):'')+'</b>');
	$("#imgshop").html('<img src="'+shopimg+'" onerror="this.src=\'assets/img/Product/noimg.png\'">');
	if(isfaka==1){
			layer.tips('自动发卡', '#shoptypes', {
			tips: [1, '#FFB800'],
			time: 4000
		});
	}else{
				layer.tips('代充商品', '#shoptypes', {
			tips: [1, '#FFB800'],
			time: 4000
		});
	}
	$('#tid').hide();
	if(alert!='' && alert!='null'){
		var ii=layer.alert(''+unescape(alert)+'',{
			btn:['我知道了'],
			title:'商品提示'
		},function(){
			layer.close(ii);
		});
	}
	getPoint();
}
function showAlert(){
	var alert = $('#tid option:selected').attr('alert');
	if(alert!=null && alert!='null'){
		var ii=layer.alert('<center>'+unescape(alert)+'</center>',{
			btn:['我知道了'],
			title:'商品提示',
			closeBtn:false
		},function(){
			layer.close(ii);
		});
	}
}
function get_shuoshuo(id,uin,km,page){
	km = km || 0;
	page = page || 1;
	if(uin==''){
		layer.alert('请先填写QQ号！');return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getshuoshuo&uin="+uin+"&page="+page+"&hashsalt="+hashsalt,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var addstr='';
				$.each(data.data, function(i, item){
					addstr+='<option value="'+item.tid+'">'+item.content+'</option>';
				});
				var nextpage = page+1;
				var lastpage = page>1?page-1:1;
				if($('#show_shuoshuo').length > 0){
					if(km==1){
						$('#show_shuoshuo').html('<div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div>');
					}else{
						$('#show_shuoshuo').html('<div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div>');
					}
				}else{
					if(km==1){
						$('#km_inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div></div>');
					}else{
						$('#inputsname').append('<div class="form-group" id="show_shuoshuo"><div class="input-group"><div class="input-group-addon onclick" title="上一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="shuoid" class="form-control" onchange="set_shuoshuo(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" title="下一页" onclick="get_shuoshuo(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div></div>');
					}
				}
				set_shuoshuo(id);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function set_shuoshuo(id){
	var shuoid = $('#shuoid').val();
	$('#'+id).val(shuoid);
}
function get_rizhi(id,uin,km,page){
	km = km || 0;
	page = page || 1;
	if(uin==''){
		layer.alert('请先填写QQ号！');return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getrizhi&uin="+uin+"&page="+page+"&hashsalt="+hashsalt,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var addstr='';
				$.each(data.data, function(i, item){
					addstr+='<option value="'+item.blogId+'">'+item.title+'</option>';
				});
				var nextpage = page+1;
				var lastpage = page>1?page-1:1;
				if($('#show_rizhi').length > 0){
					$('#show_rizhi').html('<div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div>');
				}else{
					if(km==1){
						$('#km_inputsname').append('<div class="form-group" id="show_rizhi"><div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#km_inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div></div>');
					}else{
						$('#inputsname').append('<div class="form-group" id="show_rizhi"><div class="input-group"><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+lastpage+')"><i class="layui-icon layui-icon-prev"></i></div><select id="blogid" class="form-control" onchange="set_rizhi(\''+id+'\');">'+addstr+'</select><div class="input-group-addon onclick" onclick="get_rizhi(\''+id+'\',$(\'#inputvalue\').val(),'+km+','+nextpage+')"><i class="layui-icon layui-icon-next"></i></div></div></div>');
					}
				}
				set_rizhi(id);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function set_rizhi(id){
	var blogid = $('#blogid').val();
	$('#'+id).val(blogid);
}
function fillOrder(id,skey){
	if(!confirm('是否确定补交订单？'))return;
	$.ajax({
		type : "POST",
		url : "ajax.php?act=fill",
		data : {orderid:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.alert(data.msg);
			$("#submit_query").click();
		}
	});
}
function getsongid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('.qq.com')<0){layer.alert('请输入正确的歌曲的分享链接！');return false;}
	try{
		var songid = songurl.split('s=')[1].split('&')[0];
		layer.msg('ID获取成功！下单即可');
	}catch(e){
		layer.alert('请输入正确的歌曲的分享链接！');return false;
	}
	$('#inputvalue').val(songid);
}
function getsharelink(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('http')<0){layer.alert('请输入正确的内容！');return false;}
	try{
		if(songurl.indexOf('http://')>=0){
			var songid = 'http://' + songurl.split('http://')[1].split(' ')[0].split('，')[0];
		}else if(songurl.indexOf('https://')>=0){
			var songid = 'https://' + songurl.split('https://')[1].split(' ')[0].split('，')[0];
		}
		if(songid != $("#inputvalue").val())layer.msg('链接转换成功！下单即可');
	}catch(e){
		layer.alert('请输入正确的内容！');return false;
	}
	$('#inputvalue').val(songid);
}
function getshareid(){
	var songurl=$("#inputvalue").val();
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('http')<0){layer.alert('请输入正确的内容！');return false;}
	try{
		if(songurl.indexOf('http://')>=0){
			var songurl = 'http://' + songurl.split('http://')[1].split(' ')[0].split('，')[0];
		}else if(songurl.indexOf('https://')>=0){
			var songurl = 'https://' + songurl.split('https://')[1].split(' ')[0].split('，')[0];
		}else{
			throw false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=getshareid",
			data : {url:songurl, hashsalt:hashsalt},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					$('#inputvalue').val(data.songid);
					if(typeof data.songid2 != "undefined" && $('#inputvalue2').length>0)$('#inputvalue2').val(data.songid2);
					layer.msg('ID获取成功！下单即可');
				}else{
					layer.alert(data.msg);return false;
				}
			}
		});
	}catch(e){
		layer.alert('请输入正确的内容！');return false;
	}
}
function getshareid2(id, songurl){
	if(songurl==''){layer.alert('请确保每项不能为空！');return false;}
	if(songurl.indexOf('http')<0){return false;}
	getshareid();
}
function getpddinput() {
    var result = "";
    var pddinput = $("#inputvalue").val();
    if (pddinput == '') {
        return false;
    }
    if (pddinput.indexOf("PinDuoDuo") != -1 && pddinput.indexOf("http") === -1) {
        pddinput = pddinput.replace("PinDuoDuo", "");
    }
    var pattresult = (/[a-zA-Z0-9=_\&\?\-\/]?[a-zA-Z0-9]{16}[a-zA-Z0-9=_\&\?\-\/]?/).exec(pddinput);
    var patt_str = (/τ[a-zA-Z0-9]{13}τ/).exec(pddinput);
    var pattresult1 = (/(^[a-zA-Z0-9][a-zA-Z0-9]+)点+/).exec(pddinput);
    var pattresult2 = (/(^[0-9]{15})/).exec(pddinput);
    var pattresult3 = (/([0-9]{15}$)/).exec(pddinput);
    var pattresult4 = (/[0-9]{6,20}/).exec(pddinput);
    var pattresult5 = (/(http|https):\/\/[\w\.\=\_\/\-\$\&\!\?\(\)#%+:;]+/).exec(pddinput);
    var pattresult6 = (/([0-9]{8})/).exec(pddinput);
    var pattresult7 = (/[a-zA-Z0-9=_\&\?\-\/]?[a-zA-Z0-9]{15}[a-zA-Z0-9=_\&\?\-\/]?/).exec(pddinput);
    var pattresult12 = (/^[a-zA-Z0-9]{16}/).exec(pddinput);
    
    var pattresult10 = (/[\ud83a-\ud83f][\u0000-\uFFFF]/).exec(pddinput);
    var no_emoji_input = pddinput.replace(/[\ud83a-\ud83f][\u0000-\uFFFF]/g, "");
    no_emoji_input = no_emoji_input.replace(/[\ufe00-\ufe0f]/g, "");
    no_emoji_input = no_emoji_input.replace(/[\u0000-\uffff][\u20aa-\u20ff]/g, "");
    
    var pattresult13 = (/[a-zA-Z0-9]{13}/).exec(no_emoji_input);
    var pattresult14 = (/[a-zA-Z0-9]{14}/).exec(no_emoji_input);
    var status = false;
    if (exec_succ(patt_str)) {
        result = patt_str[0];
    } else if (exec_succ(pattresult1) && pattresult1.length > 1) {
        result = pattresult1[1];
    } else if (exec_succ(pattresult2) && pattresult2.length > 1) {
        result = pattresult2[1];
    } else if (exec_succ(pattresult3) && pattresult3.length > 1) {
        result = pattresult3[1];
    } else if (exec_succ(pattresult) && pattresult[0].length == 16) {
        var a = pattresult[0].length;
        result = pattresult[0];
    } else if (exec_succ(pattresult5) && pattresult5.length > 1) {
        var a = pattresult5[0].length;
        result = pattresult5[0];
    } else if (pddinput.indexOf("⇥") != -1 && pddinput.indexOf("⇤") != -1) {
        result = pddinput.substring(pddinput.indexOf("⇥"), pddinput.indexOf("⇤") + 1);
        layer.msg('ID获取成功！提交下单即可');
    } else if (exec_succ(pattresult4) && (pattresult4[0].length == 9 || pattresult4[0].length == 13 || pattresult4[0].length == 15)) {
        result = pattresult4[0];
        status = true;
    } else if (pddinput.indexOf("口令") != -1 && exec_succ(pattresult6) && pattresult6.length > 1) {
        result = pattresult6[1];
    } else if (!exec_succ(pattresult10) && exec_succ(pattresult7) && pattresult7[0].length == 15) {
        var a = pattresult7[0].length;
        result = pattresult7[0];
    } else if (exec_succ(pattresult12)) {
        result = pattresult12[0];
    } else if (exec_succ(pattresult13) && !exec_succ(pattresult14)) {
        var password = "\ud83d\ude42" + pattresult13[0].slice(0, 6) + "\ud83d\ude42" + pattresult13[0].slice(6) + "\ud83d\ude42";
        result = password;
        $('#inputvalue').prop('readonly', true);
    } else {
        result = pddinput;
    }
    $('#inputvalue').val(result);
    return status;
}
function exec_succ(pattresult) {
    if (typeof(pattresult) == 'object' && pattresult != null && pattresult.length > 0) {
        return true;
    } else {
        return false;
    }
}
function getmulti(obj){
	var num = parseInt($(obj).val());
	if(num<1){ num=1; $(obj).val('1'); }

	var mult = 1;
	$("input[act='getmulti']").each(function () {
		mult = mult * parseInt($(this).val());
	});

	var i = parseInt($("#num").val());
	if(isNaN(i))return false;
	var price = parseFloat($('#tid option:selected').attr('price'));
	var count = parseInt($('#tid option:selected').attr('count'));
	var prices = $('#tid option:selected').attr('prices');
	if(i<1) $("#num").val(1);
	if(prices!='' || prices!='null'){
		var discount = 0;
		$.each(prices.split(','), function(index, item){
			if(i>=parseInt(item.split('|')[0]))discount = parseFloat(item.split('|')[1]);
		});
		price = price - discount;
	}
	price = price * i * mult;
	count = count * i;
	if(count>1)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
}
function getDomain(dom){
	var inputvalue=$('#'+dom).val();
	if(inputvalue=='')return false;
	inputvalue = inputvalue.toLowerCase();
	if (inputvalue.indexOf(" ")>=0){
		inputvalue = inputvalue.replace(/ /g,"");
	}
	if (inputvalue.indexOf("http://")==0){
		inputvalue = inputvalue.slice(7);
	}
	if (inputvalue.indexOf("https://")==0){
		inputvalue = inputvalue.slice(8);
	}
	if (inputvalue.slice(inputvalue.length-1)=="/"){
		inputvalue = inputvalue.slice(0,inputvalue.length-1);
	}
	$('#'+dom).val(inputvalue);
}
function checkDomain(domain){
	if(domain == '' || domain.indexOf(".")<=0 || domain.indexOf("*")>=0 || domain.indexOf("/")>=0 || domain.indexOf("?")>=0 || domain.length<4){
		return false;
	}
	return true;
}
function queryOrder(type,content,page){
	$('#submit_query').val('Loading');
	$('#result2').hide();
	$('#list').html('');
	$.ajax({
		type : "POST",
		url : "ajax.php?act=query",
		data : {type:type, qq:content, page:page},
		dataType : 'json',
		success : function(data) {
			if(data.code == 0){
				var status;
				$.each(data.data, function(i, item){
					if(item.status==1)
						status='<span class="label label-success">已完成</span>';
					else if(item.status==2)
						status='<span class="label label-warning">处理中</span>';
					else if(item.status==3)
						status='<span class="label label-danger">异常</span>&nbsp;<button type="submit" class="btn btn-info btn-xs" onclick="fillOrder('+item.id+',\''+item.skey+'\')">补交</button>';
					else if(item.status==4)
						status='<font color=red>已退款</font>';
					else
						status='<span class="label label-primary">待处理</span>';
					$('#list').append('<tr orderid='+item.id+'><td>'+item.input+'</td><td>'+item.name+'</td><td>'+item.value+'</td><td class="hidden-xs">'+item.addtime+'</td><td>'+status+'</td><td><a onclick="showOrder('+item.id+',\''+item.skey+'\')" title="查看订单详细" class="btn btn-info btn-xs">详细</a></td></tr>');
					if(item.result!=null){
						if(item.status==3){
							$('#list').append('<tr><td colspan=6><font color="red">异常原因：'+item.result+'</font></td></tr>');
						}
					}
				});
				var addstr = '';
				if(data.islast==true) addstr += '<button class="btn btn-primary btn-xs pull-left" onclick="queryOrder(\''+data.type+'\',\''+data.content+'\','+(data.page-1)+')">上一页</button>';
				if(data.isnext==true) addstr += '<button class="btn btn-primary btn-xs pull-right" onclick="queryOrder(\''+data.type+'\',\''+data.content+'\','+(data.page+1)+')">下一页</button>';
				$('#list').append('<tr><td colspan=6>'+addstr+'</td></tr>');
				if($(window).width() > 768){
					if($('#list2').length>0){
						$('#list2').html($('#list').html());
					}else{
					layer.open({
					  type: 1,
					  shadeClose: true,
					  shade: false,
					  zIndex: 90,
					  area: [";max-width:90%;min-width:800px",";max-height:100%"],
					  title: '查询订单',
					  skin: 'layui-layer-rim',
					  content: '<div class="table-responsive"><table class="table table-vcenter table-condensed table-striped"><thead><tr><th>下单账号</th><th>商品名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead><tbody id="list2">'+$('#list').html()+'</tbody></table></div>'
					});
					}
				}else{
					$("#result2").slideDown();
				}
				if($_GET['buyok']){
					showOrder(data.data[0].id,data.data[0].skey)
				}
			}else{
				layer.alert(data.msg);
			}
			$('#submit_query').val('立即查询');
		} 
	});
}
function showOrder(id,skey){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	var status = ['<span class="label label-primary">待处理</span>','<span class="label label-success">已完成</span>','<span class="label label-warning">处理中</span>','<span class="label label-danger">异常</span>','<font color=red>已退款</font>'];
	$.ajax({
		type : "POST",
		url : "ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table table-condensed table-hover" id="orderItem">';
				item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>订单基本信息</b></td></tr><tr><td class="info orderTitle">订单编号</td><td colspan="5" class="orderContent">'+id+'</td></tr><tr><td class="info orderTitle">商品名称</td><td colspan="5" class="orderContent">'+data.name+'</td></tr><tr><td class="info orderTitle">订单金额</td><td colspan="5" class="orderContent">'+data.money+'元</td></tr><tr><td class="info orderTitle">购买时间</td><td colspan="5">'+data.date+'</td></tr><tr><td class="info orderTitle">下单信息</td><td colspan="5" class="orderContent">'+data.inputs+'</td><tr><td class="info orderTitle">订单状态</td><td colspan="5" class="orderContent">'+status[data.status]+'</td></tr>';
				if(data.complain){
					item += '<tr><td class="info orderTitle">订单操作</td><td class="orderContent"><a href="./user/workorder.php?my=add&orderid='+id+'&skey='+skey+'" target="_blank" onclick="return checklogin('+data.islogin+')" class="btn btn-xs btn-default">投诉订单</a>';
					if(data.selfrefund == 1 && data.islogin == 1 && (data.status == 0 || data.status == 3)){
						item += '&nbsp;<a onclick="return apply_refund('+id+',\''+skey+'\')" class="btn btn-xs btn-danger">申请退款</a>';
					}
					item += '</td></tr>';
				}
				if(data.list && typeof data.list === "object"){
					if(typeof data.list.order_state !== "undefined" && data.list.order_state && typeof data.list.now_num !== "undefined"){
						item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>订单实时状态</b></td><tr><td class="warning">下单数量</td><td>'+data.list.num+'</td><td class="warning">下单时间</td><td colspan="3">'+data.list.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+data.list.start_num+'</td><td class="warning">当前数量</td><td>'+data.list.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+data.list.order_state+'</font></td></tr>';
						if(typeof data.list.result !== "undefined" && data.list.result){
							item += '<tr><td class="warning orderTitle">异常信息</td><td class="orderContent">'+data.list.result+'</td></tr>';
						}
					}else{
						item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>订单实时状态</b></td>';
						$.each(data.list, function(i, v){
							item += '<tr><td class="warning orderTitle">'+i+'</td><td class="orderContent">'+v+'</td></tr>';
						});
					}
				}else if(data.kminfo){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>以下是你的卡密信息</b></td><tr><td colspan="6" class="orderContent">'+data.kminfo+'</td></tr>';
				}else if(data.result){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>处理结果</b></td><tr><td colspan="6" class="orderContent">'+data.result+'</td></tr>';
				}
				if(data.desc){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>商品简介</b></td><tr><td colspan="6" class="orderContent">'+data.desc+'</td></tr>';
				}
				item += '</table>';
				var area = [$(window).width() > 480 ? '480px' : '100%', ';max-height:100%'];
				layer.open({
				  type: 1,
				  area: area,
				  title: '订单详细信息',
				  skin: 'layui-layer-rim',
				  zIndex: 2001,
				  content: item
				});
			}else{
				layer.alert(data.msg);
			}
		}
	});
}
function apply_refund(id,skey){
	var confirmobj = layer.confirm('待处理或异常状态订单可以申请退款，退款之后资金会退到用户余额，是否确认退款？', {
	  btn: ['确认退款','取消']
	}, function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=apply_refund",
			data : {id:id,skey:skey},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					layer.alert('成功退款'+data.money+'元到余额！', {icon:1}, function(){ window.location.reload(); });
				}else{
					layer.alert(data.msg, {icon:2});
				}
			}
		});
	}, function(){
		layer.close(confirmobj);
	});
}
var handlerEmbed = function (captchaObj) {
	captchaObj.appendTo('#captcha');
	captchaObj.onReady(function () {
		$("#captcha_wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:$("#tid").val(),inputvalue:$("#inputvalue").val(),inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code >= 0){
					$('#alert_frame').hide();
					alert('领取成功！');
					window.location.href='?buyok=1';
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	});
};
var handlerEmbed2 = function (token) {
	if (!token) {
		return alert('请完成验证');
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=pay",
		data : {tid:$("#tid").val(),inputvalue:$("#inputvalue").val(),inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt,token:token},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code >= 0){
				$('#alert_frame').hide();
				alert('领取成功！');
				window.location.href='?buyok=1';
			}else{
				layer.alert(data.msg);
			}
		} 
	});
};
var handlerEmbed3 = function (vaptchaObj) {
	vaptchaObj.render();
	$('#captcha_text').hide();
	vaptchaObj.listen('pass', function() {
		var token = vaptchaObj.getToken();
		if (!token) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:$("#tid").val(),inputvalue:$("#inputvalue").val(),inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt,token:token},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code >= 0){
					$('#alert_frame').hide();
					alert('领取成功！');
					window.location.href='?buyok=1';
				}else{
					layer.alert(data.msg);
					vaptchaObj.reset();
				}
			}
		});
	});
};
function dopay(type,orderid){
	if(type == 'rmb'){
		var ii = layer.msg('正在提交订单请稍候...', {icon: 16,shade: 0.5,time: 15000});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=payrmb",
			data : {orderid: orderid},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
					alert(data.msg);
					window.location.href='?buyok=1';
				}else if(data.code == -2){
					alert(data.msg);
					window.location.href='?buyok=1';
				}else if(data.code == -3){
					var confirmobj = layer.confirm('你的余额不足，请充值！', {
					  btn: ['立即充值','取消']
					}, function(){
						window.location.href='./user/recharge.php';
					}, function(){
						layer.close(confirmobj);
					});
				}else if(data.code == -4){
					var confirmobj = layer.confirm('你还未登录，是否现在登录？', {
					  btn: ['登录','注册','取消']
					}, function(){
						window.location.href='./user/login.php';
					}, function(){
						window.location.href='./user/reg.php';
					}, function(){
						layer.close(confirmobj);
					});
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	}else{
		window.location.href='other/submit.php?type='+type+'&orderid='+orderid;
	}
}
function cancel(orderid){
	layer.closeAll();
	$.ajax({
		type : "POST",
		url : "ajax.php?act=cancel",
		data : {orderid: orderid, hashsalt: hashsalt},
		dataType : 'json',
		async : true,
		success : function(data) {
			if(data.code == 0){
			}else{
				layer.msg(data.msg);
				window.location.reload();
			}
		},
		error:function(data){
			window.location.reload();
		}
	});
}
function checkInput() {
	if($('#inputname').attr("gettype")=='shareid'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			getshareid();
		}
	}
	else if($('#inputname').attr("gettype")=='shareurl'){
		if($("#inputvalue").val()!='' && $("#inputvalue").val().indexOf('http')>=0){
			getsharelink();
		}
	}
	else if($('#inputname').attr("gettype")=='pinduoduo'){
		if($("#inputvalue").val()!=''){
			getpddinput();
		}
	}
	else if($('#inputname').attr("gettype")=='domain'){
		if($("#inputvalue").val()!=''){
			getDomain('inputvalue');
		}
	}
}
function getCity(inputid,fid,i){
	i = i || 0;
	fid = fid || 0;
	if(i == 0){
		var options='<select class="form-control" id="biaozhi_'+(i+1)+'" onchange="getCity(\''+inputid+'\',this.value,'+(i+1)+')">';
		options+='<option>请选择地址</option>';
		$.each("\u5317\u4eac|1|72|1,\u4e0a\u6d77|2|78|1,\u5929\u6d25|3|51035|1,\u91cd\u5e86|4|113|1,\u6cb3\u5317|5|142,\u5c71\u897f|6|303,\u6cb3\u5357|7|412,\u8fbd\u5b81|8|560,\u5409\u6797|9|639,\u9ed1\u9f99\u6c5f|10|698,\u5185\u8499\u53e4|11|799,\u6c5f\u82cf|12|904,\u5c71\u4e1c|13|1000,\u5b89\u5fbd|14|1116,\u6d59\u6c5f|15|1158,\u798f\u5efa|16|1303,\u6e56\u5317|17|1381,\u6e56\u5357|18|1482,\u5e7f\u4e1c|19|1601,\u5e7f\u897f|20|1715,\u6c5f\u897f|21|1827,\u56db\u5ddd|22|1930,\u6d77\u5357|23|2121,\u8d35\u5dde|24|2144,\u4e91\u5357|25|2235,\u897f\u85cf|26|2951,\u9655\u897f|27|2376,\u7518\u8083|28|2487,\u9752\u6d77|29|2580,\u5b81\u590f|30|2628,\u65b0\u7586|31|2652,\u6e2f\u6fb3|52993|52994,\u53f0\u6e7e|32|2768,\u9493\u9c7c\u5c9b|84|84".split(","), function(a, c) {
			c = c.split("|"),
			options+='<option value="'+c[1]+'">'+c[0]+'</option>'
		});
		options+='</select>';
		layer.alert('<div id="layer_button">'+options+'</div>',function(index){
			var con='';
			$("#layer_button select").each(function(){
				con+=$(this.options[this.selectedIndex]).text();
			});
			if($("#more_dizhi").length>0)con+=$("#more_dizhi").val();
			if(con.length<7)return layer.alert('请选择完整的收货地址！');
			$("#"+inputid).val(con).show();
			$("#button_"+inputid).hide();
			layer.close(index);
		});
	}else{
	$.ajax({
		type:"get",
		url:"https://fts.jd.com/area/get?fid="+fid,
		dataType:"jsonp",
		success:function(data){
			if(data.length<1){
				if($("#layer_button").html().indexOf("getCity('"+inputid+"',this.value,"+(i+1)+")")!=-1){
					$("#biaozhi_"+(i+1)).remove();
				}
				if($("#more_dizhi").length>0){}else $("#layer_button").append('<input class="form-control" id="more_dizhi" placeholder="详细地址(村、门牌号)">');
				return false;
			}
			var options='<select class="form-control" id="biaozhi_'+(i+1)+'" onchange="getCity(\''+inputid+'\',this.value,'+(i+1)+')">';
			options+='<option>请选择地址</option>';
			$.each(data,function(index,res){
				options+='<option value="'+res.id+'">'+res.name+'</option>';
			});
			options+='</select>';
			if($("#layer_button").html().indexOf("getCity('"+inputid+"',this.value,"+(i+1)+")")!=-1){
				$("#more_dizhi").remove();
				$("#biaozhi_"+(i+1)).html(options);
			}else{
				$("#layer_button").append(options);
			}
		}
	});
	}
}
function checklogin(islogin){
	if(islogin==1){
		return true;
	}else{
		var confirmobj = layer.confirm('为方便反馈处理结果，投诉订单前请先登录网站！', {
		  btn: ['登录','注册','取消']
		}, function(){
			window.location.href='./user/login.php';
		}, function(){
			window.location.href='./user/reg.php';
		}, function(){
			layer.close(confirmobj);
		});
		return false;
	}
}
var audio_init = {
	changeClass: function (target,id) {
       	var className = $(target).attr('class');
       	var ids = document.getElementById(id);
       	(className == 'on')
           	? $(target).removeClass('on').addClass('off')
           	: $(target).removeClass('off').addClass('on');
       	(className == 'on')
           	? ids.pause()
           	: ids.play();
   	},
	play:function(){
		document.getElementById('media').play();
	}
}
$(document).ready(function(){
$("#showSearchBar").click(function () {
	$("#display_selectclass").slideToggle();
	$("#display_searchBar").slideToggle();
});
$("#closeSearchBar").click(function () {
	$("#display_searchBar").slideToggle();
	$("#display_selectclass").slideToggle();
});
$("#doSearch").click(function () {
	var kw = $("#searchkw").val();
	if(kw==''){$("#closeSearchBar").click();return;}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$("#shoplist").empty();
	$("#shoplist").append('<option value="0">请选择商品</option>');
	$.ajax({
		type : "POST",
		url : "ajax.php?act=gettool",
		data : {kw:kw},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					$("#shoplist").append('<div class="col-xs-6 col-sm-3 col-md-3 layui-anim layui-anim-scaleSpring" data-anim="layui-anim-upbit"><a href="javascript:void(0)" id="'+res.tid+'" onclick="getshop('+res.tid+',\''+cid+'\',\''+res.name+'\',\''+res.price+'\',\''+res.input+'\',\''+res.inputs+'\',\''+res.multi+'\',\''+res.isfaka+'\',\''+res.value+'\',\''+escape(res.desc)+'\',\''+escape(res.alert)+'\',\''+res.shopimg+'\',\''+res.close+'\',\''+res.prices+'\',\''+res.max+'\',\''+res.min+'\',\''+res.stock+'\');" value="'+res.tid+'"><div class="thumbnail" style="height:240px;"><center style="margin-top:5%;"><img src="'+res.shopimg+'" width="80" height="100" style="border-radius: 15px" onerror="this.src=\'assets/img/Product/noimg.png\'"><hr class="layui-bg-blue" style="width:100%">'+res.name+'<hr class="layui-bg-red" style="width:100%">[￥'+res.price+']<br>'+(res.close==1?'<span class="layui-badge layui-bg-yellow">停止下单</span>':'<span class="layui-badge layui-bg-blue">立即购买</span>')+'</center></div></a></div>');
					num++;
				});
				$("#shoplist").val(0);
				/*getPoint();*/
				if(num==0 && cid!=0)layer.msg('没有搜索到该商品');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('加载失败，请刷新重试');
			return false;
		}
	});
});
$("#cid").change(function () {
	var cid = $(this).val();
	if(cid>0)history.replaceState({}, null, './?cid='+cid);
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$("#shoplist").empty();
	$("#shoplist").append('');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=gettool&cid="+cid,
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var num = 0;
				$.each(data.data, function (i, res) {
					if(res.price==0){
						price='免费';
					}else{
						price=res.price;
					}
					$("#shoplist").append('<div class="col-xs-6 col-sm-3 col-md-3 layui-anim layui-anim-scaleSpring" data-anim="layui-anim-upbit"><a href="javascript:void(0)" id="tools'+res.tid+'" onclick="getshop('+res.tid+',\''+cid+'\',\''+res.name+'\',\''+res.price+'\',\''+res.input+'\',\''+res.inputs+'\',\''+res.multi+'\',\''+res.isfaka+'\',\''+res.value+'\',\''+escape(res.desc)+'\',\''+escape(res.alert)+'\',\''+res.shopimg+'\',\''+res.close+'\',\''+res.prices+'\',\''+res.max+'\',\''+res.min+'\',\''+res.stock+'\');"><div class="thumbnail" style="height:240px;"><center style="margin-top:5%;"><img src="'+res.shopimg+'" width="80" height="100" style="border-radius: 15px" onerror="this.src=\'assets/img/Product/noimg.png\'"><hr class="layui-bg-blue" style="width:100%">'+generate(res.name)+'<hr class="layui-bg-red" style="width:100%">[￥'+price+']<br>'+(res.close==1?'<span class="layui-badge layui-bg-yellow">停止下单</span>':'<span class="layui-badge layui-bg-blue">立即购买</span>')+'</center></div></a></div>');
					num++;
				});
				if($_GET["tid"] && $_GET["cid"]==cid){
					var shoptid = parseInt($_GET["tid"]);
					$("#shoplist").val(shoptid);
					$("#tools"+shoptid).click();
				}else{
					$("#shoplist").val(0);
				}
				/*getPoint();*/
				if(num==0 && cid!=0)layer.msg('该分类下没有商品');
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('加载失败，请刷新重试');
			return false;
		}
	});
});
	$("#submit_buy").click(function(){
		var tid=$("#tid").val();
		if(tid==0){layer.alert('请选择商品！');return false;}
		var inputvalue=$("#inputvalue").val();
		if(inputvalue=='' || tid==''){layer.alert('请确保每项不能为空！');return false;}
		if($("#inputvalue2").val()=='' || $("#inputvalue3").val()=='' || $("#inputvalue4").val()=='' || $("#inputvalue5").val()==''){layer.alert('请确保每项不能为空！');return false;}
		if(($('#inputname').html()=='下单ＱＱ' || $('#inputname').html()=='ＱＱ账号' || $("#inputname").html() == 'QQ账号') && (inputvalue.length<5 || inputvalue.length>11 || isNaN(inputvalue))){layer.alert('请输入正确的QQ号！');return false;}
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
		if($('#inputname').html()=='你的邮箱' && !reg.test(inputvalue)){layer.alert('邮箱格式不正确！');return false;}
		reg=/^[1][0-9]{10}$/;
		if($('#inputname').html()=='手机号码' && !reg.test(inputvalue)){layer.alert('手机号码格式不正确！');return false;}
		if($("#inputname2").html() == '说说ID'||$("#inputname2").html() == '说说ＩＤ'){
			if($("#inputvalue2").val().length != 24){layer.alert('说说必须是原创说说！');return false;}
		}
		checkInput();
		if($("#inputname").html() == '抖音作品ID'||$("#inputname").html() == '火山作品ID'||$("#inputname").html() == '火山直播ID'){
			if($("#inputvalue").val().length != 19){layer.alert('您输入的作品ID有误！');return false;}
		}
		if($("#inputname2").html() == '抖音评论ID'){
			if($("#inputvalue2").val().length != 19){layer.alert('您输入的评论ID有误！请点击自动获取手动选择评论！');return false;}
		}
		if($('#inputname').attr("gettype")=='shareurl'){
			if($("#inputvalue").val().indexOf('http://')==-1 && $("#inputvalue").val().indexOf('https://')==-1){
				layer.alert('您输入的链接有误！请重新输入！');return false;
			}
		}
		if($('#inputname').attr("gettype")=='domain'){
			if(!checkDomain($("#inputvalue").val())){
				$("#inputvalue").focus();
				layer.alert('您输入的域名格式不正确！');return false;
			}
		}
		if($('#inputname2').attr("gettype")=='domain'){
			if(!checkDomain($("#inputvalue2").val())){
				layer.alert('您输入的域名格式不正确！');return false;
			}
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:tid,inputvalue:inputvalue,inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					if($('#inputname').html()=='你的邮箱'){
						$.cookie('email', inputvalue);
					}
					var paymsg = '';
					if(data.pay_alipay>0){
						paymsg+='<button class="layui-btn layui-btn-primary layui-btn-fluid" onclick="dopay(\'alipay\',\''+data.trade_no+'\')" style="margin-top:10px;"><img src="assets/img/alipay.png" class="paylogo">支付宝</button><br/>';
					}
					if(data.pay_qqpay>0){
						paymsg+='<button class="layui-btn layui-btn-primary layui-btn-fluid" onclick="dopay(\'qqpay\',\''+data.trade_no+'\')" style="margin-top:10px;"><img src="assets/img/qqpay.png" class="paylogo">QQ钱包</button><br/>';
					}
					if(data.pay_wxpay>0){
						paymsg+='<button class="layui-btn layui-btn-primary layui-btn-fluid" onclick="dopay(\'wxpay\',\''+data.trade_no+'\')" style="margin-top:10px;"><img src="assets/img/wxpay.png" class="paylogo">微信支付</button><br/>';
					}
					if (data.pay_rmb>0) {
						paymsg+='<button class="layui-btn layui-btn-primary layui-btn-fluid" style="margin-top:10px;" onclick="dopay(\'rmb\',\''+data.trade_no+'\')" style="margin-top:10px;"><img src="assets/img/rmb.png" class="paylogo">余额支付<span class="text-muted">（剩'+data.user_rmb+'元）</span></button>';
					}
					if(data.paymsg!=null)paymsg+=data.paymsg;
					layer.alert('<center><h2>￥ '+data.need+'</h2><hr>'+paymsg+'<hr><a class="layui-btn layui-btn-primary layui-btn-fluid" onclick="cancel(\''+data.trade_no+'\')">取消订单</a></center>',{
						btn:[],
						title:'提交订单成功',
						closeBtn: false
					});
				}else if(data.code == 1){
					$('#alert_frame').hide();
					if($('#inputname').html()=='你的邮箱'){
						$.cookie('email', inputvalue);
					}
					alert('领取成功！');
					window.location.href='?buyok=1';
				}else if(data.code == 2){
					if(data.type == 1){
						layer.open({
						  type: 1,
						  title: '完成验证',
						  skin: 'layui-layer-rim',
						  area: ['320px', '100px'],
						  content: '<div id="captcha"><div id="captcha_text">正在加载验证码</div><div id="captcha_wait"><div class="loading"><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div></div></div></div>',
						  success: function(){
							$.getScript("//static.geetest.com/static/tools/gt.js", function() {
								$.ajax({
									url: "ajax.php?act=captcha&t=" + (new Date()).getTime(),
									type: "get",
									dataType: "json",
									success: function (data) {
										$('#captcha_text').hide();
										$('#captcha_wait').show();
										initGeetest({
											gt: data.gt,
											challenge: data.challenge,
											new_captcha: data.new_captcha,
											product: "popup",
											width: "100%",
											offline: !data.success
										}, handlerEmbed);
									}
								});
							});
						  }
						});
					}else if(data.type == 2){
						layer.open({
						  type: 1,
						  title: '完成验证',
						  skin: 'layui-layer-rim',
						  area: ['320px', '260px'],
						  content: '<div id="captcha" style="margin: auto;"><div id="captcha_text">正在加载验证码</div></div>',
						  success: function(){
							$.getScript("//cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js", function() {
								var myCaptcha = _dx.Captcha(document.getElementById('captcha'), {
									appId: data.appid,
									type: 'basic',
									style: 'embed',
									success: handlerEmbed2
								})
								myCaptcha.on('ready', function () {
									$('#captcha_text').hide();
								})
							});
						  }
						});
					}else if(data.type == 3){
						layer.open({
						  type: 1,
						  title: '完成验证',
						  skin: 'layui-layer-rim',
						  area: ['320px', '231px'],
						  content: '<div id="captcha"><div id="captcha_text">正在加载验证码</div></div>',
						  success: function(){
							$.getScript("//v.vaptcha.com/v3.js", function() {
								vaptcha({
									vid: data.appid,
									type: 'embed',
									container: '#captcha',
									offline_server: 'https://management.vaptcha.com/api/v3/demo/offline'
								}).then(handlerEmbed3);
							});
						  }
						});
					}
				}else if(data.code == 3){
					layer.alert(data.msg, {
						closeBtn: false
					}, function(){
						window.location.reload();
					});
				}else if(data.code == 4){
					var confirmobj = layer.confirm('请登录后再购买，是否现在登录？', {
					  btn: ['登录','注册','取消']
					}, function(){
						window.location.href='./user/login.php';
					}, function(){
						window.location.href='./user/reg.php';
					}, function(){
						layer.close(confirmobj);
					});
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	});
	$("#submit_cart_shop").click(function(){
		var tid=$("#tid").val();
		if(tid==0){layer.alert('请选择商品！');return false;}
		var inputvalue=$("#inputvalue").val();
		if(inputvalue=='' || tid==''){layer.alert('请确保每项不能为空！');return false;}
		if($("#inputvalue2").val()=='' || $("#inputvalue3").val()=='' || $("#inputvalue4").val()=='' || $("#inputvalue5").val()==''){layer.alert('请确保每项不能为空！');return false;}
		if(($('#inputname').html()=='下单ＱＱ' || $('#inputname').html()=='ＱＱ账号' || $("#inputname").html() == 'QQ账号') && (inputvalue.length<5 || inputvalue.length>11 || isNaN(inputvalue))){layer.alert('请输入正确的QQ号！');return false;}
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
		if($('#inputname').html()=='你的邮箱' && !reg.test(inputvalue)){layer.alert('邮箱格式不正确！');return false;}
		reg=/^[1][0-9]{10}$/;
		if($('#inputname').html()=='手机号码' && !reg.test(inputvalue)){layer.alert('手机号码格式不正确！');return false;}
		if($("#inputname2").html() == '说说ID'||$("#inputname2").html() == '说说ＩＤ'){
			if($("#inputvalue2").val().length != 24){layer.alert('说说必须是原创说说！');return false;}
		}
		checkInput();
		if($("#inputname").html() == '抖音作品ID'||$("#inputname").html() == '火山作品ID'||$("#inputname").html() == '火山直播ID'){
			if($("#inputvalue").val().length != 19){layer.alert('您输入的作品ID有误！');return false;}
		}
		if($("#inputname2").html() == '抖音评论ID'){
			if($("#inputvalue2").val().length != 19){layer.alert('您输入的评论ID有误！请点击自动获取手动选择评论！');return false;}
		}
		if($('#inputname').attr("gettype")=='shareurl'){
			if($("#inputvalue").val().indexOf('http://')==-1 && $("#inputvalue").val().indexOf('https://')==-1){
				layer.alert('您输入的链接有误！请重新输入！');return false;
			}
		}
		if($('#inputname').attr("gettype")=='domain'){
			if(!checkDomain($("#inputvalue").val())){
				$("#inputvalue").focus();
				layer.alert('您输入的域名格式不正确！');return false;
			}
		}
		if($('#inputname2').attr("gettype")=='domain'){
			if(!checkDomain($("#inputvalue2").val())){
				layer.alert('您输入的域名格式不正确！');return false;
			}
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay&method=cart_add",
			data : {tid:tid,inputvalue:$("#inputvalue").val(),inputvalue2:$("#inputvalue2").val(),inputvalue3:$("#inputvalue3").val(),inputvalue4:$("#inputvalue4").val(),inputvalue5:$("#inputvalue5").val(),num:$("#num").val(),hashsalt:hashsalt},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					if($('#inputname').html()=='你的邮箱'){
						$.cookie('email', inputvalue);
					}
					$('#cart_count').html(data.cart_count);
					$('#alert_cart').slideDown();
					layer.msg('添加至购物车成功~点击下方进入购物车列表结算');
				}else if(data.code == 3){
					layer.alert(data.msg, {
						closeBtn: false
					}, function(){
						window.location.reload();
					});
				}else if(data.code == 4){
					var confirmobj = layer.confirm('请登录后再购买，是否现在登录？', {
					  btn: ['登录','注册','取消']
					}, function(){
						window.location.href='./user/login.php';
					}, function(){
						window.location.href='./user/reg.php';
					}, function(){
						layer.close(confirmobj);
					});
				}else{
					layer.alert(data.msg);
				}
			} 
		});
	});
	$("#submit_query").click(function(){
		var qq=$("#qq3").val();
		var type=$("#searchtype").val();
		queryOrder(type,qq,1);
	});
$("#buy_alipay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=alipay&orderid='+orderid;
});
$("#buy_qqpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=qqpay&orderid='+orderid;
});
$("#buy_wxpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=wxpay&orderid='+orderid;
});
$("#buy_tenpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=tenpay&orderid='+orderid;
});
$("#buy_shop").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='shop.php?act=submit&orderid='+orderid;
});

$("#num_add").click(function () {
	var i = parseInt($("#num").val());
	if ($("#need").val() == ''){
		layer.alert('请先选择商品');
		return false;
	}
	var multi = $('#tid option:selected').attr('multi');
	var count = parseInt($('#tid option:selected').attr('count'));
	if (multi == '0'){
		layer.alert('该商品不支持选择数量');
		return false;
	}
	i++;
	$("#num").val(i);
	var price = parseFloat($('#tid option:selected').attr('price'));
	var prices = $('#tid option:selected').attr('prices');
	if(prices!='' || prices!='null'){
		var discount = 0;
		$.each(prices.split(','), function(index, item){
			if(i>=parseInt(item.split('|')[0]))discount = parseFloat(item.split('|')[1]);
		});
		price = price - discount;
	}

	var mult = 1;
	$("input[act='getmulti']").each(function () {
		mult = mult * parseInt($(this).val());
	});

	price = price * i * mult;
	count = count * i;
	if(count>1)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
});
$("#num_min").click(function (){
	var i = parseInt($("#num").val());
	if(i<=1){
    	layer.msg('最低下单一份哦！'); 
      	return false;
    }
	if ($("#need").val() == ''){
		layer.alert('请先选择商品');
		return false;
	}
	var multi = $('#tid option:selected').attr('multi');
	var count = parseInt($('#tid option:selected').attr('count'));
	if (multi == '0'){
		layer.alert('该商品不支持选择数量');
		return false;
	}
	i--;
	if (i <= 0) i = 1;
	$("#num").val(i);
	var price = parseFloat($('#tid option:selected').attr('price'));
	var prices = $('#tid option:selected').attr('prices');
	if(prices!='' || prices!='null'){
		var discount = 0;
		$.each(prices.split(','), function(index, item){
			if(i>=parseInt(item.split('|')[0]))discount = parseFloat(item.split('|')[1]);
		});
		price = price - discount;
	}

	var mult = 1;
	$("input[act='getmulti']").each(function () {
		mult = mult * parseInt($(this).val());
	});

	price = price * i * mult;
	count = count * i;
	if(count>1)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
});
$("#num").keyup(function () {
	var i = parseInt($("#num").val());
	if(isNaN(i))return false;
	var price = parseFloat($('#tid option:selected').attr('price'));
	var count = parseInt($('#tid option:selected').attr('count'));
	var prices = $('#tid option:selected').attr('prices');
	if(i<1) $("#num").val(1);
	if(prices!='' || prices!='null'){
		var discount = 0;
		$.each(prices.split(','), function(index, item){
			if(i>=parseInt(item.split('|')[0]))discount = parseFloat(item.split('|')[1]);
		});
		price = price - discount;
	}

	var mult = 1;
	$("input[act='getmulti']").each(function () {
		mult = mult * parseInt($(this).val());
	});

	price = price * i * mult;
	count = count * i;
	if(count>1)$('#need').val('￥'+price.toFixed(2) +"元 ➠ "+count+"个");
	else $('#need').val('￥'+price.toFixed(2) +"元");
});

var gogo; 
$("#start").click(function(){
	ii=layer.load(1,{shade:0.3});
	$.ajax({
		type:"GET",
		url:"ajax.php?act=gift_start",
		dataType:"json",
		success:function(choujiang){
			layer.close(ii);
			if(choujiang.code == 0){
				$("#start").css("display",'none');
				$("#stop").css("display",'block');
				var obj = eval(choujiang.data);
                var len = obj.length;
                gogo = setInterval(function(){
                    var num = Math.floor(Math.random()*len);
                    var id = obj[num]['tid'];
                    var v = obj[num]['name'];
                    $("#roll").html(v);
                },100);
			}else{
				layer.alert(choujiang.msg);
			}
		}
	});
});
$("#stop").click(function(){
	ii=layer.load(1,{shade:0.3});
	clearInterval(gogo);
	$("#roll").html('正在抽奖中..');
	var rand = Math.random(1);
	$.ajax({
		type:"GET",
		url:"ajax.php?act=gift_start&action=ok&r=" + rand,
		dataType:"json",
		success:function(msg){
			layer.close(ii);
			if(msg.code==0){
				$.ajax({
					type:"POST",
					url:"ajax.php?act=gift_stop&r=" + rand,
					data:{hashsalt:hashsalt,token:msg.token},
					dataType:"json",
					success:function(data){
						if(data.code == 0){
							$("#roll").html('恭喜您抽到奖品：'+data.name);
							$("#start").css("display",'block');
							$("#stop").css("display",'none');
							layer.alert('恭喜您抽到奖品：'+data.name+'，请填写中奖信息', {
							  skin: 'layui-layer-lan'
							  ,closeBtn: 0
							}, function(){
								window.location.href='?gift=1&cid='+data.cid+'&tid='+data.tid;
							});
						}else{
							layer.alert(data.msg,{icon:2,shade:0.3});
							$("#roll").html('点击下方按钮开始抽奖');
							$("#start").css("display",'block');
							$("#stop").css("display",'none');
						}
					}
				});
			}else{
				layer.alert(msg.msg,{icon:2,shade:0.3});
				$("#start").css("display",'block');
				$("#stop").css("display",'none');
			}
		}
	});
});


if(homepage == true){
	getcount();
}
if($_GET['buyok']){
	var orderid = $_GET['orderid'];
	$("#tab-query").tab('show');
	$("#submit_query").click();
	isModal=false;
}else if($_GET['chadan']){
	$("#tab-query").tab('show');
	isModal=false;
}
if($_GET['gift']){
	isModal=false;
}
if($_GET['cid']){
	var cid = parseInt($_GET['cid']);
	$("#cid").val(cid);
	isModal=false;
}
$("#cid").change();

if($.cookie('sec_defend_time'))$.removeCookie('sec_defend_time', { path: '/' });
if( !$.cookie('op') && isModal==true){
	$('#myModal').modal({
		keyboard: true
	});
	var cookietime = new Date(); 
	cookietime.setTime(cookietime.getTime() + (60*60*1000));
	$.cookie('op', false, { expires: cookietime });
}
var visits = $.cookie("counter")
if(!visits)
{
 visits=1;
}
else
{
 visits=parseInt(visits)+1;
}
$('#counter').html(visits);
$.cookie("counter", visits, 24*60*60*30);

if($('#audio-play').is(':visible')){
	audio_init.play();
}
});
function MakeHex(x) {
	if((x >= 0) && (x <= 9)){
		return x;
	}else{
		switch(x) {
		case 10: return "A"; 
		case 11: return "B";  
		case 12: return "C";  
		case 13: return "D";  
		case 14: return "E";  
		case 15: return "F";  
		  }
	}
}
function MakeNum(str) {
	if((str >= 0) && (str <= 9)){
		return str;
	}
	switch(str.toUpperCase()) {
	case "A": return 10;
	case "B": return 11;
	case "C": return 12;
	case "D": return 13;
	case "E": return 14;
	case "F": return 15;
	}
}
function HexToNum(hex) {
	tens = MakeNum(hex.substring(0,1));
	ones = 0;
	ones=MakeNum(hex.substring(1,2));
	num = (tens * 16) + (ones * 1);
	return num;
}
function NumToHex(strNum) {
	var base,rem,baseS,remS;
	base = strNum / 16;
	rem = strNum % 16;
	base = base - (rem / 16);
	baseS = MakeHex(base);
	remS = MakeHex(rem);
	hex = baseS + '' + remS;
	return hex;
}
function generate(name){
	scolor=('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);
	ecolor=('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);
	r1=HexToNum(scolor.substring(0,2));
	g1=HexToNum(scolor.substring(2,4));
	b1=HexToNum(scolor.substring(4,6));
	r2=HexToNum(ecolor.substring(0,2));
	g2=HexToNum(ecolor.substring(2,4));
	b2=HexToNum(ecolor.substring(4,6));
	r_step=(r1-r2-((r1-r2)%name.length))/name.length;
	g_step=(g1-g2-((g1-g2)%name.length))/name.length;
	b_step=(b1-b2-((b1-b2)%name.length))/name.length;
	if(r_step==0){r_step=3;}
	if(g_step==0){g_step=3;}
	if(b_step==0){b_step=3;}
	var str2='';
	r_color=r1;
	g_color=g1;
	b_color=b1;
	for(var i=0;i<name.length;i++){
		cur_str=name.substring(i,i+1);
		r_color=r_color-r_step;
		g_color=g_color-g_step;
		b_color=b_color-b_step;
		if(r_color>=255||r_color<0){r_color=r1;}
		if(g_color>=255||g_color<0){g_color=g1;}
		if(b_color>=255||b_color<0){b_color=b1;}
		cur_color=NumToHex(r_color)+''+NumToHex(g_color)+''+NumToHex(b_color)
		if(cur_str=='\n'){
			str2+='<br>';
		}else{
			str2+='<font color=#' +cur_color+ '>' + cur_str + '</font>';
		}
	}
	return str2;
}