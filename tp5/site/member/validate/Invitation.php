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
// | Invitation.php  Version 2017/3/18 会员邀请证器
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Invitation extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['rang', 'require', '{%Rang_must}'],
        ['forinv', 'require', '{%Forinv_must}'],
        ['welcome', 'require', '{%Welcome_must}'],
        ['welcome', 'max:200', '{%Welcome_rule_error}'],
    ];
}