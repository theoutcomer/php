<?php
require_once("lib/Product.php");
require_once("lib/Account.php");
$product = new Product();
$account = new Account();
$data = array(
    'fundCodes' => '270050,000509,270041'
);
//$product->getFundTradeInfo();
$product->batchGetFunds($data);
//$account->getSurvey();
//$account->prepareBindYingmiPaymentMethod();


