<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Attribute.php  Version 2017/6/4
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\Attribute as AttributeModel;

class Attribute extends Validate
{
    protected $rule = [
        'name' => 'require|checkName',
    ];
    
    protected $message = [
        'name.require' => '{%Attribute_Name_Require}',
    ];
    
    /**
     * @Mark: 检查选项值名称是否重复
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkName($value, $rule, $data)
    {
        $map = array();
        $map['name'] = ['=', $value];
        if (isset($data['attribute_group_id'])) {
            $map['attribute_group_id'] = ['=', $data['attribute_group_id']];
            $attribute = new AttributeModel();
            if (isset($data['attribute_id'])) {
                $map['attribute_id'] = ['NOT IN', $data['attribute_id']];
                $count = $attribute->where($map)->count();
                if ($count) {
                    return lang('Attribute_Name_Exist');
                } else {
                    return true;
                }
            } else {
                $count = $attribute->where($map)->count();
                if ($count) {
                    return lang('Attribute_Name_Exist');
                } else {
                    return true;
                }
            }
        } else {
            return lang('Error_Missing_Param');
        }
    }
}