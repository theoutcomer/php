<?php

class MediaSdk
{
    private $server = 'http://rm.21so.com';
//     private $server = 'http://localhost/21so_rm/backend/web';
    private $appid = '21jingji';
    private $secret = 'wee6etucityop';
    
    
    public function test(){
        $result = $this->login($this->appid, $this->secret);
        //var_dump($result);
        if($result['errno'] == '0'){
            $token = $result['data']['token'];
            $url = 'https://m.21jingji.com/article/20181122/herald/6534dbce270f8864ed95ce2cb0930837.html';
            $page = 1;
            $start_time = '2018-11-01 00:00:00';
            $result = $this->articleReprints($token, $url, $page, $start_time);
            var_dump($result);
        }else{
            var_dump($result['errno']);exit;
        }
    }
    
    /**
     * 登录接口
     */
    public function login($appid, $secret){
        $method = '/api.php?r=user/login';
        $parame = array(
            'appid' => $appid,
            'secret'=>$secret
        );
        
        $result = $this->httpGet($method, $parame);
        $result = json_decode($result, true);
        return $result;
    }
    /**
     * 获取转载文章接口
     * @param string $token      必填 login接口返回的token
     * @param string $url        必填 文章链接
     * @param string $page       必填 数码
     * @param string $start_time 可选，yyyy-mm-dd hh:ii:ss，只返回指定时间后的新数据
     * @return mixed
     */
    public function articleReprints($token, $url, $page, $start_time){
        $method = '/api.php?r=similarty/article-reprints';
        $parame = array(
            'url_id'=>$this->md5($url),
            'token'=>$token,
            'page'=>$page,
            'start_time'=>$start_time
        );
        //print_r($parame);
        //$result = $this->httpGet($method, $parame);
        $result = $this->httpPost($method, $parame);
        $result = json_decode($result, true);
        return $result;
    }
    
    public function md5($str){
        return bin2hex(md5($str,true));
    }
    
    private function httpGet($method, $parame)
    {
        $url = $this->server.$method;
        $data = "";
        foreach($parame as $key=>$value)
        {
            $data .= "&". $key."=".$value;
        }
        $url .= $data;
//         echo $url."\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    private function httpPost($method, $parame){
        $url = $this->server.$method;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parame);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
$mediaSdk = new MediaSdk();
$mediaSdk->test();
