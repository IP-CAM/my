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
// | 订单管理  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use think\Lang;
use app\admin\controller\Admin;
use app\order\service\Delivery;
use app\order\service\Order as Orderapi;
use app\order\service\OrderGoods as OrderGoodsapi;
use app\common\service\Extend as ExtendApi;
use app\order\service\OrderLog;
use app\bcwareexp\model\Express as ExpressModel;
use app\order\model\Order as OrderModel;
use app\seller\model\Transport as TransportModel;
use app\bcwareexp\model\Crossware as CrosswareModel;
use app\order\service\OrderLog as OrderLogApi;


class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/31
     */
    public function _initialize()
    {
        parent::_initialize();
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
        
        $this->conDb = 'Order';    //确定要操作的模型，导出数据时要使用
    }
    
    /**
     * @Mark:订单列表
     * @param item string 平台类型 Pc app 等
     * @param prom string 活动类型
     * @param type int 订单类型
     * @param partner string 合作商
     * @param source string 订单来源
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/16
     * @return mixed
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
        
        if($status)
        {
            if($status == 'all')
            {
                $order_map['status'] = ['<>', ''];
            }else{
                $order_map['status'] = ['=', $status];
            }
        }
        
        if ($source && $source <> 'all') $order_map["platform_type"] = ["=", $source];
        if ($prom && $prom <> 'all') $order_map["extension_code"] = ["=", $prom];
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
        
        $Order = Orderapi::getlist($this->conDb, $order_map, 'order_id desc');
        
        $this->assign("meta_title", lang('Orderlist'));
        $this->assign('list', $Order['list']);
        $this->assign('page', $Order['page']);
        $this->assign('_total', $Order['total']);
        $this->assign('partner', $partner);
        $this->assign('prom', $prom);
        $this->assign('source', $source);
        $this->assign('status', $status);
        $this->assign('_pay_total', Orderapi::getOrderCountByStatus('WAIT_BUYER_PAY'));
        $this->assign('_wait_send_total', Orderapi::getOrderCountByStatus('WAIT_SELLER_SEND_GOODS'));
        $this->assign('_wait_confirm_total', Orderapi::getOrderCountByStatus('WAIT_BUYER_CONFIRM_GOODS'));
        $this->assign('_finished_total', Orderapi::getOrderCountByStatus('TRADE_FINISHED'));
        $this->assign('_closed_total', Orderapi::getOrderCountByStatus('TRADE_CLOSED'));
        $this->assign('_sysclosed_total', Orderapi::getOrderCountByStatus('TRADE_CLOSED_BY_SYSTEM'));
        
        return $this->fetch();
    }
    
    /**
     * @Mark:订单详情
     * @return mixed
     * @param ordersn string 订单号
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/16
     */
    public function view()
    {
        $param      = $this->request->param();
        $ordersn    = isset($param['ordersn']) ? trim($param['ordersn']) : '';  //关键字搜索
        $where      = [
            'model' => 'Order',
            'where' => ['order_sn' => $ordersn],
        ];
        $data       = Orderapi::getOne($where);
        $map['order_id'] = ['=', $data['data']['order_id']];
        $goods      = Ordergoodsapi::getlist('Goods', $map, 'goods_id desc');
        //查找日志
        $log = 'order_id = '.$data['data']['order_id'].' or order_sn = "'.$data['data']['order_sn'].'"';
        $logs       = OrderLog::getlist('OrderLog', $log, 'id desc');
        $this->assign('data', $data['data']);
        $this->assign('goods', $goods);
        $this->assign('logs', $logs);
        return $this->fetch();
    }
    
    /**
     * @Mark:修改订单
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/17
     */
    public function modify()
    {
        $param      = $this->request->param();
        
        //提交修改处理
        if($this->request->isPost())
        {
            isset($param['consignee'])      ? $data['consignee'] = trim($param['consignee']) : true;
            isset($param['order_amount'])   ? $data['order_amount'] = trim($param['order_amount']) : true;
            isset($param['trade_no'])       ? $data['trade_no'] = trim($param['trade_no']) : true;
            isset($param['shipping_fee'])   ? $data['shipping_fee'] = trim($param['shipping_fee']) : true;
            isset($param['country'])        ? $data['country'] = trim($param['country']) : true;
            isset($param['province'])       ? $data['province'] = trim($param['province']) : true;
            isset($param['city'])           ? $data['city'] = trim($param['city']) : true;
            isset($param['district'])       ? $data['district'] = trim($param['district']) : true;
            isset($param['address'])        ? $data['address'] = trim($param['address']) : true;
            isset($param['mobile'])         ? $data['mobile'] = trim($param['mobile']) : true;
            isset($param['recode'])         ? $data['recode'] = trim($param['recode']) : true;
    
            $where      = [
                'model' => 'order/Order',
                'where' => ['order_id' => $param['order_id']],
            ];
            $orderInfo  = Orderapi::getOne($where);
            
            //支付方式及状态
            if(isset($param['pay_name']) && $param['pay_name'])
            {
                $data['order_id']   = $param['order_id'];
                $data['pay_name']   = trim($param['pay_name']);
                $pay = explode('_', $data['pay_name']);
                $data['pay_class']  = $pay[1]. '\\' . $pay[0];
                $data['pay_status'] = 1;
                $data['status']     = 'WAIT_SELLER_SEND_GOODS';
                $data['pay_time']   = time();
                $data['pay_ip']     = get_client_ip();
                //$data['cancel_status'] = 'NO_APPLY';
                //$data['cancel_reason'] = '';
                //$data['cancel_time']   = 0;
                
                $PaymentBill = new \app\stools\model\PaymentBill();
                $orderRow = $PaymentBill::where(['order_sn' => $orderInfo['data']['order_sn']])->find();
                if (!$orderRow) {
                    $PaymentBill->save([
                        'uid'         => (int)$orderInfo['data']['user_id'],
                        'money'       => $orderInfo['data']['order_amount'],
                        'status'      => 'succ',
                        'pay_class'   => $data['pay_class'],
                        'pay_name'    => $data['pay_name'],
                        'pay_account' => 'admin',
                        't_payed'     => time(),
                        'order_sn'    => $orderInfo['data']['order_sn'],
                        'currency'    => 'CNY',
                        'trade_no'    => $data['trade_no'],
                        'collection'  => 'system'
                    ]);
                }
                
                $res = Orderapi::updateOrderStatus($orderInfo['data']['order_sn'], $data['pay_class']);
            }else{
                $data['order_id']   = $param['order_id'];
                $data['order_sn']   = $orderInfo['data']['order_sn'];
                $data['pay_name']   = '';
                $data['pay_class']  = '';
                $data['pay_status'] = 0;
                $data['status']     = 'WAIT_BUYER_PAY';
                $data['pay_time']   = 0;
                $data['pay_ip']     = 0;
                $res = Orderapi::updateOrder($data);
            }
            
            if($res['code'])
            {
                $this->success($res['msg'], $this->jumpUrl);
            }
            
            $this->error($res['msg'], $this->jumpUrl);
        }else{
            $ordersn    = isset($param['ordersn']) ? trim($param['ordersn']) : '';
    
            $filter = [
                'subjection'  => 'seapays',
                'status'      => 1
            ];
            $payments = ExtendApi::getExt($filter);
    
            $where      = [
                'model' => 'Order',
                'where' => ['order_sn' => $ordersn],
            ];
            $data       = Orderapi::getOne($where);
            
            $this->assign('data', $data['data']);
            $this->assign('payments', $payments['data'] ? $payments['data'] : null);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:取消订单
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/16
     */
    public function cancel()
    {
        $input   = $this->request->param();
        $ordersn = isset($input['ordersn']) ? trim($input['ordersn']) : '';  //订单号
        
        if($this->request->isPost())
        {
            $reason     = isset($input['cancel_reason']) ? trim($input['cancel_reason']) : '';  //取消原因
            $order_id   = isset($input['order_id']) ? trim($input['order_id']) : '';  //订单ID
            
            if(empty($reason) || empty($order_id))
            {
                return json(['code' => 0, 'msg' => empty($order_id) ? lang('Error_id') : lang('Must has reason')]);
            }

            $reasonArr = [
                'cancel_type'   => 0, //0 退款(仅退款不退货) 1 退款退货 2 换货
                'cancel_reason' => $reason,
                'cancel_reason_log' => lang('admin_cancelorder'),
                'order_id'      => $order_id,
                'cancel_opt'    => 'admin:'. UID,
                'cancel_soruce' => PLATFORM,
                'role' => 'admin',
            ];
            $res = Orderapi::cancelOrderApi($reasonArr);
            if($res['code'])
            {
                $this->success($res['msg'], $this->jumpUrl);
            }
            $this->error($res['msg'], $this->jumpUrl);
        }
        
        $where      = [
            'model' => 'Order',
            'where' => ['order_sn' => $ordersn],
        ];
        $data       = Orderapi::getOne($where);
        $this->assign('data', $data['data']);
        $this->assign('meta_title', lang('Ocancel'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 订单发货
     * @return mixed|\think\response\Json
     * @Author: WangHuaLong
     */
    public function deliver()
    {
        $input   = $this->request->param();
        $orderid = isset($input['order_id']) ? trim($input['order_id']) : '';  //订单ID
    
        if (!$orderid) return json(['code' => 0, 'msg' => lang('Error_id')]);
        
        $data = OrderModel::get($orderid,'goods');
        
        if($data === null||$data['goods']===null||$data['status']!='WAIT_SELLER_SEND_GOODS'){
            return json(['code' => 0, 'msg' => lang('Error_id')]);
        }
        
        // 提交时的处理
        if($this->request->isPost())
        {
            // 检查是否已发货，不可以重复发货
            $request_data = $this->request->post();
            $shipping_name = $request_data['shipping_name'];
            $shipping_no = $request_data['shipping_no'];
            if($shipping_no == '' || $shipping_name == ''){
                return json(['code' => 0, 'msg' => lang('shipping_null')]);
            }
            
            $update_data = [
                'status' => 'WAIT_BUYER_CONFIRM_GOODS',
                'shipping_name' => $shipping_name,
                'shipping_no' => $shipping_no,
                'shipping_status' => 1,
                'shipping_time' => time()
            ];
            $result = $data->isUpdate(true)->save($update_data);
    
            /**
             * 订单日志
             */
            OrderLogApi::writelog([
                'order_id'  => $data['order_id'],
                'order_sn'  => $data['order_sn'],
                'user'      => UID,
                'role'      => 'admin',
                'result'    => $result,
                'soruce'    => PLATFORM,
                'action'    => 'update_order',
                'params'    => json_encode($update_data),
                'remark'    => lang('shipping_send')
            ]);
    
            if($result){
                return json(['code' => 1, 'msg' => lang('send_ok'),'url'=>$this->jumpUrl]);
            }else{
                return json(['code' => 0, 'msg' => lang('send_error')]);
            }
            
        }
        
        // 获取订单的运费模板的所有快递公司
        if($data['transport_id']==0){
            $express = ExpressModel::all();
        }else{
            $map = [
                'id' => $data['transport_id']
            ];
            $express_ids = TransportModel::where($map)->value('express_ids');
            $map2 = [
                'id' => ['in',$express_ids]
            ];
            $express = ExpressModel::where($map2)->select();
        }
        $this->assign('express', $express);
        
        // 发货仓库
        $warehouse_name = null;
        if($data['warecode']!=''){
            $map3 = [
                'code' => $data['warecode']
            ];
            $warehouse_name = CrosswareModel::where($map3)->value('name');
        }
        $this->assign('warehouse_name',$warehouse_name);
        
        $this->assign('data', $data);
        $this->assign('goods', $data['goods']);
        return $this->fetch();
    }
    
    /*
     * @Mark:保存发货信息
     * @return mixed
     * @param expresscom string 用‘_’连接的快递公司代码和快递公司id
     * @param expresssn string 快递单号
     * @param order_id int 订单id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/19
     * */
    public function save()
    {
        $arr = explode('_', trim(input('expresscom')));
        $expresscom = $arr[1];//快递公司代码
        $expresssn = trim(input('expresssn'));//快递单号
        $express_id = (int)$arr[0];//快递公司id
        $order_id = (int)trim(input('order_id'));//订单id
        if (empty($expresscom) || $express_id == 0 || empty($expresssn) || $order_id == 0) return json(['code' => 0, 'msg' => lang('Error_Param')]);
        $re = Delivery::store($expresscom, $express_id, $expresssn, $order_id);
        if ($re) {
            return json(['code' => '1', 'msg' => lang('Submit') . lang('Success')]);
        } else {
            return json(['code' => '1', 'msg' => lang('Error_Operate')]);
        }
        
    }
    
}