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

use app\common\model\Base;

class Order extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_ORDER__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    public function getCancelTimeAttr($value){
        return date('Y-m-d H:i:s',$value);
    }
    
    
    /**
     * @Mark: 关联订单商品模型
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function goods(){
        return $this->hasMany('app\order\model\Goods','order_id','order_id');
    }
    
    /**
     * @Mark: 关联店铺
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function store(){
        return $this->hasOne('app\seller\model\Store','seller_id','seller_id','','LEFT');
    }
    
    /**
     * @Mark: 关联会员
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function user(){
        return $this->hasOne('app\member\model\Account','id','user_id','','LEFT');
    }
    
    /**
     * @Mark: 订单状态可修改
     * @param $value
     * @return mixed
     * @Author: WangHuaLong
     */
    protected function setStatusAttr($value)
    {
        return $value;
    }
    
    
}