<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Statistics.php  Version 统计 2017/6/8
// +----------------------------------------------------------------------
namespace app\seller\controller;

use app\order\model\Goods as OrderGoodsModel;
use app\order\model\Order as OrderModel;
use app\order\model\Afterservice as AfterserviceModel;

class Statistics extends Common
{
    /**
     * @Mark:运营情况
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/23
     */
    public function index()
    {
        $where = ['where'=>['seller_id'=>SellerId]];
        //新增订单数量及金额(今日)
        $where['time'] = 'today';
        $new_orders = $this->getOrderInfo($where);
        $this->assign('new_orders',$new_orders);
        //本周订单数及金额
        $where['time'] = 'week';
        $week_orders = $this->getOrderInfo($where);
        $this->assign('week_orders',$week_orders);
        //本月订单数及金额
        $where['time'] = 'month';
        $week_orders = $this->getOrderInfo($where);
        $this->assign('month_orders',$week_orders);
        
        //已支付订单数量及金额(今日)
        $where['time'] = 'today';
        $where['where']['pay_status'] = 1;
        $paid_orders = OrderModel::where($where['where'])->whereTime('pay_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('paid_orders',$paid_orders);
        //本周已支付订单数及金额
        $where['time'] = 'week';
        $where['where']['pay_status'] = 1;
        $week_paid_orders = OrderModel::where($where['where'])->whereTime('pay_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('week_paid_orders',$week_paid_orders);
        //本月已支付订单数及金额
        $where['time'] = 'month';
        $where['where']['pay_status'] = 1;
        $month_paid_orders = OrderModel::where($where['where'])->whereTime('pay_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('month_paid_orders',$month_paid_orders);
        
        //今日已完成订单数、已发货订单、已取消、售后订单
        unset($where['where']['pay_status']);
        $where['time'] = 'today';
        //已完成
        $where['where']['status']='TRADE_FINISHED';
        $today_finished_orders = $this->getOrderInfo($where);
        $this->assign('today_finished_orders',$today_finished_orders);
        //发货
        $where['where']['status'] = 'WAIT_BUYER_CONFIRM_GOODS';
        $today_shipping_orders = $this->getOrderInfo($where);
        $this->assign('today_shipping_orders',$today_shipping_orders);
        //售后
        $order_ids = OrderModel::where($where['where'])->column('order_id');
        $rec_ids = AfterserviceModel::where(['order_id'=>['in',$order_ids]])->whereTime('create_time',$where['time'])->column('rec_id');
        $today_afterservice = OrderGoodsModel::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
        $this->assign('today_afterservice',$today_afterservice);
        //取消
        unset($where['where']['status']);
        $where['where']['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
        $today_cancel_orders = OrderModel::where($where['where'])->whereTime('cancel_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('today_cancel_orders',$today_cancel_orders);
       
        
        //本周已完成订单数
        unset($where['where']['cancel_status']);
        $where['time'] = 'week';
        $where['where']['status']='TRADE_FINISHED';
        $week_finished_orders = $this->getOrderInfo($where);
        $this->assign('week_finished_orders',$week_finished_orders);
        //发货
        $where['where']['status'] = 'WAIT_BUYER_CONFIRM_GOODS';
        $week_shipping_orders = $this->getOrderInfo($where);
        $this->assign('week_shipping_orders',$week_shipping_orders);
        //售后
        $order_ids = OrderModel::where($where['where'])->column('order_id');
        $rec_ids = AfterserviceModel::where(['order_id'=>['in',$order_ids]])->whereTime('create_time',$where['time'])->column('rec_id');
        $week_afterservice = OrderGoodsModel::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
        $this->assign('week_afterservice',$week_afterservice);
        //取消
        unset($where['where']['status']);
        $where['where']['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
        $week_cancel_orders = OrderModel::where($where['where'])->whereTime('cancel_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('week_cancel_orders',$week_cancel_orders);
        
        
        //本月已完成订单数
        $where['time'] = 'month';
        $where['where']['status']='TRADE_FINISHED';
        $month_finished_orders = $this->getOrderInfo($where);
        $this->assign('month_finished_orders',$month_finished_orders);
        //发货
        $where['where']['status'] = 'WAIT_BUYER_CONFIRM_GOODS';
        $month_shipping_orders = $this->getOrderInfo($where);
        $this->assign('month_shipping_orders',$month_shipping_orders);
        //售后
        $order_ids = OrderModel::where($where['where'])->column('order_id');
        $rec_ids = AfterserviceModel::where(['order_id'=>['in',$order_ids]])->whereTime('create_time',$where['time'])->column('rec_id');
        $month_afterservice = OrderGoodsModel::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
        $this->assign('month_afterservice',$month_afterservice);
        //取消
        unset($where['where']['status']);
        $where['where']['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
        $month_cancel_orders = OrderModel::where($where['where'])->whereTime('cancel_time', $where['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('month_cancel_orders',$month_cancel_orders);
        
        $this->assign('statistics',getOrderNum());
        return $this->fetch();
    }
    
    /**
     * @Mark:获取订单数量和订单金额
     * @param $data array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/28
     * @return object
     */
    private function getOrderInfo($data)
    {
        $order = OrderModel::where($data['where'])->whereTime('create_time', $data['time'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        return $order;
    }
    
    /**
     * @Mark:交易数据分析
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/29
     */
    public function trade()
    {
        $param = $this->request->param();
        $start_time= mktime(0,0,0,date('m'),date('d'),date('Y'));
        $where = ['where'=>['seller_id'=>SellerId]];
        $end_time = time();
        $time = isset($param['time'])?$param['time']:'';
        if ($time) {
            $timeArr             = explode('-', preg_replace('# #', '', $time));
            $start_time = strtotime($timeArr[0]);
            $end_time = strtotime($timeArr[1]);
        }
        $where['time'][] = ['>=', $start_time];
        $where['time'][]   = ['<=', $end_time];
        
        //新增订单数及金额
        $new_orders = OrderModel::where($where['where'])->where(['create_time'=>$where['time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('new_orders',$new_orders);
        //已付款订单数及金额
        $where['where']['pay_status'] = 1;
        $paid_orders = OrderModel::where($where['where'])->where(['pay_time'=>$where['time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('paid_orders',$paid_orders);
        $this->assign('time',$time);
        $this->assign('time_range',date('Y-m-d',$start_time).'~'.date('Y-m-d',$end_time));
        //已完成订单数及金额
        $where['where']['status']='TRADE_FINISHED';
        $finished_orders = OrderModel::where($where['where'])->where(['confirm_time'=>$where['time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('finished_orders',$finished_orders);
        //售后订单数及金额
        unset($where['where']['status']);
        $order_ids = OrderModel::where($where['where'])->where(['cancel_time'=>$where['time']])->column('order_id');
        $rec_ids = AfterserviceModel::where(['order_id'=>['in',$order_ids]])->where(['create_time'=>$where['time']])->column('rec_id');
        $afterservice = OrderGoodsModel::where(['rec_id'=>['in',$rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
        $this->assign('afterservice',$afterservice);
        //取消
        $where['where']['cancel_status'] = ['in',['SUCCESS','REFUND_PROCESS']];
        $cancel_orders = OrderModel::where($where['where'])->where(['cancel_time'=>$where['time']])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('cancel_orders',$cancel_orders);
        
        
        //订单交易记录
        if ($start_time <= $end_time) {
            $day = ceil(($end_time-$start_time)/86400);
        } else {
            $day = ceil(($start_time-$end_time)/86400);
        }
        $arr = [];
        for ($i = $day; $i >= 0; $i--) {
            $where = [];
            $strtime = $end_time-86400*$i;
            $date = date('Y-m-d', $strtime);
            $start = ['>=', mktime(0, 0, 0, date('m',$strtime), date('d',$strtime) - $i, date('Y',$strtime))];
            $end = ['<=', mktime(23, 59, 59, date('m',$strtime), date('d',$strtime) - $i, date('Y',$strtime))];
            $where['create_time'][] = $start;
            $where['create_time'][] = $end;
            //所有订单
            $all_orders = OrderModel::where($where)->count();
        
            $arr[$date]['all'] = $all_orders ;
            //待付款订单
            $where['pay_status'] = 0;
            $paid_order = OrderModel::where($where)->count();
            $arr[$date]['paid'] = $paid_order ;
            //已付款订单
            $where['pay_status'] = 1;
            $paid_order = OrderModel::where($where)->count();
            $arr[$date]['no_paid'] = $paid_order ;
        
            //已完成订单
            $where['status'] = 'TRADE_FINISHED';
            $paid_order = OrderModel::where($where)->count();
            $arr[$date]['finished'] = $paid_order ;
            unset($where);
        }
        $order = [];
        $time = [];
        foreach ($arr as $k=>$v) {
            $order['all'][] = $v['all'];
            $order['paid'][] = $v['paid'];
            $order['no_paid'][] = $v['no_paid'];
            $order['finished'][] = $v['finished'];
            $time[] = $k;
        }
        $data = [
            'time' => json_encode($time),
            'all' => json_encode($order['all']),
            'paid' => json_encode($order['paid']),
            'no_paid' => json_encode($order['no_paid']),
            'finished' => json_encode($order['finished']),
        ];
        $this->assign('statistics',$data);
        return $this->fetch();
    }
    
    /**
     * @Mark:商品销售分析
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/26
     */
    public function strade()
    {
        $param = $this->request->param();
        $where = [
            'seller_id' => SellerId
        ];
        //定义每页显示数，用于确定数据排名
        $pages = 15;
        $time = isset($param['time']) ? $param['time'] : '';
        if ($time) {
            $timeArr              = explode('-', preg_replace('# #', '', $time));
            $where['create_time'][] = ['>=',$timeArr[0]];
            $where['create_time'][] = ['<=',$timeArr[1]];
        }
        
        //商品销量
        $goods_num = OrderGoodsModel::where($where)->group('goods_id')->order('num desc')->field("count(goods_id) as num,goods_name,goods_id,sku_code")->paginate($pages);
        $this->assign('goods_num', $goods_num);
        //商品销售额
        $goods_money = OrderGoodsModel::where($where)->group('goods_id')->order('money desc')->field("SUM(sku_price) as money,goods_name,goods_id,sku_code")->paginate($pages);
        $this->assign('goods_money', $goods_money);
        
        $this->assign('time', $time);
        $this->assign('pages',$pages);
        $this->assign('meta_title', lang('Goodstrade'));
        return $this->fetch();
    }
    
    /**
     * @Mark:问题订单分析
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/26
     */
    public function aftersales()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:流量分析
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/26
     */
    public function traffic()
    {
        $param = $this->request->param();
        $time = isset($param['time'])?$param:'';
        
        $this->assign('time',$time);
        return $this->fetch();
    }
}
