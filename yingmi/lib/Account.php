<?php
require_once('Yingmi.php');
class Account extends Yingmi{

    public function prepareBindYingmiPaymentMethod(){
        $urlpath = '/account/prepareBindYingmiPaymentMethod';
        $account = array(
            'accountName' => '赵崇贺',//投资者实名
            'identityType' => 0,//投资者证件类型,0 身份证
            'identityNo' => '440782198803175316',//投资者证件号
            'paymentType' => 'bank:002',//支付方式 银行代码
            'paymentNo' => '6242263602024045791',//支付代码 银行卡号
            'phone' => '15013065796',//投资者在注册支付方式时记录的电话号码
        );
        $res = $this->yingmiHttp($urlpath,$account,'POST');
        var_dump($res);
    }

    public function getSurvey(){
        $urlpath = '/account/getSurvey';
        $method = 'GET';
        $data = array(
            'surveyId' =>2
        );
        $questions = $this->yingmiHttp($urlpath,$data,$method);
        var_dump($questions);

    }
}