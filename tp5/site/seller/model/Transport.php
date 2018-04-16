<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Transport.php  Version 2017/6/27
// +----------------------------------------------------------------------

namespace app\seller\model;

use think\Model;

class Transport extends Model
{
    protected $table = '__SELLER_TRANSPORT__';
    
    protected $type = [
        'fee_conf'=>'json',
        'fee_number_conf'=>'json',
        'fee_money_conf'=>'json',
        'free_conf'=>'json',
        'free_number_conf'=>'json',
    ];
    protected $autoWriteTimestamp = true;
    
    protected function setExpressIdsAttr($value){
        return implode(',',(array)$value);
    }
}
