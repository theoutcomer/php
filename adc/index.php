<?php 
$runtime_start = microtime(true);
header("Content-Type: text/html; charset=utf-8");
 function create_html($url){
		$fieldir = dirname(__FILE__) .'/newad';
		if(!is_dir($fieldir)){
			if(opendir($fieldir)===false){
				echo "创建目录:".$fieldir."<br />";
				mkdir($fieldir);
				chmod($fieldir,0777);
			}
		}else{
			echo '目录已经存在'."<br />";
		}
		if($url){
			$file_content = file_get_contents($url);
			var_dump($file_content);
			if($file_content !=""){
				$filename =$fieldir."/".time().".html";
				$fp = fopen($filename, "w+"); //打开文件指针，创建文件
				if (!is_writable($filename) ){
					echo "文件:不可写，请检查！<br />";
				}else{
					if(strpos($file_content, 'href')){
						//$status = 1;
						//file_put_contents($filename,$file_content);
						echo " 写入成功(状态：有效)<br />";
					}else{
						echo " 没有找到有广告内容!";
					}
				}
			}
		}
		//closedir($fieldir);
		//return true;
}

 if($_GET['url']){
 	//create_html(trim($_GET['url']));
 	
 	$url = 'http://cbh.adsame.com/s?z=cbh&c=8&op=1';
 	echo getContent($url);
 	/*$ch = curl_init();
 	$timeout = 5;
 	curl_setopt($ch, CURLOPT_URL, $url);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
 	//在需要用户检测的网页里需要增加下面两行
 	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
 	//curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD);
 	$contents = curl_exec($ch);
 	curl_close($ch);
 	echo $contents;*/
  }
  
  function getContent($url, $method = 'GET', $postData = array()) {
  	$curl = curl_init();
  	curl_setopt($curl, CURLOPT_URL, $url);
  	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux i686; zh-CN; rv:1.9.1.2) Gecko/20120829 Firefox/3.5.2 GTB5');
  	curl_setopt($curl, CURLOPT_HEADER, 0);
  	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($curl, CURLOPT_REFERER, $url);
  	$content = curl_exec($curl);
  
  	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  	curl_close($curl);
  	if ($httpCode == 200) {
  		$content = mb_convert_encoding($content, "UTF-8", "GBK");
  	}
  	return $content;
  }
  
  $runtime_stop = microtime(true);
  echo "<br /> Processed in ".round($runtime_stop-$runtime_start,6)." second(s) ";
?>