<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Transport.php  Version 2017/6/27
// +----------------------------------------------------------------------

namespace app\seller\validate;

use think\Validate;

class Transport extends Validate
{
    //验证规则
    protected $rule = [
        ['name','require','{%template_name_must}'],
        //['shop_id','require|integer','{%id_must}|{%id_error}'],
        //['warecode','require','{%warecode_must}']
    ];
}
