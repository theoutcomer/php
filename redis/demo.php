<?php
$redis = new Redis();
$redis->connect("127.0.0.1","6379");  //php客户端设置的ip及端口
//存储一个 值
$redis->set("say","Redis test!");
echo $redis->get("say");
 
//存储多个值
$array = array('first_key'=>'first_val',
          'second_key'=>'second_val',
          'third_key'=>'third_val');
$array_get = array('first_key','second_key','third_key');
$redis->mset($array);
//var_dump($redis->mget($array_get));

//$redis->mset('arr',0);
$redis->rpush('arr',1);
$redis->rpush('arr',2);
$redis->rpush('arr',3);
$redis->rpush('arr',4);
$redis->rpush('arr',5);
$arr = $redis->lgetrange('arr',0,-1);
$arr = $redis->lsize('arr');

var_dump($arr);
$redis->delete('arr');
?>