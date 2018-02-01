<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/22 0022
 * Time: 11:13
 * 封装快递接口
 */

    class Kuaidi
    {
        public static function getCode($text)
        {
            //获取公司的名字
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

            return $str;
        }
    }