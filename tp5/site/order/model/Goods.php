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

class Goods extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ORDER_GOODS__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    
    /**
     * @Mark: 关联售后表
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function afterservice()
    {
        return $this->hasOne('app\order\model\Afterservice','rec_id','rec_id','','LEFT');
    }
}