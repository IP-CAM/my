<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Ads 验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\union\validate;
use think\Validate;

class Ads extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['name', 'require', '{%Brand_Name_must}'],
        ['name', 'unique:Brand', '{%Brand_Name_repeat}'],
        //['url', 'require', '{%Brand_url_must}'],
        ['url', 'url', '{%Brand_url_rule_error}'],
        ['logo', 'require', '{%Brand_logo_must}'],
        ['description', 'length:0,5000', '{%Brand_desc_betwen2w}'],
    ];
}