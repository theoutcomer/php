<?php

/*
验证签名：
data：原文
signature：签名
返回：签名结果，true为验签成功，false为验签失败
*/
function wiipay_verify($data, $signature){
	$pubKey = file_get_contents('./certs/wiipay_public_key.pem');  
	$res = openssl_get_publickey($pubKey); 
	
	//$result:验签结果；为1时，验签正确；其余失败。 
	$result = (bool)openssl_verify($data, base64_decode($signature), $res);
	openssl_free_key($res);
	return $result;
}

$content = "operatorType=CM&operatorTypeTile=移动&channelCode=200000&appCode=174670001&payCode=0002&imsi=460000761863334&tel=null&state=success&price=10&bookNo=A12161530328264805&date=20141216153039&devPrivate=eyJvcmRlcklkIjoiMTAxNDEyMTYwMTYyOTUifQ==&synType=wiipay";
$sig = "T+VKF+NZhq3Y/YDUvBbKDSL8ihNONOzI2TRXfHrJlb3r7KyQ9qkDCaCQMMh0o7+4WA8K8WIdzsgZLM+UtTTomkY25satGgIcwt11/ucLSuqX3ahKNtoR83SuBSmHc7NAGVPGGZUacLJZNYsd3fpxvlvdBHHsPcpcsPBIYrnc1SL7sPzOOVVz6jaZBiARdh/5V5Ml3dRVpN8TOSq1uz/um/ZPywtcau1rp3Iz7Wu0+jtYE18j2XINTkhMnSj2Oht7aVwaD2GqNFFStFEPASfUbh0XbOgvk7ps+vtrOyggZaQwPjJzcIvlcjjqnsx7ZevzxsDWXD4R7zRm4yRyl2M2OA==";
	
$verity_result = wiipay_verify($content,$sig);
if($verity_result == 1){
	echo "success\n";
}else{
	echo "fail\n";
}
?>
