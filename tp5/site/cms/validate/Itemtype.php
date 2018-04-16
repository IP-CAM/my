<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Version 2017/6/14 分类属性类型验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Itemtype extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require|max:30|unique:Itemtype', '{%Itemtype_name_must}|{%Itemtype_name_length}|{%Itemtype_name_repeat}'], //类型名称
    ];
    
}