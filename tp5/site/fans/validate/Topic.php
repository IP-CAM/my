<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Topic.php  Version 2017/6/29 圈子话题管理验证器
// +----------------------------------------------------------------------
namespace app\fans\validate;

use think\Validate;

class Topic extends Validate
{
    // 验证规则
    protected $rule = [
        //数据库标识/名称验证
        ['title', 'require', '{%Topic_title_must}'],
        ['uid', 'require', '{%Topic_user_must}'],
        ['circle_id', 'require', '{%Topic_circle_must}'],
        ['title', 'unique|Topic', '{%Topic_title_report}'],
    ];
}