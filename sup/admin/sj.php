<?php
/**
 * 分类管理
**/
$title='商品管理';
include '../head.php';
if(intval($userrow['id'])!==1){exit("<script language='javascript'>alert('无权限{$userrow['id']}');window.location.href='/';</script>");}
?>
<div class="wrapper">
  <div class="col-sm-12 col-md-10 col-lg-6 center-block" style="float: none;">
<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">
      <span id="demo"></span><a href="./?mod=shop"><span class="btn btn-sm btn-warning">返回查询</span></a>
    </div>
           <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>id</th><th>商品id</th><th>金额</th><th>时间</th></tr></thead>
<tbody><form id="classlist">

<?php
$result = mysqli_query($con,"select * from shua_orders where addtime>='2019-07-04 0:00' and addtime<='2019-07-05 0:00'");
$i = 0;$b = 0;
while($res = mysqli_fetch_array($result)){
  $i = $i + 1;$b=$b+$res['money'];
    echo '<tr><td>'.$res['id'].'</td><td>'.$res['tid'].'</td><td>'.$res['money'].'</td><td>'.$res['addtime'].'</td></tr>';  } 
  echo '<script type="text/javascript">
           document.getElementById("demo").innerHTML = "数量'.$i.'个,总额'.$b.'";
         </script>';
?>

			</form>
          </tbody>
        </table>
        <a href="./?mod=shop">>>返回首页</a>
      </div>
    </div>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
  </div>
</div>