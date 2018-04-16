<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Filter.php  Version 2017/6/4
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;

class Filter extends Validate
{
    protected $rule = [
        ['name', 'require', '{%Filter_Name_Require}'],
        ['name', 'unique:Filter', '{%Filter_Name_Unique}'],
    ];
    
}