<?php 
/**
* xml test file!
* outcomer
*/
/*class Xml_test 
{
	
	function __construct(argument)
	{
		# code...
	}
	public function test(){

	}	
}*/
// 首先要建一个DOMDocument对象 
$xml = new DOMDocument();
$file_path = "http://sports.163.com/special/00051K7F/rss_sportszg.xml";
// 加载Xml文件 
$xml->load($file_path); 

// 获取所有的rss标签 
$rssDom = $xml->getElementsByTagName("item"); 

function arrayToObject($e){
    if( gettype($e)!='array' ) return;
    foreach($e as $k=>$v){
        if( gettype($v)=='array' || getType($v)=='object' )
            $e[$k]=(object)arrayToObject($v);
    }
    return (object)$e;
}


	// 循环遍历post标签 
	foreach($rssDom as $rss){ 
		// 获取Title标签Node 
		$title = $rss->getElementsByTagName("title"); 
		/** 
		* 要获取Title标签的Id属性要分两部走 
		* 1. 获取title中所有属性的列表也就是$title->item(0)->attributes 
		* 2. 获取title中id的属性，因为其在第一位所以用item(0) 
		* 
		* 小提示： 
		* 若取属性的值可以用item(*)->nodeValue 
		* 若取属性的标签可以用item(*)->nodeName 
		* 若取属性的类型可以用item(*)->nodeType 
		*/ 
		//echo "Id: " . $title->item(0)->attributes->item(0)->nodeValue . "<br />"; 
		//echo "Title: " . $title->item(0)->nodeValue . "<br />"; 
		echo "Details: " . $rss->getElementsByTagName("title")->item(0)->nodeValue . "<br /><br />"; 
	}

?>