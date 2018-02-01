<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 16:33
 */

    include './function.php';

    $appid = 'wxa1176009fc6cee0e';
    $appsecret = '681895fcadb901adfd5b7ccd6d68d52a';
    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $res = get($url);
    $res = json_decode($res, true);
    $token = $res['access_token'];

    echo $token;
?>