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
// | NationalPavilion 验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;
use think\Validate;

class NationalPavilion extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require', '{%NationalPavilion_Name_must}'],
        ['country_id', 'gt:0', '{%NationalPavilion_country_id_must}'],
        ['name', 'unique:NationalPavilion', '{%NationalPavilion_Name_repeat}'],
        ['name', 'length:0,60', '{%NationalPavilion_Name_Limit60}'],
        ['thumb', 'require', '{%NationalPavilion_thumb_must}'],
        ['banner_image', 'require', '{%NationalPavilion_banner_image_must}'],
    ];
}