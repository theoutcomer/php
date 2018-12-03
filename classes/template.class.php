<?php

   #====================================================

   # Filename:template.class.php
   # Note: 模板操作类
   # author:hxhui08
   # date:2009-03-24

   #====================================================
   
   
   class  TEMPLATE
   {
                   
               
                      private  $path = "." ;          #根目录         
                              
                   private $var;
                   
                   private $tplDir = "template"; #模板存储目录
                   
                   private $tplExt = "tpl";      #模板文件的后缀名
                   
                   private $tplId = 0 ;   #模板的ID号
                   
                   private $compileDir = "template_c";  #编译后的php文件存放目录
                   
                   private $isCache=false ; #是否用缓存 （默认不启动）
                   
                   private $cacheId = 1; #缓存文件ID号
                   
                   private $cacheLeftTime=3600; #缓存有效期 (默认保存3600秒)
                   
                   private $cacheDir = "cache"; #缓存文件存储目录
                   
                   private $autoRefresh = false ; #是否自动刷新
                   
                   private $pattern = array(
                   
                                           "/(\{dw:)\s*include\s*filename=\s*\"(.+\..+)\s*\"\s*(\/\})/i",#包含文件
                                           "/(\{dw:)\s*field\.(.+)\s*(\/\})/i",#局部变量
                                           "/(\{dw:)\s*global\.(.+)\s*(\/\})/i",#全局变量
                                           "/(\{dw:)\s*foreach\s*(.+)\s*as\s*(.+)\s*(\/\})/i",#foreach 语句
                                           "/(\{dw:)\s*end\s*foreach\s*(\/\})/i",           #foreach 结束
                                           "/(\{dw:)\s*if\s*\((.+)\)(\/\})/i",
                                           "/(\{dw:)\s*elseif\s*\((.+)\)(\/\})/i",
                                           "/(\{dw:)\s*else\s*(\/\})/i",
                                           "/(\{dw:)\s*end\s*if\s*(\/\})/i",
                                                                 
                                );
                   
                   private $replacement = array(
                   
                                           '<?php echo $this->inc_file("\\2"); ?>',
                                           "<?php echo $\\2;?>",
                                           "<?php global $\\2;\n echo $\\2; ?>",
                                           "<?php foreach($\\2 as $\\3){ ?>",
                                           "<?php } ?>",
                                           "<?php if (\\2) {  ?>" ,
                                           "<?php }else if(\\2){ ?>",
                                           "<?php }else{ ?>",
                                           "<?php  } ?>",
                                           
                                           
                                           
                                           
                                                                                                   
                                                                   );
                   
                   
                   #构造函数
                   
                   function __construct($path = "", $tplDir="", $compileDir="",$isCache="",$cacheLeftTime="",$cacheDir="" ,$autoRefresh="")
                   {
                           $this->path = $path ? $path : $this->path ;
                           
                           $this->tplDir = $tplDir ? $tplDir : $this->tplDir ;
                           
                           $this->compileDir = $compileDir ? $compileDir : $this->compileDir ;
                           
                           $this->isCache = is_bool($isCache) ? $isCache : $this->isCache ;
                           
                           $this->cacheLeftTime = $cacheLeftTime ? $cacheLeftTime : $this->cacheLeftTime ;
                           
                           $this->cacheDir = $cacheDir ? $cacheDir : $this->cacheDir ;
                           
                           $this->autoRefresh = is_bool($autoRefresh) ? $autoRefresh : $this->autoRefresh ;
                   }
                   
                   
                   #兼容php4
                   
                   function TEMPLATE($path = "", $tplDir="", $compileDir="",$isCache="",$cacheLeftTime="",$cacheDir="" ,$autoRefresh="")
                   {
                           $this->__construct($path = "", $tplDir="", $compileDir="",$isCache="",$cacheLeftTime="",$cacheDir="" ,$autoRefresh="");
                   }
                   function  __get($property)
                   {
                           return $this->$property ;
                   }
                   
                   
                   function __set($property,$value)
                   {
                           return $this->$property = $value ;
                   }
                   
                   
                   
        #给模板中的变量赋值 
        # $tplVal 模板中的变量名                   
                   
                   function assign($tplVal ,$value="")
                   {
                           if (is_array($tplVal))
                           {
                                   foreach ($tplVal as $key => $val)
                                   {
                                           if (!empty($key))
                                           
                                           $this->var[$key] = $val ;
                                   }
                           }
                           else {
                                   if (!empty($tplVal))
                                   
                                   $this->var[$tplVal] = $value ;
                           }
                   }
                   
                   #输出文件内容函数
                   
                   function display($tplFile,$tplId=0,$cacheId = 1,$cacheLeftTime="")
                   {
                           if (empty($tplFile)) die("Template \"{$tplFile}\" not exist !");
                           
                           $this->cacheId = $cacheId ?  md5($cacheId) : md5($this->cacheId);
                           
                           $cacheFile = $this->path. "/".$this->cacheDir."/".$tplFile.$this->cacheId ; 
                           
                           if ($this->check_cache($cacheFile,$cacheLeftTime))  #当缓存文件存在且不过期时直接从缓存文件读取内容
                           {
                                   echo $this->read_file($cacheFile);
                           }else {
                           
                              $tpl = $this->path."/".$this->tplDir."/".$tplFile.".".$this->tplExt;
           
                              $tplContent = $this->read_file($tpl);   #读取模板文件的内容
           
                             $compileContent= $this->compile_file($tplContent); #对读取出来的文件进行编译
            
                             $this->tplId = $tplId ? $tplId : $this->tplId ;
            
                             $compileFile = $this->path."/".$this->compileDir."/".md5($this->tplId)."".$tplFile.".php";
            
                             $this->write_file($compileFile,$compileContent);#将编译后的内容写入相应的文件中;
                           
                           @extract($this->var);
                           
                        ob_start();
                           
                           include_once($compileFile);
                           
                           $content = ob_get_contents() ;
                           
                           ob_end_clean() ;
                           
                           if ($this->isCache){
                                                      
                            $this->write_file($cacheFile,$content) ;# 帮编译好的内容写入缓存文件
                           }
                           
                           echo $content ;
                           
                           }
                   }
                   
                   
/*                   function  trim_tag($content)
                   {
                           $content = str_replace($this->startTag,"",$content);
                           
                           $content = str_replace($this->endTag,"",$content);
                                   
                           //$content = trim($content);
                           
                           return $content ;
                   }*/
                   
                   # 编译文件函数
                   
                   function compile_file($content=null)
                   {
                           
                           $content = $content ? $content :die("Compile fail!") ;
                           
                           //$content = $this->trim_tag($content);
                           
                           $content = preg_replace($this->pattern,$this->replacement,$content);
                           
                           return $content;
                           
                   }
                   
                   #解析包含文件
                   
                   function inc_file($filename,$tplId="",$cacheId="",$cacheLeftTime="")
                   {  
                           $file = $this->path."/".$this->tplDir."/".$filename ;
                           
                           if (file_exists($file))
                           {
                                   $filename = str_replace(".".$this->tplExt,"",$filename);
                                   
                           return         $this->display($filename,$tplId,$cacheId,$cacheLeftTime);
                           }
                           else die("Template \"{$filename}\" not exist");
                   }
                           
                   #读取文件内容函数
                   
                   function  read_file($filename)
                   {
                           if (!file_exists($filename)) die("Read file fail") ;
                           
                           return file_get_contents($filename);
                   }
                   
                   #内容写入函数
                   
                   function write_file($filename,$content,$mode="wb")
                   {
                           
                           $filename = trim($filename);
                           
                           $content = $content ? stripslashes(trim($content)) : exit();
                           
                           if (!file_exists($filename))
                           {
                                   $array = explode("/",$filename);
                                   
                                   $count = count($array);
                                   
                                   $path = "";
                                   
                                   for ($i = 0 ; $i <$count-1 ; ++$i )
                                   {
                                           if(!file_exists($path .= $array[$i]."/"))
                                           {
                                                   mkdir($path,0777);
                                           }
                                   }
                           }
                           $handle = fopen($filename,$mode) ;
                           
                           fwrite($handle,$content);
                           
                           fclose($handle);
                           
                           return true;        
                   }
                   
                   
                   
                   # 清除缓存
                   
                   function clear_dir($dir="")
                   {
                           
                           $dir = $this->path."/".$dir;
                           
                           $handle = opendir($dir);
                           
                           if (file_exists($dir))
                           {
                                   while ($file = readdir($handle))
                                   {
                                           if ($file !="." && $file != "..")
                                   
                                           unlink($dir."/".$file);
                                   }
                           
                             closedir($handle);
                             
                             return true;
                           }
                           
                           else {
                                   return false;
                           }
                           
                           
                   }
                   
                   #清除所有缓存
                   
                   function clear_all_cache()
                   {
                           if ($this->clear_dir($this->cacheDir) && $this->clear_dir($this->compileDir)) 
                                   
           
                           return true;
                   }
                   
                   
                   
                   #检查缓存是否过期
                   
                   function check_cache($cacheFile,$cacheLeftTime="")
                   {
                           
                           $cacheLeftTime = $cacheLeftTime ? $cacheLeftTime : $this->cacheLeftTime;
                           
                           if (!file_exists($cacheFile)) return false ;
                           
                          $time = $this->get_time($cacheFile) + $cacheLeftTime ;
                           
                           if ($time <time())
                           {
                                   unlink($cacheFile);
                                   
                                   
                                   
                                   return false;
                           }
                           
                           return true;
                           
                   }
                   
                   
                   
                   # 获取文件最后编辑时间
                   
                   function get_time($filename)
                   {
                           if (!file_exists($filename)) return false;
                           
                           return filemtime($filename);
                   }
                   
                   
                   
   }
                   



   
   ?>

