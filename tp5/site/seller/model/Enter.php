<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Enter.php  Version 2017/4/2 入驻申请
// +----------------------------------------------------------------------
namespace app\seller\model;

use app\common\model\Base;
use app\seller\model\Seller;

class Enter extends Base
{
    protected $table = '__SELLER_SELLER__';

    public function account()
    {
        return $this->hasOne('Account','seller_id','id');
    }
}