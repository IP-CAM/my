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
// | Tags.php  Version 2017/6/12  标签验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Page extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['name', 'require|unique:Page', '{%Page_name_must}|{%Page_name_repeat}'],
        ['theme', 'require', '{%Page_theme_must}'],
        ['style', 'require', '{%Page_style_must}'],
    ];
}