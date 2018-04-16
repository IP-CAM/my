<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | OrderLog.php  Version 2017/9/4  订单日志API
// +----------------------------------------------------------------------
namespace app\order\service;

use app\admin\service\Service;
use app\order\model\OrderLog as OrderLogM;

class OrderLog extends Service
{
    /**
     * @Mark:写订单日志
     * @param array $data
     * $data  = [
     *      'order_id'  => $order_id,
            'order_sn'  => $OrderModel->order_sn,
            'user'      => $data['username'],
            'result'    => true,
            'action'    => lang('Create order'),
            'remark'    => '',
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/4
     */
    static public function writelog($data = [])
    {
        $Logmodel = new OrderLogM();
        $Logmodel->allowField(true)->save($data);
    }
}