<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Cash.php  Version 1.0  2017/5/25 
// +----------------------------------------------------------------------
namespace app\seller\validate;

use think\Validate;

class Shopcat extends Validate
{
    protected $rule = [
        ['name','require|max:25','{%name_must}|{%name_too_long}'],
        ['sort','require','{%sort_must}'],
        ['suffix','require','{%suffix_error}'],
        ['goods_limit','number','{%goods_limit_error}']
    ];
}