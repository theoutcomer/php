<?php
 /*在做查询过程中,例如要实现查上个月从第一天到最后一天的佣金(提成),那我们在程序实现过程中就要让程序在上个月的范围内查询,第一天是比较好办,但最后一天就不定,要去写段函数进行月份及年份判断来得出上个月共有多少天.那就比麻烦,还有获取当前月份,当前年份等常规日期获取函数,以下代码都是经过本公司工程师测试后的正确代码,可以放心使用. 
1.获取上个月第一天及最后一天.*/
   echo date('Y-m-01', strtotime('-1 month'));
   echo "<br/>";
   echo date('Y-m-t', strtotime('-1 month'));
   echo "<br/>";
//2.获取当月第一天及最后一天.
   $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
   echo $BeginDate;
   echo "<br/>";
   echo date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
   echo "<br/>";
//3.获取当天年份、月份、日及天数.
   echo " 本月共有:".date("t")."天";
   echo " 当前年份".date('Y');
   echo " 当前月份".date('m');
   echo " 当前几号".date('d');
   echo "<br/>";
//4.使用函数及数组来获取当月第一天及最后一天,比较实用,出自网友.
   function getthemonth($date)
   {
   		$firstday = date('Y-m-01', strtotime($date));
   		$lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
   		return array($firstday,$lastday);
   }
   $today = date("Y-m-d");
   $day=getthemonth($today);
   echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1];
   echo "<br/>";
?>
