<?php 
/**
 * @file			interface.php
 * @Author			毛哥
 * @Create Date:	2014.06.06
 * @email 			theoutcomer@163.com
 */
function do_post_request($url, $data, $optional_headers = null)
  {
     $params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
     }
     $ctx = stream_context_create($params);
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp) {
        //throw new Exception("Problem with $url, $php_errormsg");
        $result = '000005';
     }
     $response = @stream_get_contents($fp);
     if ($response === false) {
       // throw new Exception("Problem reading data from $url, $php_errormsg");
     	$result = '000005';
     }
     return $response;
  }



if(isset($_GET['appid']) && isset($_GET['channel']) && isset($_GET['imei'])){
	//GET参数
	$appid = trim($_GET['appid']);//推广的广告ID  由桔子平台指定
	$channel = trim($_GET['channel']);//渠道App唯一标识  由桔子平台指定
	$imei = trim($_GET['imei']);//iOs为idfa 或mac（idfa优先）
	$pridata = isset($_GET['pridata']) ? trim($_GET['pridata']) : false;//渠道自定义参数 由渠道提供 （可选）渠道方自己定义，默认为空，确认激活后该参数会原样返回给渠道方
	$mac = isset($_GET['mac']) ? trim($_GET['mac']) : false;//idfa或 mac (idfa优先) 由渠道提供  （可选）idfa为源格式 mac地址需去除冒号转为小写
	$target = isset($_GET['target']) ? intval($_GET['target']) : -1;//是否由桔子平台主动跳转至下载地址 默认为:1,跳转至app的下载地址;如果需要自己控制下载时，target：0即可

	//固定参数
	$app_url = 'https://itunes.apple.com/cn/app/jiang-shenhd/id593417433?mt=8';//app 下载地址
	$url = 'http://demo.phptest.com/index.php';/**  这里POST数据的URL，会有数据返回的   */
	$con = mysql_connect("localhost","peter","abc123");
/*if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// some code

mysql_close($con);*/
	/*appid	广告ID
	imei	Android为设备串号，	iOs为idfa 或mac（idfa优先）
	mac	终端idfa或mac地址	idfa为源格式，mac去除冒号小写；（说明：渠道接入时需要传递，否则为空）
	pridata	渠道在接入广告时传递过来的私有参数pridata；（说明：渠道接入时需要传递，否则为空）
	tradeno	本次激活的唯一ID*/
	$array = array('appid'=>$appid,
				   'imei'=>$imei,
				   'mac'=>$mac,
				   'pridata'=>$pridata,
				   'tradeno'=>time()
		);
	$data = json_encode($array);
	$data = 'data='.base64_encode($data);
	$result = do_post_request($url, $data);
	var_dump($result);
	exit;
	
	////$data = base64_encode($data);
	//$sign = md5($sing);

	if($target==1){
		$app_url = 'https://itunes.apple.com/cn/app/jiang-shenhd/id593417433?mt=8';
		header("Location: $app_url");exit;
	}else if($target==0){
		$code = array('000000','000001','000002','000003','000004');
		$content = array('正常返馈信息','开发者状态异常','无广告内容','下载地址异常','数据发送异常');
	
		$result = array("Code"=>$code,"Content"=>$content);
		echo json_decode($result);	
	}
}else{
	return false;
}



?>