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
namespace app\statistics\controller\admin;

use app\admin\controller\Admin;
use app\order\model\Order as OrderModel;
use app\member\model\Account as MemberAccountModel;
use app\seller\model\Store as StoreModel;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\order\model\Goods as OrderGoodsModel;
use app\order\model\Afterservice as AfterserviceModel;
use app\crossbbcg\model\Brand as BrandModel;
use app\member\service\Member as MemberApi;


class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/9
     */
    public function _initialize()
    {
        parent::_initialize();
    }
    
    /**
     * @Mark:经营概况
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function index()
    {
        $param      = $this->request->param();
        $start_time = isset($param['start_time']) ? $param['start_time'] : 0;
        $end_time   = isset($param['end_time']) ? $param['end_time'] : 0;
        $date       = isset($param['date']) ? $param['date'] : 0;
        $where      = [];
        
        if ($start_time && $end_time) {
            $where['time']['op']    = 'between';
            $where['time']['range'] = [$start_time, $end_time];
        } else if ($date) {
            $where['time']['op']    = $date;
            $where['time']['range'] = null;
        } else {
            $date                   = 'week';
            $where['time']['op']    = 'week';
            $where['time']['range'] = null;
        }
        
        
        //新增订单数量及订单总数
        $ordernum    = OrderModel::whereTime('create_time', $where['time']['op'], $where['time']['range'])->count();
        $total_order = OrderModel::Count();
        $this->assign('ordernum', $ordernum);
        $this->assign('total_order', $total_order);
        
        //新增订单金额及订单总金额
        $new_order_money   = OrderModel::whereTime('create_time', $where['time']['op'], $where['time']['range'])->sum('goods_amount');
        $total_order_money = OrderModel::sum('goods_amount');
        $this->assign('new_order_money', $new_order_money);
        $this->assign('total_order_money', $total_order_money);
        
        //新增会员数及会员总数
        $membernum    = MemberAccountModel::whereTime('reg_time', $where['time']['op'], $where['time']['range'])->count();
        $total_member = MemberAccountModel::count();
        $this->assign('membernum', $membernum);
        $this->assign('total_member', $total_member);
        
        //新增店铺数及店铺总数
        $store_num   = StoreModel::whereTime('create_time', $where['time']['op'], $where['time']['range'])->count();
        $total_store = StoreModel::count();
        $this->assign('store_num', $store_num);
        $this->assign('total_store', $total_store);
        $this->assign('order_statistics', getOrderNum());
        $this->assign('date', $date);
        return $this->fetch();
    }
    
    /**
     * @Mark:商品数据排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/12
     */
    public function goods_rank()
    {
        $param      = $this->request->param();
        $start_time = isset($param['start_time']) ? $param['start_time'] : 0;
        $end_time   = isset($param['end_time']) ? $param['end_time'] : 0;
        //商品销量排行
        $where                      = [
            'where' => [],
            'paginate' => isset($param['ranks']) ? $param['ranks'] : 10
        ];
        $order_list                 = OrderModel::where(['status' => 'TRADE_FINISHED'])->column('order_id');
        $where['where']['order_id'] = ['in', $order_list];
        if ($start_time && $end_time) {
            $where['where']['create_time'][] = ['>=', strtotime(trim($start_time))];
            $where['where']['create_time'][] = ['<=', strtotime(trim($end_time))];
        }
        $sales_volume_rank = OrderGoodsModel::where($where['where'])->group('goods_id')->order('num desc')->field("COUNT(goods_id) as num,goods_name,goods_id,sku_code,seller_id")->paginate($where['paginate']);
        $cate_name         = GoodsApi::getCateogriesName();
        $store_list        = StoreModel::column('seller_name', 'seller_id');
        $this->assign('cate_name', $cate_name);
        $this->assign('sales_volume_rank', $sales_volume_rank);
        $this->assign('store_list', $store_list);
        //商品销售额排行
        $goods_money    = OrderGoodsModel::where($where['where'])->group('goods_id')->order('money desc')->field("SUM(sku_price) as money,goods_name,goods_id,sku_code,seller_id")->paginate($where['paginate']);
        $goods_cate_ids = GoodsModel::column('cat_id', 'id');
        $this->assign('goods_cate_ids', $goods_cate_ids);
        $this->assign('goods_money', $goods_money);
        $this->assign('ranks', $where['paginate']);
        $this->assign('meta_title', lang('salesVolumeRank'));
        return $this->fetch();
    }
    
    /**
     * @Mark:商品交易明细
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/12
     */
    public function goods_sale_info()
    {
        $param      = $this->request->param();
        $where      = [
            'where' => [],
            'order' => 'rec_id desc',
        ];
        $start_time = isset($param['start_time']) ? $param['start_time'] : 0;
        $end_time   = isset($param['end_time']) ? $param['end_time'] : 0;
        $name       = isset($param['name']) ? $param['name'] : '';
        $seller_id  = isset($param['seller_id']) ? $param['seller_id'] : 0;
        $brand_id   = isset($param['brand_id']) ? $param['brand_id'] : 0;
        $cat_id     = isset($param['cat_id']) ? $param['cat_id'] : 0;
        
        $order_list                 = OrderModel::where(['status' => 'TRADE_FINISHED'])->column('order_id');
        $where['where']['order_id'] = ['in', $order_list];
        
        if ($name) $where['where']['goods_name|sku_code'] = ['like', '%' . $name . '%'];
        if ($seller_id) $where['where']['seller_id'] = $seller_id;
        if ($start_time && $end_time) {
            $where['where']['create_time'][] = ['>=', strtotime(trim($start_time))];
            $where['where']['create_time'][] = ['<=', strtotime(trim($end_time))];
        }
        if ($brand_id) $where['where']['brand_id'] = $brand_id;
        if($cat_id) $where['where']['cat_id'] = $cat_id;
        
        $trade_list = \think\Db::table('__ORDER_GOODS__ o')
            ->join('__CROSSBBCG_GOODS__ g', 'o.goods_id = g.id', 'LEFT')
            ->where($where['where'])
            ->order($where['order'])
            ->paginate(25);
        
        $this->assign('trade_list', $trade_list);
        $cate_name  = GoodsApi::getCateogriesName();
        $store_list = StoreModel::column('seller_name', 'seller_id');
        $brand_list = BrandModel::column('name', 'id');
        $this->assign('cate_name', $cate_name);
        $this->assign('store_list', $store_list);
        $this->assign('brand_list', $brand_list);
        //$goods_cate_ids = GoodsModel::column('cat_id', 'id');
        //$this->assign('goods_cate_ids', $goods_cate_ids);
        $this->assign('meta_title', lang('goodsSaleInfo'));
        return $this->fetch();
    }
    
    /**
     * @Mark:会员交易排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/12
     */
    public function member_rank()
    {
        $param = $this->request->param();
        $ranks = isset($param['ranks']) ? $param['ranks'] : 10;
        $start_time = isset($param['start_time'])?$param['start_time']:'';
        $end_time = isset($param['end_time'])?$param['end_time']:'';
        $where = [
            'status' => 'TRADE_FINISHED'
        ];
        if ($start_time && $end_time) {
            $where['confirm_time'][] = ['>=',strtotime(trim($start_time))];
            $where['confirm_time'][] = ['<=',strtotime(trim($end_time))];
        }
        
        //会员订单量排行
        $num_rank = OrderModel::where($where)->group('user_id')->order('num desc')->field('COUNT(order_id) as num,user_id')->paginate($ranks);
        $this->assign('num_rank', $num_rank);
        $this->assign('ranks', $ranks);
        
        //会员订单额排行
        $money_rank = OrderModel::where($where)->group('user_id')->order('money desc')->field('SUM(goods_amount) as money,user_id')->paginate($ranks);
        $this->assign('money_rank', $money_rank);
        
        $member_list = MemberAccountModel::column('nickname', 'id');
        $this->assign('member_list', $member_list);
        $this->assign('meta_title', lang('memberRank'));
        return $this->fetch();
    }
    
    /**
     * @Mark:交易数据统计
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function trade_data()
    {
        $param      = $this->request->param();
        $start_time = isset($param['start_time']) ? $param['start_time'] : 0;
        $end_time   = isset($param['end_time']) ? $param['end_time'] : 0;
        $date       = isset($param['date']) ? $param['date'] : 0;
        $where      = [];
        
        if ($start_time && $end_time) {
            $where['time']['op']    = 'between';
            $where['time']['range'] = [$start_time, $end_time];
        } else if ($date) {
            $where['time']['op']    = $date;
            $where['time']['range'] = null;
        } else {
            $date                   = 'week';
            $where['time']['op']    = 'week';
            $where['time']['range'] = null;
        }
        
        //新增订单数及金额
        $new_order = OrderModel::whereTime('create_time', $where['time']['op'], $where['time']['range'])->field('SUM(goods_amount) as money,COUNT(order_id) as num')->find();
        $this->assign('new_order', $new_order);
        
        //已完成订单数及金额
        $where['where']['status'] = 'TRADE_FINISHED';
        $finished_orders          = OrderModel::where($where['where'])->whereTime('confirm_time', $where['time']['op'], $where['time']['range'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('finished_orders', $finished_orders);
        
        //售后订单数及金额
        unset($where['where']['status']);
        $order_ids    = OrderModel::where($where['where'])->whereTime('cancel_time', $where['time']['op'], $where['time']['range'])->column('order_id');
        $rec_ids      = AfterserviceModel::where(['order_id' => ['in', $order_ids]])->whereTime('create_time', $where['time']['op'], $where['time']['range'])->column('rec_id');
        $afterservice = OrderGoodsModel::where(['rec_id' => ['in', $rec_ids]])->field('SUM(real_price) as money,COUNT(rec_id) as num')->find();
        $this->assign('afterservice', $afterservice);
        //取消订单数及金额
        $where['where']['cancel_status'] = ['in', ['SUCCESS', 'REFUND_PROCESS']];
        $cancel_orders                   = OrderModel::where($where['where'])->where('cancel_time', $where['time']['op'], $where['time']['range'])->field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('cancel_orders', $cancel_orders);
        
        //订单总数及总金额
        $total_order = OrderModel::field('COUNT(order_id) as num,SUM(goods_amount) as money')->find();
        $this->assign('total_order', $total_order);
        $this->assign('order_statistics', getOrderNum());
        $this->assign('date', $date);
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function store_rank()
    {
        $param = $this->request->param();
        $ranks = isset($param['ranks']) ? $param['ranks'] : 10;
        $start_time = isset($param['start_time'])?$param['start_time']:'';
        $end_time = isset($param['end_time'])?$param['end_time']:'';
        $where = [
            'status' => 'TRADE_FINISHED'
        ];
        if ($start_time && $end_time) {
            $where['confirm_time'][] = ['>=',strtotime(trim($start_time))];
            $where['confirm_time'][] = ['<=',strtotime(trim($end_time))];
        }
        
        //店铺销量排行
        $num_rank   = OrderModel::where($where)->group('seller_id')->order('num desc')->field('COUNT(order_id) as num,seller_id')->paginate($ranks);
        $this->assign('num_rank',$num_rank);
        //店铺销售额排行
        $money_rank = OrderModel::where($where)->group('seller_id')->order('money desc')->field('SUM(goods_amount) as money,seller_id')->paginate($ranks);
        $this->assign('money_rank',$money_rank);
    
        $store_list = StoreModel::column('seller_name', 'seller_id');
        $this->assign('store_list',$store_list);
        $this->assign('meta_title',lang('storeRank'));
        $this->assign('ranks',$ranks);
        return $this->fetch();
    }
    
    /**
     * @Mark:会员统计排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function member_statistics_rank()
    {
        //获取一周内每天用户注册数和充值额
        $data = MemberApi::getWeekNum();
    
        //查询今日注册人数
        $day = ['reg_time' => ['>=', mktime(0, 0, 0, date('m'), date('d'), date('Y'))]];
        $dayNum = MemberApi::getDayAccount($day);
    
        //查询本月注册人数
        $mouth = ['reg_time' => ['>=', mktime(0, 0, 0, date('m'), 1, date('Y'))]];
        $mouthNum = MemberApi::getDayAccount($mouth);
    
        //查询总注册数
        $total = MemberApi::getDayAccount();
    
        //本月会员活跃数
        $active = ['last_login_time' => ['>=', mktime(0, 0, 0, date('m'), 1, date('Y'))]];
        $mouthActive = MemberApi::getDayAccount($active);
    
    
        $this->assign('meta_title', lang('rMember'));
        $this->assign('today', $dayNum);
        $this->assign('mouth', $mouthNum);
        $this->assign('total', $total);
        $this->assign('mouthActive', $mouthActive);
        $this->assign('data', $data);
        return $this->fetch();
    }
}
