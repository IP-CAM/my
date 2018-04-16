<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Offshop.php  Version 2017/5/31 线下门店
// +----------------------------------------------------------------------
namespace app\seller\model;

use app\Common\model\Base;

class Offshop extends Base
{
    protected $table = '__SELLER_OFFSHOP__';
    
    protected $insert = ['create_time','langid'];
    
    protected function setCreateTimeAttr($value){
        return time();
    }
    
}
