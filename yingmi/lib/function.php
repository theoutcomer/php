<?php
//生成随机验证码
function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

function getISOTime() {
    list($t1, $t2) = explode(' ', microtime());
    $millisecond = (float)sprintf('%.0f',(floatval($t1))*1000);
    $datetime = new DateTime(date("Y-m-d H:i:s",time()));
    $time = str_replace('+0800','.'.$millisecond,$datetime->format(DateTime::ISO8601));
    return $time;
}