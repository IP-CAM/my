<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Filter.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Filter extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_FILTER__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    
    /**
     * @Mark: 存储语言id
     * @param $value
     * @return mixed
     * @Author: WangHuaLong
     */
    protected function setLangidAttr($value)
    {
        return $value;
    }
    
    /**
     * @Mark:查找关键字是否存在
     * @param $name
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public function findName($name){
        $result = Db::table($this->table)->where('FIND_IN_SET(:name,name)',['name'=>$name])->where('status',1)->find();
        return $result;
    }
}