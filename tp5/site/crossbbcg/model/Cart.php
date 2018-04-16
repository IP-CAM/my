<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Cart.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Cart extends Base
{
    protected $table = '__CROSSBBCG_CART__';
    protected $table_goods = '__CROSSBBCG_GOODS__';
    protected $table_store = '__SELLER_STORE__';
    protected $table_sku = '__CROSSBBCG_GOODS_SKU__';
    
    //定义时间戳字段名create_time, update_time, 自动完成
    protected $autoWriteTimestamp = true;
    
    /**
     * @Mark: 获取购物车中的商品信息
     * @param array $filter_data 查询条件
     * @param bool $single 获取单个商品数据 【可选】
     * @return array|false|\PDOStatement|string|\think\Collection|\think\Model
     * @Author: WangHuaLong
     */
    public function getGoods($filter_data, $single = false)
    {
        $field = 'ss.seller_name';
        $field .= ',cg.id good_id,cg.name good_name,cg.thumb,cg.weight,cg.weight_class_id,cg.tax_rate,cg.seller_id,cg.maximum,cg.minimum,cg.points';
        $field .= ',cgs.sale_price,cgs.market_price,cgs.name sku_name,cgs.quantity,cgs.merge_option_value_id merge_option_value_id';
        $field .= ',cc.id,cc.sku,cc.num,cc.selected';
        
        $where = [];
        if (isset($filter_data['where'])) {
            foreach ($filter_data['where'] as $key => $value) {
                $where['cc.' . $key] = $value;
            }
        }
        
        if ($single) {
            $result = Db::table($this->table_sku . ' cgs')
                ->join($this->table . ' cc', 'cc.sku = cgs.sku', 'LEFT')
                ->join($this->table_goods . ' cg', 'cc.good_id = cg.id', 'LEFT')
                ->join($this->table_store . ' ss', 'cg.seller_id = ss.seller_id', 'LEFT')
                ->where($where)
                ->field($field)
                ->find();
        } else {
            $result = Db::table($this->table_sku . ' cgs')
                ->join($this->table . ' cc', 'cc.sku = cgs.sku', 'LEFT')
                ->join($this->table_goods . ' cg', 'cc.good_id = cg.id', 'LEFT')
                ->join($this->table_store . ' ss', 'cg.seller_id = ss.seller_id', 'LEFT')
                ->where($where)
                ->field($field)
                ->select();
        }
        
        
        return $result;
    }
    
    /**
     * @Mark: 删除数据库中重复的sku商品
     * @param $member_id
     * @Author: WangHuaLong
     */
    public function deleteRepeatSku($member_id)
    {
        
        $exp = '(SELECT COUNT(*) FROM rt_crossbbcg_cart WHERE sku = cc.sku AND session_id = cc.session_id) > :num';
        $num = ['num'=>1];
        $repeat_sku = Db::table($this->table)->alias('cc')
            ->field('id')
            ->where($exp, $num)
            ->where('cc.member_id', $member_id)
            ->order('id', 'DESC')
            ->column('id');
        if(count($repeat_sku) >= 2){
            unset($repeat_sku[0]);
            Db::table($this->table)->where('id','IN',$repeat_sku)->delete();
        }
    }
    
}