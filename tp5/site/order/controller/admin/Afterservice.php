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
// | Refund.php  Version 1.0  2016/3/13 售后申请列表
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;
use app\order\service\OrderLog as OrderLogApi;
use app\order\service\Afterservice as AfterserviceApi;
use app\order\model\Afterservice as AfterserviceModel;
use app\order\model\Order as OrderModel;
use app\order\model\Goods as OrderGoodsModel;
use app\order\service\Refund as RefundApi;

class Afterservice extends Admin
{
    // 分页数
    private $page;
    
    /**
     * @Mark:售后申请列表初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function _initialize()
    {
        parent::_initialize();
        
        $this->page = Config('paginate.list_rows') > 0 ? Config('paginate.list_rows') : 10;
    }
    
    /**
     * @Mark: 售后申请列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        $request_data = input();
        
        // 订单状态
        $map           = [];
        $map['status'] = ['in', 'WAIT_BUYER_CONFIRM_GOODS'];
        
        // 搜索收货人姓名，手机号码，订单编号,商品名称
        $search_name = '';
        if (isset($request_data['search_name']) && trim($request_data['search_name']) != '') {
            $search_name = trim($request_data['search_name']);
            $map4        = [
                'consignee|mobile|order_sn' => ['like', '%' . $search_name . '%']
            ];
            
            $all_ids = [];
            $ids4    = OrderModel::where($map4)->column('order_id');
            if ($ids4 !== null) {
                $all_ids = array_merge($all_ids, $ids4);
            }
            
            
            // 商品名称,只搜索售后商品的名称不包括订单的商品
            if (!is_numeric($request_data['search_name'])) {
                $map3 = [
                    'goods_name' => ['like', '%' . $search_name . '%']
                ];
                
                // 获取售后的商品的id
                $map5 = [];
                $ids5 = AfterserviceModel::where($map5)->column('rec_id');
                if ($ids5 !== null) {
                    $map3['rec_id'] = ['in', $ids5];
                }
                
                $ids3 = OrderGoodsModel::where($map3)->column('order_id');
                if ($ids3 !== null) {
                    $all_ids = array_merge($all_ids, $ids3);
                }
            }
            
            if (!empty($all_ids)) {
                $map['order_id'] = ['in', $all_ids];
            } else {
                $map['order_id'] = ['in', '0'];
            }
            
        }
        $this->assign('search_name', $search_name);
        
        // 搜索链接
        $new_input = input();
        unset($new_input['page']);
        unset($new_input['search_name']);
        unset($new_input['start_time']);
        unset($new_input['end_time']);
        $this->assign('search_url', $new_input);
        
        
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
        
        // 指定申请日期
        $start = '';
        $end   = '';
        if (isset($request_data['start_time']) || isset($request_data['end_time'])) {
            if (isset($request_data['start_time'])) {
                $start = $request_data['start_time'];
            }
            if (isset($request_data['end_time'])) {
                $end = $request_data['end_time'];
            }
            if ($start != '' && $end != '') {
                $map2['create_time'] = ['between time', [$start, $end]];
            } elseif ($start != '' && $end == '') {
                $map2['create_time'] = ['>', $start];
            } elseif ($start == '' && $end != '') {
                $map2['create_time'] = ['<', $end];
            }
        }
        $this->assign('start_time', urldecode($start));
        $this->assign('end_time', urldecode($end));
        
        // 指定排序
        if (isset($request_data['_field'])) {
            $field = $request_data['_field'];
        } else {
            $field = 'create_time';
        }
        if (isset($request_data['_order'])) {
            $order = $request_data['_order'];
        } else {
            $order = 'DESC';
        }
        
        if ($order_ids != null) {
            $map2['order_id'] = ['in', $order_ids];
            $list             = AfterserviceModel::where($map2)->order($field, $order)->paginate($this->page);
            $total            = AfterserviceModel::where($map2)->count();
            $this->assign('page', $list->render());
        } else {
            $list  = null;
            $total = 0;
            $this->assign('page', null);
        }
        
        $this->assign('list', $list);
        
        $this->assign('_total', $total);
        $this->assign('meta_title', lang('order_list'));
        $this->assign('arr_status', [0, 1, 2, 3, 4, 5, 6, 7, 8]);
        return $this->fetch();
    }
    
    /**
     * @Mark: 拒绝申请
     * @return bool
     * @Author: WangHuaLong
     */
    public function refuse()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $result = AfterserviceApi::refuse_apply((int)$value);
                
                $after_sale = AfterserviceModel::get((int)$value);
                // 创建售后订单日志信息
                if ($after_sale !== null) {
                    OrderLogApi::writelog([
                        'order_id' => $after_sale['order_id'],
                        'order_sn' => $after_sale['order_sn'],
                        'user'     => UID,
                        'role'     => 'admin',
                        'result'   => 1,
                        'soruce'   => PLATFORM,
                        'action'   => 'refuse_afterservice',
                        'params'   => json_encode(input()),
                        'remark'   => lang('batch_operation'),
                    ]);
                }
            }
        } else {
            if (input('?param.ids')) {
                $result = AfterserviceApi::refuse_apply((int)input('param.ids'));
                
                $after_sale = AfterserviceModel::get((int)input('param.ids'));
                // 创建售后订单日志信息
                if ($after_sale !== null) {
                    OrderLogApi::writelog([
                        'order_id' => $after_sale['order_id'],
                        'order_sn' => $after_sale['order_sn'],
                        'user'     => UID,
                        'role'     => 'admin',
                        'result'   => 1,
                        'soruce'   => PLATFORM,
                        'action'   => 'refuse_afterservice',
                        'params'   => json_encode(input()),
                        'remark'   => lang('batch_operation'),
                    ]);
                }
            } else {
                $this->error(lang('refuse_error'), $this->jumpUrl);
            }
        }
        
        if ($result['code']) {
            $this->success(lang('action_ok'), $this->jumpUrl);
        } else {
            return $result;
        }
    }
    
    /**
     * @Mark: 售后详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function modify()
    {
        $id  = $this->request->param('id');
        $map = [
            'id' => $id
        ];
        
        // 退换货表
        $after_sale  = AfterserviceModel::get($map, 'goods,orderGoods,getorder,sellerStore,memberAccount');
        $getorder    = $after_sale['getorder'];
        $good        = $after_sale['goods'];
        $order_goods = $after_sale['orderGoods'];
        
        
        if ($after_sale === null || $getorder === null || $good === null) {
            $this->error(lang('system_error'), $this->jumpUrl);
        }
        
        // 图片
        $images = [];
        if ($after_sale['return_images']) {
            $images = explode(',', $after_sale['return_images']);
        }
        $this->assign('images', $images);
        
        // 商家退货地址
        if (isset($after_sale['sellerStore']['after_sale_address'])) {
            $after_sale_address = $after_sale['sellerStore']['after_sale_address'];
        } else {
            $after_sale_address = '';
        }
        
        // 会员账号
        if (isset($after_sale['memberAccount']['mobile'])) {
            $member = $after_sale['memberAccount']['mobile'];
        } else {
            $member = '';
        }
        
        
        $this->assign('after_sale_address', $after_sale_address);
        $this->assign('order_goods', $order_goods);
        $this->assign('order', $getorder);
        $this->assign('store', $after_sale['sellerStore']);
        $this->assign('member', $member);
        $this->assign('good', $good);
        $this->assign('info', $after_sale);
        return $this->fetch();
    }
    
    /**
     * @Mark: 保存售后信息
     * @return array
     * @Author: WangHuaLong
     */
    public function save_modify()
    {
        $request_data = $this->request->post();
        $map          = [
            'id' => $request_data['id']
        ];
        
        // 退换货表
        $after_sale = AfterserviceModel::get($map, 'getorder');
        $getorder   = $after_sale['getorder'];
        if ($after_sale === null || $getorder === null) {
            $this->error(lang('system_error'), $this->jumpUrl);
        }
        $action = 'afterservice';
        $remark = '';
    
        // 拒绝理由
        if(isset($request_data['agree']) && $request_data['agree']==0){
            if(!isset($request_data['disagree_reason'])){
                return ['code' => 0, 'msg' => lang('disagree_reason_null')];
            }elseif(trim($request_data['disagree_reason'] =='')){
                return ['code' => 0, 'msg' => lang('disagree_reason_null')];
            }else{
                $remark = trim($request_data['disagree_reason']);
            }
        }
        
        // 未审核状态下
        if ($after_sale['status'] == 0) {
            if (!isset($request_data['agree'])) {
                return ['code' => 0, 'msg' => lang('agree_error')];
            }
            
            if ($request_data['agree'] == 1) {
    
                if ($after_sale['rtype'] != 2) {
                    if (!isset($request_data['applyprice'])) {
                        return ['code' => 0, 'msg' => lang('applyprice_error')];
                    }
                    if ($request_data['applyprice'] <= 0 || $request_data['applyprice'] > $getorder['order_amount'] || $request_data['applyprice'] == '') {
                        return ['code' => 0, 'msg' => lang('applyprice_error')];
                    }
    
                    // 只退款情况下，生成退款单
                    if ($after_sale['rtype'] == 0) {
                        // 生成退款记录，财务退款
                        $insert_data = [
                            'order_id' => $after_sale['order_id'],  //订单id
                            'contents' => $after_sale['return_description'],  //退款理由
                            'return_reason' => $after_sale['return_reason'],
                            'money'    => $request_data['applyprice'],  //退款金额
                            'rtype'    => 1,
                            'after_sn' => $after_sale['after_sn']
                        ];
                        $result      = RefundApi::createRefund($insert_data);
                        if ($result['code'] == 0) {
                            return $result;
                        }
                    }
                    AfterserviceModel::where($map)->update(['status' => 3, 'applyprice' => $request_data['applyprice']]);
                    
                }else {
                    AfterserviceModel::where($map)->update(['status' => 3]);
                    
                }
                
            } else {
                AfterserviceModel::where($map)->update(['status' => 4, 'applyprice' => 0]);
                $action = 'refuse_afterservice';
            }
            
        }
    
        // 回寄商品
        if (isset($request_data['agree']) && isset($request_data['agree_exchange'])){
            if($request_data['agree']==1){
                AfterserviceModel::where($map)->update(['status' => 6]);
            }else{
                AfterserviceModel::where($map)->update(['status' => 2]);
                $action = 'refuse_afterservice';
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
                AfterserviceModel::where($map)->update(['status' => 2,'applyprice' => 0]);
                $action = 'refuse_afterservice';
            }
        }
        
        
        
        // 创建售后订单日志信息
        OrderLogApi::writelog([
            'order_id' => $after_sale['order_id'],
            'order_sn' => $after_sale['order_sn'],
            'user'     => UID,
            'role'     => 'admin',
            'result'   => 1,
            'soruce'   => PLATFORM,
            'action'   => $action,
            'params'   => json_encode($request_data),
            'remark'   => $remark,
        ]);
    
        return ['code' => 1, 'msg' => lang('save_ok'),'url'=>$this->jumpUrl];
    }
}