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
// | Unionpay  Version 1.0  2016/3/14  中国银联支付接口
// +----------------------------------------------------------------------
namespace payments;

use app\common\libs\Payment;

class Unionpay extends Payment
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    static public function setup(){
        return array(
            'subjection'    => 'payments',     //隶属
            'code'          => 'Unionpay',     // 扩展器名称名
            'name'          => lang('Unionpay_payment'), // 扩展器名称翻译名
            'description'   => lang('Unionpay_payment_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(
                'pay_name' => array(
                    'title'     => 'Pay name',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'unionpay_mid' => array(
                    'title'     => 'Unionpay id',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'unionpay_cer_password' => array(
                    'title'     => 'Cer password',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'unionpay_user' => array(
                    'title'     => 'Biness user',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'unionpay_password' => array(
                    'title'     => 'Biness password',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'warehouse' => array(
                    'title'     => 'Storehouse',
                    'type'      => 'string',
                    'length'    => 260,
                    'tip'       => 'A001;B001;C001;D001',
                    'validate'  => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'unionpay.png',
                'appofficial'  => 'http://www.Unionpay.com/',       //官方
                'country'   => ['zh-cn'],   //适用国家
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
        // TODO: Implement notifyStop() method.
    }
    
    /**
     * @Mark:获取提交地址
     * @return string Url提交地址
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function getSubmitUrl()
    {
        // TODO: Implement getSubmitUrl() method.
    }
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $payment array 要传递的支付信息
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function getSendData($payment)
    {
        // TODO: Implement getSendData() method.
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
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function servercallback($ExternalData, &$paymentId, &$money, &$message, &$orderNo)
    {
        // TODO: Implement servercallback() method.
    }
    
}