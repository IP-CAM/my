<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Refund.php  Version 2017/7/26 退款单API
// +----------------------------------------------------------------------
namespace app\order\service;

use app\admin\service\Service;
use app\order\model\Order as OrderModel;
use app\order\service\Order as Orderapi;
use app\order\model\Refund as RefundModel;

class Refund extends Service
{
    /**
     * @Mark:微型单号生成器
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/5
     */
    static public function creatSn($prefix = '')
    {
        return $prefix . date('ymdHi').str_pad(substr(microtime(), 3, 4), 5, '0', STR_PAD_LEFT);
    }
    /**
     * @Mark:
     * @param $data
     * $data = [
            'order_id'     => ,  //订单id
            'contents'     => ,  //退款理由
            'money'        => ,  //退款金额
     *      'rtype'        => ,  //退款类型 0 取消订单，1 售后订单
      ];
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/5
     */
    static public function createRefund(&$data)
    {
        //检查订单状态及值
        $where     = [
            'model' => 'order/Order',
            'where' => ['order_id' => $data['order_id']],
        ];
        $orderInfo = Orderapi::getOne($where);
        
        //订单金额不允许超过退款金额
        if($data['money'] > $orderInfo['data']['order_amount'])
        {
            return ['code' => 0, 'msg' => lang('Order more than refund')];
        }
    
        // 退款类型 0 取消订单，1 售后订单
        $rtype  = isset($data['rtype']) ? $data['rtype'] : 0;
        $prefix = (function() use ($rtype){
            switch ($rtype)
            {
                case 0:$fix  = 'R-';break;
                case 1:$fix  = 'RH-';break;
                case 2:$fix  = 'H-';break;
                default:$fix = 'R-';break;
            }
            return $fix;
        })();
        
        //改变原始订单取消状态
        $process = [
            'model'     => 'order/Order',
            'where'     => 'order_id = '. $data['order_id'] ,
            'fields'    => 'cancel_status',
            'val'       => 'REFUND_PROCESS'
        ];
        $Orderres = Orderapi::setFields($process);
    
        //订单状态改变失败时
        if(!$Orderres['code'])
        {
            return ['code' => 0, 'msg' => lang('Set REFUND_PROCESS fail')];
        }
        
        //创建退款时的数据
        $refund = [
            'return_sn'         => self::creatSn($prefix),
            'order_id'          => $orderInfo['data']['order_id'],
            'order_sn'          => $orderInfo['data']['order_sn'],
            'user_id'           => $orderInfo['data']['user_id'],
            'return_description'=> $data['contents'],
            'return_reason'     => $orderInfo['data']['cancel_reason'],
            'orderprice'        => $orderInfo['data']['order_amount'],
            'applyprice'        => $data['money'], //退款金额
            'rtype'             => $rtype,
            'create_time'       => time(),
        ];
        
        // 售后单
        if(isset($data['after_sn'])){
            $refund['after_sn'] = $data['after_sn'];
        }
        if(isset($data['return_reason'])){
            $refund['return_reason'] = $data['return_reason'];
        }
        

        $status = RefundModel::insert($refund);
        
        //创建结果
        if ($status) {
            return ['code' => 1, 'msg' => lang('Create refund Success')];
        }
    
        return ['code' => 0, 'msg' => lang('Create refund Fail')];
    }
    
    /**
     * @Mark:返回取消订单总数
     * @param $status
     * @return int|string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/5
     */
    static public function getOrderCountByRefund($status)
    {
        return OrderModel::where('cancel_status = "'.$status.'"')->count();
    }
}