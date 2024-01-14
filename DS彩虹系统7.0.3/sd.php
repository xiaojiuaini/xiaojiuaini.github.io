<?php
include './includes/common.php';
function getRandChar($lenth = 16 , $tag = '' , $case = CASE_LOWER) {
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz"; 
	$str = '';
	for ($i = 0 ; $i <= $lenth ; $i++)
	{
		$str .= $strPol[mt_rand(0,strlen($strPol)-1)];
	}
	$newStr = $tag . $str;
	return ($case & CASE_UPPER) ? strtoupper($newStr) : strtolower($newStr);
}
function pay_type($i)
{
	if ($i == 1) {
		return 'wxpay';
	} else if ($i == 2) {
		return 'qqpay';
	} else if ($i == 3) {
		return 'tenpay';
	} else if ($i == 4) {
		return 'alipay';
	}
}
define('IS_POST' , strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' ? true : false);
if (IS_POST && isset($_POST['submit'])) {
	$api_key = isset($_POST['api_key']) ? trim($_POST['api_key']) : '';
	if ($api_key !== $conf['apikey'] || !$api_key || !$conf['apikey']) {
		exit(json_encode(['status' => false , 'message' => 'API密钥不正确']));
	}
	$ip = (isset($_POST['ip']) && !empty($_POST['ip'])) ? daddslashes($_POST['ip']) : '127.0.0.1';
	$tag = isset($_POST['tag']) ? strip_tags(daddslashes(trim($_POST['tag']))) : '';
	$number = (isset($_POST['number']) && is_numeric($_POST['number'])) ? intval($_POST['number']) : 15;
	$min_price = isset($_POST['min_price']) ? sprintf('%.2f' , $_POST['min_price']) : 0.01;
	$max_price = isset($_POST['max_price']) ? sprintf('%.2f' , $_POST['max_price']) : 0.10;
	$DB->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$ids = [];
	$success = 0;
	for($i = 1 ; $i <= $number ; $i++) {
		$tool = $DB->getRow('SELECT * FROM `pre_tools` WHERE (`active` = 1 AND (`price` >= :min_price AND `price` <= :max_price)) ORDER BY rand() DESC LIMIT 1' , [
			':min_price' => $min_price,
			':max_price' => $max_price,
		]);
		if ($tool) {
			$value = mt_rand(5 , 10);
			$data = [
				'zid'     => 1,
				'tid'     => $tool['tid'],
				'value'   => $value,
				'userid'  => $cookiesid,
				'tradeno' => date("YmdHis").rand(111,999),
				'money'   => $value * $tool['price'],
				'input'   => getRandChar(16 , $tag),
				'status'  => 1, //默认完成
				'djzt'    => $tool['shequ'] ? 1 : 0,
				'addtime' => date('Y-m-d H:i:s'),
				'endtime' => date('Y-m-d H:i:s' , strtotime('+1 hours')),
			];
			$_sql = 'INSERT INTO `pre_pay` (`trade_no`,`type`,`zid`,`tid`,`input`,`num`,`addtime`,`endtime`,`name`,`money`,`ip`,`userid`,`status`) VALUES ';
			$_sql .= '(:trade_no , :type , :zid , :tid , :input , :num , :addtime , :endtime , :name , :money , :ip , :userid , :status)';
			try {
				if ($DB->exec($_sql , [
					':trade_no' => $data['tradeno'],
					':type'     => pay_type(rand(1 , 4)),
					':zid'      => $data['zid'],
					':input'    => $data['tid'],
					':tid'     => $data['tid'],
					':num'     => $data['value'],
					':addtime' => $data['addtime'],
					':endtime' => $data['endtime'],
					':name'    => $tool['name'],
					':money'   => $data['money'],
					':ip'      => $ip,
					':userid'  => $data['userid'],
					':status'  => 1,
				])) {
					$keys = array_keys($data);
					$sql = 'INSERT INTO `pre_orders` (`' . implode('`,`', $keys) . '`) VALUES ';
					$sql .= '(:' . implode(',:', $keys) . ')';
					if ($DB->exec($sql , $data)) {
						$ids[] = $DB->lastInsertId();
						$success++;
					}
				}
			} catch (\PDOException $e) {
				continue;
			}
		}
	}
	exit(json_encode([
		'code' => 0 , 
		'message' => "已完成<br />后台->订单管理查看是否新增加订单数据<br />共计新增加 <font class=\"text-danger\">{$success}</font> 个订单<br />订单新增IDS : " . implode(',' , $ids),
		'success' => $success , 
		'ids' => $ids
	]));
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $conf['sitename']?> - 刷订单</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="//cdn.bootcss.com/layer/2.3/skin/layer.css" rel="stylesheet">
		<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//cdn.bootcss.com/layer/2.3/layer.js"></script>
		<script src="//cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
		<!--[if lt IE 9]>
			<script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
        <style type="text/css">
			[v-cloak]{
				display: none
			}
        </style>
	</head>
	<body>
		<main id="vue-app" v-cloak>
			<nav class="navbar navbar-fixed-top navbar-default">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">刷订单</a>
					</div>
				</div><!-- /.container -->
			</nav><!-- /.navbar -->
			<div class="container center-block" style="padding-top:70px;">
				<div class="row">
					<div class="col-md-7 col-sm-7 col-md-offset-2">
						<div class="panel panel-primary">
							<div class="panel-heading">订单生成控制台</div>
							<div class="panel-body center-block">
								<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" @submit.self.prevent="postSubmit">
									<input type="hidden" name="submit" value="1" />
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">API密钥</span>
											<input type="text" value="" class="form-control" name="api_key"  placeholder="请输入API密钥">
										</div>
										<div class="well well-sm text-success">查看API密钥地址：<?php echo $siteurl?>admin/set.php?mod=site</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">订单标识</span>
											<input type="text" value="tag_" class="form-control" name="tag" placeholder="请输入订单标识，混合留空即可">
										</div>
										<div class="well well-sm text-success">订单标识用于识别订单那些是刷取的，混合订单留空即可</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">下单ＩＰ</span>
											<input type="text" name="ip" value="<?php echo $clientip?>" @blur="MatchIp($event.target)" oninput="this.value = this.value.replace(/(^[\D\.])/g , '')"  class="form-control"  placeholder="请输入下单IP">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">订单数量</span>
											<input type="number" name="number" value="5" class="form-control" oninput="this.value = Math.abs(this.value)" onblur="this.value = this.value > 0 ? Number(thsi.value) : 1" placeholder="请输入生成订单数量">
											<span class="input-group-addon">个</span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">最小金额</span>
											<input type="text" value="0.01" class="form-control" name="min_price" oninput="this.value = this.value.replace(/(^[\D\.])/g , '')" onblur="this.value = toDeciml(Math.abs(this.value))" placeholder="请输入起始金额">
											<span class="input-group-addon">元</span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">最高金额</span>
											<input type="text" value="0.10" class="form-control" name="max_price" oninput="this.value = this.value.replace(/(^[\D\.])/g , '')" onblur="this.value = toDeciml(Math.abs(this.value))" placeholder="请输入最高金额">
											<span class="input-group-addon">元</span>
										</div>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block btn-loading" data-loading-text="Loading...">开始</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<footer class="footer navbar-fixed-bottom ">
			<div class="container">
				<p>&copy; Power By 树莓派 &nbsp;<i class="fa fa-qq"></i>：<a target="_blank" title="点击联系作者" href="http://wpa.qq.com/msgrd?v=3&uin=192149203&site=qq&menu=yes">192149203</a></p>
			</div>
		</footer>
		<script type="text/javascript">
			function toDeciml(x) {
				var f = parseFloat(x);
				if (isNaN(f)) {
					return 0.00;
				}
				var f = Math.round(x * 100) / 100;
				var s = f.toString();
				var rs = s.indexOf('.');
				if (rs < 0) {
					rs = s.length;
					s += '.';
				}
				while (s.length <= rs + 2) {
					s += '0';
				}
				return s;
			}
			new Vue({
				el : '#vue-app',
				methods : {
					postSubmit : (e) => {
						var obj = $(e.target),
							data = obj.serialize(),
							url = obj.attr('action'),
							_that = this;
						var layerLoadIndex = layer.load(3 , {
							shade: [0.1,'#fff'],
						});
						$.post(url , data , function(response) {
							layer.close(layerLoadIndex);
							if (typeof f === 'function') {
								return f(response);
							} else {
								if (typeof _that.recordList === 'function') {
									_that.recordList();
								}
								layer.alert(response.message , {
									icon : response.code === 0 ? 1 : 2,
								});
							}
						} , 'JSON');
					},
					MatchIp : function(t) {
						var regx = /(\d{1,3})\.(\d{1,3}).(\d{1,3}).(\d{1,3})/g;
						try {
							return t.value = t.value.match(regx)[0]
						} catch (e) {
							return t.value = '';
						}
					},
				},
				created : function() {
					layer.closeAll();
				}
			});
			var delay = 9 * 100 * 100;
			$(document).ready(function() {
				$('.btn-loading').click(function() {
					$(this).button('loading').delay(delay);
				});
				$('.btn-loading').button('reset')
				$('.btn-loading').dequeue();
				$(this).ajaxError(function() {
					layer.closeAll();
				}).ajaxStop(function() {
					$('.btn-loading').button('reset')
					$('.btn-loading').dequeue();
				});
			});
		</script>
	</body>
</html>