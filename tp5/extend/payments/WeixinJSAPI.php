<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 微信支付  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace payments;

use think\Url;
use app\common\libs\Payment;

class WeixinJSAPI extends Payment
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'  => 'payments',    //隶属
            'code'        => 'WeixinJSAPI',     // 扩展器名称名
            'name'        => lang('WeixinJSAPI_payment'), // 扩展器名称翻译名
            'description' => lang('WeixinJSAPI_payment_desc'), // 扩展器名称翻译描述
            'version'     => '1.0',                                    //版本
            'author'      => 'Runtuer',                                //作者
            'website'     => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
    
            //限制平台
            'platform'   => array(
                'title'     => 'Platform',
                'type'      => 'radio',     //类型
                'default'   => 'wap_app',    //默认值
                'tip'       => lang('In wechat'),    //提示
                'option'    => [            //列出的可选值
                    'wap_app'  => 'Wap/App',
                ],
            ),
            
            //基本配置项
            'config'      => array(
                'pay_name' => array(
                    'title'    => 'Pay name',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'appid'    => array(
                    'title'    => 'Appid',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'mchid'    => array(
                    'title'    => 'Mchid',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'key'      => array(
                    'title'    => 'Apikey',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'secert'   => array(
                    'title'  => 'Api Secert',
                    'tip'    => 'only JSAPI must',
                    'type'   => 'string',
                    'length' => 300,
                ),
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'wechat.png',
                'appofficial' => 'https://pay.weixin.qq.com',       //官方
                'country'     => ['zh-cn'],   //适用国家
            ),
        );
    }
    
    /**
     * @Mark: 退款
     * @param $sendData
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/19
     */
    public function dorefund($sendData)
    {
        // TODO: Implement dorefund() method.
    }
    
    /**
     * @Mark:异步通知停止
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function notifyStop()
    {
        die("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");
    }
    
    /**
     * @Mark:获取提交地址
     * @return string Url提交地址
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function getSubmitUrl()
    {
        return 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    }
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $payment array 要传递的支付信息
     * $payment = [
     *      'OrderNO'   => '',
     *      'Name'      => '',
     *      'Amount'    => '',
     *      'appid'     =>
     *      'mch_id'    =>
     *      'key'       =>
     * ];
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function getSendData($payment)
    {
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        $return = array();
        
        //基本参数
        $return['appid']            = $payment['mch_id'] ? $payment['mch_id'] : $config['mch_id'];
        $return['mch_id']           = $payment['mch_id'] ? $payment['mch_id'] : $config['mch_id'];
        $return['nonce_str']        = rand(100000, 999999);
        $return['body']             = lang('WeixinJSAPI_payment');
        $return['out_trade_no']     = $payment['OrderNO'];
        $return['total_fee']        = $payment['Amount'] * 100;
        $return['spbill_create_ip'] = get_client_ip();
        $return['notify_url']       = $this->serverCallbackUrl;
        $return['trade_type']       = 'JSAPI';
        $return['openid']           = \app\common\libs\Wechat::getOpenId();
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter    = $this->paraFilter($return);
        
        //对待签名参数数组排序
        $para_sort      = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign         = $this->buildMysign($para_sort, $payment['key'] ? $payment['key'] : $config['key']);
        
        //签名结果与签名方式加入请求提交参数组中
        $return['sign'] = $mysign;
        
        $xmlData = $this->converXML($return);
        $result  = $this->curlSubmit($xmlData);
        
        //进行与支付订单处理
        $resultArray = $this->converArray($result);
        if (is_array($resultArray)) {
            //处理正确
            if (isset($resultArray['return_code']) && $resultArray['return_code'] == 'SUCCESS') {
                $resultArray['key']      = $payment['key'] ? $payment['key'] : $config['key'];
                $resultArray['order_no'] = $payment['OrderNO'];
                return $resultArray;
            } else {
                die($resultArray['return_msg']);
            }
        } else {
            die($result);
        }
        return null;
    }
    
    /**
     * @Mark:重载支付方法
     * @param $sendData
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function doPay($sendData)
    {
        if (isset($sendData['prepay_id']) && $sendData['prepay_id']) {
            $return = array();
            
            //基本参数
            $return['appId']     = $sendData['appid'];
            $return['timeStamp'] = time();
            $return['nonceStr']  = rand(100000, 999999);
            $return['package']   = "prepay_id=" . $sendData['prepay_id'];
            $return['signType']  = "MD5";
            
            //除去待签名参数数组中的空值和签名参数
            $para_filter = $this->paraFilter($return);
            
            //对待签名参数数组排序
            $para_sort = $this->argSort($para_filter);
            
            //生成签名结果
            $mysign = $this->buildMysign($para_sort, $sendData['key']);
            
            //签名结果与签名方式加入请求提交参数组中
            $return['paySign']      = $mysign;
            
            $return['successUrl']   = Url::build('stools/payment/succ', [], true, true);
            $return['failUrl']      = Url::build('stools/payment/fail', [], true, true);
            
            self::createPayHtml($return);
        } else {
            $message = $sendData['err_code_des'] ? $sendData['err_code_des'] : '微信下单API接口失败';
            die($message);
        }
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function callback($ExternalData, &$paymentId, &$money, &$message, &$orderNo)
    {
        // TODO: Implement callback() method.
    }
    
    /**
     * 同步支付回调
     * @param $callbackData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function servercallback($callbackData, &$payment, &$money, &$message, &$orderNo)
    {
        $return = array();
        
        //基本参数
        $return['appid']            = $payment['appid'];
        $return['mch_id']           = $payment['mch_id'];
        $return['nonce_str']        = rand(100000, 999999);
        $return['body']             = lang('WeixinJSAPI_payment');
        $return['out_trade_no']     = $payment['OrderNO'];
        $return['total_fee']        = $payment['Amount'] * 100;
        $return['spbill_create_ip'] = get_client_ip();
        $return['notify_url']       = $this->serverCallbackUrl;
        $return['trade_type']       = 'JSAPI';
        $return['openid']           = \app\common\libs\Wechat::getOpenId();
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($return);
        
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign = $this->buildMysign($para_sort, $payment['key'] ? $payment['key'] : $config['key']);
        
        //签名结果与签名方式加入请求提交参数组中
        $return['sign'] = $mysign;
        
        $xmlData = $this->converXML($return);
        $result  = $this->curlSubmit($xmlData);
        
        //进行与支付订单处理
        $resultArray = $this->converArray($result);
        if (is_array($resultArray)) {
            //处理正确
            if (isset($resultArray['return_code']) && $resultArray['return_code'] == 'SUCCESS') {
                $callbackData['buyer']      = $callbackData['buyer_email']; //支付账户
                $callbackData['time']       = strtotime($callbackData['notify_time']); //支付时间
                $callbackData['collection'] = $callbackData['seller_email']; //收款账户
                $this->writeTradeNo($callbackData, $payment);
    
                $resultArray['key']         = $payment['key'];
                $resultArray['order_no']    = $payment['OrderNO'];
                return $resultArray;
            } else {
                die($resultArray['return_msg']);
            }
        } else {
            die($result);
        }
        return null;
    }
    
    /**
     * @Mark:提交数据
     * @param xml $xmlData 要发送的xml数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function curlSubmit($xmlData)
    {
        //接收xml数据的文件
        $url = $this->getSubmitUrl();
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    /**
     * @Mark:从array到xml转换数据格式
     * @param $arrayData
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function converXML($arrayData)
    {
        $xml = '<xml>';
        foreach ($arrayData as $key => $val) {
            $xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
        }
        $xml .= '</xml>';
        return $xml;
    }
    
    /**
     * @Mark:从xml到array转换数据格式
     * @param $xmlData
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function converArray($xmlData)
    {
        $result    = array();
        $xmlHandle = xml_parser_create();
        xml_parse_into_struct($xmlHandle, $xmlData, $resultArray);
        
        foreach ($resultArray as $key => $val) {
            if ($val['tag'] != 'XML') {
                $result[$val['tag']] = $val['value'];
            }
        }
        return array_change_key_case($result);
    }
    
    /**
     * @Mark:除去数组中的空值和签名参数
     * @param $para 签名参数组
     * @return array 去掉空值与签名参数后的新签名参数组
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function paraFilter($para)
    {
        $para_filter = array();
        foreach ($para as $key => $val) {
            if ($key == "sign" || $key == "sign_type" || $val == "") {
                continue;
            } else {
                $para_filter[$key] = $para[$key];
            }
        }
        return $para_filter;
    }
    
    /**
     * @Mark:对数组排序
     * @param $para
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }
    
    /**
     * @Mark:生成签名结果
     * @param $sort_para
     * @param $key
     * @param string $sign_type 签名类型 默认值：MD5
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function buildMysign($sort_para, $key, $sign_type = "MD5")
    {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($sort_para);
        //把拼接后的字符串再与安全校验码直接连接起来
        $prestr = $prestr . '&key=' . $key;
        //把最终的字符串签名，获得签名结果
        $mysgin = md5($prestr);
        return strtoupper($mysgin);
    }
    
    /**
     * @Mark:按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    private function createLinkstring($para)
    {
        $arg = "";
        foreach ($para as $key => $val) {
            $arg .= $key . "=" . $val . "&";
        }
        
        //去掉最后一个&字符
        $arg = trim($arg, '&');
        
        //如果存在转义字符，那么去掉转义
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        
        return $arg;
    }
    
    /**
     * @Mark:输出支付中...页面
     * @param $data array
     * $data = [
     *      'appId'         =>
     *      'timeStamp'     =>
     *      'nonceStr'      =>
     *      'package'       =>
     *      'signType'      =>
     *      'paySign'       =>
     *      'successUrl'    =>
     *      'failUrl'       =>
     * ];
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    static private function createPayHtml(&$data)
    {
        $str = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微信支付</title>

<script type='text/javascript'>
function onBridgeReady()
{
	WeixinJSBridge.invoke
	(
		'getBrandWCPayRequest',
		{
			"appId" : "{$data['appId']}",//公众号名称，由商户传入
			"timeStamp":"{$data['timeStamp']}",//时间戳，自1970年以来的秒数
			"nonceStr" : "{$data['nonceStr']}", //随机串
			"package" : "{$data['package']}",//生成预付款订单
			"signType" : "{$data['signType']}",//微信签名方式:
			"paySign" : "{$data['paySign']}" //微信签名
		},
		function(res)
		{
			// 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
			if(res.err_msg == "get_brand_wcpay_request:ok")
			{
				window.location.href="{$data['successUrl']}";
			}
			else
			{
				window.location.href="{$data['failUrl']}";
			}
		}
	);
}

if(typeof WeixinJSBridge == "undefined")
{
	if( document.addEventListener )
	{
		document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
	}else if (document.attachEvent){
		document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
		document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
	}
}else{
	onBridgeReady();
}
</script>
</head>

<body>
	正在支付......
</body>

</html>
EOF;
        return $str;
    }
}