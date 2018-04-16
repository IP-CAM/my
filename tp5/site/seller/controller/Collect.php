<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Collect.php  Version 收藏 2017/6/8
// +----------------------------------------------------------------------

namespace app\seller\controller;

use think\Db;
use app\seller\model\ShopAttention;

class Collect extends Common
{
    /**
     * @Mark:商品收藏排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function goods()
    {
        $re = Db::table('__CROSSBBCG_GOODS__')
            ->alias('cg')
            ->join('__MEMBER_COLLECT__ mc','cg.id=mc.goods_id','LEFT')
            ->field('count(mc.goods_id) as num,cg.good_code,cg.id,cg.name')
            ->group('mc.goods_id','desc')
            ->where('cg.seller_id',session('sellerId'))
            ->order('num','desc')
            ->limit(20)
            ->select();
        $this->assign('list',$re);
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺收藏统计
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function shop()
    {
        $where = ['store_id'=>session('shop_id')];
        if (input('start_time')) $where['create_time'][] = ['>=',strtotime(input('start_time'))];
        if (input('end_time')) $where['create_time'][] = ['<=',strtotime(input('end_time'))];
        $data = [];
        $re = Db::table('__SELLER_SHOP_ATTENTION__')
            ->where($where)
            ->order('create_day','desc')
            ->group('create_day')
            ->column('count(create_day) as days','create_day');
        $start_time = input('start_time')?strtotime(input('start_time')):time()-86400*31;
        $end_time = input('end_time')?strtotime(input('end_time')):time();
        $len = ceil(($end_time-$start_time)/86400);
        for ($i=0;$i<$len;$i++) {
            $days = date('Y-m-d',$end_time-86400*$i);
            $data['num'][] = isset($re[$days])?$re[$days]:0;
            $data['day'][] = $days;
        }
        $today_collect_total = ShopAttention::where(['create_day'=>date('Y-m-d',time()),'store_id'=>session('shop_id')])->count();
        $collect_total = ShopAttention::where(['store_id'=>session('shop_id')])->count();
        $this->assign('data',json($data));
        $this->assign('collect_total',$collect_total);
        $this->assign('today_collect_total',$today_collect_total);
        return $this->fetch();
    }
}
