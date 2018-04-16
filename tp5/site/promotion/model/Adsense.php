<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Adsense.php  Version 2017/3/29
// +----------------------------------------------------------------------
namespace app\promotion\model;

use app\common\model\Base;

class Adsense extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__PROMOTION_ADSENSE__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['begin_time', 'end_time', 'isrecommend', 'istop', 'status', 'langid', 'uid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:开始时间
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
     * @Mark:结束时间
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setEndTimeAttr($value)
    {
        return strtotime($value);
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setIsrecommendAttr($value)
    {
        return strtotime($value);
    }
    
    /**
     * @Mark:是否置顶
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setIstopAttr($value)
    {
        return strtotime($value);
    }
    
    /**
     * @Mark:返回操作者ID
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    protected function setUidAttr($value)
    {
        return UID;
    }
}