<?php 
header("Content-type: text/html; charset=utf-8"); 

function GetIpLookup($ip = ''){  
  if(empty($ip)){  
    return '请输入IP地址'; 
  }  
  $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
  if(empty($res)){ return false; }  
  $jsonMatches = array();  
  preg_match('#\{.+?\}#', $res, $jsonMatches);  
  if(!isset($jsonMatches[0])){ return false; }  
  $json = json_decode($jsonMatches[0], true);  
  if(isset($json['ret']) && $json['ret'] == 1){  
    $json['ip'] = $ip;  
    unset($json['ret']);  
  }else{  
    return false;  
  }  
  return $json;  
} 

$date = empty($_GET['date']) ? date("Y-m-d") : trim($_GET['date']);
$WeChat = 0;
$users =  $aritcle = array();
$dir = "D:/data/logs/web_count/".date("Y",strtotime($date))."/".date("m",strtotime($date));

$file = $dir."/aritcle_".$date.".log";

$$count = 0;
$handle = @fopen($file, "r");
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        $arr = (array)json_decode($buffer);
        if($arr['platform']!='web'){
  			if($arr['uid']!=''){
  				$aritcle[] = $arr;
	  			$count++;
	  		}
  		}
    }
    if(){}
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

var_dump($aritcle);exit;



$content = file_get_contents($file);var_dump($content);exit;
$array = explode("\n", $content);
include 'IpLocation.php';  
$iplocation = new IpLocation();     
$count =  count($array);

var_dump($count);exit;
for($i=0;$i<count($array);$i++){
	$arr = (array)json_decode($array[$i]);
	/*if($arr['uid']!=NULL){

  		$users[$arr['uid']]['id'][] = $arr['id'];
  		$users[$arr['uid']]['catid'][] = $arr['catid'];
  		$users[$arr['uid']]['platform'][] = $arr['platform'];
  		$users[$arr['uid']]['time'][] = $arr['time'];
  		$users[$arr['uid']]['ip'][] = $arr['ip'];
  		$users[$arr['uid']]['subcat'][] = $arr['subcat'];
  		$users[$arr['uid']]['pushid'][] = $arr['pushid'];
  		$users[$arr['uid']]['os'][] = $arr['os'];
  		$users[$arr['uid']]['broswer'][] = $arr['broswer'];
    }*/
    	#$aritcle[$arr['id']]['id'][] = $arr['id'];
  		#$aritcle[$arr['id']]['catid'][] = $arr['catid'];
  		/*$aritcle[$arr['id']]['platform'][] = $arr['platform'];
  		$aritcle[$arr['id']]['time'][] = $arr['time'];
  		$aritcle[$arr['id']]['ip'][] = $arr['ip'];
  		$aritcle[$arr['id']]['subcat'][] = $arr['subcat'];
  		$aritcle[$arr['id']]['pushid'][] = $arr['pushid'];
  		$aritcle[$arr['id']]['os'][] = $arr['os'];
  		$aritcle[$arr['id']]['broswer'][] = $arr['broswer'];*/
  		//$ips = GetIpLookup($arr['ip']);
  		//var_dump($ips['country'].'-'.$ips['province']);
  		/*if(isset($aritcle[$arr['id']])){
  			$aritcle[$arr['id']]++;
  		}else{
  			$aritcle[$arr['id']] = 1;
  		}
  		if(stripos($arr['broswer'], 'WeChat')!==false){
  			$broswer['WeChat'] ++;
  		}
  		if(stripos($arr['broswer'], 'Firefox')!==false){
  			$broswer['Firefox'] ++;
  		}
  		if(stripos($arr['broswer'], 'Chrome')!==false){
  			$broswer['Chrome'] ++;
  		}
  		if(stripos($arr['broswer'], 'AppleWebKit')!==false){
  			$broswer['AppleWebKit'] ++;
  		}
  		
  		if(stripos($arr['broswer'], 'Edge')!==false){
  			$broswer['Edge'] ++;
  		}
  		if(stripos($arr['broswer'], '傲游')!==false){
  			$broswer['傲游'] ++;
  		}
  		if(stripos($arr['broswer'], 'IE')!==false){
  			$broswer['IE'] ++;
  		}
  		if(stripos($arr['broswer'], 'Opera')!==false){
  			$broswer['Opera'] ++;
  		}
  		if(stripos($arr['broswer'], 'Safari')!==false){
  			$broswer['Safari'] ++;
  		}
  		if(stripos($arr['broswer'], 'Baiduspider')!==false){
  			$broswer['Baiduspider'] ++;
  		}
  		if(stripos($arr['broswer'], 'Googlebot')!==false){
  			$broswer['Googlebot'] ++;
  		}
  		if(stripos($arr['broswer'], 'UCBrowser')!==false){
  			$broswer['UCBrowser'] ++;
  		}

  		if(stripos($arr['broswer'], 'unknown')!==false && stripos($arr['platform'], 'Android')===false && stripos($arr['platform'], 'iOS')===false){
  			#var_dump($arr['platform']);
  			$broswer['unknown'] ++;
  		}
  		if(stripos($arr['platform'], 'ios')!==false){
  			$broswer['iOS'] ++;
  		}
  		if(stripos($arr['platform'], 'android')!==false){
  			$broswer['Android'] ++;
  		}
  		if($arr['platform']=='web'){
  			$broswer['web'] ++;
  		}*/

  		#echo $arr['ip']."<br />";
  		/*if(in_array($ips,GetIpLookup($arr['ip']))){
  			$ips[GetIpLookup($arr['ip'])]++;
  		}else{
  			$ips[GetIpLookup($arr['ip'])] = 0;
  		}*/
  		/*if(stripos($arr['platform'], 'web')!==false){
  			#echo $arr['ip']."<br />";
  			#$loopup = GetIpLookup($arr['ip']);
  			$location = $iplocation->getlocation($arr['ip']);   
  			if(strpos($location['country'],'省') || strpos($location['country'],'新疆')!==false || strpos($location['country'],'西藏')!==false|| strpos($location['country'],'内蒙古')!==false || strpos($location['country'],'广西')!==false){
  				if(strpos($location['country'],'新疆')!==false){
  					$temp = explode('新疆', $location['country']);
	  				$province = '新疆维吾尔自治区';
	  				$city = empty($temp[1]) ? '其它' : $temp[1];
	  				$tempcity = explode('州', $city);
	  				if(count($tempcity)>1){
	  					$city = $tempcity[0].'州';
	  				}else if($tempcity = explode('市', $city)){
	  					$city = $tempcity[0].'市';
	  				}
  				}else if(strpos($location['country'],'西藏')!==false){
  					$temp = explode('西藏', $location['country']);
	  				$province = '西藏自治区';
	  				$city = empty($temp[1]) ? '其它' : $temp[1];
  				}else if(strpos($location['country'],'内蒙古')!==false){
  					$temp = explode('内蒙古', $location['country']);
	  				$province = '内蒙古自治区';
	  				$city = empty($temp[1]) ? '其它' : $temp[1];
	  				$tempcity = explode('市', $city);
	  				if(count($tempcity)>1){
	  					$city = $tempcity[0].'市';
	  				}
  				}else if(strpos($location['country'],'广西')!==false){
  					$temp = explode('广西', $location['country']);
	  				$province = '广西壮族自治区';
	  				$city = empty($temp[1]) ? '其它' : $temp[1];
	  				$tempcity = explode('市', $city);
	  				if(count($tempcity)>1){
	  					$city = $tempcity[0].'市';
	  				}
  				}else{
  					$temp = explode('省', $location['country']);
	  				$province = $temp[0].'省';
	  				$city = empty($temp[1]) ? '其它' : $temp[1];
	  				$tempcity = explode('市', $city);
	  				if(count($tempcity)>1){
	  					$city = $tempcity[0].'市';
	  				}
  				}
  				
  				unset($tempcity);
  				unset($temp);
  			}elseif(strpos($location['country'],'市')){
  				$test = explode('市', $location['country']);
  				#$province = $test[0].'市';
  				$citys = array('北京','天津','上海','重庆');
  				if(count($test)>0 && !empty($test[0])){
	  				if(in_array($test[0],$citys)){
	  					$province = $test[0].'市';
	  					$city = $province;
	  				}else{
	  					$province = $test[0].'省';
	  					$city = empty($test[1]) ? '其它' : $test[1];
	  				}
  				}
  				unset($test);
  			}else{
  				if(strpos($location['country'],'香港')){
  					$province = '香港特别行政区';
  					$city = '香港特别行政区';
  				}else if(strpos($location['country'],'澳门')){
  					$province = '澳门特别行政区';
  					$city = '澳门特别行政区';
  				}else{
  					$province = $location['country'];
  					$city = empty($location['area']) ? '其它' : $location['area'];
  				}
	  			
  			}


  			if(isset($address[$province]['total'])){
				$address[$province]['total']++;
			}else{
				$address[$province]['total'] = 1;
			}

			if(isset($address[$province][$city])){
				$address[$province][$city]++;
			}else{
				$address[$province][$city] = 1;
			}

			if(isset($address[$location['area']])){
				$network[$location['area']]++;
			}else{
				$network[$location['area']] = 1;
			}
			unset($province);
			unset($city);

  		}*/
  		if($arr['platform']!='web'){
  			if($arr['uid']!=''){
	  			$count++;
	  		}
  		}
}

//$aritcle_count = count($aritcle);
var_dump($count);
exit;
/*$handle = fopen($file,"r");
$users =  $aritcle = array();
while (!feof($handle))
{
  $line = fgets($handle);
  $arr = (array)json_decode($line);

  if($arr['uid']!=NULL){

  		$users[$arr['uid']]['id'][] = $arr['id'];
  		$users[$arr['uid']]['catid'][] = $arr['catid'];
  		$users[$arr['uid']]['platform'][] = $arr['platform'];
  		$users[$arr['uid']]['time'][] = $arr['time'];
  		$users[$arr['uid']]['ip'][] = $arr['ip'];
  		$users[$arr['uid']]['subcat'][] = $arr['subcat'];
  		$users[$arr['uid']]['pushid'][] = $arr['pushid'];
  		$users[$arr['uid']]['os'][] = $arr['os'];
  		$users[$arr['uid']]['broswer'][] = $arr['broswer'];

  }
}

fclose($handle);*/
#var_dump($users);

?>