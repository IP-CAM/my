<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Refund.php  Version 2017/3/28 退款
// +----------------------------------------------------------------------
namespace app\order\model;

use app\common\model\Base;

class Refund extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_REFUND__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark: 关联订单表
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function getOrder(){
        return $this->hasOne('app\order\model\Order','order_id','order_id','','LEFT');
    }
    
    /**
     * @Mark:  关联售后表
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function afterservice(){
        return $this->hasOne('app\order\model\Afterservice','after_sn','after_sn','','LEFT');
    }
    
    /**
     * @Mark: 完成退款时间
     * @param $value
     * @return false|string
     * @Author: WangHuaLong
     */
    public function getRefundTimeAttr($value){
        return date('Y-m-d H:i:s',$value);
    }
}
