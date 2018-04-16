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
// | 发货记录  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;
use app\order\service\Order as Orderapi;

class Delivery extends Admin
{
    /**
     * @Mark:发货记录
     * @param name string 收货人姓名、订单号
     * @param start_time string 查询订单配送开始时间
     * @param end_time string 查询订单配送结束时间
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/17
     * @return mixed
     */
    public function index()
    {
        $index_map  = [];
        //查询条件
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
    
        $name       ? $index_map['consignee|d.order_sn'] = ['like','%'.trim($name).'%'] : '';
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['shipping_time'] = ['between' => [$start_time, $end_time]];
        }
    
        $order_map['order_type']        = 1;
        $order_map['shipping_status']   = ['>', 0];
    
        if (empty($order_map)) $order_map['status'] = ['>=', 0];
    
        //赋值
        $lists = Orderapi::getlist($this->conDb, $index_map, 'create_time desc');
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Delivery'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 发货页面显示
     * @param orderid int 订单id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/17
     * @return mixed
     */
    public function view()
    {
        $param      = $this->request->param();
        $orderid    = isset($param['orderid']) ? $param['orderid'] : '';
        
        return $this->fetch();
    }
    
    
}