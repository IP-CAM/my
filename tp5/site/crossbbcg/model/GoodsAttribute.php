<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | GoodsAttribute.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class GoodsAttribute extends Base
{
    protected $table = '__CROSSBBCG_GOODS_ATTRIBUTE__';
    
    
    /**
     * @Mark: 关联参数模型
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function attribute(){
        return $this->hasOne('Attribute','attribute_id','attribute_id','','LEFT');
    }
    
    /**
     * @Mark: 关联参数组模型
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function attributeGroup(){
        return $this->hasOne('AttributeGroup','attribute_group_id','attribute_group_id','','LEFT');
    }
}