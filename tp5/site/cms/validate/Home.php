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
// |  Version 2017/6/16 首页管理验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Home extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require|max:30|unique:Home', '{%Home_name_repeat}|{%Currency_Name_tip}|{%Home_name_must}'], //标识
        ['title', 'require|max:30|unique:Home', '{%Goods_Name_Require}|{%Home_title_length}|{%Goods_Name_Exist}'], //名称
    ];
    
}