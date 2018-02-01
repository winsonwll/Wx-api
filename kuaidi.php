<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/22 0022
 * Time: 10:58
 */

    include "./function.php";
    /*$text = '9748905282403';
    $url = 'http://www.kuaidi100.com/autonumber/autoComNum?text='.$text;
    $res = get($url);

    //对结果进行解析
    $data = json_decode($res,true);
    //获取公司名字
    $company = $data['auto'][0]['comCode'];

    $q_url = 'http://www.kuaidi100.com/query?type='.$company.'&postid='.$text.'&id=1&valicode=&temp=0.08072763069936562';
    $result = get($q_url);
    $result = json_decode($result,true);

    $str = '';
    foreach ($result['data'] as $k=>$v){
        $str .= $v['time']."\r\n".$v['context']."\r\n";
    }

    echo $str;*/

    $res = Kuaidi::getCode('9748905282403');
    echo $res;
?>