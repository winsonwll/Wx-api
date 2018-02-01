<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/22 0022
 * Time: 10:23
 */

    include './function.php';

    $token = Token::getToken();

    //创建分组
    /*$url = 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$token;
    $data = '{"group":{"name":"mpb"}}';
    $res = post($url,$data);*/

    //查询所有分组
    /*$url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$token;
    $res = get($url);*/

    //查询用户所在分组
    $url = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.$token;
    $data = '{"openid":"oTUdgxFLC8k-P2b2z8jyGK0PSPUE"}';
    $res = post($url,$data);

    //移动用户分组
    /*$url = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token='.$token;
    $data = '{"openid":"oTUdgxFLC8k-P2b2z8jyGK0PSPUE","to_groupid":100}';
    $res = post($url,$data);*/


    echo $res;
?>