<?php
$title = '发布通知-线报推广';
include '../head.php';
$my = (isset($_GET['my']) ? $_GET['my'] : NULL);
?>

<?php
if($my=='add_submit'){
$title = $POST['title'];
$type = $_POST['type'];
$content = $_POST['content'];
			if ($title==NULL || $content==NULL) 
			{
				showmsg('保存错误,请确保每项都不为空!',3);
			}else{
				$rows=$DB->get_row('select * from shua_message where type=\''.$type.'\' and title=\''.$title.'\' limit 1');
				if ($rows) 
				{
					showmsg('通知标题已存在！',3);
				}
$sql='insert into `shua_message` (`type`,`title`,`content`,`addtime`,`active`) values (\''.$type.'\',\''.addslashes($title).'\',\''.addslashes($content).'\',\''.$date.'\',\'1\')';
        if ($DB->query($sql)) {
            showmsg('发布站内通知成功！<br/><br/><a href="./message.php">>>返回通知列表</a>', 1);
        } else {
            showmsg('发布站内通知成功！' . $DB->error(), 4);
        }
			}
}
?>

<?php
if ($my=='edit_submit') 
			{
				$id=$_GET['id'];
				$rows=$DB->get_row('select * from shua_message where id=\''.$id.'\' limit 1');
				if (!$rows) 
				{
					showmsg('当前记录不存在！',3);
				}
				$title=$_POST['title'];
				$type=$_POST['type'];
				$content=$_POST['content'];
				if ($title==NULL || $content==NULL) 
				{
					showmsg('保存错误,请确保每项都不为空!',3);
				}
					if ($DB->query('update shua_message set type=\''.$type.'\',title=\''.$title.'\',content=\''.$content.'\' where id=\''.$id.'\'')) 
					{
						showmsg('修改站内通知成功！<br/><br/><a href="./message.php">>>返回通知列表</a>',1);
					}
					else 
					{
						showmsg('修改站内通知失败！'.$DB->error(),4);
					}
			}
 if ($my=='edit') 
	{
		$id=$_GET['id'];
		$row=mysqli_fetch_assoc(mysqli_query($con, 'select * from shua_message where id=\''.$id.'\' limit 1'));
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">修改通知</h3></div>
<div class="">
 <form action="./message.php?my=edit_submit&id=<?php echo $row['id'];?>" method="post" class="form-horizontal" role="form">
   <div class="form-group">
	 <label class="col-sm-2 control-label">通知标题</label>
	 <div class="col-sm-10"><input type="text" name="title" value="<?php echo $row['title'];?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">接收用户类别</label>
	 <div class="col-sm-10"><select class="form-control" name="type" default="<?php echo $row['type'];?>"><option value="0">全部用户</option><option value="1">普通用户</option><option value="2">所有分站站长</option><option value="3">普及版站长</option><option value="4">专业版站长</option></select></div>
	</div><br/>
	<div class="form-group">
	 <label class="col-sm-2 control-label">通知内容</label>
	 <div class="col-sm-10"><textarea class="form-control" name="content" rows="5"><?php echo htmlspecialchars($row['content']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	 <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="发布" class="btn btn-primary form-control"/><br/>
	</div>
	</div>
 </form>
 <br/><a href="./message.php">>>返回通知列表</a>
</div>
</div>
<?php
	}
?>
<?php
				if ($my=='delete') 
				{
					$id=$_GET['id'];
					$sql='DELETE FROM shua_message WHERE id=\''.$id.'\'';
					if ($con->query($sql)) 
					{
						showmsg('删除成功！<br/><br/><a href="./message.php">>>返回通知列表</a>',1);
					}
					else 
					{
						showmsg('删除失败！'.$DB->error(),4);
					}
				}
$numrows=mysqli_num_rows(mysqli_query($con, 'SELECT * from shua_message'));
?>

<div class="row">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="block">
<div class="block-title clearfix">
<h2>你有 <b><?php echo $numrows?></b> 个站内通知</h2>
</div>
<a href="./message.php?my=add" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;发布新通知</a>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>通知标题</th><th>发布时间</th><th>已查阅人数</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
		  <?php
		  $rs=mysqli_query($con, 'SELECT * FROM shua_message WHERE 1 order by id desc');
					while ($res = mysqli_fetch_assoc($rs)) 
					{
						echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['title'].'</td><td>'.$res['addtime'].'</td><td>'.$res['count'].'</td><td>'.($res['active']==1 ? '<span class="btn btn-xs btn-success" onclick="setActive('.$res['id'].',0)">显示</span>' : '<span class="btn btn-xs btn-warning" onclick="setActive('.$res['id'].',1)">隐藏</span>').'</td><td><span class="btn btn-xs btn-success" onclick="show('.$res['id'].')">查看</span>&nbsp;<a href="./message.php?my=edit&id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./message.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此记录吗？\');">删除</a></td></tr>';
					}
					?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<script>
function setActive(id,active) {
	$.ajax({
		type : 'GET',
		url : 'http://ds.xh66.cn/ajax.php?act=setMessage&id='+id+'&active='+active,
		dataType : 'json',
		success : function(data) {
			window.location.reload()
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
function show(id) {
	$.ajax({
		type : 'GET',
		url : 'http://ds.xh66.cn/ajax.php?act=getMessage&id='+id,
		dataType : 'json',
		success : function(data) {
			if(data.code==0){
				layer.open({
				  type: 1,
				  skin: 'layui-layer-lan',
				  anim: 2,
				  shadeClose: true,
				  title: '查看站内通知',
				  content: '<div class="widget"><div class="widget-content widget-content-mini themed-background-muted text-center"><b>'+data.title+'</b><br/><small><font color="grey">管理员  '+data.date+'</font></small></div><div class="widget-content">'+data.content+'</div></div>'
				});
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
</script>