<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | ShopAttention.php  Version 2017/6/29
// +----------------------------------------------------------------------

namespace app\seller\model;

use think\Model;
use think\Db;

class ShopAttention extends Model
{
    protected $table = '__SELLER_SHOP_ATTENTION__';
    
    protected $insert = ['create_time','create_day'];
    
    
    protected $store_table = '__SELLER_STORE__';
    
    protected function setCreateTimeAttr($value){
        return time();
    }
    
    protected function setCreateDay($value){
        return date('Y-m-d',time());
    }
    
    /**
     * @Mark:
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function store(){
        return $this->hasOne('app\seller\model\Store','id','store_id','','LEFT');
    }
}
