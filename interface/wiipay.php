<?php
	/*
	 * http://合作方URL? "? 
	operatorType=&operatorTypeTile=&channelCode=&appCode=&payCode=&imsi=" +
	"&tel=&state=&price=&bookNo=&date=&devPrivate=&synType=wiipay&sig=

	  参数说明：
	operatorType:运营商类型
	operatorTypeTile：运营商名
	channelCode：渠道号
	appCode:应用编号
	payCode: 计费编号
	imsi：手机卡imsi
	tel：手机号
	state:success表示成功，其他一切表示失败
	bookNo:订单编号唯一
	date:订单时间
	price:交易额
	devPrivate:自定义参数（为base64密码,反base64密码后是个json字字符串）
	备注：json格式：{"key":"value",…}
	synType：支付类型
	sig：加密数据
	提交方式为：
	post方式提交。
	通知重发：
		开发者服务器收到通知后需返回纯字符串“success”，不能包含其他任何HTML等语言的文本。
	 *
	 * 
	 http://合作方URL?operatorType=CM&operatorTypeTile=移动&channelCode=200000&appCode=01490001&payCode=0001&imsi=460006322757508&tel=null&state=success&price=2&bookNo=A08200921056365012&date=20130820092117&devPrivate=eyJ1c2VySUQiOiIxMDk2MDQiLCJjaGVja0NvZGUiOiIxMzUzMTA5MTUzIn0=&synType=wiipay&sig=eD8P/CZ3DrmAR8XiE0tLT80Btl7bSNKoSzggkb0FQWm5+/Q5omoQ00kF+vEOgJoP9SW5Ki2DnAOA
fqHp9VijT/N8DeHeE1MdeuJnK1l0PHN+9fcdWtsNSPAjXDn9zjYLjNwEcOYyT5YWPWgI27gXg1XL
heZffB6p6p2aSsl6KsWFiXfNC6S7r5HvSWXhVmkTE3OGE2KHevkiQRB/CEIQe0WlHVkudRWvTNd1
MxYoRG7d1zTBLPeJJnEzhtuMk5WrhRWnasP2e2EdimDHb5N+uSmHwc/z0Ycwe55yGAZgrprLqBJM
hGwtt5qgxVilPLe3ho0hzK/urn/YmVBh68py6g==
*/
	$operatorType = $_POST['operatorType'];//CM [type string]
	$operatorTypeTile = $_POST['operatorTypeTile'];//移动 [type string]
	$channelCode = $_POST['channelCode'];//200000 [type int]
	$appCode = $_POST['appCode'];//01490001 [type int]
	$payCode = $_POST['payCode'];//0001 [type int]
	$imsi = $_POST['imsi'];//460006322757508 [type int]
	$tel = $_POST['tel'];//null [type int]
	$state = $_POST['state'];//success [type string]
	$price = $_POST['price'];//2 [type int]
	$bookNo = $_POST['bookNo'];//A08200921056365012 [type string]
	$date = $_POST['date'];//20130820092117  [type string]
	$devPrivate = $_POST['devPrivate'];//eyJ1c2VySUQiOiIxMDk2MDQiLCJjaGVja0NvZGUiOiIxMzUzMTA5MTUzIn0 [type string]
	$synType = $_POST['synType'];//wiipay [type string]
	$sig = $_POST['sig'];// [type string]


	

	$data = !empty($_REQUEST['content']) ? json_decode($_REQUEST['content'],true) : '';


?>