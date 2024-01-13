<?php
/**
 * 导出订单列表
**/
$title='导出订单列表';
include '../head.php';
$sql = "SELECT * FROM shua_tools WHERE supplier='$u'";
$result = mysqli_query($con,$sql);
$select='<option value="0">请选择商品</option>';
$shua_class[0]='默认分类';
while($res = mysqli_fetch_assoc($result)) {
	$shua_class[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'">'.$res['name'].'</option>';
}

$select2='<option value="0">请选择商品</option>';
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 col-lg-8 center-block" style="float: none;">
	  <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">导出订单列表</h3></div>
        <div class="panel-body">
          <form action="download.php" method="get" role="form">
		    <div class="form-group">
				<div class="input-group"><div class="input-group-addon">选择商品</div>
				<select name="tid" id="tid" class="form-control"><?php echo $select?></select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">要导出的订单状态</div>
				<select name="status" id="status" class="form-control">
					<option value="0">待处理</option>
					<option value="1">已完成</option>
					<option value="2">正在处理</option>
					<option value="3">异常</option>
				</select>
			</div></div>
			<div class="form-group">
				<div class="input-group"><div class="input-group-addon">导出同时改变状态</div>
				<select name="sign" id="sign" class="form-control">
					<option value="0">不改变状态</option>
					<option value="1">标记为已完成</option>
				</select>
			</div></div>
            <p><input type="submit" value="生成TXT" class="btn btn-primary form-control"/></p>
          </form>
        </div>
		<div class="panel-footer">
          <span class="glyphicon glyphicon-info-sign"></span> 生成txt的格式：输入内容1----输入内容2----输入内容3----输入内容4----输入内容5----下单数量<br/>
		  已标记为已完成的下次导出时就不会导出了。
        </div>
      </div>
    </div>
  </div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
