<?php
/* * 
 * 功能：彩虹易支付页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("./inc.php");

$out_trade_no = isset($_GET['out_trade_no'])?daddslashes($_GET['out_trade_no']):exit('error');
$srow=$DB->getRow("SELECT * FROM pre_pay WHERE trade_no='{$out_trade_no}' LIMIT 1");
$pay_config = get_pay_api($srow['channel']);

require_once(SYSTEM_ROOT."epay/epay.config.php");
require_once(SYSTEM_ROOT."epay/epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result && ($conf['alipay_api']==2 || $conf['qqpay_api']==2 || $conf['wxpay_api']==2 || $conf['qqpay_api']==8 || $conf['wxpay_api']==8 || $conf['wxpay_api']==9) && !empty($pay_config['pid']) && !empty($pay_config['key'])) {

	//支付宝交易号

	$trade_no = daddslashes($_GET['trade_no']);

	//交易状态
	$trade_status = $_GET['trade_status'];

	//金额
	$money = $_GET['money'];

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		if($srow['status']==0 && round($srow['money'],2)==round($money,2)){
			if($DB->exec("UPDATE `pre_pay` SET `status` ='1' WHERE `trade_no`='{$out_trade_no}'")){
				$DB->exec("UPDATE `pre_pay` SET `endtime` ='$date',`api_trade_no` ='$trade_no' WHERE `trade_no`='{$out_trade_no}'");
				processOrder($srow);
			}
			showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no,$srow['tid']);
		}else{
			showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no,$srow['tid']);
		}
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
}
else {
    //验证失败
	showalert('验证失败！',4,'shop');
}

?>