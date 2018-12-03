<?php
require_once("function.php");
/**
 * @ignore
 */
class YingmiException extends Exception {
    // pass
}

class Yingmi{
    //=======【基本信息设置】=====================================
    //
    /**
     * TODO: 这里配置为盈米财富分配的商户信息
     * 盈米财富信息配置
     *
     * APIKEY：是一个唯一的代码用于识别调用者身份
     *
     * APPSECRET：是一段密文，用于产生请求签名
     * @var string
     */
    const APIKEY = '81321308-a0c8-4add-955e-08aff93ff8df';
    const APISECTET = 'b3tsvu4WX9OGnHhgyQGnYkVsQr8yrY5w';

    //=======【证书路径设置】=====================================
    /**
     *  ：设置商户证书路径
     * 证书路径,注意应该填写绝对路径
     * @var path
     */
    const SSLCERTCRT_PATH ='./cert/openapi-test-cert-1071.crt';
    const SSLCERTKEY_PATH ='./cert/openapi-test-cert-1071.key';

    /**
     * @var array接口公共参数
     */
    public $parameter = array();

    //实时接口
    public $development_apiUrl = 'https://api-test.frontnode.net/v1'; // 测试环境
    public $product_apiUrl = 'https://api.yingmi.cn/v1 '; //生产环境

    //文件接口
    public $development_fileUrl = 'https://file-test.frontnode.net/v1';// 测试环境
    public $product_fileUrl = 'https://api-file.yingmi.cn/v1'; //生产环境

    /**
     * @var \签名算法版本，目前只支持“1”
     */
    public $sigVer = 1;

    public function __construct(){
        header("Content-type: text/html; charset=utf-8");
        //初始化公共参数
        $this->parameter = array(
            'key' => self::APIKEY,
            'ts' => getISOTime(),
            'nonce' => random(10),
            'sigVer' => $this->sigVer,
        );
    }

    /**
     * 生成实时接口GET方法的请求地址
     * @param $data array 接口所需参数
     * @param $urlpath 接口相对路径
     * @return string GET请求的地址
     * @return array|bool 返回盈米请求结果
     */
    public function yingmiHttp($urlpath,$data=array(),$method)
    {
        if($method != 'GET' && $method != 'POST')return false;
        $parameter = $this->parameter;//获取公共参数
        //计算sig签名
        if(is_array($data) && !empty($data)){
            $parameter = array_merge($parameter,$data);
        }
        ksort($parameter);
        foreach($parameter as $key=>$val){
            $sendData[] = $key.'='.$val;
        }
        $str = implode('&',$sendData);
        $unifiedString  = $this->unifiedString($method,$urlpath,$str);
        $sig = $this->SetSig($unifiedString);
        $str .= '&sig='.urlencode($sig);
        //发送请求
        if($method == 'GET'){
            $url = $this->development_apiUrl.$urlpath.'?'.$str;
            $res = $this->http($url,$method);
        }else if($method == 'POST'){
            $res = $this->http($this->development_apiUrl.$urlpath,$method,$str);
        }
        return $res;
    }


    /**
     * @param $unifendStr 规范化字符串
     * @return string 生成签名
     */
    protected function SetSig($unifendStr)
    {
        $sig = base64_encode(hash_hmac("sha1",$unifendStr,self::APISECTET, true));
        return $sig;
    }

    /**
     * @param $httpMethod 请求方法
     * @param $urlPath 接口path
     * @param $string 请求参数
     * @return bool|string 返回规范化字符串
     */
    public function unifiedString($httpMethod,$urlPath,$string)
    {
        if($httpMethod == 'GET' || $httpMethod == 'POST'){
            return $httpMethod.':'.$urlPath.':'.$string;
        }else{
            return false;
        }
    }

    /**
     * Make an HTTP request
     * @param 发送请求
     * @return array API results
     * @ignore
     */
    private function http($url,$method='',$data='')
    {
        if($url){
            $curl = curl_init();
            if($method && $method == 'POST'){
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl, CURLOPT_VERBOSE, '1');
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '1');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '1');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 检查证书中是否设置域名,0不验证
            curl_setopt($curl, CURLOPT_SSLCERT, self::SSLCERTCRT_PATH); //client.crt文件路径
            curl_setopt($curl, CURLOPT_SSLKEY, self::SSLCERTKEY_PATH); //client.key文件路径
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $res = curl_exec($curl);
            return json_decode($res,true);
        }
        return false;
    }

    function _curl($url,$method = '',$data = array()) {
        $ch = curl_init() ;
        curl_setopt($ch, CURLOPT_URL,$url);
        if($method) {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $r = curl_exec($ch);
        //$curl_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $r;
    }



}