<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Category.php  Version 2017/6/7
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Articlecat extends Validate
{
    // 验证规则
    protected $rule = [
        ['pid', 'checkpid', '{%Canot_be_self_father}'],
        ['title', 'require', '{%Category_title_must}'],
        ['title', 'unique:Articlecat', '{%Category_title_repeat}'],
        ['title', 'length:0,80', '{%Category_title_length080}'],
    ];
    
    /**
     * @Mark:检查PID是否合法
     * @param $value
     * @param $rule
     * @param $data
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/18
     */
    protected function checkpid($value, $rule, $data){
        if(!empty($data['id'])){
            if($data['id'] == $data['pid'] ){
                return false;
            }
        }
        return true;
    }
}