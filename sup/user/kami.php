<?php
$title='卡密添加';
$act = $_GET['my'];
include '../head.php';
$tid=intval($_GET['tid']);
if($act == 'add_submit'){
$tid=intval($_POST['tid']);
$kms=$_POST['kms'];
$split = strval($_POST['split']);
if (empty($split))
$split = ' ';
if ($tid==null){exit("<script language='javascript'>alert('商品错误！');window.history.go(-1);</script>");}
if ($kms==null){exit("<script language='javascript'>alert('卡密为空！');window.history.go(-1);</script>");}
$arr = explode(PHP_EOL,$kms);
for($j=0;$j<count($arr);$j++){
	$createTime  = date('Y-m-d H:i:s', time());
	$sj=explode($split,$arr[$j]);
	$km=$sj[0];$pw=$sj[1];
	$sql = "INSERT INTO shua_faka (`tid`,`km`,`pw`,`addtime`) VALUES ('$tid','$km','$pw','$createTime')";
	mysqli_query($con,$sql);
	}  
	exit("<script language='javascript'>alert('成功添加{$j}条卡密！');window.location.href='kami.php';</script>");}
?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >添加卡密</div>
<div class="panel-body">
<style>
td{overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width:360px;}
</style>

<form action="?my=add_submit" method="POST" onsubmit="return checkAdd()">
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon">
			选择商品
		</span>
		<select id="tid" name="tid" class="form-control" default="<?php echo $tid?>"><option value="0">请选择商品</option>
<?php   
$sql = "SELECT * FROM `shua_tools` WHERE is_curl='4' and supplier='$u' order by tid desc";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($result)) {
    	//$count2=$con->count("SELECT count(*) from shua_orders WHERE tid='{$res['tid']}' AND status=1");
    	$sls = mysqli_query($con,"SELECT * from shua_orders WHERE tid='{$res['tid']}' AND status=1");
    	$slss = $sls->num_rows;
      echo'<option value="'.$res['tid'].'">'.$res['name'].'</option>';
                        }
}
?>
		</select>
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon">
			卡密列表
		</span>
		<textarea class="form-control" id="kms" name="kms" rows="8" placeholder="一行一张卡"></textarea>
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon">
			分隔符
		</span>
		<input type="text" name="split" value="" class="form-control" placeholder="可自定义卡号和密码之间的分隔符，默认留空为空格">
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><label><input id="is_check_repeat" name="is_check_repeat" type="checkbox" value="1">检查重复的卡密</label></span>
	</div>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-primary btn-block">确认提交</button>
	<button type="reset" class="btn btn-default btn-block">重新填写</button>
</div>
</form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
注意：卡密格式：卡号+空格+密码，一行一张卡，如：ABCDEFG 123456789<br>
只有商品设置里面购买成功后的动作选择自动发卡，该商品才会显示在当前列表
</div>
</div>
<a href="http://xh66.cn/admin/fakakms.php?tid=2934" class="btn btn-default btn-block">&gt;&gt;返回发卡库存列表</a>
    </div>
  </div>
</div>
<script>
    var checkflag1 = "false";

    function check1(field) {
        if (checkflag1 == "false") {
            for (i = 0; i < field.length; i++) {
                field[i].checked = true;
            }
            checkflag1 = "true";
            return "false";
        } else {
            for (i = 0; i < field.length; i++) {
                field[i].checked = false;
            }
            checkflag1 = "false";
            return "true";
        }
    }

    function unselectall1() {
        if (document.form1.chkAll1.checked) {
            document.form1.chkAll1.checked = document.form1.chkAll1.checked & 0;
            checkflag1 = "false";
        }
    }

    function showkms(obj) {
        $(obj).css("white-space", "normal");
        $(obj).css("word-break", "break-all");
    }

    function checkAdd() {
        if ($("#tid").val() == 0 || $("#tid").val() == null) {
            layer.alert('请先选择商品');
            return false;
        }
        if ($("#kms").val() == '') {
            layer.alert('卡密列表不能为空');
            return false;
        }
    }

    $(document).ready(function () {
        $("#cid").change(function () {
            var cid = $(this).val();
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $("#tid").empty();
            $("#tid").append('<option value="0">请选择商品</option>');
            $.ajax({
                type: "GET",
                url: "./ajax.php?act=getfakatool&cid=" + cid,
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        var num = 0;
                        $.each(data.data, function (i, res) {
                            $("#tid").append('<option value="' + res.tid + '">' + res.name + '</option>');
                            num++;
                        });
                        $("#tid").val(0);
                        if (num == 0 && cid != 0) $("#tid").html('<option value="0">该分类下没有发卡类商品</option>');
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        });
        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
    });
</script>