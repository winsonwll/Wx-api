<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 16:45
 */
    include './function.php';
    //获取token
    $appid = 'wxa1176009fc6cee0e';
    $appsecret = '681895fcadb901adfd5b7ccd6d68d52a';
    $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $res = get($token_url);
    $res = json_decode($res, true);
    $token = $res['access_token'];

    //添加客服账号
    /*$url = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.$token;
    $data = '{
                 "kf_account" : "test1@test",
                 "nickname" : "客服1",
                 "password" : "pswmd5",
            }';*/


    $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$token;
    //发送文本消息
    /*$data = '{
                "touser":"oTUdgxFLC8k-P2b2z8jyGK0PSPUE",
                "msgtype":"text",
                "text":
                {
                     "content":"asasas"
                }
            }';*/

    //发送图文消息
    $data = '{
                "touser":"oTUdgxFLC8k-P2b2z8jyGK0PSPUE",
                "msgtype":"news",
                "news":{
                    "articles": [
                     {
                         "title":"Happy Day",
                         "description":"Is Really A Happy Day",
                         "url":"https://www.baidu.com/",
                         "picurl":"https://www.baidu.com/img/bd_logo1.png"
                     },
                     {
                         "title":"111",
                         "description":"2222",
                         "url":"https://www.baidu.com/",
                         "picurl":"https://www.baidu.com/img/bd_logo1.png"
                     }
                     ]
                }
            }';

    $result = post($url, $data);
    echo $result;
?>