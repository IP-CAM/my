<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | AttributeGroup.php  Version 2017/6/4
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\AttributeGroup as AttributeGroupModel;

class AttributeGroup extends Validate
{
    protected $rule = [
        'name' => 'require|checkName',
    ];
    
    protected $message = [
        'name.require' => '{%AttributeGroup_Name_Require}',
        
    ];
    
    /**
     * @Mark: 检查选项名称是否重复
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkName($value,$rule,$data){
        $map = array();
        $map['name'] = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
        if(isset($data['attribute_group_id'])){
            $map['attribute_group_id'] = ['NOT IN',$data['attribute_group_id']];
            $attribute_group = new AttributeGroupModel();
            $count = $attribute_group->where($map)->count();
            if($count){
                return lang('AttributeGroup_Name_Exist');
            }else{
                return true;
            }
        }else{
            $attribute_group = new AttributeGroupModel();
            $count = $attribute_group->where($map)->count();
            if($count){
                return lang('AttributeGroup_Name_Exist');
            }else{
                return true;
            }
        }
    }
}