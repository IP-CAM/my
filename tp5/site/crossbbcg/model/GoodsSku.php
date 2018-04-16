<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | GoodsSku.php  Version 2017/6/22
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class GoodsSku extends Base
{
    protected $table = '__CROSSBBCG_GOODS_SKU__';
    protected $table_good = '__CROSSBBCG_GOODS__';
    
    /**
     * @Mark: 合并商品的选项值id
     * @param int $good_id      商品id
     * @param bool $quantity     是否检查sku的库存大于0
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public function getMergeValue($good_id, $quantity = false)
    {
        if ($quantity) {
            $result = Db::table($this->table)
                ->field('GROUP_CONCAT(`merge_option_value_id` SEPARATOR \',\')')
                ->where('good_id', $good_id)->where('quantity','>',0)
                ->value('GROUP_CONCAT(`merge_option_value_id` SEPARATOR \',\')');
        } else {
            $result = Db::table($this->table)
                ->field('GROUP_CONCAT(`merge_option_value_id` SEPARATOR \',\')')
                ->where('good_id', $good_id)
                ->value('GROUP_CONCAT(`merge_option_value_id` SEPARATOR \',\')');
        }
        
        return $result;
    }
    
    /**
     * @Mark: 查找sku是否包括option_value_id，返回商品id的数组
     * @param $option_value_id
     * @return array
     * @Author: WangHuaLong
     */
    public function findGoodId($option_value_id)
    {
        $exp = 'FIND_IN_SET(:merge_option_value_id,merge_option_value_id)';
        $val = ['merge_option_value_id' => (int)$option_value_id];
        $result = Db::table($this->table)->where($exp,$val)->column('good_id');
        return $result;
    }
    
    /**
     * @Mark: 获取sku的商品总信息
     * @param $sku_id
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public function getGoodsSku($sku_id){
        $result = Db::table($this->table . ' gs')->join($this->table_good . ' g','gs.good_id=g.id')->where('gs.sku',$sku_id)->find();
        return $result;
    }
}