<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Settle.php  Version 结算 2017/6/8
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\service\Count as CountModel;
use app\order\model\Order as OrderModel;

class Settle extends Common
{
    /**
     * @Mark:结算汇总
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function index()
    {
        $param  = $this->request->param();
        $where  = ['seller_id' => SellerId];
        $status = isset($param['status']) ? $param['status'] : '';
        $time   = isset($param['time']) ? $param['time'] : '';
        
        if ($status !== '') $where['status'] = $status;
        if ($time) {
            $timeArr             = explode('-', preg_replace('# #', '', $time));
            $where['start_time'] = ['>=', strtotime($timeArr[0])];
            $where['end_time']   = ['<=', strtotime($timeArr[1])];
        }
        $data = CountModel::countList($where);
        $this->assign('list', $data);
        $this->assign("meta_title", lang('settle_record'));
        $this->assign('_total', $data->total());
        $this->assign('status', isset($param['status']) ? $param['status'] : 'all');
        $this->assign('time', isset($param['time']) ? $param['time'] : '');
        return $this->fetch();
    }
    
    /**
     * @Mark:结算明细
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function info()
    {
        $param  = $this->request->param();
        $where  = ['seller_id' => SellerId];
        $status = isset($param['status']) ? $param['status'] : '';
        $time   = isset($param['time']) ? $param['time'] : '';
        $name   = isset($param['name']) ? $param['name'] : '';
        
        if ($status && $status <> 'all') $where['status'] = $status;
        if ($time) {
            $timeArr             = explode('-', preg_replace('# #', '', $time));
            $where['start_time'] = ['>=', $timeArr[0]];
            $where['end_time']   = ['<=', $timeArr[1]];
        }
        if ($name) $where['seller_name'] = ['like', '%' . $name . '%'];
        
        $data = CountModel::CountInfo($where);
        $this->assign('list', $data);
        $this->assign('status', $status);
        $this->assign('time', $time);
        $this->assign('meta_title', lang('SettleInfo'));
        if (isset($param['id'])) return $this->fetch('info2');
        return $this->fetch();
    }
    
    /**
     * @Mark:结算订单详情
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/25
     */
    public function detail()
    {
        $order_sn = $this->request->param('order_sn');
        //订单详情
        $info = OrderModel::get(['order_sn' => $order_sn], 'user,goods');
        //会员信息
        $user_info = $info['user'];
        //订单商品信息
        $goods_info = $info['goods'];
        $show_id    = $info['store']['show_customer_id'];
        $this->assign('show_id', $show_id);
        $this->assign('goods_info', $goods_info);
        $this->assign('user_info', $user_info);
        $this->assign('info', $info);
        return $this->fetch('order/info');
    }
}
