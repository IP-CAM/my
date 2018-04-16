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
// | 阿里跨境支付  Version 2016/11/25
// +----------------------------------------------------------------------
namespace seapays;

use app\common\libs\Seapyment;

class Alipay extends Seapyment
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'  => 'seapays',  //隶属
            'code'        => 'Alipay',    // 扩展器名称名
            'name'        => lang('Alipay_seapays'), // 扩展器名称翻译名
            'description' => lang('Alipay_seapays_desc'), // 扩展器名称翻译描述
            'official'    => 'http://www.alipay.com',               //官方
            'version'     => '1.0',                                 //版本
            'author'      => 'Runtuer',                             //作者
            'website'     => 'http://www.runtuer.com',              //出处
            'upgrade'     => '/cmfup/ver2.php',                       //升级位置
            //基本配置项
            'config'      => array(
                'pay_name'      => array(
                    'title'    => 'Pay name',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'parterid'      => array(
                    'title'    => 'Parter ID',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'key'           => array(
                    'title'    => 'Payment key',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'account'       => array(
                    'title'    => 'Pay account',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                /*'refundsappid' => array(
                    'title'     => 'Refunds appID',
                    'type'      => 'string',
                    'suffix'    => lang('Mayijinfu appid'),
                ),
                'refundsappkey' => array(
                    'title'     => 'Refunds appkey',
                    'type'      => 'string',
                    'suffix'    => lang('Mayijinfu appkey'),
                ),*/
                'pay_fee'       => array(
                    'title'    => 'Pay fee',
                    'type'     => 'number',
                    'validate' => 'required',
                    'suffix'   => '%',
                ),
                'currency_code' => array(
                    'title'    => 'Default currency_code',
                    'type'     => 'select',
                    'validate' => 'required',
                    'default'  => 'CNY',
                    'option'   => [
                        'CNY' => 'CNY',
                        'HKD' => 'HKD',
                        'USD' => 'USD',
                        'CAD' => 'CAD',
                        'EUR' => 'EUR',
                        'GBP' => 'GBP',
                        'AUD' => 'AUD',
                    ],
                ),
                'warehouse'     => array(
                    'title'    => 'Storehouse',
                    'type'     => 'string',
                    'length'   => 260,
                    'tip'      => 'A001;B001;C001;D001',
                    'validate' => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'alipay.png',
                'appofficial' => 'https://www.alipay.com/',         //官方
                'country'     => ['zh-cn'],   //适用国家
            ),
        
        );
    }
    
    /**
     * @Mark:异步通知停止
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function notifyStop()
    {
        echo "success";
    }
    
    /**
     * @Mark:获取提交地址
     * @return string Url提交地址
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function getSubmitUrl()
    {
        return "https://mapi.alipay.com/gateway.do?_input_charset=utf-8";
    }
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $payment array 要传递的支付信息
     * $payment = [
     *      'OrderNO'   => '',
     *      'Name'      => '',
     *      'Amount'    => '',
     *      'parterid'  => '', //可选
     *      'key'       => '', //可选
     * ];
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function getSendData($payment)
    {
        //获取配置参数
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        switch (strtolower($this->platform)) {
            case 'pc':
                $service = "create_direct_pay_by_user";
                break;
            default:
                $service = "alipay.wap.create.direct.pay.by.user";
                break;
        }
        
        //构造要请求的参数数组，无需改动
        $return = array(
            "service"        => $service,
            "_input_charset" => 'utf-8',
            "partner"        => $config['parterid'] ? $config['parterid'] : $payment['parterid'],
            "seller_id"      => $config['parterid'] ? $config['parterid'] : $payment['parterid'],
            "sign_type"      => "MD5",
            "notify_url"     => $this->serverCallbackUrl,
            "return_url"     => $this->callbackUrl,
            "out_trade_no"   => $payment['OrderNO'],
            "subject"        => $payment['Name'],
            "total_fee"      => number_format($payment['Amount'], 2, '.', ''),
            "payment_type"   => 1,
            'ip'             => get_client_ip(),
        );
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($return);
        
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign = $this->buildMysign($para_sort, $config['key'] ? $config['key'] : $payment['key']);
        
        //签名结果与签名方式加入请求提交参数组中
        $return['sign'] = $mysign;
        
        return $return;
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $payment    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function callback($callbackData, &$payment, &$money, &$message, &$orderNo)
    {
        $returnSign = $callbackData['sign'];
        
        //获取配置参数
        $config = self::config(self::setup());
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($callbackData);
        
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign = $this->buildMysign($para_sort, $config['key']);
        
        if ($returnSign == $mysign) {
            //回传数据
            $orderNo = $callbackData['out_trade_no'];
            $money   = $callbackData['total_fee'];
            
            //记录回执流水号
            if (isset($callbackData['trade_no']) && $callbackData['trade_no']) {
                $callbackData['buyer']      = $callbackData['buyer_email']; //支付账户
                $callbackData['time']       = strtotime($callbackData['notify_time']); //支付时间
                $callbackData['collection'] = $callbackData['seller_email']; //收款账户
                $this->writeTradeNo($callbackData, $payment);
            }
            
            if ($callbackData['trade_status'] == 'TRADE_FINISHED' || $callbackData['trade_status'] == 'TRADE_SUCCESS') {
                return ['code' => 1, 'msg' => lang('Payment success')];
            }
        }
        
        return ['code' => 0, 'msg' => lang('Sign error')];
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $payment      string    支付接口类名
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function servercallback($callbackData, &$payment, &$money, &$message, &$orderNo)
    {
        return $this->callback($callbackData, $payment, $money, $message, $orderNo);
    }
    
    /**
     * @Mark:除去数组中的空值和签名参数
     * @param $para 签名参数组
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
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
     * @Version 2017/7/16
     */
    private function argSort($params)
    {
        ksort($params);
        reset($params);
        return $params;
    }
    
    /**
     * @Mark:生成签名结果
     * @param $sort_para
     * @param $key
     * @param string $sign_type
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function buildMysign($sort_para, $key)
    {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($sort_para);
        //把拼接后的字符串再与安全校验码直接连接起来
        $prestr = $prestr . $key;
        //把最终的字符串签名，获得签名结果
        $mysgin = md5($prestr);
        return $mysgin;
    }
    
    /**
     * @Mark:把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function createLinkstring($params)
    {
        $str = "";
        foreach ($params as $key => $val) {
            $str .= $key . "=" . $val . "&";
        }
        
        //去掉最后一个&字符
        $str = trim($str, '&');
        
        //如果存在转义字符，那么去掉转义
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        
        return $str;
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
        
        return ['code' => 0, 'msg' => lang('Refund fail') . ':' . $res['msg']];
    }
    
    
    /**
     * @Mark:推送支付单报文信息
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/16
     */
    public function pushpay($sendData)
    {
        //获取配置参数
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        //构造要请求的参数数组，无需改动
        $pushData = array(
            //************固定参数 start****************
            "service"        => 'alipay.acquire.customs',
            "partner"        => $config['parterid'] ? $config['parterid'] : $sendData['parterid'],
            "_input_charset" => 'utf-8',
            "sign_type"      => "MD5",
            //************固定参数 end****************
            
            'out_request_no'        => '', //报关流水号
            'trade_no'              => '', //支付宝交易号
            'merchant_customs_code' => '', //商户海关备案编号
            'amount'                => '', //报关金额
            'customs_place'         => '', //海关编号  https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.IQ2kZ7&treeId=155&articleId=104778&docType=1#s5
            'merchant_customs_name' => '', //商户海关备案名称
            'is_split'              => '', //是否拆单  可空
        );
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($pushData);
        
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign = $this->buildMysign($para_sort, $config['key'] ? $config['key'] : $sendData['key']);
        
        //签名结果与签名方式加入请求提交参数组中
        $pushData['sign'] = $mysign;
        
        $res = self::post($this->getSubmitUrl(), $pushData);
        
        //TODO 后继结果处理
    }
}