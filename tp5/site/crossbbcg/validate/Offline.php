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
// | Offline 验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;
use think\Validate;

class Offline extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require', '{%Offline_title_must}'],
        ['title', 'unique:Offline', '{%Offline_title_repeat}'],
        ['tel', 'require', '{%Offline_tel_must}'],
        ['description', 'length:0,240', '{%Offline_description_240}'],
        ['address', 'require', '{%Offline_address_must}'],
        ['address', 'length:5,100', '{%Offline_address_5_120}'],
        ['contents', 'length:0,20000', '{%Offline_contents_2w}'],
    ];
}