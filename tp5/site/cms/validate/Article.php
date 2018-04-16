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
// | Pagecat.php  Version 2017/6/7 文章验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Article extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require|length:0,80|unique:Article', '{%Art_title_must}|{%Art_title_length}|{%Art_title_repeat}'],
        ['category_id', 'require', '{%Art_category_must}'],
        ['contents', 'require', '{%Art_content_must}'],
    ];
}