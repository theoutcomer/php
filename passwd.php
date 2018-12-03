<?php 
if($_GET['n']){

	if($_GET['num']){
		$num = $_GET['num'];
	}else{
		$num = 10;
	}
	if($_GET['md5']){
		echo md5(md5($_GET['n']).$_GET['md5']);
	}else{
		echo substr(strtoupper(md5($_GET['n'])),10,$num);
	}
	
} 

?>