<?php 
header("Content-type: text/html; charset=utf-8"); 


function getAddr($ip)
	{
		//$ip=mb_convert_encoding(file_get_contents("http://fw.qq.com/ipaddress"),"UTF-8", "GBK");
		//$ips = iconv("GB2312", "UTF-8",file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=$ip"));
		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=".$ip;
		$iparr = file_get_contents($url);
		//var_dump($ip);exit;
		$c = explode("	",$iparr);
		
		return trim($c[5]);
	}
//echo getAddr('58.248.203.87');
//$ip ='222.186.132.58, 192.168.2.82';
//$ips = explode( ',', $ip );
//var_dump($ips);

/*$filename = './20140715.log';
$content = iconv("GB2312", "UTF-8",file_get_contents($filename));
//preg_match_all('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$content,$ips, PREG_PATTERN_ORDER);
$arr = explode("\n",$content);
$ipss = array();
$s = $_GET['s'] ? $_GET['s'] : count($arr);

for($i=0;$i<$s;$i++){
	$arrs = explode(" ",$arr[$i]);
	$ip = end($arrs);
	echo  $i." : ".$ip."<br />";
	echo getAddr($ip);
}*/
//var_dump($ipss);

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-7-29
 * Time: 下午2:25
 * To change this template use File | Settings | File Templates.
 */
/*function mod_rewrite(){
	//global $_GET;
	$nav=$_SERVER["REQUEST_URI"];
	//echo $nav."<br>";
	$script_name=$_SERVER["SCRIPT_NAME"];
	echo ereg_replace("^$script_name","",urldecode($nav));
	$nav=substr(ereg_replace("^$script_name","",urldecode($nav)),1);
	$nav=str_replace(".php","",$nav);//这句是去掉尾部的.html或.htm
	$nav=str_replace(".php","",$nav);
	//echo $nav."<br>";
	$vars = explode("/",$nav);
	//print_r($vars);
	for($i=0;$i<Count($vars);$i+=2){
		$_GET["$vars[$i]"]=$vars[$i+1];
	}
	return $_GET;
}
mod_rewrite();
$year=$_GET["id"];
echo $year."<br>";
$action=$_GET["tid"];
echo $action;
if($_GET['id']==3){

    echo "测试！！！";
}
*/
$weekstr = array('日', '一', '二', '三', '四', '五', '六');

$weekday = date('w', strtotime('2014-12-02 15:45:48 '));
		//echo '星期'.$weekstr[$weekday]."<br />";
		$w = date("w");
		date_default_timezone_set('PRC');
    	$h = idate('h',time());
		$i = idate("i",time());
		switch ($w){
			case 0:
				$status = 0;
				break;
			case 6:
				$status = 6;
				break;
			default:
				if($h > 9){
					$status = 0;	
				}else{
					if($h==9 && $i>5){
						$status = 0;
					}else{
						$status = 1;
					}
				}
				break;
		}
/*
 * 返回日期几天前
 */

function time_tran($the_time) {
    $now_time = time ();
    $dur = $now_time - $the_time;
    switch ($dur) {
        case 0:
            return '1分钟前';
            break;
        case $dur < 3600 :
            return floor($dur / 60) . '分钟前';
            break;
        case $dur < 86400 :
            return floor($dur / 3600) . '小时前';
            break;
        case $dur < 15552000:
            return floor($dur / 86400) . '天前';
            break;
        case $dur < 31104000:
            return '半年前';
            break;
        case $dur < 62208000:
            return '一年前';
            break;
        default :
            return date('Y-m-d H:i', $the_time);
            break;
    }
}		
		
	$r['wiki'] = '新常态#改革#注册制#证监会#A股';

	if(strpos($r['wiki'], '＃')){
        $gbk = $pos = true;   
    }elseif (strpos($r['wiki'], '#')) {
        $pos = true;
    }
    if($pos===false){
       $tags = array_slice(array_unique(explode(' ',$r['wiki'])),0,30);
    }else{
        if($gbk){
            $tags = array_slice(array_unique(explode('＃',$r['wiki'])),0,30);
        }else{
            $tags = array_slice(array_unique(explode('#',$r['wiki'])),0,30);
        }
    }
 // var_dump($tags);
//echo date("Y-m-d H:i:s","1419500758");
//echo date('W',strtotime('2014-12-28'));
    /*$name = str_replace(array('.xls','.xlsx'), '', '2014.12.22-2014.12.28.xls');
    $arr = explode('-',$name);
    $name1 = strtotime(str_replace('.', '-', $arr[0]));
    $name2 = strtotime(str_replace('.', '-', $arr[1]));
   	$time =  $name1 + ($name2-$name1)/2;
    $week = date("m",$time);
    var_dump($week);*/
   // echo date("W",strtotime("-2 week"));
	//echo strtotime('2015-01-25');
	
    $string = '<!-- 网友留言 Begin -->
<div class="tonglan">
	<div class="title">
		<h2>网友留言</h2>
		<p><a href="#top" target="_self">返回顶部</a></p>
		<div class="clear"> </div>
	</div>

	<div id="messagelist"></div>
    		<script  type="text/javascript"> hello</script>	
	<div id="commentreply"></div>
    	
	<script> 
	var zhuantiid=\'special-20140909_iPhone\';
	specialcommentform(zhuantiid);
	$(\'#messagelist\').load(\'/comment/?c=zhuanti&action=list&keyid=\'+zhuantiid+"&rand="+Math.random());
	</script>
</div>
<!-- 网友留言 End-->';
    
$replace = 'zhuantiid={$id};
	specialcommentform_new(zhuantiid,\'zhuanti\',\'all\');
		var url = \'http://comment.21cbh.com/comment2/zhuanti/list?cb=?\';
		$.getJSON(url,\'&app=zhuanti&source=all&contentid=\'+zhuantiid+\'&callback=?\',function(data){
			if(data.code){
				$("#messagelist").html(data.content);
			}
		});';
$preg = '/zhuantiid=[\s\S]*?random\(\)\);/i';
    $str = preg_replace($preg, $replace, $string);
    //var_dump($str);exit;


 	/**
	 * 简单对称加密算法之加密
	 * @param String $string 需要加密的字串
	 * @param String $skey 加密EKY
	 * @author QZQ <qinzq@21cbh.com>
	 * @date 2015-02-10 
	 * @return String
	 */
	 function encode_qzq($string = '', $skey = '21cbh') {
	    $strArr = str_split(base64_encode($string));
	    $strCount = count($strArr);
	    foreach (str_split($skey) as $key => $value)
	        $key < $strCount && $strArr[$key].=$value;
	    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
	 }
	 /**
	 * 简单对称加密算法之解密
	 * @param String $string 需要解密的字串
	 * @param String $skey 解密KEY
	 * @author QZQ <qinzq@21cbh.com>
	 * @date 2015-02-10 
	 * @return String
	 */
	 function decode_qzq($string = '', $skey = '21cbh') {
	    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
	    $strCount = count($strArr);
	    foreach (str_split($skey) as $key => $value)
	        $key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
	    return base64_decode(join('', $strArr));
	 }
echo '<pre>';
$str = '3655';
echo "string : " . $str . " <br />";
echo "encode : " . ($enstring = encode_qzq($str)) . '<br />';
echo $enstring = encode_qzq($enstring)."<br />";
echo 'T2T1Jc6bMhUljNGJPaEFPME8wT08wTzBP'."<br />";

echo "decode : " . decode_qzq($enstring);
//echo "decode : " . decode_qzq(decode_qzq($enstring));
 die();

    
?>
<script type="text/javascript">
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
    }
var sid = getQueryString('token');

  alert(sid);
  

</script>