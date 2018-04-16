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
// | Nav.php  Version 2017/3/23  导航验证器
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;

class Nav extends Validate
{
    // 验证规则
    protected $rule = [
        ['type', 'require', '{%Bbcgnav_type_must}'],
        ['url', 'require', '{%Bbcgnav_url_must}'],
        ['title', 'require', '{%Bbcgnav_title_must}'],
        ['title', 'unique:Nav', '{%Bbcgnav_title_repeat}'],
        ['url', 'url', '{%url_rule_error}'],
        ['url', 'require', '{%url_require}'],
    ];
}