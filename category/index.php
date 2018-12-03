<?php
/*
*/
include_once("../config/config.php");
//获取某分类的直接子分类
function getSons($categorys,$catId=0){
	$sons=array();
	foreach($categorys as $item){
		if($item['parentId']==$catId)
			$sons[]=$item;
	}
	return $sons;
}

//获取某个分类的所有子分类
function getSubs($categorys,$catId=0,$level=1){
	$subs=array();
	foreach($categorys as $item){
		if($item['parentId']==$catId){
			$item['level']=$level;
			$subs[]=$item;
			$subs=array_merge($subs,getSubs($categorys,$item['categoryId'],$level+1));
		}	
	}
	return $subs;
}

//获取某个分类的所有父分类
//方法一，递归
function getParents($categorys,$catId){
	$tree=array();
	foreach($categorys as $item){
		if($item['categoryId']==$catId){
			if($item['parentId']>0)
				$tree=array_merge($tree,getParents($categorys,$item['parentId']));
			$tree[]=$item;	
			break;	
		}
	}
	return $tree;
}

//方法二,迭代
function getParents2($categorys,$catId){
	$tree=array();
	while($catId != 0){
		foreach($categorys as $item){
			if($item['categoryId']==$catId){
				$tree[]=$item;
				$catId=$item['parentId'];
				break;	
			}
		}
	}
	return $tree;
}


//测试 部分
$hostname = $config['phptest']['hostname'];
$database = $config['phptest']['database'];
$username = $config['phptest']['username'];
$password = $config['phptest']['password'];

$pdo = new PDO("mysql:host=$hostname;dbname=$database",$username,$password);
$stmt = $pdo->query("select * from category order by categoryId");
$categorys = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo '<pre>'.var_dump($categorys).'</pre>';


$result=getSons($categorys,1);
foreach($result as $item)
	echo $item['categoryName'].'<br>';
echo '<hr>';

$result=getSubs($categorys,0);
foreach($result as $item)
	echo str_repeat('&nbsp;&nbsp;',$item['level']).$item['categoryName'].'<br>';
echo '<hr>';

$result=getParents($categorys,7);
foreach($result as $item)
	echo $item['categoryName'].' >> ';
echo '<hr>';

$result=getParents2($categorys,15);
foreach($result as $item)
	echo $item['categoryName'].' >> ';






?>