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
// | 控制器  Version 2017/1/23
// +----------------------------------------------------------------------

namespace app\seller\controller;

use think\Cache;
use app\crossbbcg\model\Goods as GoodsModel;
use app\seller\model\Store as StoreModel;
use think\Session;
use app\order\model\Order as OrderModel;
use app\order\model\Afterservice as AfterserviceModel;


class Index extends Common
{
    
    /**
     * @Mark:商户中心首页
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function index()
    {
        //店铺信息
        $store_info = StoreModel::get(Session::get('shop_id'));
        $this->assign('store_info',$store_info);
        
        //昨日订单信息
        $yestedayorders = OrderModel::where(['seller_id'=>SellerId])
            ->whereTime('create_time', 'yesterday')
            ->field("COUNT(*) as num,SUM(goods_amount) as money")
            ->find();
        $this->assign('yestedayordernum',$yestedayorders['num']);
        $this->assign('yestedayordermoney',round($yestedayorders['money'],2));
        
        //本周订单信息
        $weekorders = OrderModel::where(['seller_id'=>SellerId])
            ->whereTime('create_time', 'week')
            ->field("COUNT(*) as num,SUM(goods_amount) as money")
            ->find();
        $this->assign('weekordernum',$weekorders['num']);
        $this->assign('weekordermoney',round($weekorders['money'],2));
        
        //查询当月订单信息
        $monthorders = OrderModel::where(['seller_id'=>SellerId])
            ->whereTime('create_time', 'month')
            ->field("COUNT(*) as num,SUM(goods_amount) as money")
            ->find();
        $this->assign('monthordernum',$monthorders['num']);
        $this->assign('monthordermoney',round($monthorders['money'],2));
        
        //商品销量排行
        $goods_rank = GoodsModel::where(['seller_id'=>SellerId])->order('sales_volume desc')->limit(10)->select();
        $this->assign('goods_rank',$goods_rank);
        
        //待付款订单数
        $wait_buyer_pay = OrderModel::where(['seller_id'=>SellerId,'status'=>'WAIT_BUYER_PAY'])->count();
        $this->assign('wait_buyer_pay',$wait_buyer_pay);
        //待发货订单
        $wait_buyer_send_goods = OrderModel::where(['seller_id'=>SellerId,'status'=>'WAIT_SELLER_SEND_GOODS'])->count();
        $this->assign('wait_buyer_send_goods',$wait_buyer_send_goods);
        //取消订单
        $map = [
            'seller_id' => SellerId,
            'status'=>['in', 'WAIT_SELLER_SEND_GOODS,TRADE_CLOSED'],
            'cancel_status'=>['<>', 'NO_APPLY'],
        ];
        $cancel_order = OrderModel::where($map)->count();
        $this->assign('cancel_order',$cancel_order);
        //退货申请
        $refund_goods = OrderModel::where(['seller_id'=>SellerId,'cancel_type'=>1,'status'=>'WAIT_BUYER_CONFIRM_GOODS'])->count();
        $this->assign('refund_goods',$refund_goods);
        //换货申请
        $change_goods = OrderModel::where(['seller_id'=>SellerId,'cancel_type'=>2,'status'=>'WAIT_BUYER_CONFIRM_GOODS'])->count();
        $this->assign('change_goods',$change_goods);
        //退款处理
        $order_ids = OrderModel::where(['seller_id'=>SellerId,'cancel_type'=>0,'status'=>'WAIT_BUYER_CONFIRM_GOODS'])->column('order_id');
        $refund_orders = AfterserviceModel::where(['order_id'=>['in',$order_ids]])->count();
        $this->assign('refund_orders',$refund_orders);
        
        //已上架商品
        $enable_goods = GoodsModel::where(['seller_id'=>SellerId,'status'=>'enabled'])->count();
        $this->assign('enable_goods',$enable_goods);
        //待审核商品
        $pending_review_goods = GoodsModel::where(['seller_id'=>SellerId,'status'=>'pending_review'])->count();
        $this->assign('pending_review_goods',$pending_review_goods);
        //已下架商品
        $disable_goods = GoodsModel::where(['seller_id'=>SellerId,'status'=>'disabled'])->count();
        $this->assign('disable_goods',$disable_goods);
        
        
        //$this->assign('meta_title','首页');
        $this->assign('statistics',getOrderNum());
        return $this->fetch();
    }
    
    public function clearcache()
    {
        Cache::clear();
        $this->success(lang('cache_clear_success'));
    }
}