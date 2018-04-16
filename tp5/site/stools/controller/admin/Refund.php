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
// | Version 2017/1/23  支付单管理
// +----------------------------------------------------------------------
namespace app\stools\controller\admin;

use app\admin\controller\Admin;
use app\stools\service\RefundBill as RefundBillApi;

class Refund extends Admin
{
    /**
     * @Mark:退款单管理
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function index()
    {
        $this->conDb = 'RefundBill';
        $index_map   = [];
        //查询条件
        $param       = $this->request->param();
        $name        = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time  = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time    = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
        $status      = isset($param['status']) ? trim($param['status']) : null;         //支付状态
        
        $name        ? $index_map['name|id'] = ['like','%'. $name .'%'] : '';
        //按时间查询
        $start_time  ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time    ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
        
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        $status     ? $index_map['status'] = ['=', $status] : '';
        
        //赋值
        $lists = RefundBillApi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('status', $status);
        $this->assign ("meta_title", lang('Refundform'));
        return $this->fetch();
    }
    
    /**
     * @Mark:查看支付单信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/9
     */
    public function view()
    {
        $param  = $this->request->param();
        $id     = isset($param['ids']) ? $param['ids'] : '';
        empty($id) && $this->error(lang('Error refund sn'));
        $map['where'] = 'id = '. $id;
        $data         = RefundBillApi::getOne($map);
        $this->assign ("data", $data['data']);
        $this->assign ("meta_title", lang('Payinfo'));
        return $this->fetch();
    }
}
