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
// | Account.php  Version 2017/3/18 会员账户验证器
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Extent extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['field_name', 'require', '{%Extent_fieldname_must}'],
        ['alias', 'require', '{%Extent_alias_must}'],
        ['field_type', 'require', '{%Extent_fieldtype_must}'],
        ['field_name', '^(?!_)(?!.*?_$)[a-zA-Z0-9_]+$', '{%Extent_alias_rule_error}'],
    ];
}