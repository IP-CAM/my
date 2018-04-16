<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | AttributeGroup.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class AttributeGroup extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_ATTRIBUTE_GROUP__';
    
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
     * @Mark:  关联参数
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function attribute(){
        return $this->hasMany('Attribute','attribute_group_id','attribute_group_id');
    }
}