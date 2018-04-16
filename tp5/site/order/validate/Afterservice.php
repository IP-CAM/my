<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Afterservice.php  Version 2017/6/22
// +----------------------------------------------------------------------
namespace app\order\validate;

use think\Validate;

class Afterservice extends Validate
{
    // 验证规则
    protected $rule = [
        ['rec_id','require'],
        ['rec_id','unique:order_afterservice','{%apply_error}'],
        ['user_id', 'require'],
        ['return_reason','require'],
        ['rtype','require'],
    ];
    
}