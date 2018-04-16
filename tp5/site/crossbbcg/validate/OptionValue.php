<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | OptionValue.php  Version 2017/6/4
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\OptionValue as OptionValueModel;

class OptionValue extends Validate
{
    protected $rule = [
        'name' => 'require|checkName',
    ];
    
    protected $message = [
        'name.require' => '{%Option_Value_Name_Require}',
    
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
        if (isset($data['option_id'])) {
            $map['option_id'] = ['=', $data['option_id']];
            $option_value = new OptionValueModel();
            if (isset($data['option_value_id'])) {
                $map['option_value_id'] = ['NOT IN', $data['option_value_id']];
                $count = $option_value->where($map)->count();
                if ($count) {
                    return lang('Option_Value_Name_Exist');
                } else {
                    return true;
                }
            } else {
                $count = $option_value->where($map)->count();
                if ($count) {
                    return lang('Option_Value_Name_Exist');
                } else {
                    return true;
                }
            }
        } else {
            return lang('Error_Missing_Param');
        }
    }
    
}