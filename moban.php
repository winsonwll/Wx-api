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

    //设置所属行业
    /*$url = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.$token;
    $data = ' {
              "industry_id1":"1",
              "industry_id2":"4"
           }';*/

    //获取设置的行业信息
    //$url = 'https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token='.$token;
    //$result = get($url);


    $token = Token::getToken();
    //获得模板ID
    $tpl_url = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token='.$token;
    $tpl_data = ' {
           "template_id_short":"TM00015"
       }';

    $tpl_result = post($tpl_url, $tpl_data);
    $tpl_result = json_decode($tpl_result, true);
    $template_id = $tpl_result['template_id'];
    //echo $template_id;

    //获取模板列表
    //$url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.$token;
    //$result = get($url);

    //发送模板消息
    $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
    $data = ' {
           "touser":"oTUdgxFLC8k-P2b2z8jyGK0PSPUE",
           "template_id":"'.$template_id.'",
           "url":"http://weixin.qq.com/download",            
           "data":{
                   "first": {
                       "value":"恭喜你购买成功！",
                       "color":"#173177"
                   },
                   "keynote1":{
                       "value":"巧克力",
                       "color":"#173177"
                   },
                   "keynote2": {
                       "value":"39.8元",
                       "color":"#173177"
                   },
                   "keynote3": {
                       "value":"2014年9月22日",
                       "color":"#173177"
                   },
                   "remark":{
                       "value":"欢迎再次购买！",
                       "color":"#173177"
                   }
           }
       }';
    $result = post($url, $data);

    echo $result;
?>