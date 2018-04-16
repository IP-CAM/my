<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Yugou.php  Version 2017/3/27 云购
// +----------------------------------------------------------------------
namespace app\promotion\validate;

use think\Validate;

class Yugou extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require', '{%Brand_Name_must}'],
        ['name', 'unique:Brand', '{%Brand_Name_repeat}'],
        ['alias', 'unique:Brand', '{%Brand_alias_repeat}'],
        //['url', 'require', '{%Brand_url_must}'],
        ['url', 'url', '{%Brand_url_rule_error}'],
        ['logo', 'require', '{%Brand_logo_must}'],
        ['description', 'length:0,5000', '{%Brand_desc_betwen2w}'],
    ];
}