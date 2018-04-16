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
// | Posid.php  Version 2017/3/22 推荐位验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Posid extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require|unique:Posid', '{%Posid_title_must}|{%Posid_title_repeat}'], //名称
    ];
    
}