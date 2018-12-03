<?php 
$list = array(
	0=>array('http://news.21so.com/?c=fengXiangBiao&html=1&action=show_list'),
	1=>array('http://search.21so.com/index/cbhjson/'),
	2=>array('http://socms.21cbh.com/positiondata.php'),
	3=>array('http://data.auto.21cbh.com:2hr9jytx8hi5c45h@api.cheshi.com/product/site_common.php?act=catesubclassprice&limit=16'),
	4=>array('http://data.auto.21cbh.com:2hr9jytx8hi5c45h@api.cheshi.com/product/site_common.php?act=get_hot_catesub&limit=16'),
	5=>array('http://data.auto.21cbh.com:2hr9jytx8hi5c45h@api.cheshi.com/product/site_common.php?act=catesubclassprice&limit=27'),
	6=>array('http://data.auto.21cbh.com:2hr9jytx8hi5c45h@api.cheshi.com/product/site_common.php?act=get_hot_catesub&limit=27'),
	7=>array('http://qd.10jqka.com.cn/quote.php?cate=real&type=stock&dt=A'),
	8=>array('http://www.sge.sh/publish/sge/'),
	9=>array('http://data.simuwang.com/api/21cbh/?mod=brokerage_b1_1m_json'),
	10=>array('http://data.simuwang.com/api/21cbh/?mod=brokerage_a1_json'),
	11=>array('http://www.chinamoney.com.cn/static/html/column/frontpage/baseprice/rmbcentralparity/RMBCentralParity.html'),
	12=>array('http://www.shibor.org/shibor/web/html/shibor.html'),
	13=>array('http://www.howbuy.com/cooperate/smjzrank.html'),
	14=>array('http://simu.howbuy.com/board.htm'),
	15=>array('http://www.howbuy.com/fund/fundranking/'),
	16=>array('http://www.howbuy.com/cooperate/smrank.htm'),
	17=>array('http://qd.10jqka.com.cn/dataService.php?type=common&datatype=fundcode'),
	18=>array('http://quotes.money.163.com/fn/service/fundReturn.php?host=/fn/service/fundReturn.php&page=0&fields=RN,SYMBOL,SNAME,TDATE,NAV,D1NAVGR,W4NAVG,W26NAVG,W52NAVG,YTDNAVG,SLNAVG,CODE&sort=W4NAVG&order=desc&count=6&type=query&callback=&req='),
	19=>array('http://quotes.money.163.com/fn/service/netvalue.php?host=/fn/service/netvalue.php&page=0&query=STYPE:FDO;TYPE3:GPX&fields=no,PUBLISHDATE,SYMBOL,SNAME,NAV,PCHG,M12RETRUN,M3RETRUN,SLNAVG,ZJZC&sort=M3RETRUN&order=desc&count=6&type=query&callback=&req='),
	20=>array('http://quotes.money.163.com/fn/service/netvalue.php?host=/fn/service/netvalue.php&page=0&query=STYPE:FDO;TYPE3:ZQX&fields=no,PUBLISHDATE,SYMBOL,SNAME,NAV,PCHG,M12RETRUN,M3RETRUN,SLNAVG,ZJZC&sort=M3RETRUN&order=desc&count=6&type=query&callback=&req='),
	21=>array('http://quotes.money.163.com/fn/service/netvalue.php?host=/fn/service/netvalue.php&page=0&query=TYPE1:MONEY&fields=no,PUBLISHDATE,SYMBOL,SNAME,CUR4,CURNAV_010,CURNAV_011,OFPROFILE8&sort=CURNAV_011&order=desc&count=6&type=query&callback=&req='),
	22=>array('http://simu.howbuy.com/yhzcg.htm'),
	23=>array('http://news.21so.com/?c=fengXiangBiao&action=show_hotkeyword')
	);

$fliename = 'exteral_file_';
$fieldir = "D:\website\phptest\exteral_file";
//$fieldir = $_SERVER['HOST_NAME']
//if(opendir($fieldir)==false){
	mkdir($fieldir,0777);
//}else{
	//echo '2';exit;
//}

for($i=0;$i<count($list);$i++){
	if(!empty($list[$i][0])){
		$file_content = file_get_contents($list[$i][0]);
		if($file_content!=''){
			$filename =$fieldir."/".$fliename.$i.".html";
			$fp=fopen($filename, "w+"); //打开文件指针，创建文件
			if (!is_writable($filename) ){
			      die("文件:" .$filename. "不可写，请检查！");
			}else{
				file_put_contents($filename,$file_content);
				echo $i."<br />";
			}
			fclose($fp);//关闭指针
		}else{
			echo $list[$i][0]."---";
		}
	}

}

?>