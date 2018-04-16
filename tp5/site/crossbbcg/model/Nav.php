<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Nav.php  Version 2017/3/23  跨境商城导航管理器
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class Nav extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_NAV__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['status', 'begin_time', 'end_time', 'isadsense', 'isrecommend'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:开始时间
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setBeginTimeAttr($value)
    {
        return strtotime($value);
    }
    
    /**
     * @Mark:结束时间
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setEndTimeAttr($value)
    {
        return getforever($value);
    }
    
    /**
     * @Mark:是否广告
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsadsenseAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsrecommendAttr($value)
    {
        return autostatus($value);
    }
}