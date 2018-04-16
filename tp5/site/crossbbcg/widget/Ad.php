<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Ad.php  Version 2017/8/4
// +----------------------------------------------------------------------

namespace app\crossbbcg\widget;

use app\crossbbcg\model\Advertising as AdvertisingModel;
use app\crossbbcg\model\AdPosition as AdPositionModel;


class Ad{
    /**
     * @Mark:获取当前广告位所有图文广告数据
     * @param $id int 广告位id
     * @param $limit int 查询结果限制数量
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/4
     * @return object
     */
    public function get_ad($id,$limit=null)
    {
        $list = AdvertisingModel::where(array('langid'=>LANG,'ad_position'=>$id,'status'=>1))
            ->order('sort asc')
            ->limit($limit)
            ->select();
        return $list;
    }
    
    /**
     * @Mark:获取商品广告
     * @param $id
     * @param null $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/16
     */
    public function get_goods_ad($id,$limit=null)
    {
        //判断广告位排序类型
        $info = AdPositionModel::get($id);
        if (!$info) return null;
        if ($info['sort_type'] == 1) {
            $order = 'g.sales_volume desc';
        } elseif($info['sort_type'] == 2) {
            $order = 'a.sort asc';
        } elseif($info['sort_type'] == 3) {
            $order = 'g.update_time desc';
        } else {
            $order = 'a.sort asc';
        }
        $data = array(
            'where' =>array('a.langid'=>LANG,'a.ad_position'=>$id,'a.status'=>1),
            'limit'=>$limit,
            'order'=>$order
        );
        $obj = new AdvertisingModel();
        return $obj->get_goods_ad($data);
    }
    
    
}
