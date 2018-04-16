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
namespace app\financial\controller\admin;

use think\Lang;
use app\admin\controller\Admin;
use app\order\service\Order as OrderApi;
use app\order\service\OrderGoods as OrderGoodsApi;
use app\order\service\OrderLog as OrderLogApi;
use app\order\model\Order as OrderModel;
use app\order\model\Refund as RefundModel;
use app\order\model\Afterservice as AfterserviceModel;

class Refund extends Admin
{
    
    public function _initialize()
    {
        parent::_initialize();
        
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_' . $this->lang . '.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    
        
    }
    
    /**
     * @Mark: 退款订单列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        $order_map  = [];   //查询条件
        $param      = $this->request->param();
    
        // 搜索手机号码，收货人姓名，订单号
        $name       = isset($param['name']) ? trim($param['name']) : '';
        $search_name = '';
        if($name) {
            $order_map['consignee|order_sn|tel|mobile'] = ['like', '%' . $name . '%'];
            $search_name = $name;
        }
        $this->assign('search_name', $search_name);
        // 搜索链接
        $new_input = $param;
        unset($new_input['page']);
        unset($new_input['name']);
        unset($new_input['start_time']);
        unset($new_input['end_time']);
        $this->assign('search_url', $new_input);
    
    
        // 搜索订单来源
        $source     = isset($param['source']) ? trim($param['source']) : '';    //平台类型
        if ($source) {
            $order_map["platform_type"] = ["=", $source];
        }
            
        
        // 筛选后的订单id
        if(!empty($order_map)){
            $order_ids =  OrderModel::where($order_map)->column('order_id');
        }else{
            $order_ids = [];
        }
    
        $map = [];
        $order_by = [
            'status' => 'asc',
            'create_time' => 'asc'
        ];
        
        if(isset($param['_order']) && isset($param['_field'])){
            $order_by = [
                $param['_field'] => $param['_order']
            ];
        }
        
        // 申请时间查询
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : '';
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';
        
        if ($start_time && $end_time) {
            $map['create_time'] = ['between time' => [$start_time, $end_time]];
        } else if($start_time){
            $map['create_time'] = ['>=', strtotime($start_time)];
        } else if($end_time){
            $map['create_time'] = ['<=', strtotime($end_time)];
        }
        $this->assign('start_time', urldecode($start_time));
        $this->assign('end_time', urldecode($end_time));
        
        // 分页数
        $listRows = \think\Config::get('paginate.list_rows') > 0 ? \think\Config::get('paginate.list_rows') : 10;
        if(!empty($order_ids)){
            $map['order_id'] = ['in',$order_ids];
                
            $refund = RefundModel::where($map)->order($order_by)->paginate($listRows);
            $total = RefundModel::where($map)->count();
        }else{
            if(empty($param)){
                $refund = RefundModel::where([])->order($order_by)->paginate($listRows);
                $total = RefundModel::count();
            }else{
                $refund = null;
                $total = 0;
            }
            
        }
        
        
        $this->assign("meta_title", lang('Refundpays'));
        $this->assign('list', $refund);
        $this->assign('_total', $total);
        $this->assign('source', $source);
        
        return $this->fetch();
    }
    
    /**
     * @Mark: 查看订单
     * @return mixed
     * @Author: WangHuaLong
     */
    public function view()
    {
        $param      = $this->request->param();
        $ordersn    = isset($param['ordersn']) ? trim($param['ordersn']) : '';  //关键字搜索
        $where      = [
            'model' => 'order/Order',
            'where' => ['order_sn' => $ordersn],
        ];
        $data       = OrderApi::getOne($where);
        $map['order_id'] = ['=', $data['data']['order_id']];
        $goods      = OrderGoodsApi::getlist('order/Goods', $map, 'goods_id desc');
        //查找日志
        $log = 'order_id = '.$data['data']['order_id'].' or order_sn = "'.$data['data']['order_sn'].'"';
        $logs       = OrderLogApi::getlist('order/OrderLog', $log, 'id desc');
        $this->assign('data', $data['data']);
        $this->assign('goods', $goods);
        $this->assign('logs', $logs);
        return $this->fetch();
    }
    
    /**
     * @Mark: 审核
     * @return mixed|\think\response\Json
     * @Author: WangHuaLong
     */
    public function edit()
    {
        if(input('?ids')){
            $id = input('ids');
        }else{
            $this->error(lang('error_id'));
        }
        
        $data = RefundModel::get($id,'getorder');
        if($data == null|| $data['getorder'] ==null){
            $this->error(lang('error_id'));
        }
        
        if ($this->request->isPost()) {
            $request_data = $this->request->post();
            // 退款处理
            $method = $request_data['method'];
            if($method != 0){
                return ['code'=>0,'msg'=> lang('refund_method_error')];
            }
            
            // 退款单操作
            $data->refund_time = time();
            $data->status = 1;
            $data->method = 0;
            $result = $data->isUpdate(true)->save();
            if($result){
    
                $action = 'refund';
                // 退款类型 修改对应的订单状态和售后状态
                if($data['rtype'] == 0){
                    // 取消订单
                    $action = 'cancel_order';
                    $map = [
                        'order_id' => $data['order_id']
                    ];
                    $update_data = [
                        'status' => 'TRADE_CLOSED',
                        'cancel_status' => 'SUCCESS'
                    ];
                    OrderModel::where($map)->update($update_data);
        
                }else if($data['rtype'] == 1){
                    // 售后订单
                    $action = 'afterservice';
                    $map1 = [
                        'after_sn' => $data['after_sn']
                    ];
                    $update_data = [
                        'status' => 1
                    ];
                    AfterserviceModel::where($map1)->update($update_data);
                }
    
                // 订单日志
                OrderLogApi::writelog([
                    'order_id'  => $data['order_id'],
                    'order_sn'  => $data['order_sn'],
                    'user'      => UID,
                    'role'      => 'admin',
                    'result'    => 1,
                    'soruce'    => PLATFORM,
                    'action'    => $action,
                    'params'    => json_encode($request_data),
                    'remark'    => lang('refund_success')
                ]);
                
                return ['code'=>1,'msg'=>lang('refund_success'),'url'=>$this->jumpUrl];
            }else{
                return ['code'=>0,'msg'=>lang('refund_fail')];
            }
            
            
            
            
        }
        
        $this->assign('data', $data);
        $this->assign('meta_title', lang('Refunds to user'));
        return $this->fetch();
    }
}