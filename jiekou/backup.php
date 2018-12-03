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
                  'method' => 'GET',
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

function access_url($url) {    
    if ($url=='') return false;    
    $fp = fopen($url, 'r') or exit('Open url faild!');    
    if($fp){  
    while(!feof($fp)) {    
        $file.=fgets($fp)."";  
    }  
    fclose($fp);    
    }  
    return $file;  
}

//POST
if(!empty($_POST['data']) && !empty($_POST['sign']) || !empty($_GET['data']) && !empty($_GET['sign'])){
		//if(trim($_POST['sign'])=='86a28181389a61e167e8cb5b0909c845'){
			//if(trim($_POST['sign'])=='86a28181389a61e167e8cb5b0909c845'){
			
			$con = mysql_connect("localhost","root","root123wan");
			if (!$con)
			{
			  	//die('Could not connect: ' . mysql_error());
			  	$code = '000005';
				$content = 'Failure';
			}else{
				mysql_select_db("dinj", $con);
				
				if(empty($_POST['data'])){
					$data = json_decode(base64_decode($_GET['data']));
					$sign = trim($_GET['sign']);
				}else{
					$data = json_decode(base64_decode($_POST['data']));
					$sign =  trim($_POST['sign']);
				}
				
				$data = get_object_vars($data);
				$appid = $data['appid'];
				$imei = $data['imei'];
				$pridata = $data['pridata'];
				$mac = $data['mac'];
				$tradeno = $data['tradeno'];

				$add_time = time();

				$only_sql =  "SELECT count(id) AS c FROM  `int_pc` WHERE `imei`='$imei'";
				$only_result = mysql_query($only_sql,$con);
				$only_res = mysql_fetch_assoc($only_result);
				
				if($only_res['c']=='0' || $only_res['c']==0){
					//广告接入
					$pc_query = "INSERT INTO `int_pc` (`appid`,`imei`,`pridata`,`mac`,`tradeno`,`sign`,`add_time`) VALUES ('$appid', '$imei', '$pridata','$mac', '$tradeno', '$sign','$add_time')";
					$pc_result = mysql_query($pc_query,$con);
					if($pc_result){
						//回调给渠道
						$qudao_url = "http://www.qinmayi.com/client/adcallback?eid=1000051_2000088&did=".$imei."&mac=".$mac;
						$qudao_res = access_url($qudao_url);
						$code = '000000';
						$content = 'Success';
					}else{
						$code = '000005';
						$content = 'Failure';
					}
				}else{
					$code = '000005';
					$content = 'Failure';
				}
				mysql_close($con);
			}
			
		//}else{
			//$code = '000005';
			//$content = 'Failure';
		//}
		$result = array("Code"=>$code,"Content"=>$content);
		echo json_encode($result);exit;
	}



//GET
	if(isset($_GET['appid']) && isset($_GET['channel']) && isset($_GET['imei'])){
		//GET参数
		$appid = trim($_GET['appid']);//推广的广告ID  由桔子平台指定
		$channel = trim($_GET['channel']);//渠道App唯一标识  由桔子平台指定
		$imei = trim($_GET['imei']);//iOs为idfa 或mac（idfa优先）
		$pridata = isset($_GET['pridata']) ? trim($_GET['pridata']) : false;//渠道自定义参数 由渠道提供 （可选）渠道方自己定义，默认为空，确认激活后该参数会原样返回给渠道方
		$mac = isset($_GET['mac']) ? trim($_GET['mac']) : false;//idfa或 mac (idfa优先) 由渠道提供  （可选）idfa为源格式 mac地址需去除冒号转为小写
		$mac = str_replace(";", "", strtolower($mac));
		$target = isset($_GET['target']) ? intval($_GET['target']) : -1;//是否由桔子平台主动跳转至下载地址 默认为:1,跳转至app的下载地址;如果需要自己控制下载时，target：0即可
		//固定参数
		$app_url = 'https://itunes.apple.com/cn/app/jiang-shenhd/id593417433?mt=8';//app 下载地址
		

		$con = mysql_connect("localhost","root","root123wan");
		if (!$con)
		{
		  	die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("dinj", $con);
		$add_time = time();

		$only_sql =  "SELECT count(id) AS c FROM  `int_qudao` WHERE `imei`='$imei'";
		$only_result = mysql_query($only_sql,$con);
		$only_res = mysql_fetch_row($only_result);

		if($only_res[0]=='0' || $only_res[0]==0){
			//广告接入
			$qudao_query = "INSERT INTO `int_qudao` VALUES ('', '$appid', '$channel', '$imei', '$pridata', '$mac', $target, '$add_time', 1)";
			$qudao_result = mysql_query($qudao_query,$con);
		}
		//PC
		$url = "http://ifenxiao.juzi.cn/channel/getad?appid=1000051&channel=2000088&imei=$imei&pridata=$pridata&mac=$mac&target=$target";
		$json = access_url($url);
		$json = stripslashes($json);
		$pc_res = json_decode($json, true);
		if($pc_res){
			$code = $pc_res['Code'];
			$content = $pc_res['Content'];
			$type = $pc_res['Type'];
		}else{
			$type = '1';
			$code = '000001';
			$content = '开发者状态异常';
		}

		//广告激活
		$pc_query = "SELECT * FROM  `int_pc` WHERE `imei`='$imei' ";
		$pc_result = mysql_query($pc_query,$con);
		$res = mysql_fetch_array($pc_result);
		if($res){
			$qudao_url = "http://www.qinmayi.com/client/adcallback?eid=1000051_2000088&did=".$res['imei']."&mac=".$res['mac'];
			$qudao_res = access_url($qudao_url);
		}else{
			$code = '000002';
			$content = '无广告内容';
		}
		mysql_close($con);
		if($target==1){
			$app_url = 'https://itunes.apple.com/cn/app/jiang-shenhd/id593417433?mt=8';
			header("Location: $app_url");exit;
		}else{
			$result = array("Code"=>$code,'Type'=>$type,"Content"=>$content);
			echo json_encode($result);exit;
		}
	}else{
		$result = array("Code"=>'000004','Type'=>$type,"Content"=>'数据发送异常');
		echo json_encode($result);exit;
	}





?>