<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Address.php  Version 2017/6/26 收货地址验证器
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Address extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['consignee', 'require', '{%Consignee_must}'],
        ['country', 'require', '{%Country_must}'],
        ['city', 'require', '{%Province_must}'],
        ['address', 'require', '{%Address_must}'],
        ['mobile', 'require', '{%Mobile_must}'],
        ['mobile', 'regex:/^1[34578]{1}\d{9}$/', '{%Member_mobile_rule_error}'],
        ['identity', 'require', '{%Identity_must}'],
    ];
}