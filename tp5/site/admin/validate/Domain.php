<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Domain.php  Version 2017/3/27  行为验证器
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class Domain extends Validate
{
    protected $rule = [
        ['model', 'require', '{%model_must}'],
        ['model', 'unique:Domain', '{%model_repeat}'],
        ['domain', 'require', '{%domain_must}'],
        ['domain', 'unique:Domain', '{%domain_repeat}'],
    ];
}