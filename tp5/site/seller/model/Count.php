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
// | Count.php  Version 1.0  2017/5/26
// +----------------------------------------------------------------------
namespace app\seller\model;

use app\common\model\Base;

class Count extends Base
{
    protected $table = '__SELLER_COUNT__';

    protected $autoWriteTimestamp = true;

    //关联order模块order表
    public function profile()
    {
        return $this->hasOne('\app\order\model\Order');
    }

    
}