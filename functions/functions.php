<?php 


    /**
     * [PHP发送POST请求 使用curl 来实现post提交数据]
     * @param  [type]  $url       [description]
     * @param  string  $post_data [description]
     * @param  integer $timeout   [description]
     * @return [type]             [description]
     */
    public static function post($url, $post_data = '', $timeout = 5){//curl
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($post_data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
 
    /**
     * [PHP发送POST请求 使用file_get_content 提交]
     * @param  [type]  $url       [description]
     * @param  string  $post_data [description]
     * @param  integer $timeout   [description]
     * @return [type]             [description]
    */ 
    public static function post2($url, $data){//file_get_content
        $postdata = http_build_query(
            $data
        );
        $opts = array('http' =>
                      array(
                          'method'  => 'POST',
                          'header'  => 'Content-type: application/x-www-form-urlencoded',
                          'content' => $postdata
                      )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
 
     /**
     * [PHP发送POST请求 使用fsocket 来实现post提交数据]
     * @param  [type]  $host       [description]
     * @param  string  $path [description]
     * @param  string $query   [description]
     * @param  string $others   [description]
     * @return [type]             [description]
     */ 
    public static function post3($host,$path,$query,$others=''){//fsocket
        $post="POST $path HTTP/1.1\r\nHost: $host\r\n";
        $post.="Content-type: application/x-www-form-";
        $post.="urlencoded\r\n${others}";
        $post.="User-Agent: Mozilla 4.0\r\nContent-length: ";
        $post.=strlen($query)."\r\nConnection: close\r\n\r\n$query";
        $h=fsockopen($host,80);
        fwrite($h,$post);
        for($a=0,$r='';!$a;){
                $b=fread($h,8192);
                $r.=$b;
                $a=(($b=='')?1:0);
            }
        fclose($h);
        return $r;
    }

    /**
     * [timediff description]
     * @param  [type] $begin_time [description]
     * @param  [type] $end_time   [description]
     * @return [type]             [description]
     */
    function timediff( $begin_time, $end_time ){
        if ( $begin_time < $end_time ) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval( $timediff / 86400 );
        $remain = $timediff % 86400;
        $hours = intval( $remain / 3600 );
        $remain = $remain % 3600;
        $mins = intval( $remain / 60 );
        $secs = $remain % 60;
        $res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
        return $res;
    }

    /**
    * [random description]
    * @param  [type] $length [description]
    * @param  string $chars  [description]
    * @return [type]         [description]
    */
    function random($length, $chars = '0123456789') {
        $hash = '';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * [_curl description]
     * @param  [type] $url    [description]
     * @param  string $method [description]
     * @param  array  $data   [description]
     * @return [type]         [description]
     */
    function _curl($url,$method = 'GET',$data = array(),$timeout = 5) {
        $ch = curl_init() ;
        curl_setopt($ch, CURLOPT_URL,$url);
        if($method=='POST') {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        //严格校验2
        if(strpos($url, 'https')!==false){
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        }
        $r = curl_exec($ch);
        //$curl_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $r;  
        
    }

    /**
     * [checkIP description]
     * @param  [type] $ip [description]
     * @return [type]     [description]
     */
    function checkIP($ip) {
       if (!empty($ip) && ip2long($ip)!=-1 && ip2long($ip)!=false) {
           $private_ips = array (
           array('0.0.0.0','2.255.255.255'),
           array('10.0.0.0','10.255.255.255'),
           array('127.0.0.0','127.255.255.255'),
           array('169.254.0.0','169.254.255.255'),
           array('172.16.0.0','172.31.255.255'),
           array('192.0.2.0','192.0.2.255'),
           array('192.168.0.0','192.168.255.255'),
           array('255.255.255.0','255.255.255.255')
           );

           foreach ($private_ips as $r) {
               $min = ip2long($r[0]);
               $max = ip2long($r[1]);
               if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
           }
           return true;
       } else { 
           return false;
       }
    }

    /**
     * [determineIP description]
     * @return [type] [description]
     */
    function determineIP() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            if (checkIP($_SERVER["HTTP_CLIENT_IP"])) {
                return $_SERVER["HTTP_CLIENT_IP"];
            }
        }
        foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
            if (checkIP(trim($ip))) {
                return $ip;
            }
        }
        if (checkIP($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (checkIP($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
            return $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
        } elseif (checkIP($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (checkIP($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    /**
     * [arrayToObject description]
     * @param  [type] $e [description]
     * @return [type]    [description]
     */
    function arrayToObject($e){
        if( gettype($e)!='array' ) return;
        foreach($e as $k=>$v){
            if( gettype($v)=='array' || getType($v)=='object' )
                $e[$k]=(object)arrayToObject($v);
        }
        return (object)$e;
    }

    /**
     * [objectToArray description]
     * @param  [type] $e [description]
     * @return [type]    [description]
     */
    function objectToArray($e){
        $e=(array)$e;
        foreach($e as $k=>$v){
            if( gettype($v)=='resource' ) return;
            if( gettype($v)=='object' || gettype($v)=='array' )
                $e[$k]=(array)objectToArray($v);
        }
        return $e;
    }

?>