<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Option.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Option extends Base
{
    protected $table = '__CROSSBBCG_OPTION__';
    protected $table_option_value = '__CROSSBBCG_OPTION_VALUE__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    
    /**
     * @Mark: 存储langid
     * @param $value
     * @return mixed
     * @Author: WangHuaLong
     */
    protected function setLangidAttr($value)
    {
        return $value;
    }
    
    /**
     * @Mark: 返回商品sku的选项
     * @param $merge_value
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public function getSkuOptions($merge_value)
    {
        $result = Db::table($this->table . ' o')
            ->field('o.name,o.sort,o.type,ov.option_value_id,ov.name option_value_name,ov.sort option_value_sort')
            ->join($this->table_option_value . ' ov', 'o.option_id=ov.option_id')
            ->where('ov.option_value_id', 'IN', $merge_value)
            ->order(['sort' => 'ASC', 'option_value_sort' => 'ASC'])
            ->select();
        return $result;
    }
    
    /**
     * @Mark: 关联选项值
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function optionValue()
    {
        return $this->hasMany('OptionValue','option_id','option_id');
    }
}