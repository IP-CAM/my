<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Refund.php  Version 2017/7/25  退款单
// +----------------------------------------------------------------------
namespace app\stools\model;

use app\common\model\Base;

class RefundBill extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__STOOLS_REFUND_BILL__';
    protected $autoWriteTimestamp = true;
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
}