<?php 
/**
* @author QZQ 
* 算法
* Create Date 2014.09.25
*
*/

/**
* 阶乘法
* @param int $n 次数
* Create Date 2014.09.25
* @author QZQ
*/
function factorial($n){
	$result = 1;
	for($i=2;$i<=$n;$i++){
		$result *= $i;
	}
	return $result;
}

/*for($i=0;$i<$n;$i++){
	$num = factorial($i);
	echo 'This num is:'.$num."<br />";
}*/

/**
* 约瑟夫算法（猴子王例子）
* @param int $m 猴子总数
* @param int $n 第几只猴子
* Create Date 2014.09.25
* @author QZQ
*/
function king($m,$n){
	for($i=1;$i<=$m;$i++){
		$arr[] = $i;
	}
	$j = 0;
	while(count($arr)>1){
		if(($j+1)%$n == 0){
			unset($arr[$j]);
		}else{
			array_push($arr,$arr[$j]);//倒换
			unset($arr[$j]);
		}
		$j++;
	}
	return $arr;
}

/**
* 冒泡算法（排序）
* @param array  $arr
* Create Date 2014.09.26
* @author QZQ
*/
function bubble_sort($arr){
	$count = count($arr);
	if($count < 0){
		return false;
	}
	for($i=0;$i<$count;$i++){
		for($j=$count-1;$j>$i;$j--){
			if($arr[$j]>$arr[$j-1]){
				$temp = $arr[$j-1];
				$arr[$j-1] = $arr[$j];
				$arr[$j] = $temp;
			}
		}
	}
	return $arr;
}

/**
* 菱形算法（排序）菱形
* @param int  $n 控制循环的行数
* @param bool $hollow 默认空心为FALSE
* Create Date 2014.09.26
* @author QZQ
*/
function diamond($n,$hollow=false){
	$str = '';
	for($i=0;$i<=$n;$i++){
		for($j=0;$j<$n-$i;$j++){
			$str .= "&nbsp;";
		}
		for($k=0;$k<=2*$i;$k++){
			if($hollow){
				if($k==0 || $k==2*$i){
					$str .= "*";
				}else{
					$str .= "&nbsp;";
				}
			}else{
				$str .= "*";
			}
		}
		$str .= "<br />";
	}

	for($i=$n-1;$i>=0;$i--){
		for($j=0;$j<$n-$i;$j++){
			$str .= "&nbsp;";
		}
		for($k=2*$i;$k>=0;$k--){
			if($hollow){
				if($k==2*$i || $k==0){
					$str .= "*";
				}else{
					$str .= "&nbsp;";
				}
			}else{
				$str .= "*";
			}	
		}
		$str .="<br />";
	}
	return $str;
}
//echo diamond(7);

/**
* 直角三角形算法（排序）
* @param int  $n 控制循环的行数
* @param int $type 类别
* Create Date 2014.09.28
* @author QZQ
*/
function triangle($n,$type=1){
	//输出三角形  
	$str = '';
	switch($type){
		case 1:
			for($i=0;$i<$n;$i++){  
				for($j=0;$j<$n-$i;$j++){
				   $str .= "*";  
				}    
				$str .= "<br>";  
			} 
			break;
		case 2:
			for($i=0;$i<$n;$i++){  
				for($j=0;$j<$n-$i;$j++){
				   $str .= "&nbsp";  
				}   
				for($k=0;$k<=$i;$k++){   
					$str .= "*";  
				}    
				$str .= "<br>";  
			} 
			break;	
		case 3:
			for($i=0;$i<$n;$i++){  
				for($j=0;$j<$n-$i;$j++){   
					$str .= "*";  
				}   
				for($k=0;$k<=$i;$k++){    
					$str .= "&nbsp";  
				}    
				$str .= "<br>";  
			} 
			break;		
	}
	return $str;
}
//echo triangle(6,3);

/**
* 杨辉三角形算法（排序）
* @param int  $n 控制循环的行数
* Create Date 2014.09.28
* @author QZQ
*/
function pascal_triangle($n){
	if($n<2){
		return false;
	}
	$str = '';
	for($i=0;$i<$n;$i++){
		$arr[$i][0] = 1;
		$arr[$i][$i] = 1; 
	}
	for($i=2;$i<$n;$i++){
		for($j=1;$j<$i;$j++){
			$arr[$i][$j] = $arr[$i-1][$j-1]+$arr[$i-1][$j];
		}
	}
	for($i=0;$i<$n;$i++){
		for($j=0;$j<$i;$j++){
			$str .= $arr[$i][$j]."&nbsp;";
		}
		$str .= "<br />";
	}
	return $str;
}
//echo pascal_triangle(10);exit;
//echo "<pre>".print_r($arr,1)."</pre>";

/**
* 杨辉三角形算法（排序）
* @param int  $iLine 控制循环的行数
* Create Date 2014.09.28
* @author QZQ
*/
function YangHui($iLine){
	$str = '';
    for ($i = 0;$i <= $iLine;$i++){//行  
        for ($j = 0;$j <= $i;$j++){//列  
            if ($i == $j){//行=列(也就是最后一列)或者第一行和第一列  
                $arr[$i][$j] = 1; 
                $str .= $arr[$i][$j]."<br>";
            }else if ($i != 0 && $j == 0){//行=列(也就是最后一列)或者第一行和第一列  
                $arr[$i][$j] = 1; 
                $str .= $arr[$i][$j]."&nbsp;";
            }else{ 
                $arr[$i][$j] = $arr[$i-1][$j]+$arr[$i-1][$j-1];//行+列的值=上一行2个值相加  
                $str .= $arr[$i][$j]."&nbsp;";
            } 
        } 
    } 
  	return $str; 
}

//echo YangHui(10);

//梵塔问题  
function hanoi($n,$a,$b,$c){
  	if($n == 1){   
  		move($a,1,$c);  
  	}else{
  	    hanoi($n-1,$a,$c,$b);   
  	    move($a,$n,$c);      
  	    move($n-1,$b,$a,$c);   
  	} 
}  
function move($a,$n,$c){  
	echo "move disk ".$n." from ".$a." to ".$c." <br>"; 
}  
//hanoi(3,'x','y','z'); 

/**
* 水仙花数
* @param int  $iLine 控制循环的行数
* Create Date 2014.09.29
* 水仙花数是指一个 n 位数 ( n≥3 )，它的每个位上的数字的 n 次幂之和等于它本身。（例如：1^3 + 5^3+ 3^3 = 153
* @author QZQ
*/
function narcissistic_number($start,$end){
	$arr = array();
	for($i=$start;$i<$end;$i++){ 
		$a = intval($i/100);  
		$b = intval($i/10)%10;  
		$c = $i%10;   
		if(pow($a,3)+pow($b,3)+pow($c,3)==$i){//公式
		   $arr[] = $i;   
		}
	}
	return $arr;
}	
//$arr = narcissistic_number(100,1000);
//echo "<pre>".print_r($arr,1)."</pre>";