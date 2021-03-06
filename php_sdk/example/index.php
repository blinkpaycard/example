<?php
require_once "BlinkPayCard.Config.php"; 
require_once "BlinkPayCard.Api.php";
header("Content-Type: text/html;charset=utf-8");

$config = new BlinkPayCardConfig;
$api = new BlinkPayCardApi;

$app_id = $config -> getAppId();
$mch_id = $config -> getMerchantId();
$app_key = $config -> getAppKey();

$notify = "{\"nonce_str\":\"0F77ezcval5lEYb6FKPtCMqwMMqzHHLm\"," .
	"\"amount\":\"100\"," .
	"\"event_type\":\"order_payed\"," .
	"\"sign\":\"64963552561AD42D1D842271B7123D02\"," .
	"\"currency\":\"CNY\"," .
	"\"pre_order\":\"dae80fd0a98e4ba6bc4a77a3bac64d2c\"," .
	"\"sign_type\":\"md5\"," .
	"\"osu_number\":\"efaa8247f91748468e8ae541e563cb39\"}";

echo "=========== 充值下单 ===========" . "\n </br>";
$pre_order = $api -> preOrder($app_id, $mch_id, $app_key);

echo "=========== 网页充值 =========== " . "\n </br>";
$webPayUrl = $api -> webPay($mch_id, $pre_order);
echo "请用浏览器访问：" . $webPayUrl  . "\n </br>";

echo "=========== 订单查询 ===========" . "\n </br>";
$api -> orderQuery($app_id, $mch_id, $app_key, $pre_order);

echo "=========== 模拟接收通知消息 ===========" . "\n </br>";
$api -> receiveNotify($notify);

echo "=========== 提现结果查询 ===========" . "\n </br>";
$withdraw_number = "37fd349c3cdf40718345943f0643c94b";
$api -> withdrawQuery($withdraw_number);
