<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Devloper.php  Version 2017/5/2  开发者验证器
// +----------------------------------------------------------------------
namespace app\openapi\validate;

use think\Validate;

class Devloper extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['levelid', 'require', '{%Member_levelid_must}'],
        ['username', 'require', '{%Member_username_must}'],
    ];
}