<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Level.php  Version 2017/3/18 会员等级验证器
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Level extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['tag', 'require', '{%Memberlevel_tag_must}'],
        ['tag', '/^[a-zA-Z]\w{0,39}$/', '{%Memberlevel_tag_rule_error}'],
        ['tag', 'unique:Level', '{%Memberlevel_tag_repeat}'],
        ['name', 'require', '{%Memberlevel_Name_must}'],
        //['name', '/^[a-zA-Z]\w{0,39}$/', '{%Memberlevel_Name_rule_error}'],
        ['name', 'unique:Level', '{%Memberlevel_Name_repeat}'],
        ['alias', 'require', '{%Memberlevel_alias_must}'],
        ['alias', 'unique:Level', '{%Memberlevel_alias_repeat}'],
        ['discount', 'number', '{%Discount_must_number}'],
        ['discount', 'between:0,100', '{%Discount_betwen_0100}'],
    ];
}