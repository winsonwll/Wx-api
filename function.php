<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 16:26
 */

    // 获取token 得先发送请求
    // 使用curl方法
    function get($url)
    {
        // 初始化 curl
        $ch = curl_init($url);

        // 参数设置
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // 执行发送请求
        $res = curl_exec($ch);

        return $res;
    }

    //post 传输
    function post($url, $data)
    {
        // 初始化 curl
        $ch = curl_init($url);

        // 参数设置
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // 执行发送请求
        $res = curl_exec($ch);

        return $res;
    }

    //自动加载类
    function __autoload($className)
    {
        if(file_exists('./Controller/'.$className.'.php')){
            include './Controller/'.$className.'.php';
        }
    }
?>