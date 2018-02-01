<?php
/**
 * Created by PhpStorm.
 * User: linlinwang
 * Date: 2017/2/21 0021
 * Time: 14:37
 */
    include './function.php';

    //发送消息
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    file_put_contents('./data.txt',$postStr);   // 不用echo 防止微信服务器把echo的数据返回给用户

    //回复消息
    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);     // 接收到的数据 转化XML对象
    $fromUsername = $postObj->FromUserName;     //用户id
    $toUsername = $postObj->ToUserName;         //商户id
    $keyword = trim($postObj->Content);         //内容
    $time = time();

    /**
     * 回复文本消息：
     * ToUserName   接收方帐号（收到的OpenID）
     * FromUserName 开发者微信号
     * CreateTime   消息创建时间 （整型）
     * MsgType      text
     * Content      回复的消息内容（换行：在content中能够换行，微信客户端就支持换行显示）
     */
    /*echo "<xml>
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
            <CreateTime>".$time."</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[你好]]></Content>
            </xml>";*/

    /**
     * 回复图片消息：
     * ToUserName   接收方帐号（收到的OpenID）
     * FromUserName 开发者微信号
     * CreateTime   消息创建时间 （整型）
     * MsgType      image
     * MediaId      通过素材管理接口上传多媒体文件，得到的id
     */
    /*echo "<xml>
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
            <CreateTime>".$time."</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[Nhksl7yDn3U8Swad13ysj6O2w-NFhHBgiwdOHyc6XvjacAIxV4YlK5WRs5f0bqmi]]></MediaId>
            </Image>
            </xml>";*/

    /**
     * 回复语音消息：
     * ToUserName   接收方帐号（收到的OpenID）
     * FromUserName 开发者微信号
     * CreateTime   消息创建时间 （整型）
     * MsgType      语音，voice
     * MediaId      通过素材管理接口上传多媒体文件，得到的id
     */
    /*echo "<xml>
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
            <CreateTime>".$time."</CreateTime>
            <MsgType><![CDATA[voice]]></MsgType>
            <Voice>
            <MediaId><![CDATA[t-bZkxVfR3EDjWwn-v65w_cJjrqjaU88FrPNsv66EbiqJIWE2oHgoUVKbRf8bk2W]]></MediaId>
            </Voice>
            </xml>";*/

    /**
     * 回复图文消息：
     * ToUserName   接收方帐号（收到的OpenID）
     * FromUserName 开发者微信号
     * CreateTime   消息创建时间 （整型）
     * MsgType      news
     * ArticleCount 图文消息个数，限制为10条以内
     * Articles     多条图文消息信息，默认第一个item为大图,注意，如果图文数超过10，则将会无响应
     * Title        否   图文消息标题
     * Description  否   图文消息描述
     * PicUrl       否   图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
     * Url          否   点击图文消息跳转链接
     */
    /*echo "<xml>
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
            <CreateTime>".$time."</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>2</ArticleCount>
            <Articles>
            <item>
            <Title><![CDATA[111]]></Title> 
            <Description><![CDATA[1111]]></Description>
            <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/CtGAEfrTiabtibRBZ8exMKoIXTTC0RPeJSJ2Jdoww8XfLchZJqkQeAlkQExN1rK4x54HenZjZve6EgdfnSb3EicXg/0]]></PicUrl>
            <Url><![CDATA[https://www.baidu.com/]]></Url>
            </item>
            <item>
            <Title><![CDATA[222]]></Title>
            <Description><![CDATA[2222]]></Description>
            <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/CtGAEfrTiabtibRBZ8exMKoIXTTC0RPeJSJ2Jdoww8XfLchZJqkQeAlkQExN1rK4x54HenZjZve6EgdfnSb3EicXg/0]]></PicUrl>
            <Url><![CDATA[https://www.baidu.com/]]></Url>
            </item>
            </Articles>
            </xml>";*/

    /**
     * 扫码推事件
     * ToUserName   开发者微信号
     * FromUserName 发送方帐号（一个OpenID）
     * CreateTime   消息创建时间（整型）
     * MsgType      消息类型，event
     * Event        事件类型，scancode_push
     * EventKey     事件KEY值，由开发者在创建菜单时设定
     * ScanCodeInfo 扫描信息
     * ScanType     扫描类型，一般是qrcode
     * ScanResult   扫描结果，即二维码对应的字符串信息
     */
    //接收事件
    $eventKey = $postObj->EventKey;
    switch ($eventKey){
        case 'sao':
            //扫描结果 运单号
            $temp = $postObj->ScanCodeInfo->ScanResult;

            $text = explode(',',$temp);
            $code = $text[1];
            $res = Kuaidi::getCode($code);

            //回复给用户
            echo "<xml>
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                    <CreateTime>".$time."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[".$res."]]></Content>
                    </xml>";
            break;
        default:
            echo "<xml>
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
                    <CreateTime>".$time."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[你好你好]]></Content>
                    </xml>";
            break;
    }

?>