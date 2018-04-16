<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Order.php  Version 2017/6/7
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\order\model\Order as OrderModel;
use app\order\service\Refund as RefundApi;
use app\order\model\Afterservice as AfterserviceModel;
use think\Lang;
use app\order\model\OrderLog as OrderLogModel;
use app\order\service\OrderLog as OrderLogApi;
use think\Session;
use app\seller\model\Store as StoreModel;
use app\order\model\Goods as OrderGoodsModel;
use app\seller\model\Transport as TransportModel;
use app\bcwareexp\model\Express as ExpressModel;
use app\bcwareexp\model\Crossware as CrosswareModel;


class Order extends Common
{
    // 分页数
    private $page;
    
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('arr_platform', config('platform'));
    
        // 加载扩展的语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    
        $this->page = Config('paginate.list_rows') > 0 ? Config('paginate.list_rows') : 10;
    
    }
    
    /**
     * @Mark: 订单列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        // 查询条件
        $map = [
            'seller_id' => SellerId
        ];
        
        $request_data = $this->request->param();
        
        // 订单状态
        $order_status = '';
        if (isset($request_data['order_status']) && $request_data['order_status'] != '') {
            $map['status'] = $request_data['order_status'];
            $order_status  = $request_data['order_status'];
        }
        $this->assign('order_status', $order_status);
        $arr_order_status = [
            'WAIT_BUYER_PAY',
            'WAIT_SELLER_SEND_GOODS',
            'WAIT_BUYER_CONFIRM_GOODS',
            'TRADE_FINISHED',
            'TRADE_CLOSED'
        ];
        $this->assign('arr_order_status', $arr_order_status);
        $new_input = input();
        unset($new_input['order_status']);
        unset($new_input['page']);
        $this->assign('order_status_url', $new_input);
    
        // 来源平台
        $platform_type = '';
        if (isset($request_data['platform_type']) && $request_data['platform_type'] != '') {
            $map['platform_type'] = $request_data['platform_type'];
            $platform_type        = $request_data['platform_type'];
        }
        $this->assign('platform_type', $platform_type);
        $new_input = input();
        unset($new_input['platform_type']);
        unset($new_input['page']);
        $this->assign('platform_type_url', $new_input);
        
        // 指定开始结束日期
        $time = '';
        if (isset($request_data['time']) && $request_data['time'] != '') {
            if (strpos($request_data['time'], '-') !== false) {
                $time  = explode('-', $request_data['time']);
                $start = strtotime($time[0]);
                $end   = strtotime($time[1]);
                if ($start != '' && $end != '') {
                    $map['create_time'] = ['between time', [$start, $end]];
                } elseif ($start != '' && $end == '') {
                    $map['create_time'] = ['>', $start];
                } elseif ($start == '' && $end != '') {
                    $map['create_time'] = ['<', $end];
                }
                $time = $request_data['time'];
            }
        }
        $this->assign('time', $time);
        
        // 搜索收货人姓名，手机号码，订单编号,商品名称
        $search_name = '';
        if (isset($request_data['search_name']) && trim($request_data['search_name']) != '') {
            $search_name = trim($request_data['search_name']);
            $map2 = [
                'consignee|mobile|order_sn' => ['like', '%' . $search_name . '%'],
                'seller_id' => SellerId
            ];
            
            $all_ids = [];
            $ids2 = OrderModel::where($map2)->column('order_id');
            if ($ids2 !== null) {
                $all_ids = array_merge($all_ids, $ids2);
            }
            
            // 商品名称
            if(!is_numeric($request_data['search_name'])){
                $map3 = [
                    'goods_name' => ['like','%'.$search_name.'%'],
                    'seller_id' => SellerId
                ];
                $ids3 = OrderGoodsModel::where($map3)->column('order_id');
                if($ids3!==null){
                    $all_ids = array_merge($all_ids, $ids3);
                }
            }
    
            if (!empty($all_ids)) {
                $map['order_id'] = ['in', $all_ids];
            }else{
                $map['order_id'] = ['in', '0'];
            }
            
        }
        $this->assign('search_name', $search_name);
        
        $list = OrderModel::where($map)->order('create_time', 'DESC')->paginate($this->page);
        $total = OrderModel::where($map)->count();
        $this->assign('total',$total);
        $this->assign('list', $list);
        $this->assign('meta_title', lang('order_list'));
        return $this->fetch();
    }
    
    /**
     * @Mark:订单详情
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function info()
    {
        $order_sn = $this->request->param('order_sn');
        //订单详情
        $info = OrderModel::get(['order_sn' => $order_sn], 'user,goods');
        //会员信息
        $user_info = $info['user'];
        //订单商品信息
        $goods_info = $info['goods'];
    
        // 获取商品的物流查询
        $filter_data = array(
            'subjection' => 'expresss',
            PLATFORM => 1,
            'status' => 1
        );
        $express = \app\common\service\Extend::getOneExt($filter_data);
        if ($express['code'] && $info['shipping_no'] != '' && $info['shipping_name'] != '') {
            $api_code = $express['data']['code'];  // 使用的插件code
            $extClass = "\\expresss\\" . $api_code;
            $api_express = new $extClass();
            $shipping_info = [
                'shipping_no' => $info['shipping_no'],
                'shipping_company' => $info['shipping_name']
            ];
            $traces = $api_express->response($shipping_info);
            // 物流状态，跟踪信息
            $this->assign('traces', $traces);
        
        } else {
            // 无可用的物流查询接口
            $traces = ['code' => 0, 'msg' => lang('express_api_error'), 'data' => ''];
            $this->assign('traces', $traces);
        }
        
        $show_id = $info['store']['show_customer_id'];
        $this->assign('show_id', $show_id);
        $this->assign('goods_info', $goods_info);
        $this->assign('user_info', $user_info);
        $this->assign('info', $info);
        return $this->fetch();
    }
    
    /**
     * @Mark:  发货页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function deliver()
    {
        $order_sn = $this->request->param('order_sn');
        //订单详情
        $info = OrderModel::get(['order_sn' => $order_sn], 'user,goods');
        
        //订单商品信息
        $goods_info = $info['goods'];
        $this->assign('goods_info', $goods_info);
        
        $this->assign('info', $info);
    
        // 获取订单的运费模板的所有快递公司
        if($info['transport_id']==0){
            $express = ExpressModel::all();
        }else{
            $map = [
                'id' => $info['transport_id']
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
        if($info['warecode']!=''){
            $map3 = [
                'code' => $info['warecode']
            ];
            $warehouse_name = CrosswareModel::where($map3)->value('name');
        }
        $this->assign('warehouse_name',$warehouse_name);
        
        
        return $this->fetch();
    }
    
    public function save_deliver(){
        
        // 检查是否已发货，不可以重复发货
        $request_data = $this->request->post();
        $shipping_name = $request_data['shipping_name'];
        $shipping_no = $request_data['shipping_no'];
        if(!isset($request_data['order_sn'])){
            return json(['code' => 0, 'msg' => lang('Error_id')]);
        }
        if($shipping_no == '' || $shipping_name == ''){
            return json(['code' => 0, 'msg' => lang('shipping_null')]);
        }
        
        $map = [
            'order_sn' => $request_data['order_sn']
        ];
        $order = OrderModel::get($map,'goods');
    
        if($order === null||$order['goods']===null||$order['status']!='WAIT_SELLER_SEND_GOODS'){
            return json(['code' => 0, 'msg' => lang('Error_id')]);
        }
    
        $update_data = [
            'status' => 'WAIT_BUYER_CONFIRM_GOODS',
            'shipping_name' => $shipping_name,
            'shipping_no' => $shipping_no,
            'shipping_status' => 1,
            'shipping_time' => time()
        ];
    
        $result = $order->isUpdate(true)->save($update_data);
    
        /**
         * 订单日志
         */
        OrderLogApi::writelog([
            'order_id'  => $order['order_id'],
            'order_sn'  => $order['order_sn'],
            'user'      => SellerId,
            'role'      => 'seller',
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
    
    /**
     * @Mark: 查看收货人的身份证信息
     * @return mixed|void
     * @Author: WangHuaLong
     */
    public function idnumber()
    {
        $order_sn = $this->request->param('order_sn');
        //订单详情
        $info    = OrderModel::get(['order_sn' => $order_sn]);
        $show_id = $info['store']['show_customer_id'];
        if ($show_id == 0) {
            $this->redirect('error/illegality');
        }
        
        $this->assign('data', $info);
        return $this->fetch();
    }
    
    /**
     * @Mark: 取消订单列表页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function cancel()
    {
        // 加载支付方式的语言包
        $langfile = RUNTIME_PATH . '/lang/extend_' . $this->lang . '.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
        
        // 取消订单状态
        $arr_cancel_status = [
            'WAIT_PROCESS',
            'REFUND_PROCESS',
            'SUCCESS',
            'FAILS'
        ];
        $this->assign('arr_cancel_status', $arr_cancel_status);
        
        
        // 查询条件
        $map = [
            'seller_id' => SellerId
        ];
        
        $request_data = $this->request->param();
        
        // 订单状态
        $map['status']        = ['in', 'WAIT_SELLER_SEND_GOODS,TRADE_CLOSED'];
        $map['cancel_status'] = ['<>', 'NO_APPLY'];
        
        // 取消订单状态
        $cancel_status = '';
        if (isset($request_data['cancel_status']) && $request_data['cancel_status'] != '') {
            $map['cancel_status'] = $request_data['cancel_status'];
            $cancel_status        = $request_data['cancel_status'];
        }
        $this->assign('cancel_status', $cancel_status);
        $new_input = input();
        unset($new_input['cancel_status']);
        unset($new_input['page']);
        $this->assign('cancel_status_url', $new_input);
        
        
        // 来源平台
        $platform_type = '';
        if (isset($request_data['platform_type']) && $request_data['platform_type'] != '') {
            $map['platform_type'] = $request_data['platform_type'];
            $platform_type        = $request_data['platform_type'];
        }
        $this->assign('platform_type', $platform_type);
        $new_input = input();
        unset($new_input['platform_type']);
        unset($new_input['page']);
        $this->assign('platform_type_url', $new_input);
        
        
        // 指定取消订单日期
        $time = '';
        if (isset($request_data['time']) && $request_data['time'] != '') {
            if (strpos($request_data['time'], '-') !== false) {
                $time  = explode('-', $request_data['time']);
                $start = strtotime($time[0]);
                $end   = strtotime($time[1]);
                if ($start != '' && $end != '') {
                    $map['cancel_time'] = ['between time', [$start, $end]];
                } elseif ($start != '' && $end == '') {
                    $map['cancel_time'] = ['>', $start];
                } elseif ($start == '' && $end != '') {
                    $map['cancel_time'] = ['<', $end];
                }
                $time = $request_data['time'];
            }
        }
        $this->assign('time', $time);
    
    
        // 搜索收货人姓名，手机号码，订单编号,商品名称
        $search_name = '';
        if (isset($request_data['search_name']) && trim($request_data['search_name']) != '') {
            $search_name = trim($request_data['search_name']);
            $map2 = [
                'consignee|mobile|order_sn' => ['like', '%' . $search_name . '%'],
                'seller_id' => SellerId
            ];
        
            $all_ids = [];
            $ids2 = OrderModel::where($map2)->column('order_id');
            if ($ids2 !== null) {
                $all_ids = array_merge($all_ids, $ids2);
            }
        
            // 商品名称
            if(!is_numeric($request_data['search_name'])){
                $map3 = [
                    'goods_name' => ['like','%'.$search_name.'%'],
                    'seller_id' => SellerId
                ];
                $ids3 = OrderGoodsModel::where($map3)->column('order_id');
                if($ids3!==null){
                    $all_ids = array_merge($all_ids, $ids3);
                }
            }
        
            if (!empty($all_ids)) {
                $map['order_id'] = ['in', $all_ids];
            }else{
                $map['order_id'] = ['in', '0'];
            }
        
        }
        $this->assign('search_name', $search_name);
        $list = OrderModel::where($map)->order('create_time', 'DESC')->paginate($this->page);
        $this->assign('list', $list);
        
        $total = OrderModel::where($map)->count();
        $this->assign('total',$total);
        
        $this->assign('meta_title', lang('cancel_order'));
        return $this->fetch();
        
    }
    
    /**
     * @Mark: 取消订单的操作页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function cancel_info()
    {
        
        $order_sn = $this->request->param('order_sn');
        $map      = [
            'order_sn'      => $order_sn,
            'status'        => ['in', 'WAIT_SELLER_SEND_GOODS,TRADE_CLOSED'],
            'cancel_status' => ['<>', 'NO_APPLY']
        ];
        
        //订单详情
        $info = OrderModel::get($map);
        if ($info == null) {
            $this->redirect('error/index');
        }
        $this->assign('order_sn', $order_sn);
        
        $this->assign('info', $info);
        
        $map2    = [
            'order_sn' => $order_sn,
            'action'   => 'cancel_order'
        ];
        $history = OrderLogModel::where($map2)->order('create_time', 'ASC')->select();
        
        
        $this->assign('history', $history);
        
        return $this->fetch();
    }
    
    /**
     * @Mark: 取消订单操作
     * @return array
     * @Author: WangHuaLong
     */
    public function edit_cancel()
    {
        $request_data = $this->request->post();
        
        // 获取订单数据
        $order = OrderModel::get($request_data['order_id']);
        if ($order == null) {
            $this->redirect('error/index');
        }
        
        
        $map = [
            'order_id'  => $request_data['order_id'],
            'seller_id' => SellerId
        ];
        
        /*if (isset($request_data['remark']) && trim($request_data['remark']) == '') {
            return ['code' => 0, 'msg' => lang('remark_reason_have_to')];
        }*/
        
        $log_result = 1;
        // 是否同意退款
        $remark = '';
        if (isset($request_data['agree'])) {
            if ($request_data['agree'] == 1) {
                $remark = lang('seller_agree_cancel');
                
                // 生成退款记录，财务退款
                $insert_data = [
                    'order_id' => $request_data['order_id'],  //订单id
                    'contents' => $request_data['remark'],  //退款理由
                    'money'    => $order['order_amount'],  //退款金额
                    'rtype'    => 0
                ];
                $result      = RefundApi::createRefund($insert_data);
                if ($result['code'] == 0) {
                    return $result;
                }
                
                OrderModel::where($map)->update(['cancel_status' => 'REFUND_PROCESS']);
                
                // 操作人员日志
                $log_info = lang('refund_cancel_do') . $request_data['order_sn'] . lang('user_action') . Session::get('sellername');
                seller_log(SellerId, Session::get('userid'), $log_info);
            } else {
                $remark = lang('seller_disagree_cancel') . $request_data['remark'];
                
                $log_result = 0;
                OrderModel::where($map)->update(['cancel_status' => 'FAILS']);
                
                // 操作人员日志
                $log_info = lang('refund_cancel_faile') . $request_data['order_sn'] . lang('user_action') . Session::get('sellername');
                seller_log(SellerId, Session::get('userid'), $log_info);
            }
        }
        
        // 创建取消订单日志信息
        OrderLogApi::writelog([
            'order_id' => $request_data['order_id'],
            'order_sn' => $request_data['order_sn'],
            'user'     => SellerId,
            'role'     => 'seller',
            'result'   => $log_result,
            'soruce'   => PLATFORM,
            'action'   => 'cancel_order',
            'params'   => json_encode($request_data),
            'remark'   => $remark,
        ]);
        
        
        return ['code' => 1, 'msg' => lang('save_ok')];
    }
    
    /**
     * @Mark: 商品售后列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function after_sale()
    {
        // 查询条件
        $map = [
            'seller_id' => SellerId
        ];
        
        $request_data = $this->request->param();
        
        // 订单状态
        $map['status'] = ['in', 'WAIT_BUYER_CONFIRM_GOODS'];
        
        // 来源平台
        $platform_type = '';
        if (isset($request_data['platform_type']) && $request_data['platform_type'] != '') {
            $map['platform_type'] = $request_data['platform_type'];
            $platform_type        = $request_data['platform_type'];
        }
        $this->assign('platform_type', $platform_type);
        $new_input = input();
        unset($new_input['platform_type']);
        unset($new_input['page']);
        $this->assign('platform_type_url', $new_input);
    
        // 搜索收货人姓名，手机号码，订单编号,商品名称
        $search_name = '';
        if (isset($request_data['search_name']) && trim($request_data['search_name']) != '') {
            $search_name = trim($request_data['search_name']);
            $map4 = [
                'consignee|mobile|order_sn' => ['like', '%' . $search_name . '%'],
                'seller_id' => SellerId
            ];
        
            $all_ids = [];
            $ids4 = OrderModel::where($map4)->column('order_id');
            if ($ids4 !== null) {
                $all_ids = array_merge($all_ids, $ids4);
            }
            
            
            
            // 商品名称,只搜索售后商品的名称不包括订单的商品
            if(!is_numeric($request_data['search_name'])){
                $map3 = [
                    'goods_name' => ['like','%'.$search_name.'%'],
                    'seller_id' => SellerId
                ];
                
                // 获取售后的商品的id
                $map5 = [
                    'seller_id' => SellerId
                ];
                $ids5 = AfterserviceModel::where($map5)->column('rec_id');
                if ($ids5 !== null) {
                    $map3['rec_id'] = ['in',$ids5];
                }
                
                $ids3 = OrderGoodsModel::where($map3)->column('order_id');
                if($ids3!==null){
                    $all_ids = array_merge($all_ids, $ids3);
                }
            }
        
            if (!empty($all_ids)) {
                $map['order_id'] = ['in', $all_ids];
            }else{
                $map['order_id'] = ['in', '0'];
            }
        
        }
        $this->assign('search_name', $search_name);
        
        // 关联订单表
        
        $order_ids = OrderModel::where($map)->order('create_time', 'DESC')->column('order_id');
        
        // 指定售后类型
        $map2 = [];
        
        $rtype = false;
        if (isset($request_data['rtype']) && $request_data['rtype'] != '') {
            $map2['rtype'] = $request_data['rtype'];
            $rtype         = $request_data['rtype'];
        }
        $this->assign('rtype', $rtype);
        $new_input = input();
        unset($new_input['rtype']);
        unset($new_input['page']);
        $this->assign('rtype_url', $new_input);
        $this->assign('arr_rtype', [0, 1, 2]);
        
        // 指定售后状态
        $status = false;
        if (isset($request_data['status']) && $request_data['status'] != '') {
            $map2['status'] = $request_data['status'];
            $status         = $request_data['status'];
        }
        $this->assign('status', $status);
        $new_input = input();
        unset($new_input['status']);
        unset($new_input['page']);
        $this->assign('status_url', $new_input);
        $this->assign('arr_status', [0, 1, 2, 3, 4, 5, 6, 7, 8]);
        
        
        // 指定申请日期
        $time = '';
        if (isset($request_data['time']) && $request_data['time'] != '') {
            if (strpos($request_data['time'], '-') !== false) {
                $time  = explode('-', $request_data['time']);
                $start = strtotime($time[0]);
                $end   = strtotime($time[1]);
                if ($start != '' && $end != '') {
                    $map2['create_time'] = ['between time', [$start, $end]];
                } elseif ($start != '' && $end == '') {
                    $map2['create_time'] = ['>', $start];
                } elseif ($start == '' && $end != '') {
                    $map2['create_time'] = ['<', $end];
                }
                $time = $request_data['time'];
            }
        }
        $this->assign('time', $time);
        
        
        if ($order_ids != null) {
            $map2['order_id'] = ['in', $order_ids];
            $list             = AfterserviceModel::where($map2)->order('create_time', 'DESC')->paginate($this->page);
            $total = AfterserviceModel::where($map2)->count();
        } else {
            $list = null;
            $total = 0;
        }
        
        $this->assign('list', $list);
        $this->assign('total',$total);
        
        $this->assign('meta_title', lang('ChangeOrRefund'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 售后详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function after_sale_info()
    {
        $order_sn = $this->request->param('order_sn');
        $rec_id   = $this->request->param('rec_id');
        $map      = [
            'order_sn' => $order_sn,
            'rec_id'   => $rec_id
        ];
        
        // 退换货表
        $after_sale  = AfterserviceModel::get($map, 'goods,orderGoods,getorder');
        $getorder    = $after_sale['getorder'];
        $good        = $after_sale['goods'];
        $order_goods = $after_sale['orderGoods'];
        
        if ($after_sale === null || $getorder === null || $good === null) {
            $this->redirect('error/index');
        }
        
        // 图片
        $images = [];
        if ($after_sale['return_images']) {
            $images = explode(',', $after_sale['return_images']);
        }
        $this->assign('images', $images);
        
        // 商家退货地址
        $map2               = [
            'seller_id' => SellerId
        ];
        $after_sale_address = StoreModel::where($map2)->value('after_sale_address');
        
        
        $this->assign('after_sale_address', $after_sale_address);
        $this->assign('order_goods', $order_goods);
        $this->assign('order', $getorder);
        $this->assign('good', $good);
        $this->assign('info', $after_sale);
        return $this->fetch();
    }
    
    /**
     * @Mark: 保存售后信息
     * @return array
     * @Author: WangHuaLong
     */
    public function edit_after_sale()
    {
        $request_data = $this->request->post();
        $after_sn     = $request_data['after_sn'];
        $map          = [
            'after_sn' => $after_sn
        ];
        
        // 退换货表
        $after_sale = AfterserviceModel::get($map, 'getorder');
        $getorder   = $after_sale['getorder'];
        if ($after_sale === null || $getorder === null) {
            $this->redirect('error/index');
        }
        
        // 操作人员日志
        $log_info = lang('afterservice_action') . $after_sale['after_sn'] . lang('user_action') . Session::get('sellername');
        $action = 'afterservice';
        $remark = '';
        
        // 未审核状态下,退款，退货情况下
        if (isset($request_data['agree']) && isset($request_data['applyprice']) && $after_sale['status']==0) {
            
            if ($request_data['agree'] == 1) {
                // 需要检查退款金额
                if ($request_data['applyprice'] <= 0 || $request_data['applyprice'] > $getorder['order_amount'] || $request_data['applyprice'] == '') {
                    return ['code' => 0, 'msg' => lang('applyprice_error')];
                }
                
                
                // 只退款情况下，生成退款单
                if ($after_sale['rtype'] == 0) {
                    // 生成退款记录，财务退款
                    $insert_data = [
                        'order_id' => $after_sale['order_id'],
                        'contents' => $after_sale['return_description'],
                        'return_reason' => $after_sale['return_reason'],
                        'money'    => $request_data['applyprice'],
                        'rtype'    => 1,
                        'after_sn' => $after_sale['after_sn']
                    ];
                    $result      = RefundApi::createRefund($insert_data);
                    if ($result['code'] == 0) {
                        return $result;
                    }
                }
                AfterserviceModel::where($map)->update(['status' => 3, 'applyprice' => $request_data['applyprice']]);
                
            } else {
                // 拒绝理由
                if(!isset($request_data['disagree_reason'])){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }else if (trim($request_data['disagree_reason'])==''){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }
                $remark = $request_data['disagree_reason'];
                
                AfterserviceModel::where($map)->update(['status' => 4, 'applyprice' => 0]);
                $action = 'refuse_afterservice';
                // 操作人员日志
                $log_info = lang('afterservice_action_fail') . $after_sale['after_sn'] . lang('user_action') . Session::get('sellername');
            }
        }
        
        // 退货退款，同意/不同意退款
        if (isset($request_data['agree']) && isset($request_data['agree_return'])) {
            if ($request_data['agree'] == 1) {
    
                if(isset($request_data['applyprice'])){
                    if ($request_data['applyprice'] <= 0 || $request_data['applyprice'] > $getorder['order_amount'] || $request_data['applyprice'] == '') {
                        return ['code' => 0, 'msg' => lang('applyprice_error')];
                    }
                    $money = $request_data['applyprice'];
                        
                }else{
                    $money = $after_sale['applyprice'];
                }
                
                // 生成退款记录，财务退款
                $insert_data = [
                    'order_id' => $after_sale['order_id'],
                    'contents' => $after_sale['return_description'],
                    'return_reason' => $after_sale['return_reason'],
                    'money'    => $money,
                    'rtype'    => 1,
                    'after_sn' => $after_sale['after_sn']
                ];
                $result      = RefundApi::createRefund($insert_data);
                if ($result['code'] == 0) {
                    return $result;
                }
    
                AfterserviceModel::where($map)->update(['status' => 6]);
            } else {
                // 拒绝理由
                if(!isset($request_data['disagree_reason'])){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }else if (trim($request_data['disagree_reason'])==''){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }
                $remark = $request_data['disagree_reason'];
                
                AfterserviceModel::where($map)->update(['status' => 2,'applyprice' => 0]);
                $action = 'refuse_afterservice';
            }
        }
        
        // 换货
        if (isset($request_data['agree']) && isset($request_data['exchange'])){
            if($request_data['agree']==1){
                AfterserviceModel::where($map)->update(['status' => 3]);
            }else{
                // 拒绝理由
                if(!isset($request_data['disagree_reason'])){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }else if (trim($request_data['disagree_reason'])==''){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }
                $remark = $request_data['disagree_reason'];
        
                AfterserviceModel::where($map)->update(['status' => 4]);
                $action = 'refuse_afterservice';
            }
        }
    
        // 回寄商品
        if (isset($request_data['agree']) && isset($request_data['agree_exchange'])){
            if($request_data['agree']==1){
                AfterserviceModel::where($map)->update(['status' => 6]);
            }else{
                // 拒绝理由
                if(!isset($request_data['disagree_reason'])){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }else if (trim($request_data['disagree_reason'])==''){
                    return ['code' => 0, 'msg' => lang('disagree_reason_null')];
                }
                $remark = $request_data['disagree_reason'];
                
                AfterserviceModel::where($map)->update(['status' => 2]);
                $action = 'refuse_afterservice';
            }
        }
        
        // 创建售后订单日志信息
        OrderLogApi::writelog([
            'order_id' => $after_sale['order_id'],
            'order_sn' => $after_sale['order_sn'],
            'user'     => SellerId,
            'role'     => 'seller',
            'result'   => 1,
            'soruce'   => PLATFORM,
            'action'   => $action,
            'params'   => json_encode($request_data),
            'remark'   => $remark,
        ]);
        
        // 商家操作日志
        seller_log(SellerId, Session::get('userid'), $log_info);
        
        return ['code' => 1, 'msg' => lang('save_ok')];
    }
    
}