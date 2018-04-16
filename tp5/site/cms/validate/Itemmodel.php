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
// |  Version 2017/3/22 分类模型验证器
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

class Itemmodel extends Validate
{
    // 验证规则
    protected $rule = [
        ['iden', 'require|unique:Itemmodel', '{%Itemmodel_iden_must}|{%Itemmodel_iden_repeat}'],
        ['attr_id', 'require', '{%Itemmodel_attr_must}'],
        ['type_id', 'require', '{%Itemmodel_type_must}'],
    ];
    
}