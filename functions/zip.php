<?php 

//实例化类
$zip = new ZipArchive();
//需要打开的zip文件,文件不存在将会自动创建
$filename = "./test.zip";
 
if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    //如果是Linux系统，需要保证服务器开放了文件写权限
    exit("文件打开失败!");
}
 
//将一段字符串添加到压缩文件中,test.txt文件会自动创建
$zip->addFromString("test.txt", "你好 , 世界");
 
//将test.php文件添加到压缩文件中
$zip->addFile("system.php");
 
//输出加入的文件数 , 这里应该是 2
echo "文件数 : ".$zip->numFiles;
 
//关闭文件
$zip->close();

?>