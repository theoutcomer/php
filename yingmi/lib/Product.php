<?php
require_once('Yingmi.php');
class Product extends Yingmi{
    public function batchGetFunds($product){
        $urlpath = '/product/batchGetFunds';
        $method = 'GET';
        $res = $this->yingmiHttp($urlpath,$product,$method);
        var_dump($res);
    }

    public function getFundTradeInfo(){
        $product = array('fundCode'=>'000509');
        $urlpath = '/product/getFundAnnouncement';
        $method = 'GET';
        $res = $this->yingmiHttp($urlpath,$product,$method);
        var_dump($res);
    }

}