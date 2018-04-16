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
// | Feedback.php  Version 意见反馈  2017/5/25
// +----------------------------------------------------------------------
namespace app\seller\model;
use app\common\model\Base;

class Feedback extends Base
{
    protected $table = '__SELLER_FEEDBACK__';
    protected $insert = ['create_time','langid','user_ip'];

    protected $update = ['check_time'];

    protected function setCreateTimeAttr($value){
        return time();
    }

    protected function setCheckTimeAttr($value){
        return time();
    }

    protected function setLangidAttr($value){
        return getlangid($value);
    }

    protected function setUserIpAttr($value){
        return ipToInt(get_client_ip());
    }

}