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
// | Without.php  Version 2017/6/26 提现记录验证器
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Without extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['money', 'require', '{%without_money_must}'],
        ['uid', 'require', '{%without_uid_must}'],
        ['bank_name', 'require', '{%without_bankname_must}'],
        ['account_bank', 'require', '{%without_accountbank_must}'],
        ['account_name', 'require', '{%without_accountname_must}'],
    ];
}