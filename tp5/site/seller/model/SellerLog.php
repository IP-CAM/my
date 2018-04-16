<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | SellerLog.php  Version 2017/8/2
// +----------------------------------------------------------------------

namespace app\seller\model;

use app\common\model\Base;

class SellerLog extends Base
{
    protected $table='__SELLER_LOG__';
    protected $insert = ['log_time','log_ip'];
    
    protected function setLogTimeAttr($value){
        return time();
    }
    
    protected function setLogIpAttr($value){
        return ipToInt(get_client_ip());
    }
}
