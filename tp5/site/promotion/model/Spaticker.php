<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Spa.php  Version 2017/3/27 提货券模型
// +----------------------------------------------------------------------
namespace app\promotion\model;

use app\common\model\Base;

class Spaticker extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__PROMOTION_SPATICKER__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['begin_time', 'end_time', 'status', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:可用开始时间
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setBeginTimeAttr($value)
    {
        return strtotime($value);
    }
    
    /**
     * @Mark:可用结束时间
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setEndTimeAttr($value)
    {
        return getforever($value);
    }
}