<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Attribute.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class Attribute extends Base
{
    protected $table = '__CROSSBBCG_ATTRIBUTE__';
    
    /**
     * @Mark: 过滤参数值
     * @param $value
     * @return string
     * @Author: WangHuaLong
     */
    protected function setAttributeValueAttr($value){
        $value = trim($value);
        if(substr($value,0,1) == ','){
            $value = substr($value,1);
        }
        if(substr($value,-1,1) == ','){
            $value = substr($value,0,-1);
        }
        
        // 过滤掉重复的值
        if($value && strpos($value,',') !== false){
            $value = implode(',',array_unique(explode(',',$value)));
        }
        
        // 替换,, 成,防止空值
        $value = str_replace(',,',',',$value);
        
        return $value;
    }
    
    /**
     * @Mark: 关联参数组
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function attributeGroup(){
        return $this->hasOne('AttributeGroup','attribute_group_id','attribute_group_id','','LEFT');
    }
}