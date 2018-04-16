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
// | Member.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\member\controller;

use think\Cache;
use think\Cookie;
use think\Request;
use think\Lang;
use app\admin\model\Message;
use app\bcwareexp\model\Area;
use app\bcwareexp\model\Country;
use app\member\model\Couponlist;
use app\member\model\MyPath as MyPathModel;
use app\member\service\Collect;
use app\member\service\Member as MemberApi;
use app\order\service\Order as OrderApi;
use app\order\model\Order as OrderModel;
use app\order\model\Goods as OrderGoodsModel;
use app\order\model\Afterservice as AfterserviceModel;
use app\seller\model\Account as SellerModel;
use app\seller\model\Store as StoreModel;
use app\crossbbcg\service\Goods as GoodsApi;
use common\PhpMailer;
use app\order\model\OrderLog as OrderLogModel;


class Index extends Passport
{
    private $uid;
    
    /**
     * @Mark: 初始化，会员模块必须登录
     * @Author: WangHuaLong
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->uid = is_login();
        if ($this->uid < 1) {
            $this->redirect('passport/index');
        }
    }
    
    /**
     * @Mark:会员中心首页
     * @return mixed
     * @Author: fancstheseaer <theseaer@qq.com>
     * @Version 2017/7/8
     */
    public function index()
    {
        //用户信息
        $param = ['name' => $this->uid];
        $userInfo = \app\member\service\Member::info($param);
        $level = \app\member\service\Member::get_user_level($param);
        //收藏
        $collect = \app\member\model\Collect::all(function ($query) use ($param) {
            $query->where(['uid' => $param['name']])->order('id', 'DESC');
        });
        $arr_collect = [];
        if ($collect !== null) {
            foreach ($collect as $key => $arr) {
                $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
            }
        }
        
        //用户优惠券
        $coupon_count = Couponlist::where('uid', $param['name'])->count();
        $this->assign('Title', lang('Member index'));
        $this->assign('user', $userInfo);
        $this->assign('collect', $arr_collect);
        $this->assign('coupon', $coupon_count);
        $this->assign('level', $level);
        
        
        // 统计订单数
        $filter_data = array(
            'user_id' => $this->uid,
            'display' => 1
        );
        $count_all = OrderModel::where($filter_data)->count();
        $count_wait = OrderModel::where($filter_data)->where('status', 'WAIT_BUYER_PAY')->count();
        $count_send = OrderModel::where($filter_data)->where('status', 'WAIT_SELLER_SEND_GOODS')->count();
        $count_confirm = OrderModel::where($filter_data)->where('status', 'WAIT_BUYER_CONFIRM_GOODS')->count();
        
        $count_comment = OrderModel::where($filter_data)->where('status', 'TRADE_FINISHED')->where('is_evaluate', 0)->count();
        $this->assign('count_all', $count_all);
        $this->assign('count_wait', $count_wait);
        $this->assign('count_send', $count_send);
        $this->assign('count_confirm', $count_confirm);
        $this->assign('count_comment', $count_comment);
        
        // 最近5笔订单
        $map = [
            'user_id' => $this->uid,
            'display' => 1
        ];
        $list = OrderApi::getlist('order/order', $map);
        $order_list = [];
        if ($list['list'] !== null) {
            /*获取订单商品*/
            foreach ($list['list'] as $key => $arr) {
                if ($key > 4) {
                    break;
                }
                $order_list[$key] = $arr;
            }
        }
        $this->assign('order_list', $order_list);
        
        $this->assign('expire_time', get_config('crossbbcg')['tradeclose'] * 3600);
        
        
        $this->assign('page', null);
        $this->assign('arr_cancel_reason', config('cancel_reason'));
    
        // 常用快递公司
        $this->assign('arr_express', config('catalog_express'));
        
        
        // 是否有提示语
        if (session('?member_remind')) {
            $member_remind = session('member_remind');
            session('member_remind', null);
        } else {
            $member_remind = false;
        }
        $this->assign('member_remind', $member_remind);
        
        return $this->fetch();
    }
    
    /**
     * @Mark: 我的订单 订单列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function orderList()
    {
        $request_data = $this->request->param();
        
        // 订单状态
        $display = 1;
        if (isset($request_data['order_status'])) {
            $order_status = $request_data['order_status'];
            if ($order_status == 'recycle') {
                $display = 0;
                $order_status = 'all';
            }
        } else {
            $order_status = 'all';
        }
        
        $map = [
            'user_id' => $this->uid,
            'display' => $display
        ];
        if ($order_status != 'all') {
            if ($order_status == 'comment') {
                $map['is_evaluate'] = 0;
                $map['status'] = strtoupper('TRADE_FINISHED');
            } else {
                $map['status'] = strtoupper($order_status);
            }
        }
        
        // 搜索，商品名称，订单日期，订单编号
        if (isset($request_data['name'])) {
            $all_ids = [];
            $search_name = trim($request_data['name']);
            $map2 = [
                'goods_name' => ['like', '%' . $search_name . '%']
            ];
            $ids2 = OrderGoodsModel::where($map2)->column('order_id');
            if ($ids2 !== null) {
                $all_ids = array_merge($all_ids, $ids2);
            }
            
            // 纯数字搜索订单号
            if (is_numeric($search_name)) {
                $map3 = [
                    'order_sn' => ['like', '%' . $search_name . '%']
                ];
                $ids3 = OrderModel::where($map3)->column('order_id');
                if ($ids3 !== null) {
                    $all_ids = array_merge($all_ids, $ids3);
                }
            }
            
            if (!empty($all_ids)) {
                $map['order_id'] = ['in', $all_ids];
            }else{
                $map['order_id'] = ['in', '0'];
            }
            
    
            $this->assign('search_name', $search_name);
        } else {
            $this->assign('search_name', '');
        }
        
        // 按照日期显示最近的订单
        if (isset($request_data['recently_order'])) {
            $recently_order = (int)$request_data['recently_order'];
            $end_time = time();
            if ($recently_order == 1) {
                // 最近三个月
                $start_time = $end_time - 3600 * 24 * 30;
                
            } else if ($recently_order == 2) {
                // 最近六个月
                $start_time = $end_time - 3600 * 24 * 30 * 6;
            } else if ($recently_order == 3) {
                // 最近一年
                $start_time = $end_time - 3600 * 24 * 30 * 12;
            } else {
                $start_time = false;
                $recently_order = 0;
            }
            if ($start_time) {
                $map['create_time'] = ['between time', [$start_time, $end_time]];
            } else {
                $map['create_time'] = ['<', $end_time];
            }
            
            $this->assign('recently_order_id', $recently_order);
        } else {
            $this->assign('recently_order_id', 0);
        }
        
        // 搜索店铺名称
        if (isset($request_data['store_name'])) {
            $store_name = trim($request_data['store_name']);
            $map4 = [
                'seller_name' => ['like', '%' . $store_name . '%']
            ];
            $seller_ids = StoreModel::where($map4)->column('seller_id');
            if ($seller_ids === null) {
                $seller_ids = [0];
            }
            $map['seller_id'] = ['in', $seller_ids];
            $this->assign('store_name', $store_name);
        } else {
            $this->assign('store_name', '');
        }
        
        // 售后类型
        if (isset($request_data['sale_service'])) {
            $sale_service = (int)$request_data['sale_service'];
            $map5 = [
                'user_id' => $this->uid,
            ];
            if ($sale_service == 0) {
                $map5['rtype'] = false;
            } elseif ($sale_service == 1) {
                $map5['rtype'] = ['in', '1,2'];
            } elseif ($sale_service == 2) {
                $map5['rtype'] = ['in', '0'];
            } else {
                $map5['rtype'] = false;
                $sale_service = 0;
            }
            if ($map5['rtype'] !== false) {
                $ids5 = AfterserviceModel::where($map5)->column('order_id');
                if ($ids5 !== null) {
                    $map['order_id'] = ['in', $ids5];
                } else {
                    $map['order_id'] = 0;
                }
            }
            $this->assign('sale_service_id', $sale_service);
        } else {
            $this->assign('sale_service_id', 0);
        }
    
        // 常用快递公司
        $this->assign('arr_express', config('catalog_express'));
        
        // 指定开始结束日期
        if (isset($request_data['start']) && isset($request_data['end'])) {
            $start = $request_data['start'];
            $end = $request_data['end'];
            if ($start != '' && $end != '') {
                $map['create_time'] = ['between time', [$start, $end]];
            } elseif ($start != '' && $end == '') {
                $map['create_time'] = ['>', $start];
            } elseif ($start == '' && $end != '') {
                $map['create_time'] = ['<', $end];
            }
            $this->assign('start', $start);
            $this->assign('end', $end);
        } else {
            $this->assign('start', '');
            $this->assign('end', '');
        }
        
        // 是否展开高级搜索
        if (isset($start) && isset($end) && isset($sale_service) && isset($store_name)) {
            $this->assign('more_search', true);
        } else {
            $this->assign('more_search', false);
        }
        
        
        $list = OrderApi::getlist('order/order', $map);
        $this->assign('order_list', $list['list']);
        $this->assign('page', $list['page']);
        $this->assign('arr_cancel_reason', config('cancel_reason'));
        $this->assign('expire_time', get_config('crossbbcg')['tradeclose'] * 3600);
        
        
        // 统计订单数
        $filter_data = array(
            'user_id' => $this->uid,
            'display' => 1
        );
        $count_all = OrderModel::where($filter_data)->count();
        $count_wait = OrderModel::where($filter_data)->where('status', 'WAIT_BUYER_PAY')->count();
        $count_send = OrderModel::where($filter_data)->where('status', 'WAIT_SELLER_SEND_GOODS')->count();
        $count_confirm = OrderModel::where($filter_data)->where('status', 'WAIT_BUYER_CONFIRM_GOODS')->count();
        
        $count_comment = OrderModel::where($filter_data)->where('status', 'TRADE_FINISHED')->where('is_evaluate', 0)->count();
        $this->assign('count_all', $count_all);
        $this->assign('count_wait', $count_wait);
        $this->assign('count_send', $count_send);
        $this->assign('count_confirm', $count_confirm);
        $this->assign('count_comment', $count_comment);
        $this->assign('order_status', $order_status);
        
        
        return $this->fetch('order_list');
    }
    
    /**
     * @Mark: 订单详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function orderdetail()
    {
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_' . $this->lang . '.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
        
        // 传入用户id，订单号
        if (input('?order_sn')) {
            $order_sn = input('order_sn');
        } else {
            $this->redirect('crossbbcg/error/error');
        }
        $map = [
            'user_id' => $this->uid,
            'order_sn' => $order_sn
        ];
        $order = OrderModel::where($map)->find();
        if ($order === null) {
            $this->redirect('crossbbcg/error/error');
        }
        
        // 判断订单是否处于取消状态
        if($order['cancel_status'] =='WAIT_PROCESS'||$order['cancel_status'] =='REFUND_PROCESS'){
            $this->redirect(url('member/index/cancel_order_detail','order_sn='.$order_sn));
        }
        
        // 订单的状态进展
        $trade_closed = false;
        $step1 = $step2 = $step3 = $step4 = $step5 = false;
        if ($order['status'] == 'WAIT_BUYER_PAY') {
            $step1 = $step2 = true;
        }
        if ($order['status'] == 'WAIT_SELLER_SEND_GOODS') {
            $step1 = $step2 = $step3 = true;
        }
        if ($order['status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
            $step1 = $step2 = $step3 = true;
        }
        if ($order['status'] == 'TRADE_FINISHED') {
            $step1 = $step2 = $step3 = $step4 = $step5 = true;
        }
        if ($order['status'] == 'TRADE_CLOSED') {
            $trade_closed = true;
        }
        if ($order['status'] == 'TRADE_CLOSED_BY_SYSTEM') {
            $trade_closed = true;
        }
        $this->assign('trade_closed', $trade_closed);
        $this->assign('step1', $step1);
        $this->assign('step2', $step2);
        $this->assign('step3', $step3);
        $this->assign('step4', $step4);
        $this->assign('step5', $step5);
        
        // 商家名称
        $seller_name = SellerModel::where('id', $order['seller_id'])->value('nickname');
        $this->assign('seller_name', $seller_name);
        $store_name = StoreModel::where('seller_id', $order['seller_id'])->value('seller_name');
        $this->assign('store_name', $store_name);
        
        // 剩余关闭时间
        $this->assign('expire_time', get_config('crossbbcg')['tradeclose'] * 3600);
        
        // 订单商品
        $goods = OrderGoodsModel::where('order_id', $order['order_id'])->select();
        
        // 获取商品的物流查询
        $filter_data = array(
            'subjection' => 'expresss',
            PLATFORM => 1,
            'status' => 1
        );
        $express = \app\common\service\Extend::getOneExt($filter_data);
        if ($express['code'] && $order['shipping_no'] != '' && $order['shipping_name'] != '') {
            $api_code = $express['data']['code'];  // 使用的插件code
            $extClass = "\\expresss\\" . $api_code;
            $api_express = new $extClass();
            $shipping_info = [
                'shipping_no' => $order['shipping_no'],
                'shipping_company' => $order['shipping_name']
            ];
            $traces = $api_express->response($shipping_info);
            // 物流状态，跟踪信息
            $this->assign('traces', $traces);
            
        } else {
            // 无可用的物流查询接口
            $traces = ['code' => 0, 'msg' => lang('express_api_error'), 'data' => ''];
            $this->assign('traces', $traces);
        }
        
        
        $this->assign('goods', $goods);
        $this->assign('data', $order);
        $this->assign('arr_cancel_reason', config('cancel_reason'));
        $this->assign('order_status', $order['status']);
        $this->assign('order_sn', $order_sn);
        return $this->fetch('orderDetail');
    }
    
    public function addressList()
    {
        $param = ['name' => $this->uid];
        $list = \app\member\service\Address::get_address($param);
        foreach ($list as $k => $v) {
            $v['country'] = Country::where('id', $v['country'])->value('name');
            $v['province'] = Area::where('id', $v['province'])->value('name');
            $v['city'] = Area::where('id', $v['city'])->value('name');
            $v['district'] = Area::where('id', $v['city'])->value('name');
            $v['twon'] = Area::where('id', $v['twon'])->value('name');
        }
        $country = \app\bcwareexp\service\Country::get_country();
        $this->assign('list', $list);
        $this->assign('country', $country);
        return $this->fetch('address_list');
    }
    
    /**
     * @Mark:新增收货地址
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function address_add()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            if (!isset($post['consignee'])) $this->error(lang('consignee_must_tips'));
            if (!isset($post['identity'])) $this->error(lang('pleace input IDcard'));
            $post['uid'] = $this->uid;
            //调用实名认证接口 调用API服务
            $param = [
                'realName' => $post['consignee'],
                'IDcard' => $post['identity']
            ];
            $re = MemberApi::identification($param);
            if ($re['code'] == 0) return json(['code' => 0, 'msg' => lang('realauth_fail_tips')]);
            $res = \app\member\service\Address::add_address($post);
            if ($res['code'] == 1) return json(['code' => 1, 'msg' => lang('Add ok')]);
            return json($res);
        } else {
            return $this->fetch('address_add');
        }
    }
    
    /**
     * @Mark:修改收货地址
     * @Author: fancs
     * @Version 2017/7/11
     */
    public function address_edit()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            //更新数据
            $res = \app\member\service\Address::add_address($data);
            if ($res['code'] == 1) return json(['code' => 1, 'msg' => lang('Edit ok')]);
            return json($res);
        } else {
            $id = $this->request->has('id') ? $this->request->param('id') : 0;
            if (!$id) $this->error(lang('Param error'));
            $data = \app\member\model\Address::get($id);
            $country = \app\bcwareexp\service\Country::get_country();
            $province = Area::all(function ($query) {
                $query->where(['type' => 0]);
            });
            $city = Area::all(function ($query) use ($data) {
                $query->where(['type' => 1, 'pid' => $data['province']]);
            });
            $district = Area::all(function ($query) use ($data) {
                $query->where(['type' => 2, 'pid' => $data['city']]);
            });
            $this->assign('country', $country);
            $this->assign('data', $data);
            $this->assign('province', $province);
            $this->assign('city', $city);
            $this->assign('district', $district);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:设置默认收获地址
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function setDefaultAddress()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : 0;
        if (!$id) $this->redirect('addressList');
        //将原先的默认地址更新为不是默认
        $is = \app\member\model\Address::where(['uid' => $this->uid, 'is_default' => 1])->value('id');
        if ($is) {
            \app\member\model\Address::update(['id' => $is, 'is_default' => 0]);
        }
        //更新设置选中为默认地址
        \app\member\model\Address::where('id', $id)->update(['is_default' => 1]);
        $this->redirect('addressList');
    }
    
    /**
     * @Mark:删除收货地址
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function AjaxDelAddress()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) return json(['code' => 0]);
        \app\member\model\Address::where('id', $param['id'])->delete();
        return json(['code' => 1]);
    }
    
    /**
     * @Mark:AJAX 请求获取省级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_province()
    {
        $country = $this->request->has('country') ? $this->request->param('country') : 0;//国家id
        $param = ['pid' => $country];
        $zone = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        $data = [];
        foreach ($zone as $v) {
            $data[] = Area::all(['pid' => $v['id']]); //获取省份
        }
        //转化为二维数组
        $province = [];
        foreach ($data as $val) {
            foreach ($val as $value) {
                $province[] = $value;
            }
        }
        if ($province) {
            return json(['code' => 1, 'data' => $province]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
        
    }
    
    /**
     * @Mark:AJAX 请求获取市级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_city()
    {
        $province = $this->request->has('province') ? $this->request->param('province') : 0;//省id
        $param = ['pid' => $province];
        $city = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        if ($city) {
            return json(['code' => 1, 'data' => $city]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
    }
    
    /**
     * @Mark:AJAX 请求获取县级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_district()
    {
        $district = $this->request->has('district') ? $this->request->param('district') : 0;//区id
        $param = ['pid' => $district];
        $district = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        if ($district) {
            return json(['code' => 1, 'data' => $district]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
    }
    
    /**
     * @Mark: 取消订单记录
     * @return mixed
     * @Author: WangHuaLong
     */
    public function ordercancel()
    {
        $map = [
            'user_id' => $this->uid,
            'status' => ['in', 'WAIT_SELLER_SEND_GOODS,TRADE_CLOSED'],
            'cancel_status' => ['not in', 'NO_APPLY']
        ];
        $list = OrderApi::getlist('order/order', $map);
        $this->assign('order_list', $list['list']);
        $this->assign('page', $list['page']);
        $this->assign('arr_cancel_reason', config('cancel_reason'));
        $this->assign('expire_time', get_config('crossbbcg')['tradeclose'] * 3600);
        
        return $this->fetch('cancel_order');
    }
    
    
    /**
     * @Mark: 取消订单详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function cancel_order_detail(){
    
        // 传入用户id，订单号
        if (input('?order_sn')) {
            $order_sn = input('order_sn');
        } else {
            $this->redirect('crossbbcg/error/error');
        }
        $map = [
            'user_id' => $this->uid,
            'order_sn' => $order_sn
        ];
        $order = OrderModel::where($map)->find();
        if ($order === null || $order['cancel_status']=='NO_APPLY') {
            $this->redirect('crossbbcg/error/error');
        }
        
        // 处理进展
        $step1 = $step2 = $step3 = $step4 = false;
        // 提交申请，等待商家处理
        if ($order['cancel_status'] == 'WAIT_PROCESS') {
            $step1 = true;
        }
        // 商家同意取消订单，做退款处理
        if ($order['cancel_status'] == 'REFUND_PROCESS') {
            $step1 = $step2 = true;
        }
        // 商家完成退款，订单成功取消
        if ($order['cancel_status'] == 'SUCCESS') {
            $step1 = $step2 = $step3 = true;
        }
        // 商家不同意取消订单
        if ($order['cancel_status'] == 'FAILS') {
            $step1 = $step4 = true;
        }
        
        $this->assign('step1', $step1);
        $this->assign('step2', $step2);
        $this->assign('step3', $step3);
        $this->assign('step4', $step4);
        
        $map2 = [
            'order_sn' => $order_sn,
            'action' => 'cancel_order'
        ];
        $history = OrderLogModel::where($map2)->order('create_time','ASC')->select();
        
        
        $this->assign('history',$history);
        $this->assign('data',$order);
        return $this->fetch();
    }
    /**
     * @Mark:会员信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function info()
    {
        $this->assign('Title', lang('Member info'));
        return $this->fetch();
    }
    
    /**
     * @Mark:会员地址列表页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function address()
    {
        $this->assign('Title', lang('Member address'));
        return $this->fetch();
    }
    
    /**
     * @Mark:个人信息
     * @return bool|int|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function seinfoset()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            if (!$data['nickname']) return json(['code' => 0, 'msg' => lang('Nickname null')]);
            
            if (substr($data['headimg'], 1, 7) == 'uploads') {
                $headimg = substr($data['headimg'], 9);
            } else {
                $headimg = $data['headimg'];
            }
            //组装数据，更新用户修改的数据
            $member = [
                'name' => $this->uid,
                'update' => [
                    'nickname' => $data['nickname'],
                    'sex' => $data['sex'],
                    'headimg' => $headimg
                ],
            ];
            
            //更新account表信息
            $res = \app\member\service\Member::update_user($member);
            $extent = ['name' => $this->uid, 'birthday' => $data['birthday'], 'truename' => $data['realname']];
            \app\member\service\Member::update_extent($extent);
            if ($res === true) {
                return json(['code' => 1, 'msg' => lang('Update user success')]);
            } else if ($res === false) {
                return json(['code' => 0, 'msg' => lang('Update user error')]);
            } else {
                return $res;
            }
        } else {
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            $this->assign('data', $user);
            $this->assign('ids', $this->uid);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:安全中心
     * @return bool|int|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function security()
    {
        $param = ['name' => $this->uid];
        $user = \app\member\service\Member::info($param);
        $this->assign('data', $user);
        $this->assign('ids', $this->uid);
        return $this->fetch('security');
    }
    
    /**
     * @Mark:更换密码
     * @return bool|int|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function AlterPassword()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            //数据合法性验证
            if (!($data['password'] && $data['newpassword'] && $data['newrepassword']))
                return json(['code' => 0, 'msg' => lang('Password_error')]);
            if ($data['newpassword'] !== $data['newrepassword'])
                return json(['code' => 0, 'msg' => lang('the password not same')]);
            //组装数据，更新用户修改的数据
            $up = [
                'name' => $this->uid,
                'old_password' => $data['password'],
                'new_password' => $data['newpassword'],
            ];
            
            $res = \app\member\service\Member::change_pwd($up);
            if ($res === true) {
                return json(['code' => 1, 'msg' => lang('Update password success')]);
            } else {
                return $res;
            }
        } else {
            return $this->fetch('AlterPassword');
        }
        
    }
    
    /**
     * @Mark:修改手机号码 1
     * @return mixed|string|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function AlterMobile()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            //验证短信验证码
            if (Cache::get($data['username']) && Cache::get($data['username']) == $data['smscode']) {
                return json(['code' => 1]);
            } else {
                return json(['code' => 0, 'msg' => lang('SMS code error')]);
            }
        } else {
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            $this->assign('data', $user);
            $this->assign('ids', $this->uid);
            return $this->fetch('AlterMobile');
        }
        
    }
    
    /**
     * @Mark:修改手机号码 2
     * @return mixed|string|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function AlterMobileTwo()
    {
        
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            //验证短信验证码
            if (!Cache::get($data['username']) || !Cache::get($data['username']) == $data['smscode']) {
                return json(['code' => 0, 'msg' => lang('SMS code error')]);
            }
            //更新用户手机号
            $up = [
                'name' => $this->uid,
                'update' => ['mobile' => $data['username']],
            ];
            $res = \app\member\service\Member::update_user($up);
            if ($res) return json(['code' => 1]);
            return json(['code' => 0, 'msg' => lang('System error')]);
        } else {
            return $this->fetch('AlterMobileTwo');
        }
    }
    
    /**
     * @Mark:绑定手机1
     * @Author: fancs
     * @Version 2017/7/18
     */
    public function VerifyMobilecheck()
    {
        if ($this->request->isAjax()) {
            $password = $this->request->post('password');
            if (!$password) {
                return json(['code' => 0, 'msg' => lang('Password empty')]);
            }
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            if (md5($password) !== $user['password']) {
                return json(['code' => 0, 'msg' => lang('Password error')]);
            } else {
                return json(['code' => 1]);
            }
        } else {
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            if ($user['mobile']) {
                $this->error(lang('error_telphone_exist'));
            }
            return $this->fetch('VerifyMobilecheck');
        }
        
    }
    
    /**
     * @Mark:绑定手机2
     * @return mixed
     * @Author: fancs
     * @Version 2017/7/18
     */
    public function VerifyMobile()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            //验证短信验证码
            $param = ['mobile' => $data['username'], 'code' => $data['smscode']];
            $res = \app\member\service\Smscode::get_code($param);
            if ($res != $data['smscode']) {
                return $res;
            }
            //更新用户手机号
            $up = [
                'name' => $this->uid,
                'update' => ['mobile' => $data['username']],
            ];
            $res = \app\member\service\Member::update_user($up);
            if ($res) return json(['code' => 1]);
            return json(['code' => 0, 'msg' => lang('System error')]);
        } else {
            $t = $this->request->param('t');
            if (empty($t)) $this->redirect('VerifyMobilecheck');
            return $this->fetch('VerifyMobile');
        }
    }
    
    /**
     * @Mark:绑定邮箱1
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function verifyemailcheck()
    {
        if ($this->request->isAjax()) {
            $password = $this->request->post('password');
            if (!$password) {
                return json(['code' => 0, 'msg' => lang('Password empty')]);
            }
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            if (md5($password) !== $user['password']) {
                return json(['code' => 0, 'msg' => lang('Password error')]);
            } else {
                return json(['code' => 1]);
            }
        } else {
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            if ($user['email']) {
                $this->error();
            }
            return $this->fetch('verifyEmailcheck');
        }
        
    }
    
    /**
     * @Mark:绑定邮箱2
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function verifyEmail()
    {
        if ($this->request->post()) {
            $data = $this->request->param();
            if (!($data['username'] && $data['emailcode'])) {
                return json(['code' => 0, 'msg' => lang('Code_null')]);
            }
            $cache = Cache::get('verifyEmail_' . $data['username']);
            if (!$cache) return json(['code' => 0, 'msg' => lang('Code_overdue')]);
            if ($cache != md5($data['emailcode']))
                return json(['code' => 0, 'msg' => lang('Code_error')]);
            $up = [
                'name' => $this->uid,
                'update' => ['email' => $data['username']]
            ];
            $res = \app\member\service\Member::update_user($up);
            if ($res !== true) {
                return json(['code' => 0, 'msg' => lang('System_error')]);
            }
            return json(['code' => 1, 'msg' => lang('edit_successful')]);
        } else {
            $t = $this->request->param('t');
            if (empty($t)) $this->redirect('verifyemailcheck');
            return $this->fetch('verifyEmail');
        }
    }
    
    /**
     * @Mark:修改邮箱1
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/17
     */
    public function AlterEmail()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->post();
            if (!($data['username'] && $data['emailcode'])) {
                return json(['code' => 0, 'msg' => lang('Code_null')]);
            }
            $cache = Cache::get('verifyEmail_' . $data['username']);
            if (!$cache) return json(['code' => 0, 'msg' => lang('Code_overdue')]);
            if ($cache != md5($data['emailcode'])) {
                return json(['code' => 0, 'msg' => lang('Code_error')]);
            }
            return json(['code' => 1]);
        } else {
            $param = ['name' => $this->uid];
            $user = \app\member\service\Member::info($param);
            $this->assign('data', $user);
            return $this->fetch('AlterEmail');
        }
        
    }
    
    /**
     * @Mark:修改邮箱2
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/17
     */
    public function AlterEmailTwo()
    {
        if ($this->request->post()) {
            $data = $this->request->param();
            if (!($data['username'] && $data['emailcode'])) {
                return json(['code' => 0, 'msg' => lang('Code_null')]);
            }
            $cache = Cache::get('verifyEmail');
            if (!$cache) return json(['code' => 0, 'msg' => lang('Code_overdue')]);
            if ($cache != md5($data['emailcode']))
                return json(['code' => 0, 'msg' => lang('Code_error')]);
            $up = [
                'name' => $this->uid,
                'update' => ['email' => $data['username']]
            ];
            $res = \app\member\service\Member::update_user($up);
            if ($res !== true) {
                return json(['code' => 0, 'msg' => lang('System_error')]);
            }
            return json(['code' => 1,]);
        } else {
            $t = $this->request->param('t');
            if (empty($t)) $this->redirect('AlterEmail');
            return $this->fetch('AlterEmailTwo');
        }
    }
    
    /**
     * @Mark:检查邮箱是否已存在
     * @Author:fancs
     * @Version 2017/7/14
     */
    public function check_email()
    {
        $email = $this->request->param('username');
        $res = \app\member\service\Member::check_email($email);
        //场景
        if ($res) $this->error(lang('Email_exit'));
    }
    
    /**
     * @Mark:发送邮箱验证码
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function get_email_code()
    {
        $to = $this->request->param('username');
        if (empty($to)) {
            $this->error(lang('Email_null'));
        }
        //邮箱模板
        $tpl = Message::get(function ($query) {
            $query->where(['msgid' => 'deposit-lostPw', 'type' => 'email']);
        });
        $code = generate_code();
        $text = str_replace('$vcode$', $code, $tpl['msgtpl']);
        $text = str_replace('$username$', Cookie::get('user_auth')['nickname'], $text);
        $data = [
            'to_email' => $to,
            'content' => $text
        ];
        $res = PhpMailer::send($data);
        if ($res['code'] == 1) {
            //缓存验证码
            Cache::set('verifyEmail_' . $to, md5($code), 36000);
            $this->success('OK');
        } else {
            return json($res);
        }
    }
    
    /**
     * @Mark:更新手机号码
     * @Author: fancs
     * @Version 2017/7/17
     */
    public function AlterMobileSuccess()
    {
        return $this->fetch('AlterMobileSuccess');
        
    }
    
    /**
     * @Mark:用户积分
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function point()
    {
        $param = ['name' => $this->uid];
        $user = \app\member\service\Member::info($param);
        //积分记录
        $experi = \app\member\service\Experi::get_experi($this->uid);
        $this->assign('data', $user);
        $this->assign('experi', $experi);
        return $this->fetch();
    }
    
    /**
     * @Mark:商品收藏页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function favor()
    {
        //收藏
        $param = ['name' => $this->uid];
        $collect = \app\member\model\Collect::all(function ($query) use ($param) {
            $query->where(['uid' => $param['name']])->order('id', 'DESC');
        });
        $arr_collect = [];
        if ($collect !== null) {
            foreach ($collect as $key => $arr) {
                if ($arr['goods']['minimum'] <= 0) {
                    $minimum = 1;
                } else {
                    $minimum = $arr['goods']['minimum'];
                }
                if ($arr['goods']['maximum'] <= 0) {
                    $maximum = $arr['goods']['quantity'];
                } else {
                    if ($arr['goods']['maximum'] > $arr['goods']['quantity']) {
                        $maximum = $arr['goods']['quantity'];
                    } else {
                        $maximum = $arr['goods']['maximum'];
                    }
                }
                $arr_collect[$key]['id'] = $arr['id'];
                $arr_collect[$key]['goods']['maximum'] = $maximum;
                $arr_collect[$key]['goods']['minimum'] = $minimum;
                $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
            }
        }
        $this->assign('data', $arr_collect);
        return $this->fetch();
    }
    
    /**
     * @Mark:取消收藏
     * @return \think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/14
     */
    public function del_collect()
    {
        $id = $this->request->param('id');
        if ($id < 0) {
            return json(['code' => 0, 'msg' => lang('Check_null')]);
        }
        Collect::del_collect($id);
        return json(['code' => 1]);
    }
    
    /**
     * @Mark:实名认证
     * @return mixed
     * @Author: fancs
     * @Version 2017/7/17
     */
    public function realauth()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            //数据合法性验证
            if (empty($data['user']['realname']))
                return json(['code' => 0, 'msg' => lang('Realname_empty')]);
            if (empty($data['user']['identity']))
                return json(['code' => 0, 'msg' => lang('Identity_empty')]);
            if (empty($data['img'][0]))
                return json(['code' => 0, 'msg' => lang('Front_img_empty')]);
            if (empty($data['img'][1]))
                return json(['code' => 0, 'msg' => lang('Verso_img_empty')]);
            //调用实名认证接口 调用API服务
            $data = [
                'realName' => $data['user']['realname'],
                'IDcard' => $data['user']['identity']
            ];
            $res = MemberApi::identification($data);
            
            //判断认证结果
            if ($res['code'] == 1) {
                //认证成功，将结果插入数据库
                $data = [
                    'id' => is_login(),
                    'truename' => $data['user']['realname'],
                    'sfz' => $data['user']['identity'],
                    'sfz_img_z' => $data['img'][0],
                    'sfz_img_f' => $data['img'][1],
                ];
                \app\member\model\Member::update($data);
                $this->success(lang('realauth_success'), 'realauth');
            } else {
                $this->error(lang('realauth_fail_tips') . ': ' . $res['data']);
            }
        } else {
            $uid = is_login();
            $result = \app\member\model\Member::get($uid);
            $this->assign('realauth_result', $result ? $result : null);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:文件上传
     * @param Request $request
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/18
     */
    public function ajax_upload(Request $request)
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = $this->request->file('file');
        return $this->up($file);
    }
    
    /**
     * @Mark: 身份正反面上传
     * @param Request $request
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/18
     */
    public function id_upload(Request $request)
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = $this->request->file('file');
        return $this->up($file, 'id_card');
    }
    
    /**
     * @Mark:优惠券页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function coupon()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark: 申请售后
     * @return mixed
     * @Author: WangHuaLong
     */
    public function aftersalesApply()
    {
        $order_sn = input('get.order_sn');
        $rec_id = input('get.rec_id');
        $user_id = $this->uid;
        
        // 判断售后是否存在
        $exist_map = array(
            'rec_id' => $rec_id,
            'user_id' => $user_id
        );
        $exist = AfterserviceModel::get($exist_map);
        if ($exist !== null) {
            $this->redirect(url('member/index/aftersaleslist'));
        }
        
        // 判断订单是否存在
        $map = [
            'order_sn' => $order_sn,
            'user_id' => $user_id
        ];
        $order = OrderModel::where($map)->find();
        if ($order === null) {
            $this->redirect('crossbbcg/error/error');
        }
        
        // 商家名称
        $seller_name = SellerModel::where('id', $order['seller_id'])->value('nickname');
        $this->assign('seller_name', $seller_name);
        $store_name = StoreModel::where('seller_id', $order['seller_id'])->value('seller_name');
        $this->assign('store_name', $store_name);
        $this->assign('seller_id',$order['seller_id']);
        
        // 退货商品的信息
        $map2 = [
            'rec_id' => $rec_id,
        ];
        $return_good = OrderGoodsModel::where($map2)->find();
        if ($return_good === null) {
            $this->redirect('crossbbcg/error/error');
        }
        $this->assign('return_reason', config('return_reason'));
        $this->assign('goods', $return_good);
        $this->assign('rec_id', $rec_id);
        
        
        $this->assign('order', $order);
        $this->assign('order_sn', $order_sn);
        return $this->fetch('aftersalesApply');
    }
    
    
    /**
     * @Mark: 申请退换货
     * @return mixed
     * @Author: WangHuaLong
     */
    public function applyreturn()
    {
        $post_data = input('post.');
        
        
        // 图片合并成逗号字符串
        $imgs = '';
        if (isset($post_data['return_images'])) {
            foreach ($post_data['return_images'] as $key => $arr) {
                if (substr($arr, 0, 9) == '/uploads/') {
                    $imgs .= ',' . substr($arr, 9);
                }
            }
            $imgs = substr($imgs, 1);
        }
        $post_data['return_images'] = $imgs;
        $insert_data = $post_data;
        $insert_data['user_id'] = $this->uid;
        
        $insert_data['source'] = PLATFORM;
        $insert_data['role'] = 'customer';
        
        $result = OrderApi::createAfterservice($insert_data);
        
        return $result;
    }
    /**
     * @Mark: 退换货列表
     * @return mixed
     * @Author: WangHuaLong
     */
    public function aftersalesList()
    {
        $map = array(
            'user_id' => $this->uid,
        );
        $listRows = \think\Config::get('paginate.list_rows') > 0 ? \think\Config::get('paginate.list_rows') : 10;
        
        $result = AfterserviceModel::where($map)->order('create_time', 'DESC')->paginate($listRows);
        
        $page = $result->render();
        $this->assign('page', $page);
        $this->assign('return_orders', $result);
        return $this->fetch('aftersalesList');
    }
    
    /**
     * @Mark: 退换货详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function aftersalesDetail()
    {
        $after_sn = input('get.after_sn');
        $return = AfterserviceModel::where('after_sn', $after_sn)->find();
        
        // 退货退款售后
        $step1 = $step2 = $step3 = $step4 = $step5 = false;
        if ($return['rtype'] == 1) {
            // 等待商家审核
            if ($return['status'] == 0) {
                $step1 = true;
            }
            // 审核通过，等待买家回寄
            if ($return['status'] == 3) {
                $step1 = $step2 = true;
            }
            // 等待商家收货
            if ($return['status'] == 5) {
                $step1 = $step2 = $step3 = true;
            }
            // 商家确认收货
            if ($return['status'] == 6) {
                $step1 = $step2 = $step3 = $step4 = true;
            }
            // 完成
            if ($return['status'] == 1) {
                $step1 = $step2 = $step3 = $step4 = $step5 = true;
            }
        } elseif ($return['rtype'] == 0) {
            // 仅退款不退货
            // 等待商家审核
            if ($return['status'] == 0) {
                $step1 = true;
            }
            // 商家审核通过，等待退款
            if ($return['status'] == 3) {
                $step1 = $step2 = true;
            }
            // 完成
            if ($return['status'] == 1) {
                $step1 = $step2 = $step3 = true;
            }
        } elseif ($return['rtype'] == 2) {
            // 换货
            // 等待商家审核
            if ($return['status'] == 0) {
                $step1 = true;
            }
            // 商家审核通过，待买家退货
            if ($return['status'] == 3) {
                $step1 = $step2 = true;
            }
            // 待商家确认收货
            if ($return['status'] == 5) {
                $step1 = $step2 = $step3 = true;
            }
            // 商家已收货已发货
            if ($return['status'] == 6) {
                $step1 = $step2 = $step3 = $step4 = true;
            }
            // 完成
            if ($return['status'] == 1) {
                $step1 = $step2 = $step3 = $step4 = $step5 = true;
            }
        }
        
        $this->assign('rtype', $return['rtype']);
        $this->assign('step1', $step1);
        $this->assign('step2', $step2);
        $this->assign('step3', $step3);
        $this->assign('step4', $step4);
        $this->assign('step5', $step5);
        
        if ($return['applyprice'] == 0) {
            $applyprice = '';
        } else {
            $applyprice = GoodsApi::currencyFormat($return['applyprice']);
        }
        
        // 常用快递公司
        $this->assign('arr_express', config('catalog_express'));
        
        // 商家退货地址
        $map2 = [
            'seller_id' => $return['getorder']['seller_id']
        ];
        $after_sale_address = StoreModel::where($map2)->value('after_sale_address');
        if($after_sale_address ===null){
            $after_sale_address = lang('please_contact_seller');
        }
        $this->assign('after_sale_address',$after_sale_address);
        
        
        $sku_price = $return['getorder']['symbol'] . $return['goods']['sku_price'];
        $sku_amount = $return['getorder']['symbol'] . ($return['goods']['sku_price'] * $return['goods']['sku_number']);
        $this->assign('sku_price', $sku_price);
        $this->assign('sku_amount', $sku_amount);
        $this->assign('applyprice', $applyprice);
        $this->assign('data', $return);
        $this->assign('after_sn', $after_sn);
        return $this->fetch('aftersalesDetail');
    }
    
    /**
     * @Mark: 保存退换货的快递单号
     * @return array
     * @Author: WangHuaLong
     */
    public function return_express()
    {
        $post_data = input('post.');
        $update_data = array(
            'shipping_no' => $post_data['number'],
            'shipping_name' => $post_data['company'],
            'status' => 5
        );
        
        AfterserviceModel::where('after_sn', $post_data['after_sn'])->update($update_data);
        return ['code' => 1, 'msg' => lang('save_success')];
    }
    
    /**
     * @Mark: 会员浏览足迹
     * @return mixed
     * @Author: WangHuaLong
     */
    public function mypath()
    {
        // 删除30天前的浏览记录
        $month = time() - 3600*24*30;
        MyPathModel::where(['create_time'=>['<', $month]])->where('uid',$this->uid)->delete();
    
        // 商品数据
        $map = [
            'uid' => $this->uid,
        ];
        
        $collect = MyPathModel::where($map)->order('create_time','DESC')->select();
        $arr_collect = [];
        $now_day = date('j',time());
        
    
        $this->assign('now_day',$now_day);
        if ($collect !== null) {
            foreach ($collect as $key => $arr) {
                
                if ($arr['goods']['minimum'] <= 0) {
                    $minimum = 1;
                } else {
                    $minimum = $arr['goods']['minimum'];
                }
                if ($arr['goods']['maximum'] <= 0) {
                    $maximum = $arr['goods']['quantity'];
                } else {
                    if ($arr['goods']['maximum'] > $arr['goods']['quantity']) {
                        $maximum = $arr['goods']['quantity'];
                    } else {
                        $maximum = $arr['goods']['maximum'];
                    }
                }
                $arr_collect[$key]['id'] = $arr['id'];
                $arr_collect[$key]['goods']['maximum'] = $maximum;
                $arr_collect[$key]['goods']['minimum'] = $minimum;
                $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
                $day = date("j",strtotime($arr['create_time']));
                $arr_collect[$key]['day'] = $day;
                $arr_collect[$key]['month'] = date("n",strtotime($arr['create_time']));
    
               
                if($day == $now_day){
                    $arr_collect[$key]['today'] = lang('today');
                }elseif($day == ($now_day-1)){
                    $arr_collect[$key]['today'] = lang('yesterday');
                }else{
                    $arr_collect[$key]['today'] = false;
                }
                
                
            }
        }
        $this->assign('arr_collect', $arr_collect);
        /*print_r($arr_collect);
        exit;*/
    
    
        return $this->fetch();
    }
    
    /**
     * @Mark: 删除单条浏览记录
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function del_mypath()
    {
        $id = $this->request->param('id');
        if ($id < 0) {
            return json(['code' => 0, 'msg' => lang('Check_null')]);
        }
        $map = [
            'uid' => $this->uid,
            'id' => $id
        ];
        
        MyPathModel::where($map)->delete();
        
        return json(['code' => 1]);
    }
    
    
    public function promote()
    {
        return $this->fetch('promote');
    }
    
    public function storeList()
    {
        return $this->fetch();
    }
    
    
    
    public function rebate()
    {
        return $this->fetch('rebate');
    }
    
    public function rebaterecord()
    {
        return $this->fetch('rebaterecord');
    }
    
    public function team()
    {
        return $this->fetch('team');
    }
    
    public function certificate()
    {
        return $this->fetch('certificate');
    }
    
    
    /**
     * @Mark:订单商品评价
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/18
     */
    public function comment()
    {
        $user_id = is_login();
        $param = $this->request->get();
        if (!isset($param['order_sn'])) $this->redirect('index');
        //查询订单信息
        $order_info = OrderModel::get(['order_sn' => $param['order_id'], 'user_id' => $user_id]);
        //查询订单下所有商品
        $order_goods_info = OrderGoodsModel::where(['order_id' => $param['order_id']])->select();
        if (!$order_info || !$order_goods_info) $this->redirect('index');
        $this->assign('data', $order_goods_info);
        $this->assign('order_info', $order_info);
        return $this->fetch();
    }
    
    /**
     * @Mark:商品评价入库
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/18
     */
    public function comment_save()
    {
        $param = $this->request->post();
        //订单信息
        $order_info = OrderModel::get(['order_sn' => $param['order_sn']]);
        //用户信息
        $user_info = \app\member\model\Account::get(is_login());
        foreach ($param['comment'] as $v) {
            $goods_info = OrderGoodsModel::get(['order_id' => $order_info['order_id'], 'goods_id' => $order_info['goods_id'], 'sku_id' => $v['sku_id']]);
            $data = [
                'order_id' => $order_info['order_id'],
                'order_sn' => $order_info['order_sn'],
                'goods_name' => $order_info['goods_name'],
                'goods_id' => $order_info['goods_id'],
                'goods_price' => $goods_info['sale_price'],
                'uid' => is_login(),
                'shop_id' => $goods_info['seller_id'],
                'from_membername' => $user_info['nickname'],
                'isanonymity' => $v['isanonymity'],
                'comment_content' => empty($v['content']) ? '用户暂未评价，系统默认好评' : $v['content'],
                'score' => $v['score'],
                'image' => $v['img'],
                'grade' => $v['grade']
            ];
            \app\member\service\GoodsComment::add($data);
        }
        return json(['code' => 1, 'msg' => lang('comment_success')]);
    }
    
    // 接口
    /**
     * @Mark: 取消订单操作
     * @return bool
     * @Author: WangHuaLong
     */
    public function cancelorder()
    {
        $order_id = input('post.order_id');
        $reason = input('post.reason');
        $data = [
            'cancel_type' => 0, //0 退款(仅退款不退货) 1 退款退货 2 换货
            'cancel_reason' => $reason,
            'cancel_reason_log' => lang('customer_cancelorder'),
            'order_id' => $order_id,
            'cancel_opt' => $this->uid,
            'cancel_soruce' => PLATFORM,
            'role' => 'customer',
        ];
        $result = OrderApi::cancelOrderApi($data);
        return $result;
    }
    
    /**
     * @Mark: 确认收货
     * @return array
     * @Author: WangHuaLong
     */
    public function finishorder()
    {
        
        $order_id = input('order_id');
        $data = array(
            'order_id' => $order_id,
            'user_id' => $this->uid,
            'source' => 'user'
        );
        
        $result = OrderApi::confirmorder($data);
        
        return $result;
    }
    
    /**
     * @Mark: 软删除订单，在回收站可还原
     * @return array
     * @Author: WangHuaLong
     */
    public function delete_order()
    {
        $order_id = input('post.order_id');
        $display = (int)input('post.display');
        $order = OrderModel::get($order_id);
        if ($order === null) {
            return ['code' => 0, 'msg' => lang('order_delete_error')];
        }
        if (!($order->status == 'TRADE_FINISHED' || $order->status == 'TRADE_CLOSED' || $order->status == 'TRADE_CLOSED_BY_SYSTEM')) {
            return ['code' => 0, 'msg' => lang('order_delete_error_status')];
        }
        
        if ($display == 0) {
            if ($order->display == 0) {
                return ['code' => 0, 'msg' => lang('order_delete_error')];
            }
            $order->display = 0;
            $order->save();
            return ['code' => 1, 'msg' => lang('order_delete_success')];
        } else {
            $order->display = 1;
            $order->save();
            return ['code' => 1, 'msg' => lang('order_display_success')];
        }
        
        
    }
    
    
}