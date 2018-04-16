<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Goods.php  Version 2017/7/26  订单商品子表
// +----------------------------------------------------------------------
namespace app\order\model;

use app\common\model\Base;

class Afterservice extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_AFTERSERVICE__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark: 关联订单商品表，获取商品的数据
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function goods()
    {
        return $this->hasOne('app\order\model\Goods','rec_id','rec_id','','LEFT');
    }
    
    /**
     * @Mark: 获取订单的关联商品
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function orderGoods(){
        return $this->hasMany('app\order\model\Goods','order_id','order_id');
    }
    
    /**
     * @Mark: 关联退款表
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function refund(){
        return $this->hasOne('app\order\model\Refund','rec_id','rec_id','','LEFT');
    }
    
    /**
     * @Mark: 关联订单表
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function getorder(){
        return $this->hasOne('app\order\model\Order','order_id','order_id','','LEFT');
    }
    
    /**
     * @Mark:  关联商户账号
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function sellerAccount(){
        return $this->hasOne('app\seller\model\Account','id','seller_id','','LEFT');
    }
    
    /**
     * @Mark:  关联商户店铺
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function sellerStore(){
        return $this->hasOne('app\seller\model\Store','seller_id','seller_id','','LEFT');
    }
    
    /**
     * @Mark:  关联会员信息
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function memberAccount(){
        return $this->hasOne('app\member\model\Account','id','user_id','','LEFT');
    }
    
    
    
    /**
     * @Mark: 状态重写
     * @param $value
     * @return int
     * @Author: WangHuaLong
     */
    protected function setStatusAttr($value)
    {
        return (int)$value;
    }
}