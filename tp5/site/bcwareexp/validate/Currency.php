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
// | Category.php  Version 2017/6/8
// +----------------------------------------------------------------------
namespace app\bcwareexp\validate;

use think\Validate;

class Currency extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['name', 'require|length:0,20|alpha|unique:Currency', '{%Cur_name_must}|{%Cur_langstr_length}|{%Cur_name_rule}|{%Cur_name_repeat}'],
        ['langstr', 'require|length:0,30|unique:Currency', '{%Cur_langstr_must}|{%Cur_langstr_length}|{%Cur_langstr_length}|{%Cur_langstr_repeat}'],
        ['symbol', 'require', '{%Cur_symbol_must}'],
        ['code', 'require', '{%Cur_code_must}'],
        ['rate', 'require', '{%Cur_rate_must}'],
        ['place', 'require', '{%Cur_place_must}'],
        ''          => 'require',
        ''         => 'require',
    ];
}