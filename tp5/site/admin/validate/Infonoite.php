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
// | Noite.php  Version 2017/3/17  公告广播验证器
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class Infonoite extends Validate
{
    // 验证规则
    protected $rule = [
        ['pid', 'checkpid', '{%Canot_be_self_father}'],
        ['name', 'require', '{%Role_Name_must}'],
        ['name', '/^[a-zA-Z]\w{0,39}$/', '{%Role_Name_rule_error}'],
        ['name', 'unique:Role', '{%Role_Name_repeat}'],
        ['alias', 'require', '{%Role_alias_must}'],
        ['alias', 'length:0,80', '{%Role_alias_betwen015}'],
        ['description', 'length:0,80', '{%Desc_Name_betwen050}'],
    ];
}