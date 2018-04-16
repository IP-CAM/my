<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Recharge.php  Version 2017/3/28 充值订单模型
// +----------------------------------------------------------------------
namespace app\order\model;

use app\common\model\Base;

class Recharge extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_RECHARGE__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
}