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
// | Express.php  Version 2017/3/19  快递验证器
// +----------------------------------------------------------------------
namespace app\bcwareexp\validate;

use think\Validate;

class Express extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require', '{%Express_title_must}'],
        ['title', 'unique:Express', '{%Express_title_repeat}'],
        ['code', 'require', '{%Express_code_must}'],
        ['code', 'alphaDash', '{%Express_code_rule_error}'],
        ['code', 'unique:Express', '{%Express_code_repeat}'],
        ['website', 'url', '{%Express_website_error}'],
        ['checkurl', 'url', '{%Express_checkurl_error}'],
    ];
}