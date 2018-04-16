<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 具备清关支付的接口基类  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\common\libs;

use think\Url;
use app\order\service\Order as OrderApi;
use app\stools\model\PaymentBill;

abstract class Seapyment extends Baseexted
{
    public $method              = "post";//表单提交模式
    public $version             = '';    //版本
    public $charset             = 'utf-8';
    public $callbackUrl         = '';    //支付完成后，同步回调地址
    public $serverCallbackUrl   = '';    //异步通知地址
    public $merchantCallbackUrl = '';    //支付中断返回
    public $platform            = '';    //平台
    
    /**
     * @Mark:构造函数
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function __construct($platform = 'pc')
    {
        //回调函数地址
        $this->callbackUrl = Url::build('stools/payment/callback', ['class' => base64_encode(get_called_class()), 'platform' => $platform], true, true);
        
        //回调业务处理地址(异步)
        $this->serverCallbackUrl = Url::build('stools/payment/servercallback', ['class' => base64_encode(get_called_class()), 'platform' => $platform], true, true);
        //中断支付返回
        $this->merchantCallbackUrl = Url::build('stools/payment/merchantcallback', ['class' => base64_encode(get_called_class()), 'platform' => $platform], true, true);
        
        $this->platform = $platform;
    }
    
    /**
     * @Mark:记录流水号
     * @param $callbackData 订单号
     * @param $payment 支付类名
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/12
     */
    protected function writeTradeNo($callbackData, $payment)
    {
        $result = array();//订单号 => 订单金额
        
        $orderList = explode(',', $callbackData['out_trade_no']);
        if ($orderList) {
            foreach ($orderList as $key => $val) {
                $map = [
                    'model'   => 'order/Order',
                    'where'   => 'order_sn = ' . $val,
                ];
                $orderRow = OrderApi::getOne($map);
                if (isset($orderRow['data']) && $orderRow['data']) {
                    $result[$val] = $orderRow['data']['order_amount'];
                }
            }
        }
        
        $PaymentBill = new PaymentBill();
        $payClass    = '\\'. $payment;
        $extConfig[] = $payClass::setup();
        
        if ($result) {
            foreach ($result as $key => $val) {
                //更新支付流水号
                $map = [
                    'model'     => '\\app\\order\\model\\Order',
                    'where'     => 'order_sn = ' . $key,
                    'fields'    => 'trade_no',
                    'val'       => $callbackData['trade_no'],
                ];
                OrderApi::setFields($map);
                //保存支付单号
    
                $orderRow = $PaymentBill::where(['order_sn' => $key])->find();
                if (!$orderRow) {
                    $PaymentBill->save([
                        'money'       => isset($callbackData['total_fee']) ? $callbackData['total_fee']:0,
                        'status'      => 'succ',
                        'pay_class'   => $payClass,
                        'pay_name'    => isset($extConfig[0]['name']) ? $extConfig[0]['name'] : $payClass,
                        'pay_account' => isset($callbackData['buyer']) ? $callbackData['buyer'] : '',
                        't_payed'     => isset($callbackData['time']) ? $callbackData['time'] : time(),
                        'order_sn'    => $key,
                        'currency'    => 'CNY',
                        'trade_no'    => isset($callbackData['trade_no']) ?$callbackData['trade_no'] : '',
                        'collection'  => isset($callbackData['collection'])?$callbackData['collection']:''
                    ]);
                }
    
            }
        }
    }
    
    /**
     * @Mark:支付功能实现
     * @param $sendData
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function doPay($sendData)
    {
        header("Content-Type: text/html;charset=" . $this->charset);
        echo <<< OEF
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" dir="ltr" >
			<head></head>
			<body>
				<p>Redirecting ...</p>
				<form action="{$this->getSubmitUrl()}" method="{$this->method}">
OEF;
        foreach ($sendData as $key => $item) {
            echo <<< OEF
					<input type='hidden' name='{$key}' value='{$item}' />
OEF;
        }
        echo <<< OEF
				</form>
			</body>
			<script type='text/javascript'>
				window.document.forms[0].submit();
			</script>
		</html>
OEF;
    }
    
    /**
     * @Mark: 退款
     * @param $sendData
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/19
     */
    abstract public function dorefund($sendData);
    
    /**
     * @Mark:异步通知停止
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    abstract public function notifyStop();
    
    /**
     * @Mark:获取提交地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    abstract public function getSubmitUrl();
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    abstract public function getSendData($data);
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $payment      string 支付接口类
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    abstract public function callback($callbackData, &$payment, &$money, &$message, &$orderNo);
    
    /**
     * 异步同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $payment      string 支付接口类
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    abstract public function serverCallback($callbackData, &$payment, &$money, &$message, &$orderNo);
    
}