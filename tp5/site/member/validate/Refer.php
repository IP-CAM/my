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
// | Refer.php  Version 1.0  2017/5/24 咨询
// +----------------------------------------------------------------------
namespace app\member\validate;

use think\Validate;

class Refer extends Validate
{
    protected $rule = [
        ['user_id', 'require', '{%user_id_must}'],
        ['nickname', 'require|max:50', '{%nickname_must}|{%nickname_too_long}'],
        ['goods_id', 'require', '{%goods_id_must}'],
        ['goods_logo_url', 'require|max:200', '{%goods_logo_must}|{%url_too_long}'],
        ['question', 'require|max:500|chsDash', '{%question_must}|{%question_max}|{%question_chs}'],
    ];
}