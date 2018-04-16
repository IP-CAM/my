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

class Account extends Validate
{
    // 验证规则
    protected $rule = [
        //['nickname', 'require', '{%Member_nickname_must}'],
        //['username', 'require', '{%Member_username_must}'],
        ['username', 'unique:Account', '{%Memberlevel_username_rule_error}'],
        //['nickname', 'unique:Account', '{%nickname_rule_error}'],
        ['email', 'unique:Account', '{%Member_email_repeat}'],
        ['email', 'email', '{%Member_email_error}'],
        ['password', '/^[a-zA-Z0-9]{6,}$/', '{%Member_password_rule_error}'],
        ['password', 'require', '{%Member_password_must}'],
        ['mobile', 'unique:Account', '{%Member_mobile_rule_error}'],
        ['mobile', 'regex:/^1[34578]{1}\d{9}$/', '{%Member_mobile_rule_error}'],
       
    ];
}