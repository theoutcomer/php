<?php 
header("Content-type: text/html; charset=utf-8");  
require "/xloger.php";
echo "<pre>";
echo "写入10000条日志\n";
$month = date("m");
$day = date("d");
$loger = XLoger::fileLoger("test_{$month}{$day}.log");
$start = microtime(true);
for($i=0; $i<10000; $i++){
    $loger->log($i, uniqid());
}
$end = microtime(true);
echo("Network fileloger time: ".($end-$start)."\n" );

$start = microtime(true);
for($i=0; $i<10000; $i++){
    # 如果open和close放循环外, 性能将大幅提升
    $f = fopen("test.log", "a+"); 
    fwrite($f, "{$i} ".uniqid()."\n");
    fclose($f);
}
$end = microtime(true);
print_r("Local file write time: ".($end-$start)."\n" );
echo "</pre>";

?>