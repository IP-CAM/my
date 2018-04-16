<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Action.php  Version 2017/3/27  行为验证器
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class Action extends Validate
{
    protected $rule = [
        ['name', 'require', '{%Action_name_must}'],
        ['name', 'unique:Action', '{%Action_name_repeat}'],
        ['title', 'require', '{%Action_title_must}'],
        ['title', 'unique:Action', '{%Action_title_repeat}'],
        ['remark', 'require', '{%Action_remark_must}'],
        ['remark', 'length:0,80', '{%Action_remark_betwen80}'],
    ];
}