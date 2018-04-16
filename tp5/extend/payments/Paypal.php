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
// | Paypal.php  Version 2017/3/11  贝宝支付
// +----------------------------------------------------------------------
namespace payments;

use app\common\libs\Payment;

class Paypal extends Payment
{
    static public function setup()
    {
        return array(
            'subjection'    => 'payments',    //隶属
            'code'          => 'Paypal',     // 扩展器名称名
            'name'          => lang('Paypal_payment'), // 扩展器名称翻译名
            'description'   => lang('Paypal_payment_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'       => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(
                'pay_name'      => array(
                    'title'     => 'Pay name',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'parterid' => array(
                    'title'     => 'Parter ID',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'parterkey' => array(
                    'title'     => 'Partner Key',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'currency_code' => array(
                    'title'     => 'Default currency_code',
                    'type'      => 'select',
                    'validate'  => 'required',
                    'default'   => 'CNY',
                    'option'    => [
                        'CNY'     => 'CNY',
                        'HKD'     => 'HKD',
                        'USD'     => 'USD',
                        'CAD'     => 'CAD',
                        'EUR'     => 'EUR',
                        'GBP'     => 'GBP',
                        'AUD'     => 'AUD',
                    ],
                ),
                'pay_fee' => array(
                    'title'     => 'Pay fee',
                    'type'      => 'number',
                    'min'       => '0',
                    'validate'  => 'required',
                    'suffix'    => '%',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'          => 'paypal.png',
                'appofficial'   => 'http://www.paypal.com/',       //官方
                'country'       => ['zh-cn'],   //适用国家
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
        return 'https://www.paypal.com/cgi-bin/webscr';
    }
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $payment array 要传递的支付信息
     * $payment = [
     *      'OrderNO'   => '',
     *      'Name'      => '',
     *      'Amount'    => '',
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
    
        $return = array();
        $return['business']      = $config['parterid']; //卖家帐号也就是收钱的号(商户号)
        $return['item_number']   = 1;                   //商品数量
        $return['invoice']       = $payment['OrderNO']; //商品名称
        $return['amount']        = $payment['Amount'];  //商品价格
        $return['return']        = $this->callbackUrl;  //支付成功后网页跳转地址，也就是买家看的信息页面
        $return['notify_url']    = $this->serverCallbackUrl; //支付成功后paypal后台发送信息地址
        $return['tax']           = $config['pay_fee'];  //税率
        //$return['custom']      = $this->createMD5($return, $config['parterkey']);
        $return['custom']        = '';
        $return['item_name']     = $payment['Name'];
        $return['cmd']           = '_xclick';
        $return['charset']       = 'utf-8';
        $return['currency_code'] = $config['currency_code'];
    
        return $return;
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function callback($callbackData, &$payment, &$money, &$message, &$orderNo)
    {
        $info           = self::setup();
        $where          = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config         = self::config($where);
        
        $req['cmd']     = '_notify-synch';
        $req['tx']      = $callbackData['tx'];
        $req['at']      = $config['parterkey'];
    
        $respose        = self::post($this->getSubmitUrl(), $req);
    
        if(!$respose){
            $ret['status'] = 'error';
        }else{
            $lines      = explode("\n", $respose);
            $keyarray   = array();
            if(strcmp($lines[0], "SUCCESS")==0){
                for ($i=1; $i <count($lines) ; $i++) {
                    list($key,$val) = explode("=", $lines[$i]);
                    $keyarray[urldecode($key)] = urldecode($val);
                }
    
                //记录回执流水号
                if (isset($callbackData['txn_id']) && $callbackData['txn_id'])
                {
                    $callbackData['out_trade_no'] = $keyarray['invoice'];
                    $callbackData['buyer']        = $callbackData['payer_email'];         //支付账户
                    $callbackData['time']         = strtotime($keyarray['payment_date']) ? strtotime($keyarray['payment_date']) : time(); //支付时间
                    $callbackData['collection']   = $callbackData['business']; //收款账户
                    $callbackData['total_fee']    = $callbackData['mc_gross'];
                    
                    $this->writeTradeNo($callbackData, $payment);
                }
            
                if($keyarray['txn_id'] != $callbackData['tx']){
                        return ['code' => 0, 'msg' => lang('Payment fail')];
                }else{
                    if($keyarray['payment_status'] == "Completed"){
                        return ['code' => 1, 'msg' => lang('Payment succ')];
                    }else{
                        return ['code' => 0, 'msg' => lang('Payment fail')];
                    }
                }
            }else if(strcmp($lines[0], "FATL")==0){
                return ['code' => 0, 'msg' => lang('Payment fail')];
            }
        }
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口类名
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function servercallback($callbackData, &$payment, &$money, &$message, &$orderNo)
    {
        $callbackData['cmd']    = '_notify-validate';
        $response   = self::post($this->getSubmitUrl(), $callbackData);
    
        if (strcmp ($response, "VERIFIED") == 0)
        {
            switch($callbackData['payment_status'])
            {
                case 'Completed':
                case 'Processed':
                    $callbackData['out_trade_no'] = $callbackData['invoice'];
                    $callbackData['buyer']        = $callbackData['payer_email'];         //支付账户
                    $callbackData['time']         = strtotime($callbackData['payment_date']) ? strtotime($callbackData['payment_date']) : time(); //支付时间
                    $callbackData['collection']   = $callbackData['business']; //收款账户
                    $callbackData['total_fee']    = $callbackData['mc_gross'];
    
                //记录回执流水号
                    if(isset($callbackData['txn_id']) && $callbackData['txn_id'])
                    {
                        $this->writeTradeNo($callbackData, $payment);
                    }
                    return ['code' => 1, 'msg' => lang('Payment success')];
                    break;
        
                default:
                    return ['code' => 0, 'msg' => lang('Payment fail')];
                    break;
            }
        }
    
        return ['code' => 0, 'msg' => lang('Payment fail')];
    
        //校验md5码 防止篡改数据
    }
}