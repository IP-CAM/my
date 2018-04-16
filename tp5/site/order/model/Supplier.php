<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Order.php  Version 2017/3/28 订单模型
// +----------------------------------------------------------------------
namespace app\order\model;

use think\Db;
use app\common\model\Base;

class Supplier extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_SUPPLIER__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
}