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
// | Area.php  Version 2017/6/9  区域管理验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Zone extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['name', 'require|unique:Zone', '{%Area_name_must}|{%Area_name_must}'],//地区名称
    ];
}