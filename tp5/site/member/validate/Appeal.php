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
// | yang.php  Version 1.0  2017/5/24  申诉
// +----------------------------------------------------------------------

namespace app\member\validate;

use think\Validate;

class Appeal extends Validate
{
    protected $rule =[
        ['handling_content','require','{%handling_must}'],
        ['operator','require','{%operator_must}'],
    ];
}