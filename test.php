<?php 
header("Content-type: text/html; charset=utf-8"); 
/* 测试一
*  变量的作用域
*/
class A 
{
	public $n = 90;
	function __construct()
	{
		$n = 45;
	}
}
$a = new A();
//echo $a->n;

/* 测试二
*  静态变量的用法
*/
class B{
	public $name;
	public $age;
	public static $country = 'Chinese';
	/*public function __construct($country){
		$this->country = $country;
	}*/
}
	//print B::$country."  ";

	//$one = new B();
	//$two = new B("Chinese");
	//$one->country = 'China';
	//print $two->country."<br />";
	//print $one->country;
	//print B::$country."  ";



//$str = '2';
//$int = (int)$str;
//var_dump($int);
//
//echo md5(md5("qzq7710520"));
//echo urlencode("http://m.21jingji.com/article/20140730/herald/64491f4574649d92bc5b999084fa7ae3.html");
//
/*echo $_SERVER['HTTP_HOST'];//获取当前域名 
$arr = array();
$str = '';
for($i=0;$i<count($arr);$i++){
	if($i<count($arr)-1){
		$str .= $arr[$i]."|";
	}
}*/
//$str = strtotime("2015-12-11 16:30:11");
//echo $str;
/*$moblie = '18665621750';
$newMobile = substr_replace($moblie,'*****',3,5);   
//echo $newMobile; 
$date = "2016-02-01";
$time = strtotime($date);

$t1['1'] = 1;
$t1['2'] = 2;
$arr = Array(756,760,764,759,768,758,765,776,797,798,799,800);

echo date("Y-m-d",1453620531);*/




/*
$password = '123456abc';
$needChange = (!ctype_alpha($password) && !ctype_digit($password) && !(strlen($password) < 9) && !(strlen($password) > 16)) ? true : false;
//var_dump(ctype_digit($password));

                //var_dump($needChange);

$Memcache= new Memcache();
$Memcache->addServer('localhost', 12111);
$json = json_encode(array('you'=>'kiss me'));
$Memcache->set('var_key', 'some really big variable', MEMCACHE_COMPRESSED, 50);

echo $Memcache->get('var_key');*/

/*function udate($format = 'u', $utimestamp = null) {
        if (is_null($utimestamp))
           $utimestamp = microtime(true);
 
        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000);
 		return date("Y-m-d")."T".date('H:i:s').".".$milliseconds;
   }
 
echo udate();
echo "<br />2015-08-29T12:31:24.556";*/

 /*$TimeStamp = strtotime(str_replace('T', ' ', '2016-11-23T11:37:46'));
 echo date("Y-m-d H:i:s");
var_dump($TimeStamp);exit;*/
/*$data['thumb'] = 'http://img.21sq.org/uploadfile/cover/20170511/201705110654302151.jpeg';
$int = strrpos($data['thumb'],'.');
$newsimg = '';
for($i=0;$i<strlen($data['thumb']);$i++){
	if($i==($int)){
		$newsimg .= '_small'.$data['thumb'][$i];
	}else{
		$newsimg .= $data['thumb'][$i];
	}
}
var_dump($newsimg);*/


/*function chinese($string){
    $res = false;
    if($string){
        preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $string, $matches);  
        $string = join('', $matches[0]); 
        if(!empty($string)){
            $res = true;
        }
    }
    return $res;
}

//提取字符串中的汉字其余信息剔除  
header("Content-type: text/html; charset=utf-8");  
$str='■ 戴春晨 实习生 王鹏钧 广州报道';   
$res = chinese($str);
var_dump($res);*/

/*$str = strtotime("-1 hours");
echo date("Y-m-d : H:i:s",$str);
*/
/**//*$_POSTs = array(
    'username'=>11713,
    'sign'=>'E3A1454990BD08EF27467368F4121223',
    '0'=>'931148',
    '1'=>'931149',
    '2'=>'931150',
    '3'=>'931151',
    '4'=>'931152',
    '5'=>'931153',
    '6'=>'931154',
);
ksort($_POSTs);
var_dump($_POSTs);*/



//echo date("Y-m-d%20H:i:s.").microtime(true)*1000;
$str = "/Date(1504231852006+0800)/";


/*$date = date("Y-m-t H:i:s",intval(substr($str, 6,10)));

echo $date;exit;*/
//echo  date("Y-m-d : H:i:s",strtotime("-1 hours"));
/* $GLOBALS['z'] = 0;
function getlist(){
	
	if($GLOBALS['z']==0){
		$GLOBALS['z']++;
		getlist();
	}else{
		$GLOBALS['z']++;
	}
	return $GLOBALS['z'];
}
$r =  getlist();
echo $r;*/
/*$agent = 'Mozilla/5.0 (Linux; Android 5.0.2; A0001 Build/LRX22G; wv) Z2 Pro_6.0.1_WeiboIntlAndroid_2590';
preg_match("/(?<=Android )[\d\.]{1,}/", $agent, $version);  
//var_dump($version);
//
$str = "('111',
	'222',
	'333',
	'444',
	'555',
	'666',
	'777',
	'888',
	'999',
	'000')";
	$new_str = substr($str, 1,-1);
	

$array = array('code'=>'2222');
$r = array_keys($array);
var_dump($r);exit;*/
/*$lasttime = "21epaper/4.5.2 (iPhone 5s; iOS 9.3.3; Scale/2.00)";
preg_match("/(?<=iPhone )[\d\.]{1,}/", $lasttime, $version); 
var_dump($version);exit;*/

#$gm =  gmdate("D, d M Y H:i:s \G\M\T");
#$gm = "Thu, 30 Nov 2017 15:54:51 GMT";
#echo $gm."<br />";
#echo date("Y-m-d H:i:s",strtotime($gm)-60*60*8);


/*//连接本地的 Redis 服务
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
   echo "Connection to server sucessfully";
   //设置 redis 字符串数据
   $redis->set("tutorial-name", "Redis tutorial2");
   // 获取存储的数据并输出
   echo "Stored string in redis:: " . $redis->get("tutorial-name");*/
/*$title = "从&amp;ldquo;听她说&amp;rdquo;到&amp;ldquo;看她说&amp;rdquo;&amp;mdash;&amp;mdash;&amp;mdash;Ｏｒａｎｇｅ可视移动电话";
$title = html_entity_decode(htmlspecialchars_decode($title));
$title = ($title);
echo $title;exit;
   function getTags($html, $tag){  
        $level        = 0;  
        $offset        = 0;  
        $return     = "";  
        $len        = strlen($tag);  
        $tag        = strtolower($tag);  
        $html2        = strtolower($html);  
        if(strpos($tag," ")){  
            $temp         = explode(" ",$tag);  
        }  
        $tag_end    = (isset($temp[0]))?$temp[0]:$tag;  
        $i = 0;  
        while(1){  
            $seat1    = strpos($html2,"<{$tag}",$offset);  
            if(false === $seat1) return $return;  
            $seat2    = strpos($html2,"</{$tag_end}>",$seat1+strlen($tag)+1);  
            $seat3    = strpos($html2,"<{$tag}",$seat1+strlen($tag)+1);  
            while($seat3!=false && $seat3<$seat2){  
                $seat2    = strpos($html2,"</{$tag_end}>",$seat2+strlen($tag_end)+3);  
                $seat3    = strpos($html2,"<{$tag}",$seat3+strlen($tag)+1);  
            }  
            $offset = $seat1+$len+1;  
            $return[$i]['s'] = $seat1;  
            $return[$i]['e'] = $seat2+$len+3-$seat1;  
            $i++;  
        }  
    }*/

 /*$version = '5.0.0';
$ret = preg_match('/^[0-9]{1,3}\.[0-9]{1,2}\.[0-9]{1,2}$/', $version);
$record = true;
if($ret){
	list($major, $minor, $sub) = explode('.', $version);
		$integer_version = $major*10000 + $minor*100 + $sub;
		$n = intval($integer_version);
		$record = $n > 50000 ? false : true;
}
var_dump($record);exit;*/

/*$str = 'qinzq';
$password = 'outcomernick901';
$pass = sha1($str.$password);
var_dump($pass);

echo 'UEx5nDuRtwvsL/+Pylv2SZ3XSiY=';*/
/*$val = 8;
var_dump(log($val+1,10));*/

 //随机生成字符串
/*    function createNonceStr($length = 30) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return "z".$str;
    }
    echo uniqid()."<br />";
    echo createNonceStr();*/


echo '开始内存：'.memory_get_usage(), "<br />"; 
$stime = microtime(true); //获取程序开始执行的时间

    $str = "<p>中国证券报（ID:xhszzb）记者从多个信源处获悉，银保监会于近日下发《中国银保监会办公厅关于商业银行承销地方政府债券有关事项的通知》（以下简称“通知”）。</p><p><img src='https://mmbiz.qpic.cn/mmbiz_jpg/HlLt5rdYSZhGLXLJjnzBvoHQlWHR5lo7qCZvOopK8ZRI6s0SicibhV18SavDXrhaAGk7kh0ou0KctrxiaZRE4hUwA/640?wx_fmt=jpeg' /></p><p>通知指出，新预算法实施后，地方政府债券发行兑付方式由财政部代为还本付息变为省级政府自发自还，地方政府债券规模管理比照国债实行余额限额管理。为适应这一新情况，自通知印发之日起，地方政府债券参照国债和政策性金融债，不适用《中国银监会关于加强商业银行债券承销业务风险管理的通知》（银监发[2012]16号）（以下简称“银监发[2012]16号文”）相关规定。</p><p>银监发[2012]16号文规定： 商业银行投资部门投资于（计入会计分类为可供出售债券、持有至到期债券或应收款项类债券）本行所主承销债券的金额，在债券存续期内，不应超过当只债券发行量的20%，同时应满足其他关于商业银行投资业务的监管要求及内部管理规定。 某证券公司银行业分析师指出，此前银行无法购买超出限额的本行承销的地方债，通知下发后，银行购买本行承销的地方债将不受此规定限制，银行承销地方债意愿会增强。 南方某股份制银行地方债承销业务人士表示，取消20%的限制对地方债发行是一个利好，地方政府后续发债会相对之前变得容易。</p><p>事实上，进入8月以来，地方债发行速度较上半年有了明显提升。 Wind数据显示，8月份地方债发行额达到8829.7亿元，较7月增长16.65%。</p><p><img src='https://mmbiz.qpic.cn/mmbiz_png/HlLt5rdYSZhGLXLJjnzBvoHQlWHR5lo7HChI5uksh86Wc3PIGfJddtmvaIaB5WzD0Dicj5sNwKtRxsKewkaGO6A/640?wx_fmt=png' /></p><p>8月14日，财政部发布《关于做好地方政府专项债券发行工作的意见》——</p><p><img src='https://mmbiz.qpic.cn/mmbiz_png/HlLt5rdYSZhGLXLJjnzBvoHQlWHR5lo7Ol7XSkhvUIYw8ewJWDPjicSgAZpFa3E4ARo1pZhYFGy3Y2ppiaBgqF4Q/640?wx_fmt=png' /></p><p>华创证券据此测算，2018年专项债发行额度为13500亿元，在额度完全使用的情况下，8、9月份至少需要发行9297亿元，10月需发行约2700亿元。 按照财政部此前的要求，9月份专项债仍至少要发行5500亿元；若将一般债发行剩余额度按照9、10月份平均分配，9月份的新增债总量接近6000亿元。 从绝对量上看，地方债剩余额度主要集中在东部地区和中部地区，如山东、河北、江苏、浙江、安徽、湖北、内蒙古、湖南、江西等地。</p><p>上半年基建基建投资大幅下滑引发市场关注，7月23日，国务院常务会议强调积极财政政策要更加积极，加快今年1.35万亿元地方政府专项债券发行和使用进度，在推动在建基础设施项目上早见成效。 兴业银行首席经济学家鲁政委表示，地方债发行提速背后更为积极的财政政策可能使资金需求重新回升。事实上基建融资需求的回升在此之前就有所体现。据银保监会网站数据，7月新增基础设施行业贷款1724亿元，较6月多增469亿元。如果基建投资增速回升，将对下游制造业融资需求形成拉动。数据显示，基建投资增速领先制造业贷款需求同比约6个月。因此，如果宽财政得以最终兑现，基建投资增速的回升可能逐步传导至其他经济主体，使其融资需求回升。 国盛证券固定收益分析师刘郁表示，根据测算，8-12月的新增专项债中流入基建的资金总量约为7200亿元，由此拉动的基建总投资可能达到4.3万亿元的规模，但考虑到施工进度问题，并不会全部计入当年基建投资。考虑到专项债带来的增量基建投资，预计后续基建投资可能企稳并温和反弹。</p>";
$pattern_src = '/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/';#2018.09.04 QZQ
#header('Content-type: image/jpeg');

        
function imgToLocal($link){

    $components  = parse_url($link);
    $hostname     = $components['host'];   
    $path = $components['path']; 
    $port     =  80 ;
    $errno = 0;  
    $errstr = '';
    $timeout = 100;
    
    if(empty($referer)){  
      $referer   = $components['scheme'] . '://' . $components['host'];   
    }elseif($referer == '1'){  
      $referer   = '';  
    }  
    $filename   = basename($path);   
    //提取内容类型   extract the content type
    $ext = substr(strrchr($path, '.'), 1);   
    if ($ext == 'jpg' or $ext == 'jpeg') {   
        $contentType = 'image/pjpeg';   
    }elseif ($ext == 'gif') {   
      $contentType = 'image/gif';   
    }elseif ($ext == 'png') {   
        $contentType = 'image/x-png';   
    }elseif ($ext == 'bmp') {   
        $contentType = 'image/bmp';   
    }else {   
        $contentType = 'application/octet-stream';   
    } 
   
    #建立页眉 buildHeaders
    $request = "GET $path HTTP/1.1\r\n";   
    $request .= "Host: $hostname\r\n";   
    $request .= "Accept-Encoding: gzip, deflate\r\n";  
    $request .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-CN; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1\r\n";
    $request .= "Content-Type: image/jpeg\r\n";   
    $request .= "Accept: */*\r\n";   
    $request .= "Keep-Alive: 300\r\n";   
    $request .= "Referer: $referer\r\n";   
    $request .= "Cache-Control: max-age=315360000\r\n";   
    $request .= "Connection: close\r\n\r\n";  
    
    
    #打开一个持久的网络连接或者Unix套接字连接
    $stream = fsockopen($hostname, $port, $errno, $errstr, $timeout); 

    fwrite($stream, $request);
    $body = "";   
    $img_size = get_headers($link,true);  

    while (!feof($stream)) {
        if(isset($img_size['Content-Length'])){
            $body .= fgets($stream, $img_size['Content-Length']);
        }
        //fwrite($jpg,fread($stream, $img_size['Content-Length']));  
    }   
    
    $content = explode("\r\n\r\n", $body, 2);   
    $body = $content[1]; 
    fclose($stream);    
    // send 'ContentType' header for saving this file correctly
    // 如果不发送CT，则在试图保存图片时，IE7 会发生错误 (800700de)   
    // Flock, Firefox 则没有这个问题，Opera 没有测试   
    #header("Content-Type: $contentType;");   
    header("Cache-Control: max-age=5");  
    
    //保存图片  
    $filename = date("Ymd").'/'.time().mt_rand(100000,999999).'.jpg';
    $local_scr_path = 'D:/website/21APP/staging/editord_21jingji/htdocs/upfiles/cover/'.$filename;
    file_put_contents($local_scr_path, $body); 
    
    /*$filename = date("Ymd").'/'.time().mt_rand(100000,999999).'.jpg';
    $local_scr_path = ROOT_PATH.'/htdocs/upfiles/cover/'.$filename;
    $dirname = dirname($local_scr_path);
    if (!file_exists($dirname)) {
        mkdir($dirname, 0777, true);
    }

    file_put_contents($local_scr_path, $body); 

    $web_src_path = SOURCE_URL_PATH.'/cover/'.$filename;
    $replaceSrc[] = $web_src_path;*/
    #var_dump($filename);exit;
    return $filename;
 }


$url = isset($_GET['url']) ? $_GET['url'] : 'https://mmbiz.qpic.cn/mmbiz_jpg/HlLt5rdYSZhGLXLJjnzBvoHQlWHR5lo7qCZvOopK8ZRI6s0SicibhV18SavDXrhaAGk7kh0ou0KctrxiaZRE4hUwA/640?wx_fmt=jpeg';

 preg_match_all($pattern_src,$str,$img_src);

        foreach ($img_src[1] as $key => $img){

            $filename[] = imgToLocal($img);
           
            
        }
        var_dump($filename);

        $tmp = str_repeat('hello', 1000);   
        echo "<br />运行后内存：".memory_get_usage(), '';  
        unset($tmp);   
        echo "<br />回到正常内存：".memory_get_usage();

        

        $etime = microtime(true);//获取程序执行结束的时间
        $total = $etime-$stime;   //计算差值
        echo "<br />[页面执行时间：{$total} ]秒";