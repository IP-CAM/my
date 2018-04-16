<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | AdPosition.php  Version 2017/8/7
// +----------------------------------------------------------------------

namespace app\crossbbcg\validate;

use think\Validate;

class AdPosition extends Validate
{
    protected $rule = array(
        ['name','require','{%ad_position_name_must}']
    );
}
