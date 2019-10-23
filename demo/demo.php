<?php

use EasyARSdk\EasyARClientSdkCRS;

$appKey = '这里是Cloud Key';
$appSecret = '这里是Cloud Secret';
$appHost = '这里是Cloud URLs 不含端口的部分!!例如 xxx.cn1.crs.easyar.com';
$timestamp = time(); //当你的时区配置为UTC+8时删除此行

$sdk = new EasyARClientSdkCRS($appKey, $appSecret, $appHost, $timestamp);

$rs = $sdk->ping();
print_r($rs);


/*
$rs = $sdk->targets(10, time() * 1000);
if ($rs->statusCode == 0) {
	print_r($rs->result->targets);
} else {
	echo $rs->result->message;
}
*/

/*
$rs = $sdk->info('17b99593-0c2c-4cff-a9a5-5df6145528941');
if ($rs->statusCode == 0) {
	print_r($rs->result);
} else {
	echo $rs->result->message;
}
*/

/*
$params = [
	'name' => 'image 1',
	'active' => '1',
	'size' => '1',
	'meta' => base64_encode('hello world'),
	'image' => base64_encode(file_get_contents('1.jpg')),
];

$rs = $sdk->targetAdd($params);
if ($rs->statusCode == 0) {
	print_r($rs->result);
} else {
	print_r($rs);
}
*/

/*
$params = [
	'name' => 'update image',
	'active' => '0',
	'size' => '1',
	'meta' => base64_encode('hello world'),
	'image' => base64_encode(file_get_contents('1.jpg')),
];
$rs = $sdk->targetUpdate('b189a689-569c-407c-a934-b4a4dedd6066', $params);
if ($rs->statusCode == 0) {
	print_r($rs->result);
} else {
	echo $rs->result->message;
}
*/

/*
$rs = $sdk->delete('b189a689-569c-407c-a934-b4a4dedd6066');
if ($rs->statusCode == 0) {
	print_r($rs->result);
} else {
	echo $rs->result->message;
}
*/

/*
$rs = $sdk->targetsCount();
if ($rs->statusCode == 0) {
	print_r($rs->result->count);
} else {
	echo $rs->result->message;
}
*/

/*
$image = base64_encode(file_get_contents('1.jpg'));
$rs = $sdk->similar($image);
if ($rs->statusCode == 0) {
	print_r($rs->result->results);
} else {
	echo $rs->result->message;
}
*/

/*
$image = base64_encode(file_get_contents('1.jpg'));
$rs = $sdk->detection($image);
if ($rs->statusCode == 0) {
	print_r($rs->result->grade);
} else {
	echo $rs->result->message;
}
*/

/*
$image = base64_encode(file_get_contents('1.jpg'));
$rs = $sdk->search($image);
if ($rs->statusCode == 0) {
	print_r($rs->result->grade);
} else {
	echo $rs->result->message;
}
*/
