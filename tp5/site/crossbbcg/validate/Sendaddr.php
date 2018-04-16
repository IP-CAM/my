<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Sendaddr.php  Version 2017/3/27  收发地址验证器
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;

class Sendaddr extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require', '{%Sendaddr_title_must}'],
        ['title', 'unique:Sendaddr', '{%Sendaddr_title_repeat}'],
        ['name', 'require', '{%Sendaddr_Name_must}'],
        ['province', 'require', '{%Sendaddr_province_must}'],
        ['city', 'require', '{%Sendaddr_city_must}'],
        ['address', 'require', '{%Sendaddr_address_must}'],
        ['mobile', 'require', '{%Sendaddr_mobile_must}'],
    ];
}