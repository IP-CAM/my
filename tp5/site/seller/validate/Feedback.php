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
// | Feedback.php  Version 意见反馈  2017/5/26
// +----------------------------------------------------------------------

namespace app\seller\validate;

use think\Validate;

class Feedback extends Validate
{
    protected $rule = [
        ['seller_id','require','{%id_must}'],
        ['seller_name','require','{%realname_must}'],
        ['content','require|max:500','{%f_content_must}|{%f_content_too_long}'],
        ['handling_content','require|max:500','{%handling_must}|{%handling_too_long}'],
        ['operator','require','{%operator_must}'],
        ['operator_id','require','{%operatorId_must}'],
        ['mobile','require|^1[34578]\d{9}$','{%mobile_must}|{%mobile_format_error}'],
        ['email','email','{%email_error}'],
    ];

    protected $scene = [
        'insert'    =>  ['seller_id','seller_name','content','mobile','email'],
        'update'    =>  ['handling_content','operator','operator_id']
    ];
}