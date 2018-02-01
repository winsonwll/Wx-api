<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 17:54
 * 封装Token
 */
    class Token
    {
        public static $tokenFile = './token.txt';   //缓存token
        public static $tokenTime = 3600;                   //有效期

        //获取token
        public static function getToken()
        {
            //判断缓存是否合法
            if(!self::checkTokenExists() || !self::checkTokenExpire()){
                //请求token
                $res = self::requestToken();
                //存入缓存
                self::writeToken($res);
                return $res;
            }else{
                //读取缓存
                return self::readToken();
            }
        }

        //请求token
        public static function requestToken()
        {
            $appid = 'wxa1176009fc6cee0e';
            $appsecret = '681895fcadb901adfd5b7ccd6d68d52a';
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
            $res = get($url);
            $res = json_decode($res, true);
            $token = $res['access_token'];
            if(!empty($token)){
                return $token;
            }else{
                return false;
            }
        }

        //写入缓存
        public static function writeToken($token)
        {
            file_put_contents(self::$tokenFile, $token);
        }

        //读取缓存
        public static function readToken()
        {
            return file_get_contents(self::$tokenFile);
        }

        //判断缓存是否存在
        public static function checkTokenExists()
        {
            return file_exists(self::$tokenFile);
        }

        //判断缓存是否有效
        public static function checkTokenExpire()
        {
            return filemtime(self::$tokenFile) + self::$tokenTime < time();
        }
    }