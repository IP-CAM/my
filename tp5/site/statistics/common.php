<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>  Version 1.0  2016/3/12
// +----------------------------------------------------------------------

/**
 * @Mark:订单统计
 * @param null $day
 * @return array
 * @Author: yang <502204678@qq.com>
 * @Version 2017/10/12
 */
function getOrderNum($day=7)
{
    //所有订单信息
    $param = \think\Request::instance()->param();
    $start_time = isset($param['start_time']) ? $param['start_time'] : 0;
    $end_time   = isset($param['end_time']) ? $param['end_time'] : 0;
    $date       = isset($param['date']) ? $param['date'] : 0;
    if ($date) {
        switch ($date){
            case 'yesterday':
                $day = 1;
                break;
            case 'week':
                $day = 7;
                break;
            case 'month':
                $day = 30;
                break;
        }
    }
    if ($start_time && $end_time) {
        $day = floor((strtotime($end_time)-strtotime($start_time))/86400);
    }
    $arr = [];
    if ($day == 1) {
        $hour = date('H',time());
        for ($i=23;$i>=0;$i--) {
            $time = date('H:i:s',mktime($hour-$i, 0, 0, date('m'), date('d'), date('Y')));
            $start_time = ['>=', mktime($hour-$i, 0, 0, date('m'), date('d'), date('Y'))];
            $end_time = ['<=', mktime($hour-$i-1, 0, 0, date('m'), date('d'), date('Y'))];
            $where['create_time'][] = $start_time;
            $where['create_time'][] = $end_time;
            //所有订单
            $all_orders = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$time]['all'] = $all_orders['num'];
            $arr[$time]['all_money'] = $all_orders['money'];
            //待付款订单
            $where['pay_status'] = 0;
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$time]['paid'] = $paid_order['num'];
            $arr[$time]['paid_money'] = $paid_order['money'];
            //已付款订单
            $where['pay_status'] = 1;
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$time]['no_paid'] = $paid_order['num'];
            $arr[$time]['no_paid_money'] = $paid_order['money'];
            //已完成订单
            $where['status'] = 'TRADE_FINISHED';
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$time]['finished'] = $paid_order['num'];
            $arr[$time]['finished_money'] = $paid_order['money'];
            //取消订单
            unset($where['status']);
            $where['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
            $cancel_orders = app\order\model\Order::where(['cancel_status'=>$where['cancel_status']])->where(['cancel_time'=>$where['create_time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$time]['cancel'] = $cancel_orders['num'];
            $arr[$time]['cancel_money'] = $cancel_orders['money'];
    
            //售后订单
            $order_ids = app\order\model\Order::where(['cancel_time'=>$where['create_time']])->column('order_id');
            $rec_ids = app\order\model\Afterservice::where(['order_id'=>['in',$order_ids]])->where(['create_time'=>$where['create_time']])->column('rec_id');
            $afterservice = app\order\model\Goods::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
            $arr[$time]['afterservice'] = $afterservice['num'];
            $arr[$time]['afterservice_money'] = $afterservice['money'];
    
    
            unset($where);
        }
        
    } else {
        for ($i = $day; $i >= 0; $i--) {
            $where = [];
            $date = date('Y-m-d', strtotime("-$i day"));
            $start = ['>=', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))];
            $end = ['<=', mktime(23, 59, 59, date('m'), date('d') - $i, date('Y'))];
            $where['create_time'][] = $start;
            $where['create_time'][] = $end;
            //所有订单
            $all_orders = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$date]['all'] = $all_orders['num'];
            $arr[$date]['all_money'] = $all_orders['money'];
            //待付款订单
            $where['pay_status'] = 0;
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$date]['paid'] = $paid_order['num'];
            $arr[$date]['paid_money'] = $paid_order['money'];
            //已付款订单
            $where['pay_status'] = 1;
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$date]['no_paid'] = $paid_order['num'];
            $arr[$date]['no_paid_money'] = $paid_order['money'];
            //已完成订单
            $where['status'] = 'TRADE_FINISHED';
            $paid_order = app\order\model\Order::where($where)->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$date]['finished'] = $paid_order['num'];
            $arr[$date]['finished_money'] = $paid_order['money'];
            //取消订单
            unset($where['status']);
            $where['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
            $cancel_orders = app\order\model\Order::where(['cancel_status'=>$where['cancel_status']])->where(['cancel_time'=>$where['create_time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
            $arr[$date]['cancel'] = $cancel_orders['num'];
            $arr[$date]['cancel_money'] = $cancel_orders['money'];
            
            //售后订单
            $order_ids = app\order\model\Order::where(['cancel_time'=>$where['create_time']])->column('order_id');
            $rec_ids = app\order\model\Afterservice::where(['order_id'=>['in',$order_ids]])->where(['create_time'=>$where['create_time']])->column('rec_id');
            $afterservice = app\order\model\Goods::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
            $arr[$date]['afterservice'] = $afterservice['num'];
            $arr[$date]['afterservice_money'] = $afterservice['money'];
            
            unset($where);
        }
    }
    $time = $order = [];
    foreach ($arr as $k=>$v) {
        $order['all'][] = $v['all'];
        $order['all_money'][] = round($v['all_money'],2);
        $order['paid'][] = $v['paid'];
        $order['paid_money'][] = round($v['paid_money'],2);
        $order['no_paid'][] = $v['no_paid'];
        $order['no_paid_money'][] = round($v['no_paid_money'],2);
        $order['finished'][] = $v['finished'];
        $order['finished_money'][] = round($v['finished_money'],2);
        $order['cancel'][]=$v['cancel'];
        $order['cancel_money'][]=$v['cancel_money'];
        $order['afterservice'][] = $v['afterservice'];
        $order['afterservice_money'][] = $v['afterservice_money'];
        $time[] = $k;
    }
    $data = [
        'time' => json_encode($time),
        'all' => json_encode($order['all']),
        'all_money' => json_encode($order['all_money']),
        'paid' => json_encode($order['paid']),
        'paid_money' => json_encode($order['paid_money']),
        'no_paid' => json_encode($order['no_paid']),
        'no_paid_money' => json_encode($order['no_paid_money']),
        'finished' => json_encode($order['finished']),
        'finished_money' => json_encode($order['finished_money']),
        'cancel' => json_encode($order['cancel']),
        'cancel_money' => json_encode($order['cancel_money']),
        'afterservice' => json_encode($order['afterservice']),
        'afterservice_money' => json_encode($order['afterservice_money']),
    ];
    return $data;
}
