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
// | 数据模型验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class Dbmodel extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['name', 'require', '{%Model_Name_must}'],
        ['name', '/^[a-zA-Z]\w{0,39}$/', '{%Model_Name_rule_error}'],
        ['name', 'unique:Dbmodel', '{%Model_Name_repeat}'],
        ['description', 'length:0,80', '{%Desc_Name_betwen050}'],
    ];
}