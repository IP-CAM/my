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
// | Refundpay.php Version 1.0  2016/3/13 退款申请
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use think\Lang;
use app\admin\controller\Admin;
use app\order\service\Order as OrderApi;
use app\order\service\Refund as RefundApi;

class Refund extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/5
     */
    public function _initialize()
    {
        parent::_initialize();
        
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    }
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/2
     */
    public function index()
    {
        $order_map  = $order_search = [];   //查询条件
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';  //关键字搜索
        $prom       = isset($param['prom']) ? trim($param['prom']) : '';  //活动类型
        $status     = isset($param['status']) ? trim($param['status']) : '';   //订单状态
        $source     = isset($param['source']) ? trim($param['source']) : '';    //平台类型
        $partner    = isset($param['partner']) ? trim($param['partner']) : '';  //合作商
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //下单时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //下单时间结束
    
        $order_map['cancel_status'] = ['=', 'REFUND_PROCESS'];
        if($status && $status != 'all')
        {
            $order_map['cancel_status'] = ['=', $status];
        }
    
        if ($source && $source <> 'all') $order_map["cancel_soruce"] = ["=", $source];
        if ($partner && $partner <> 'all') $order_map["partner"] = ["=", $partner];
    
        //条件搜索
        $name      ? $order_map['consignee|order_sn|tel|mobile|email'] = ['like', '%' . $name . '%'] : '';
        $start_time ? $order_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time ? $order_map['create_time']   = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
    
        $Order = Orderapi::getlist('Order', $order_map, 'order_id desc');
    
        $this->assign("meta_title", lang('Refundpays'));
        $this->assign('list', $Order['list']);
        $this->assign('page', $Order['page']);
        $this->assign('_total', $Order['total']);
        $this->assign('status', $status);
        $this->assign('source', $source);
        $this->assign('partner', $partner);
        $this->assign('prom', $prom);
        $this->assign('_refund_total', RefundApi::getOrderCountByRefund('REFUND_PROCESS'));
    
        return $this->fetch();
    }
    
    /**
     * @Mark:查看订单
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/4
     */
    public function view()
    {
        $this->assign('data', null);
        $this->assign('meta_title', lang('View order'));
        return $this->fetch();
    }
    
    /**
     * @Mark:审核
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/4
     */
    public function edit()
    {
        $input = $this->request->param();
        $order_id   = isset($input['order_id']) ? trim($input['order_id']) : '';
        $where      = [
            'model' => 'Order',
            'where' => ['order_id' => $order_id],
        ];
        $data       = Orderapi::getOne($where);
        
        if($this->request->isPost())
        {
            $isagree    = isset($input['isagree']) ? $input['isagree'] : 0;
            $contents   = isset($input['contents']) ? $input['contents'] : '';
            //同意
        }
        
        $this->assign('data', $data['data']);
        $this->assign('meta_title', lang('Refunds to user'));
        return $this->fetch();
    }
}