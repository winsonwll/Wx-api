<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "wxdajiao");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{

    /**
     * GET请求携带四个参数
     * signature    微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数
     * timestamp    时间戳
     * nonce        随机数
     * echostr      随机字符串
     */
	public function valid()
    {
        $echoStr = $_GET["echostr"];        //随机字符串

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }

    /*加密/校验流程如下：
    1. 将token、timestamp、nonce三个参数进行字典序排序
    2. 将三个参数字符串拼接成一个字符串进行sha1加密
    3. 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信*/
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        //接收请求
        $signature = $_GET["signature"];        //签名
        $timestamp = $_GET["timestamp"];        //时间戳
        $nonce = $_GET["nonce"];                //随机数
        		
		$token = TOKEN;                         //密钥
		$tmpArr = array($token, $timestamp, $nonce);    //压入数组
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);             //用字典序排序
		$tmpStr = implode( $tmpArr );             //切割
		$tmpStr = sha1( $tmpStr );                //哈希加密
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>