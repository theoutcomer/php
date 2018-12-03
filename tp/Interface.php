<?php 
//确认数据是否发过来
if($_POST['dosubmit']){
	//查检数据是否是正常状态发送过来
	$secureKey = $_POST['dosubmit']; //加密密钥
	$str = serialize('IN 2015.03.16');
	$str = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secureKey, $str, MCRYPT_MODE_ECB));
	if($_POST['code'] == $str){
		$arr['img_url'] = trim($_POST['img']);
		$arr['apk_url'] = trim($_POST['apk']);
		$arr['need'] = trim($_POST['need']);
		$arr['other'] = trim($_POST['other']);
		$arr['operator'] = trim($_POST['operator']);

		$link = @mysql_connect('127.0.0.1','root','z123456');
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("test", $link);
		$sql = " INSERT INTO `jiekou` (`img_url`,`apk_url`,`need`,`other`,`operator`) VALUES('{$arr['img_url']}','{$arr['apk_url']}','{$arr['need']}','{$arr['other']}','{$arr['operator']}') ";
		$result = mysql_query($sql);
		if($result){
			$key = 'yitui';
			$data = serialize($arr);
			$post_data = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB));
			$postData = array('code'=>'yseZ4suhyDMna5qLwumPK/tLkekW4C99k70TLvnaNnE=','data'=>$post_data);
			$res = actionPost('',$postData);
			
			//当需要使用时进行解密
			$get_data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($post_data), MCRYPT_MODE_ECB);
			$uinfo = unserialize($get_data);
			var_dump($uinfo);
		}
		mysql_close($link);
		echo "操作成功！！！";
	}else{
		die("这个操作不合法！！！");
	}
}else{
	die("这个操作不合法！！！");
}

function actionPost($url,$data){ // 模拟提交数据函数
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
		curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
		curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt'); // 读取上面所储存的Cookie信息
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
		$tmpInfo = curl_exec($curl); // 执行操作
		if (curl_errno($curl)) {
			echo ‘Errno’.curl_error($curl);
		}
		curl_close($curl); // 关键CURL会话
		return $tmpInfo; // 返回数据
	}
?>