<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | ShopAttention.php  Version 2017/6/29
// +----------------------------------------------------------------------

namespace app\seller\validate;

use think\Validate;

class ShopAttention extends Validate
{
    protected $rule = [
        ['uid','require|integer','{%param_error}|{%param_error}'],
        ['store_id','require|integer','{%param_error}|{%param_error}']
    ];
}
