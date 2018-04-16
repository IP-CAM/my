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
// | 环迅跨境支付  Version 2016/11/25
// +----------------------------------------------------------------------
namespace seapays;

use app\common\libs\Seapyment;

class Ips extends Seapyment
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup(){
        return array(
            'subjection'    => 'seapays',  //隶属
            'code'          => 'Ips',    // 扩展器名称名
            'name'          => lang('Ips_seapays'), // 扩展器名称翻译名
            'description'   => lang('Ips_seapays_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                         //版本
            'author'        => 'Runtuer',                     //作者
            'website'       => 'http://www.runtuer.com',      //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
            //基本配置项
            'config'        => array(
                'pay_name' => array(
                    'title'     => 'Pay name',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'parterid' => array(
                    'title'     => 'Parter ID',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'key' => array(
                    'title'     => 'Payment key',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'account' => array(
                    'title'     => 'Pay account',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'pay_fee' => array(
                    'title'     => 'Pay fee',
                    'type'      => 'number',
                    'validate'  => 'required',
                    'suffix'    => '%',
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
                'logo'  => 'Ips.png',
                'appofficial' => 'http://www.ips.com/',         //官方
                'country'       => ['zh-cn'],//适用国家
            ),
        );
    }
    
    /**
     * @Mark:异步通知停止
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function notifyStop()
    {
        
    }
    
    /**
     * @Mark:获取提交地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function getSubmitUrl()
    {
        
    }
    
    /**
     * @Mark:获取要发送的数据数组结构
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function getSendData($data)
    {
        
    }
    
    /**
     * 同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function callback($ExternalData,&$paymentId,&$money,&$message,&$orderNo)
    {
        
    }
    
    /**
     * 异步同步支付回调
     * @param $ExternalData array  支付接口回传的数据
     * @param $paymentId    int    支付接口ID
     * @param $money        float  交易金额
     * @param $message      string 信息
     * @param $orderNo      string 订单号
     */
    public function serverCallback($ExternalData,&$paymentId,&$money,&$message,&$orderNo)
    {
        
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
}