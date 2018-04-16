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
// | 订单管理  Version 1.0  2017/3/20
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;

class Order extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/31
     */
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->status      = '';
    }
    
    /**
     * 先来个测试
     */
    public function index(){
        $order_map = $order_search =array();
        $order_type = input('type');
        switch ($order_type){
            case "tobeconfirmed";
                $order_map["order_status"] = array("eq", 0);
                break;
            case "tobepaid";
                $order_map["pay_status"] = array("eq", 0);
                break;
            case "tobeshipped";
                $order_map["shipping_status"] = array("eq", 0);
                break;
            case "cancelled";
                $order_map["order_status"] = array("eq", 2);
                break;
            case "paymenting";
                $order_map["pay_status"] = array("eq", 1);
                break;
            case "paid";
                $order_map["pay_status"] = array("eq", 2);
                break;
            case "completed";
                $order_map["shipping_status"] = array("eq", 1);
                break;
            case "return";
                $order_map["order_status"] = array("eq", 4);
                break;
            case "part";
                $order_map["shipping_status"] = array("eq", 4);
                break;
            case "invalid";
                $order_map["order_status"] = array("eq", 3);
                break;
            default:
        }
        if(input('item') && input('item') <> 'all'){
            $order_map["platform_type"] = array("eq", input('item\s'));
        }
        if(input('prom') && input('prom') <> 'all'){
            $order_map["extension_code"] = array("eq", input('prom\s'));
        }
        if(input('name')){
            $order_search['consignee']  = array('like', '%'.input('name\s').'%');
            $order_search['order_sn']   = array('like', '%'.input('name\s').'%');
            $order_search['tel']        = array('like', '%'.input('name\s').'%');
            $order_search['mobile']     = array('like', '%'.input('name\s').'%');
            $order_search['email']      = array('like', '%'.input('name\s').'%');
            $order_search['_logic']     = 'or';
            $order_map['_complex']      = $order_search;
        }
        
        if (input("start_time")) {
            $order_map['add_time'][]    = array('egt',strtotime(trim(input("start_time"))));
        }
        if (input("end_time")) {
            $order_map['add_time'][]    = array('egt',strtotime(trim(input("end_time"))));
        }
        
        $Order = $this->lists('Order',$order_map,'order_id desc');
        $this->assign('list',$Order);
        $this->meta_title = lang('Orderlist');
        $this->display();
        
        
        $option = array(
            0 => lang('Allorders'),
            1 => lang('Completed'),
            2 => lang('Paid'),
            3 => lang('To_be_confirmed'),
            4 => lang('To_be_paid'),
            5 => lang('To_be_shipped'),
            6 => lang('Paymenting'),
            7 => lang('Return'),
        );
        $this->assign ("meta_title", lang('Orderlist'));
        $this->assign ("option", $option);
        $this->assign ("list", '');
        return $this->fetch();
    }

}