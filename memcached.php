<?php
header("Content-type:text/html;charset=utf-8");
$mem = new Memcache;  
$mem->connect("localhost", 11211); 
 
$mem->set('key', '我是memcache存储的数据', 0, 60);  
$val = $mem->get('key');  
echo $val;
//输出结果为"我是memcache存储的数据",说明window本地的memcache已经成功安装好！！