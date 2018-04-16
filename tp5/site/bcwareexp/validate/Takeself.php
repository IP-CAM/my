<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Takeself.php  Version 2017/3/28  自提点验证器
// +----------------------------------------------------------------------
namespace app\bcwareexp\validate;

use think\Validate;

class Takeself extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require', '{%Takeself_title_must}'],
        ['title', 'unique:Takeself', '{%Takeself_title_repeat}'],
        ['name', 'require', '{%Takeself_Name_must}'],
        ['address', 'require', '{%Takeself_address_must}'],
        ['address', 'length:0,250', '{%Takeself_address_betwen250}'],
    ];
}