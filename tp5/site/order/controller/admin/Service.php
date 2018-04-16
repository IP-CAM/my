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
// | Version 1.0  2016/3/13 售后服务
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;
use app\order\model\Refund;
use app\order\model\Order;
use app\order\service\Services as Serviceapi;

class Service extends Admin
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        //售后订单类型
        $option = [
            '1' => lang('Refund_Not_Return'),
            '2' => lang('Refund_And_Return'),
            '3' => lang('Only_Exchange'),
        ];
        $this->assign('option', $option);
    }
    
    
    /**
     * @Mark:售后申请列表
     * @param rtype string 售后类型
     * @param start_time string 查询开始时间
     * @param end_time string 查询结束时间
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/18
     * @return mixed
     */
    public function index()
    {
        $params = $this->request->param();
        $rtype  = isset($params['rtype']) ? trim($params['rtype']) : '';
    
        $index_map = ['status' => ['eq', 0]];
        //按时间查询
        isset($param['start_time']) ? $index_map['create_time'] = ['>=',strtotime(trim($param['start_time']))] : '';
        isset($param['end_time']) ? $index_map['create_time'] = ['<=',strtotime(trim($param['end_time']))] : '';
    
        if (!empty($rtype) && $rtype <> '4') $index_map['rtype'] = $rtype;
        $list = Serviceapi::getlist('Refund', $index_map);
        $this->assign("meta_title", lang('Refund'));
        $this->assign('list', $list['list']);
        $this->assign('page', $list['page']);
        $this->assign('_total', $list['total']);
        $this->assign('rtype', $rtype);
        return $this->fetch();
    }
    
    /**
     * @Mark:驳回售后申请
     * @param ids int 售后id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/18
     * @return mixed
     */
    public function reject()
    {
        $id = (int)input('ids');
        if ($id == 0) return json(['code' => 0, 'msg' => lang('Error_Param')]);
        $re = Refund::editStatus($id, -1);
        if ($re) {
            $this->success(lang('Reject') . lang('Success'));
        } else {
            $this->error(lang('Error_Operate'));
        }
    }
    
    /**
     * @Mark:售后申请详情
     * @param order_sn string 订单号
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/19
     * @return mixed
     */
    public function view()
    {
        $ordersn = trim(input('order_sn'));
        if (empty($ordersn)) return json(['code' => 0, 'msg' => lang('Error_Param')]);
        $orderDetail = Order::getOrderDerail($ordersn);
        $refundDetail = Db::name('refund')->where('order_sn', $ordersn)->find();
        $this->assign('info', $orderDetail);
        $this->assign('re_info', $refundDetail);
        return $this->fetch();
        
        
    }
    
    
    /**
     * @Mark:待退货记录
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/29
     */
    public function back()
    {
        $this->assign("meta_title", lang('Waitbak'));
        return $this->fetch();
    }
    
    /**
     * @Mark:待退货记录
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/29
     */
    public function come()
    {
        $this->assign("meta_title", lang('Waitcom'));
        return $this->fetch();
    }
    
    /**
     * @Mark:已结束
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/29
     */
    public function complete()
    {
        $this->assign("meta_title", lang('Complete'));
        return $this->fetch();
    }
    
    /**
     * @Mark:已收货
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/29
     */
    public function received()
    {
        $this->assign("meta_title", lang('Received'));
        return $this->fetch();
    }
    
    public function config()
    {
        $this->assign("_total", 100);
        $this->assign("_enable", 100);
        $this->assign("meta_title", lang('Servicecnf'));
        return $this->fetch();
    }
    
    public function reason()
    {
        $this->assign("meta_title", lang('Reason'));
        return $this->fetch();
    }
}