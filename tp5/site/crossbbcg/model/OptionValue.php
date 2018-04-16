<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | OptionValue.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class OptionValue extends Base
{
    protected $table = '__CROSSBBCG_OPTION_VALUE__';
    protected $table_option = '__CROSSBBCG_OPTION__';
    
    
    public function getMergeOption($option_value_id)
    {
        $result = Db::table('rt_crossbbcg_option_value ov')
            ->join('rt_crossbbcg_option o', 'ov.option_id=o.option_id')
            ->field('o.option_id AS option_id,o.name AS option_name,ov.name AS option_value_name')
            ->where('option_value_id', $option_value_id)
            ->find();
        
        return $result;
    }
}