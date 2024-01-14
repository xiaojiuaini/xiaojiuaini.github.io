<?php
error_reporting(0);
$title = '发卡库存管理';
include_once '../head.php';


?>
<style>
.msg-head{text-align: center;min-width: 360px;padding: 7px;background-color: #f9f9f9 !important;}
.msg-body{padding: 15px;margin-bottom: 20px;}
</style>
<div class="wrapper">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >发卡管理</div>
<div class="panel-body">
    <form name="form1" method="post" action="fakalist.php?my=move">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商品名称</th>
                    <th>剩余卡密</th>
                    <th>已售出</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
<?php   
$sql = "SELECT * FROM `shua_tools` WHERE is_curl='4' and supplier='$u' order by tid desc";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($res = mysqli_fetch_assoc($result)) {
    	//$count2=$con->count("SELECT count(*) from shua_orders WHERE tid='{$res['tid']}' AND status=1");
    	$sls = mysqli_query($con,"SELECT * from shua_orders WHERE tid='{$res['tid']}' AND status=1");
    	$slss = $sls->num_rows;
    	$sykm = mysqli_query($con,"SELECT * from shua_faka WHERE tid='{$res['tid']}' AND orderid=0");
    	$sykms = $sykm->num_rows;
      echo"
                    <tr>
                        <td>{$res['tid']}</td>
                        <td>{$res['name']}</td>
                        <td>$sykms</td>
                        <td>$slss</td>
                        <td><a href='./kami.php?tid={$res['tid']}' class='btn btn-success btn-xs'>加卡</a></td>
                    </tr>";
                        }
}
?>
                </tbody>
            </table>

        </div>
    </form>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
注意：自动发卡业务需要联系站长或客服结算<br>
自动发卡后余额不会增加，结算周期请咨询平台！
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

        function setActive(tid, active) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setTools&tid=' + tid + '&active=' + active,
                dataType: 'json',
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function sort(cid, tid, sort) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setToolSort&cid=' + cid + '&tid=' + tid + '&sort=' + sort,
                dataType: 'json',
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
    </script>

