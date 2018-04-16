<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Account.php  Version 2017/4/1
// +----------------------------------------------------------------------
namespace app\seller\validate;

use think\Validate;

class Account extends Validate
{
    //验证规则
    protected $rule = [
        ['nickname','require|unique:Account','{%seller_name_must}|{%nickname_unique}'],
        ['realname','require','{%realname_must}'],
        ['mobile','unique:Account|^1[34578]{1}\d{9}$','{%mobile_unique}|{%mobile_format_error}'],
        ['email','email|unique:Account','{%email_format_error}|{%email_unique}'],
        ['password','require','{%password_error}'],
        //['housecode','require','{%choose_warehouse}']
    ];

    //验证场景
    protected $scene =[
        'update'    =>  ['mobile','email','realname'],
        'password'  =>  ['password'],
        'add_son'   =>  ['nickname','realname','mobile','email','password'],
    ];
    
    
}