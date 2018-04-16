<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Role.php  Version 2017/6/15
// +----------------------------------------------------------------------

namespace app\seller\validate;

use think\Validate;

class Role extends Validate
{
    protected  $rule = [
        ['seller_id','require|integer','{%seller_id_must}|{%id_must}'],
        ['name','require','{%rolename_must}'],
    ];
}
