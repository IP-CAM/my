<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Reply.php  Version 2017/5/22
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Reply extends Validate
{
    //验证规则
    protected $rule = [
        ['refer_id', 'require', '{%Refer_id_must}'],
        ['answer', 'require|chsDash|max:500', '{%answer_must}|{%answer_chsDash}|{%answer_max}'],
    ];
}