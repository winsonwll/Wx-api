<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 17:24
 */
    include './function.php';
    //获取token
    /*$appid = 'wxa1176009fc6cee0e';
    $appsecret = '681895fcadb901adfd5b7ccd6d68d52a';
    $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $res = get($token_url);
    $res = json_decode($res, true);
    $token = $res['access_token'];*/

    $token = Token::getToken();
    $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$token;
    $data = '{
               "filter":{
                  "is_to_all":true
               },
               "text":{
                  "content":"CONTENT"
               },
                "msgtype":"text"
            }';

    $result = post($url, $data);
    echo $result;

?>