<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/22 0022
 * Time: 10:35
 */
    include './function.php';
    $token = Token::getToken();

    //创建自定义菜单
    $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;
    $data = ' {
             "button":[
             {	
                  "type":"click",
                  "name":"今日歌曲",
                  "key":"V1001_TODAY_MUSIC"
              },
              {
                    "type": "scancode_waitmsg", 
                    "name": "扫码推事件", 
                    "key": "sao"
                },
              {
                   "name":"菜单",
                   "sub_button":[
                   {	
                       "type":"view",
                       "name":"搜索",
                       "url":"http://www.soso.com/"
                    },
                    {
                        "type": "pic_weixin", 
                        "name": "微信相册发图", 
                        "key": "wxphoto"
                    },
                    {
                       "type":"click",
                       "name":"赞一下我们",
                       "key":"V1001_GOOD"
                    }]
               }]
         }';
    $res = post($url,$data);
    echo $res;
?>