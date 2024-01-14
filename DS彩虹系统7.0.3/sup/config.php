<?php
error_reporting(0);
function request_by_curl($remote_server)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $remote_server);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 6);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; c8650 Build/GWK74) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1s');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

$admins = explode("/", $_SERVER['PHP_SELF']);
if(!isset($_SESSION['authcode'])) {
	$auth_file = dirname(__FILE__).'/authcode.php';
	if(!file_exists($auth_file))exit('<h3>本程序已损坏，请重新下载</h3>');
	include $auth_file;
	if(!$authcode||empty($authcode)){
		$authcode='123456789';
	}
	$query=file_get_contents('='.$_SERVER['HTTP_HOST'].'&authcode='.$authcode);
	if($query=json_decode($query,true)) {
		if($query['code']==1)$_SESSION['authcode']=$authcode;
		if(!empty($query['url'])&&$query['code']!=1)@header("Location:{$query['url']}");
		if($query['code']!=1)exit('<h3>'.$query['msg'].'</h3>');
	}
}
$login = $_GET['login'];
header("Content-type: text/html; charset=utf-8");
$sj = explode("/", $_SERVER['REQUEST_URI']);

if ($sj[2] == "user" || $sj[2] == "admin" || $sj[2] == "email") {
	include '../../config.php';
} else {
	include '../config.php';
}
$con = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname']);
$con->query("SET NAMES utf8");
if (mysqli_connect_errno()) {
	echo "连接失败: " . mysqli_connect_error();
}
$d = base64_decode($_COOKIE['key']);
$u = $_COOKIE['user'];
if (!empty($u)) {
	$userrow = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM supplier WHERE user='$u' limit 1"));
}
if ($login == 'yhdl') {
	$user = $_POST['user'];
	$pwd = $_POST['pwd'];
	$result = mysqli_query($con, "SELECT * FROM supplier WHERE user='$user' limit 1");
	$userrow = mysqli_fetch_array($result);
	if (password_verify($pwd, $userrow['pwd'])) {
		$hash = password_hash($pwd, PASSWORD_DEFAULT);
		mysqli_query($con, "UPDATE supplier SET pwd='$hash' WHERE user='$user'");
		setcookie('user', $user, time() + 3600 * 168);
		setcookie('key', base64_encode($hash), time() + 3600 * 168);
		exit("<script language='javascript'>window.location.href='/sup';</script>");
	} else {
		exit("<script language='javascript'>alert('用户名或密码不正确');window.location.href='/sup/login.php';</script>");
	}
}
if ($login == 2) {
	setcookie("user", "");
	setcookie("key", "");
	exit("<script language='javascript'>alert('你已退出登录！');window.location.href='/sup/login.php';</script>");
}