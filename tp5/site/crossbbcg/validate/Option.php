<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Option.php  Version 2017/6/4
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\Option as OptionModel;

class Option extends Validate
{
    protected $rule = [
        'name' => 'require|checkName',
    ];
    
    protected $message = [
        'name.require' => '{%Option_Name_Require}',
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
        $map['langid'] = $data['langid'];
        if(isset($data['option_id'])){
            $map['option_id'] = ['NOT IN',$data['option_id']];
            $option = new OptionModel();
            $count = $option->where($map)->count();
            if($count){
                return lang('Option_Name_Exist');
            }else{
                return true;
            }
        }else{
            $option = new OptionModel();
            $count = $option->where($map)->count();
            if($count){
                return lang('Option_Name_Exist');
            }else{
                return true;
            }
        }
    }
}