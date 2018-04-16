<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Manager.php  Version 2017/9/7
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;

class Manager extends Validate
{
    protected $rule = [];
    
    protected $scene = [
        'edit'  =>[],
        'add'   =>[]
    ];
}
